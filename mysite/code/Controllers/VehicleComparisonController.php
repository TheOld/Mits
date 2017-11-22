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
 * Class VehicleComparisonController
 * @package MitsubishiMotors\Controllers
 */
class VehicleComparisonController extends ContentController
{
    use VehicleHubCommunicationTrait, GlobalVariables, ColourHelper, ReusableMethods;

    /**
     * @var array
     */
    private static $allowed_actions = [
        'select',
        'compare'
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
            return $this->redirect($request->getURL() . '/select');
        }
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Vehicle Comparison Tool';
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
            case 'select':
                $query = $this->getSelectStepQuery();
                break;

            case 'compare':
                $query = $this->getCompareStepQuery();
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
                    $logger->notice('Errors from GraphQL, vehicle comparison controller ', $errors);
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

        } catch (Exception $e) {
            $this->handleVehicleHubCommunicationException($e);
        }
    }

    /**
     * @return string
     */
    private function getSelectStepQuery()
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
    }
}
GRAPHQL;
    }

    /**
     * TODO will need to get two Models here to compare OR one model if you haven't yet selected second vehicle
     * @return string
     */
    private function getCompareStepQuery()
    {
        $request = $this->getRequest();
        $model = $request->param('Model1');

        return <<<GRAPHQL
{
    models (slug: "{$model}") {
        id
        name
        slug
        logo
        vehicleId
        swatches {
            id
            name
            colour
            slug
            path360s
            extension360s
            total360s
            start360s
            rightAngleClearCut
        }
        defaultSwatch {
            name
            colour
            path360s
            extension360s
            total360s
            start360s
            rightAngleClearCut
        }
        defaultAngleImage
        defaultRightAngleClearCut
        rrp
        onPromotion
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
        if ($step == 'compare' ) {
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
            case 'select':

                // We have vehicle data from the hub but we also need some data from the CMS
                foreach ($vehicleData as &$vehicle) {

                    $vehicle['defaultColour'] = '';
                    $vehicle['lifeStyleImage'] = $this->getVehicleLifeStyleImageLink($vehicle['id']);

                    $vehicleFromCMS = VehiclePage::get()->filter('HubVehicleId', $vehicle['id'])->first();

                    if ($vehicleFromCMS instanceof VehiclePage && $vehicleFromCMS->exists()) {
                        $vehicle['defaultColour'] = $vehicleFromCMS->DefaultColour;
                    }
                }

                $stepData = ArrayList::create($vehicleData);

                break;

            case 'compare':



                break;


        }

//        Debug::dump($stepData);die;

        return $stepData;
    }

    public function getCurrentLink()
    {

    }
}
