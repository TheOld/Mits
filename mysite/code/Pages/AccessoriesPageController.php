<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\Traits\VehicleHubCommunicationTrait;
use SilverStripe\CMS\Controllers\ContentController;
use MitsubishiMotors\Forms\AccessoriesWishListForm;
use SilverStripe\Control\HTTPRequest;
use GuzzleHttp\RequestOptions;
use Exception;
use MitsubishiMotors\Constants\VehicleHubURIs;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;


/**
 * Class AccessoriesPageController
 * @package MitsubishiMotors\Pages
 */
class AccessoriesPageController extends ContentController
{
    use VehicleHubCommunicationTrait;

    /**
     * @var array
     */
    private static $allowed_actions = [
        'AccessoriesWishListForm',
        'submit',
        'success',
        'vehicle',
        'summary'
    ];

    /**
     * @return mixed
     */
    public function AccessoriesWishListForm()
    {
        return AccessoriesWishListForm::create($this, 'AccessoriesWishListForm');
    }

    /**
     * @param HTTPRequest $request
     * @return $this|\SilverStripe\Control\HTTPResponse
     */
    public function success(HTTPRequest $request)
    {
        // return to index if session identifier for form submission not set
        $submitted = $request->getSession()->get(AccessoriesWishListForm::SESSION_IDENTIFYIER . $this->ID . 'submitted');

        if (!$submitted) {
            return $this->redirect($this->Link());
        }

        $request->getSession()->clear(AccessoriesWishListForm::SESSION_IDENTIFYIER . $this->ID . 'submitted');

        return $this;
    }

    /**
     * @return ArrayList
     */
    public function getStepData($step = null)
    {
        if (is_null($step)) {
            $step = $this->urlParams['Action'];
        }

        switch ($step) {
            case 'vehicle':
                $query = $this->getAccessoriesStepQuery();
                break;

            default:
                $query = $this->getVehicleStepQuery();
                break;
        }

        try {

            $response = $this->getClient()->post(VehicleHubURIs::GET_VEHICLES, [
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

                    return $data['data']['vehicles'];
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
        outline
        defaultClearCut
    }
}
GRAPHQL;
    }

    /**
     * @return string
     */
    private function getAccessoriesStepQuery()
    {
        $vehicle = $this->urlParams['ID'];

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
            category {
                id
                name
            }
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
     * @return static
     */
    public function getVehicles()
    {
        $vehicleHubData = $this->getStepData();

        // We have vehicle data from the hub but we also need some data from the CMS
        foreach ($vehicleHubData as &$vehicle) {

            $vehicle['defaultColour'] = '';
            $vehicleFromCMS = VehiclePage::get()->filter('HubVehicleId', $vehicle['id'])->first();

            if ($vehicleFromCMS instanceof VehiclePage && $vehicleFromCMS->exists()) {
                $vehicle['defaultColour'] = $vehicleFromCMS->DefaultColour;
            }
        }

        return ArrayList::create($vehicleHubData);
    }

    /**
     * @return mixed
     */
    public function getGroupedAccessories()
    {
        $groupedList = Injector::inst()->create(ArrayList::class);
        $vehicleHubData = $this->getStepData();

        if (!is_null($vehicleHubData)) {
            $vehicle = $vehicleHubData[0];

            if (is_array($vehicle)) {
                $vehicle = new ArrayData($vehicle);
            }

            $groupedAccessories = [];

            if (isset($vehicle->accessoryPacks)) {
                if (is_array($vehicle->accessoryPacks)) {

                    foreach ($vehicle->accessoryPacks as $accessoryPack) {

                        if (is_array($accessoryPack['accessories'])) {
                            $packAccessories = ArrayList::create();

                            foreach ($accessoryPack['accessories'] as $accessory) {
                                $packAccessories->push(ArrayData::create($accessory));
                            }

                            $accessoryPack['accessories'] = $packAccessories;
                        }
                        // create all category
                        $groupedAccessories['all']['accessories'][] = ArrayData::create($accessoryPack);
                        // create accessory Packs category
                        $groupedAccessories['packs']['accessories'][] = ArrayData::create($accessoryPack);
                    }
                }

            }

            if (isset($vehicle->accessories)) {
                if (is_array($vehicle->accessories)) {

                    foreach ($vehicle->accessories as $accessory) {
                        if (count($accessory['category'])) {
                            if (is_array($accessory['category']) && isset($accessory['category']['name'])) {
                                // create all category
                                $groupedAccessories['all']['accessories'][] = ArrayData::create($accessory);
                                // other categories
                                $groupedAccessories[$accessory['category']['name']]['accessories'][] = ArrayData::create($accessory);
                            }
                        }
                    }


                }
            }


            foreach ($groupedAccessories as $category => $list) {
                $groupedList->push([
                    'category' => $category,
                    'accessories' => ArrayList::create($list['accessories'])
                ]);
            }

        }

        return $groupedList;
    }

    /**
     * @return mixed
     */
    public function getVehicleName()
    {
        $vehicleHubData = $this->getStepData();

        if (!is_null($vehicleHubData)) {
            $vehicle = $vehicleHubData[0];
        }

        return $vehicle['name'];
    }
}
