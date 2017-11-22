<?php

namespace MitsubishiMotors\Controllers;

use MitsubishiMotors\Traits\GlobalVariables;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\HTTPRequest;
use MitsubishiMotors\Traits\VehicleHubCommunicationTrait;
use MitsubishiMotors\Constants\VehicleHubURIs;
use GuzzleHttp\RequestOptions;
use Exception;
use MitsubishiMotors\Traits\ReusableMethods;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;
use SilverStripe\Core\Injector\Injector;


/**
 * Class SpecController
 * @package MitsubishiMotors\Controllers
 */
class SpecController extends ContentController
{
    use VehicleHubCommunicationTrait, GlobalVariables, ReusableMethods;

    /**
     * @var array
     */
    private static $allowed_actions = [
        'full'
    ];

    /**
     * @param HTTPRequest $request
     * @return array
     */
    public function index(HTTPRequest $request)
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        $model = $this->getRequest()->param('Model');

        $query = <<<GRAPHQL
        {
  models(slug: "$model") {
    id
    name
    logo
    slug
    defaultRightAngleClearCut
    defaultSwatchColour
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
    specs
    vehicleId
  }
}
GRAPHQL;

        try {

            $response = $this->getClient()->post(VehicleHubURIs::GET_MODELS, [
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
            $list = Injector::inst()->create(ArrayList::class);

            if (isset($data['data']['models']) && is_array($data['data']['models'])) {
                $models = $data['data']['models'];

                if (is_array($models)) {
                    foreach ($models as $model) {

                        if (count($model['uniqueSpecs'])) {
                            if (is_array($model['uniqueSpecs'])) {
                                $uniqueSpecList = ArrayList::create();
                                foreach ($model['uniqueSpecs'] as $spec) {

                                    $uniqueSpecList->push(ArrayData::create($spec));
                                }
                                $model['uniqueSpecs'] = $uniqueSpecList;
                            }

                        }

                        if (count($model['specLabels'])) {
                            if (is_array($model['specLabels'])) {
                                $specLabelList = ArrayList::create();
                                foreach ($model['specLabels'] as $label) {
                                    $specLabelList->push(ArrayData::create($label));
                                }

                                $model['specLabels'] = $specLabelList;
                            }
                        }

                        // JSON decode the specs and then loop through them and format the groups and categories
                        if (isset($model['specs'])) {

                            $listOfSpecs = ArrayList::create();

                            $data = json_decode($model['specs'], true);

                            ksort($data);

                            foreach ($data as $order => $group) {

                                foreach ($group as $groupName => $categoriesList) {

                                    $categories = ArrayList::create();

                                    foreach ($categoriesList as $categoryName => $categoriesData) {
                                        $categories->push([
                                            'categoryName' => $categoryName,
                                            'categories' => ArrayList::create($categoriesData)
                                        ]);
                                    }

                                    $listOfSpecs->push([
                                        'groupName' => $groupName,
                                        'categories' => $categories
                                    ]);
                                }
                            }

                            $model['specs'] = $listOfSpecs;
                        }

                        if (isset($model['vehicleId'])) {
                            $model['lifeStyleImage'] = $this->getVehicleLifeStyleImageLink($model['vehicleId']);
                            $model['defaultColour'] = $this->getVehicleDefaultColour($model['vehicleId']);
                        }

                        $list->push(ArrayData::create($model));
                    }
                }

                return $list;

            }

        } catch (Exception $e) {
            $this->handleVehicleHubCommunicationException($e);
        }
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return 'Model Specifications';
    }
}
