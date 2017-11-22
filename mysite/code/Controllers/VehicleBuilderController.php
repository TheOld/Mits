<?php

namespace MitsubishiMotors\Controllers;


use Heyday\SilverStripe\WkHtml\Output\TextString;
use Knp\Snappy\Pdf;
use SilverStripe\Assets\Folder;
use SilverStripe\Control\Email\Email;
use SilverStripe\Dev\Debug;
use GuzzleHttp\RequestOptions;
use Exception;
use MitsubishiMotors\Constants\VehicleHubURIs;
use MitsubishiMotors\DataObjects\VehicleBuilder;
use MitsubishiMotors\Pages\VehiclePage;
use MitsubishiMotors\Traits\GlobalVariables;
use MitsubishiMotors\Traits\ReusableMethods;
use MitsubishiMotors\Traits\VehicleHubCommunicationTrait;
use MitsubishiMotors\Traits\ColourHelper;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Cookie;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\View\SSViewer;
use SilverStripe\Control\Director;
use SilverStripe\Assets\FileNameFilter;
use Heyday\SilverStripe\WkHtml\Generator;
use Heyday\SilverStripe\WkHtml\Input\Viewer;
use Heyday\SilverStripe\WkHtml\Output\File;


/**
 * Class VehicleBuilderController
 * @package MitsubishiMotors\Controllers
 */
class VehicleBuilderController extends ContentController
{
    use VehicleHubCommunicationTrait, GlobalVariables, ColourHelper, ReusableMethods;

    /**
     * @var array
     */
    private static $allowed_actions = [
        'vehicle',
        'configure',
        'colour',
        'accessories',
        'summary',
        'save'
    ];

    /**
     * @var \Knp\Snappy\Pdf
     */
    protected $snappyPDF;

    /**
     * @param \Knp\Snappy\Pdf $snappyPDF
     */
    public function setSnappyPDF(Pdf $snappyPDF)
    {
        $this->snappyPDF = $snappyPDF;
    }

    /**
     * @param HTTPRequest $request
     * @return \SilverStripe\Control\HTTPResponse
     */
    public function index(HTTPRequest $request)
    {
        $action = $request->param('Action');

        if (is_null($action)) {
            return $this->redirect($request->getURL() . '/vehicle');
        }
    }

    /**
     * @param HTTPRequest $request
     * @return \SilverStripe\View\ViewableData_Customised|string
     */
    public function save(HTTPRequest $request)
    {
        $data = $request->postVars();
        $summary = $this->getStepData('summary');

        $data = [
            'Name' => 'Ms Fin',
            'Email' => 'claire@heyday.co.nz',
            'Vehicle' => 'ASX',
            'Model' => 'asx 2.0 xls petrol 2wd',
            'Accessories' => '{1 TEST PART1234 TESTING {id name}}'
        ];

        $builder = $this->findOrCreateBuilder();
        $builder->update($data);
        $builder->write();

        $this->sendEmail($builder, $summary);

        if ($this->getRequest()->isAjax()) {

            return json_encode([
                "success" => true,
                "message" => "Vehicle builder saved",
                "type" => "good"
            ]);
        }

        return $this->customise([
            'Content' => 'Builder saved'
        ]);
    }

    /**
     * @return \SilverStripe\ORM\DataObject|static
     */
    public function findOrCreateBuilder()
    {
        // look for cookie
        $cookie = Cookie::get('vehicle_builder');

        // if not found then create the builder object and set the cookie with th eid returned
        if (!isset($cookie)) {

            $builder = VehicleBuilder::create();
            $builder->write();

            /** @var  $expires  In 1 Day */
            $expires = time() + 60 * 60 * 24 * 1;
            setcookie('vehicle_builder', $builder->ID, $expires);

            $cookie = Cookie::get('vehicle_builder');

        } else {
            $builder = VehicleBuilder::get()->byID($cookie);
        }

        return $builder;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Vehicle Builder';
    }

    /**
     * @return string|ArrayList
     */
    public function getStepData($step = null)
    {
        if (is_null($step)) {
            $step = $this->urlParams['Action'];
        }

        switch ($step) {
            case 'vehicle':
                $query = $this->getVehicleStepQuery();
                break;

            case 'configure':
                $query = $this->getConfigureStepQuery();
                break;

            case 'colour':
                $query = $this->getColourStepQuery();
                break;

            case 'accessories':
                $query = $this->getAccessoriesStepQuery();
                break;

            case 'summary':
                $query = $this->getSummaryStepQuery();
                break;
        }

        try {

            $response = $this->getClient()->post($this->determineHubEndpoint($step), [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->getAuthenticationToken(),
                    'Accept' => 'application/json'
                ],
                RequestOptions::JSON => [
                    'query' => $query
                ]
            ]);

            if (!$response->getStatusCode() == '200') {
                throw new Exception("Got this bad response code: {$response->getStatusCode()}");
            }

            $data = json_decode($response->getBody(), true);

            // log errors in response json
            if (isset($data['errors'])) {
                if (count($errors = $data['errors'])) {
                    /** @var \Monolog\Logger $logger */
                    $logger = Injector::inst()->create('Logger');
                    $logger->notice('Errors from GraphQL, vehicle builder controller ', $errors);
                }
            }

            if (isset($data['data'])) {

                if (isset($data['data']['vehicles'])
                    && isset($data['data']['vehicles'][0])
                    && is_array($data['data']['vehicles'][0])
                ) {

                    return $this->buildArrayList($step, $data['data']['vehicles']);
                }
            }

            if (isset($data['data'])) {

                if (isset($data['data']['models'])
                    && isset($data['data']['models'][0])
                    && is_array($data['data']['models'][0])
                ) {
                    return $this->buildArrayList($step, $data['data']['models'][0]);
                }
            }

        } catch (Exception $e) {
            $this->handleVehicleHubCommunicationException($e);
        }
    }

    /**
     * @return string
     */
    private function getVehicleStepQuery()
    {
        return <<<GRAPHQL
{
    vehicles {
        id
        name
        logo
        slug
        lowestRRP
        defaultModel {
            defaultRightAngleClearCut
        }
        defaultSwatchWith360s
        outline
        defaultClearCut
    }
}
GRAPHQL;
    }

    /**
     * @return string
     */
    private function getConfigureStepQuery()
    {
        $request = $this->getRequest();
        $vehicle = $request->param('Vehicle');

        // TODO the vehicle name needs to be dynamic and represent the vehicle the user has already chosen
        return <<<GRAPHQL
{
    vehicles (slug: "{$vehicle}") {
        id
        name
        slug
        searchFilters {
            id
            name
        }
        models {
            id
            name
            slug
            defaultAngleImage
            defaultRightAngleClearCut
            searchFilters {
                id
                name
            }
            uniqueSpecs {
                id
                name
                icon
            }
            rrp
            onPromotion
            co2
            fuelConsumption
            crashRatingProvider
            crashRatingStars
        }
    }
}
GRAPHQL;
    }

    /**
     * @return string
     */
    private function getColourStepQuery()
    {
        $request = $this->getRequest();
        $model = $request->param('Model');

        return <<<GRAPHQL
{
    models (slug: "{$model}") {
        id
        name
        slug
        logo
        vehicleId
        swatchesWith360s
        defaultSwatchWith360s
        defaultAngleImage
        defaultRightAngleClearCut
        rrp
        onPromotion
    }
}
GRAPHQL;
    }

    /**
     * @return string
     */
    private function getAccessoriesStepQuery()
    {
        $request = $this->getRequest();
        $vehicle = $request->param('Vehicle');

        return <<<GRAPHQL
{
    vehicles (slug: "{$vehicle}") {
        id
        name
        slug
        logo
        accessories {
            id
            name
            description
            rrp
            image
        }
        accessoryPacks {
            id
            name
            description
            rrp
            image
            accessories {
                id
                name
                description
                image
                rrp
            }
        }
    }
}
GRAPHQL;
    }

    /**
     * @return string
     */
    private function getSummaryStepQuery($model = null)
    {
        if (is_null($model)) {

            $request = $this->getRequest();
            $model = $request->param('Model');
        }

        return <<<GRAPHQL
{
    models (slug: "{$model}") {
        id
        name
        logo
        uniqueSpecs {
            id
            name
            icon
        }
        specLabels {
            id
            name
            group
            category
            value
        }
        defaultRightAngleClearCut
        specs
        vehicleId
    }
}
GRAPHQL;
    }

    /**
     * @param $step
     * @return string
     */
    private function determineHubEndpoint($step)
    {
        if ($step == 'summary' || $step == 'colour') {
            return VehicleHubURIs::GET_MODELS;
        }

        return VehicleHubURIs::GET_VEHICLES;
    }

    /**
     * This method builds up an array list with array data and array lists for SilverStripe template looping
     *
     * @param $step
     * @param $vehicleData
     * @return ArrayList
     */
    private function buildArrayList($step, $vehicleData)
    {
        $stepData = ArrayList::create();

        switch ($step) {
            case 'vehicle':

                // We have vehicle data from the hub but we also need some data from the CMS
                foreach ($vehicleData as &$vehicle) {

                    $vehicle['defaultColour'] = '';
                    $vehicle['lifeStyleImage'] = $this->getVehicleLifeStyleImageLink($vehicle['id']);

                    $vehicleFromCMS = VehiclePage::get()->filter('HubVehicleId', $vehicle['id'])->first();

                    if ($vehicleFromCMS instanceof VehiclePage && $vehicleFromCMS->exists()) {
                        $vehicle['defaultColour'] = $vehicleFromCMS->DefaultColour;
                    }


                    if (isset($vehicle['defaultSwatchWith360s'])) {
                        $vehicle['defaultSwatch'] = json_decode($vehicle['defaultSwatchWith360s'], true)[0];
                    }

                }

                $stepData = ArrayList::create($vehicleData);
                break;

            case 'configure':

                $vehicleData = $vehicleData[0];

                if (count($vehicleData['searchFilters'])) {
                    if (is_array($vehicleData['searchFilters'])) {
                        $searchFiltersList = ArrayList::create();
                        foreach ($vehicleData['searchFilters'] as $filter) {
                            $searchFiltersList->push(ArrayData::create($filter));
                        }
                        $vehicleData['searchFilters'] = $searchFiltersList;
                    }
                }

                if (isset($vehicleData['models'])) {

                    $models = ArrayList::create();

                    foreach ($vehicleData['models'] as $model) {

                        if (count($model['uniqueSpecs'])) {
                            if (is_array($model['uniqueSpecs'])) {
                                $uniqueSpecList = ArrayList::create();
                                foreach ($model['uniqueSpecs'] as $spec) {
                                    $uniqueSpecList->push(ArrayData::create($spec));
                                }
                                $model['uniqueSpecs'] = $uniqueSpecList;
                            }
                        }

                        if (count($model['searchFilters'])) {
                            if (is_array($model['searchFilters'])) {
                                $searchFiltersList = ArrayList::create();
                                foreach ($model['searchFilters'] as $filter) {
                                    $searchFiltersList->push(ArrayData::create($filter));
                                }
                                $model['searchFilters'] = $searchFiltersList;
                            }
                        }

                        $models->push($model);
                    }

                    $vehicleData['models'] = $models;
                }

                $stepData->push([
                    'id' => $vehicleData['id'],
                    'name' => $vehicleData['name'],
                    'slug' => $vehicleData['slug'],
                    'searchFilters' => $vehicleData['searchFilters'],
                    'models' => $vehicleData['models'],
                ]);

                break;

            case 'colour':

                // for this step we have retrieved 1 Model
                $lifeStyleImageLink = $this->getVehicleLifeStyleImageLink($vehicleData['id']);
                $swatchesArray = json_decode($vehicleData['swatchesWith360s'], true);

                if (!is_array($swatchesArray)) {
                    $swatchesArray = [];
                }

                $stepData->push(ArrayData::create([
                    'id' => $vehicleData['id'],
                    'name' => $vehicleData['name'],
                    'logo' => $vehicleData['logo'],
                    'rrp' => $vehicleData['rrp'],
                    'defaultAngleImage' => $vehicleData['defaultAngleImage'],
                    'defaultRightAngleClearCut' => $vehicleData['defaultRightAngleClearCut'],
                    'swatches' => ArrayList::create($swatchesArray),
                    'defaultSwatch' => ArrayData::create(json_decode($vehicleData['defaultSwatchWith360s'], true)[0]),
                    'lifeStyleImage' => $lifeStyleImageLink
                ]));

                break;

            case 'accessories':

                $accessories = [];
                $accessoryPacks = [];

                foreach ($vehicleData as $data) {

                    foreach ($data['accessories'] as $accessory) {
                        $accessories[] = ArrayData::create($accessory);
                    }

                    foreach ($data['accessoryPacks'] as $accessoryPack) {
                        $accessoryPack['accessories'] = ArrayList::create($accessoryPack['accessories']);
                        $accessoryPacks[] = $accessoryPack;
                    }
                }

                $stepData->push(ArrayData::create([
                    'accessories' => ArrayList::create($accessories),
                    'accessoryPacks' => ArrayList::create($accessoryPacks),
                    'logo' => $data['logo']
                ]));

                break;

            case 'summary':

                $uniqueSpecList = ArrayList::create();
                foreach ($vehicleData['uniqueSpecs'] as $spec) {
                    $uniqueSpecList->push(ArrayData::create($spec));
                }

                $specLabelList = ArrayList::create();
                foreach ($vehicleData['specLabels'] as $label) {
                    $specLabelList->push(ArrayData::create($label));
                }

                $specs = json_decode($vehicleData['specs'], true);
                $groupedSpecs = ArrayList::create();

                ksort($specs);

                foreach ($specs as $order => $group) {

                    foreach ($group as $groupName => $categoriesList) {

                        $categories = ArrayList::create();
                        foreach ($categoriesList as $categoryName => $categoriesData) {

                            $categories->push([
                                'categoryName' => $categoryName,
                                'categories' => ArrayList::create($categoriesData)
                            ]);
                        }

                        $groupedSpecs->push([
                            'groupName' => $groupName,
                            'categories' => $categories
                        ]);
                    }

                }

                $stepData->push([
                    'id' => $vehicleData['id'],
                    'name' => $vehicleData['name'],
                    'logo' => $vehicleData['logo'],
                    'uniqueSpecs' => $uniqueSpecList,
                    'specLabels' => $specLabelList,
                    'defaultRightAngleClearCut' => $vehicleData['defaultRightAngleClearCut'],
                    'lifeStyleImage' => $this->getVehicleLifeStyleImageLink($vehicleData['vehicleId']),
                    'defaultColour' => $this->getVehicleDefaultColour($vehicleData['vehicleId']),
                    'specs' => $groupedSpecs
                ]);

                break;
        }

//        Debug::dump($stepData);die;

        return $stepData;
    }

    // generate Summary PDF and save it to a temp folder in assets
    public function generatePDF($builder, $summary)
    {
        $viewer = Injector::inst()->create(
            SSViewer::class,
            Director::baseFolder() . '/themes/base/templates/PDFs/VehicleBuilderSummary.ss'
        );

        $generator = Injector::inst()->create(Generator::class,
            $this->snappyPDF,
            new Viewer($viewer, [
                'Builder' => $builder,
                'Summary' => $summary
            ]),
            new TextString()
        );

        // open a temporary file handle in memory
        $tmp_handle = fopen('php://temp', 'r+');
        fwrite($tmp_handle, $generator->process());

        // do some more stuff, then when you want the contents of your "file"
        rewind($tmp_handle);
        $file_contents = stream_get_contents($tmp_handle);

        //encode it with MIME base64,
        //and split it into smaller chunks
        $attachment = chunk_split(base64_encode($file_contents));

        // clean up your temporary storage handle
        fclose($tmp_handle);

        return $attachment;

    }

    /**
     *
     */
    public function sendEmail($builder, $summary)
    {
        $from = 'no-reply@mitsubishimotorsnewzealand';
        $to = $builder->Email;
        $subject = 'Your dream Mitsubishi.';

        $filter = FileNameFilter::create();
        $cleanTitle = $filter->filter('builder_' . $builder->id);

        /** @var Email $email */
        $email = Injector::inst()->create(Email::class, $from, $to, $subject);

        // set template
        $email->setHTMLTemplate('Emails/VehicleBuilderEmail.ss');
        //attache file
        $email->addAttachmentFromData($this->generatePDF($builder, $summary), $cleanTitle, 'application/pdf');

        if ($email->send()) {
            print_r('Looks like email was sent');
            die;
        } else {
            print_r('yeahNah!');
            die;
        }

    }


}
