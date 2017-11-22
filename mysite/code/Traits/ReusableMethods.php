<?php

namespace MitsubishiMotors\Traits;

use MitsubishiMotors\Pages\VehiclePage;
use SilverStripe\Assets\Image;
use GuzzleHttp\RequestOptions;
use MitsubishiMotors\Auth\GraphQLAuthenticationController;
use MitsubishiMotors\Constants\VehicleHubURIs;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\ArrayList;
use Exception;

/**
 * Class ReusableMethods
 * @package MitsubishiMotors\Traits
 */
trait ReusableMethods
{
    /**
     * TODO If two or more VehiclePage pages are assigned the same vehicle from the hub ...
     * TODO ... then it gets the first one - do we need some validation to make sure ...
     * TODO ... vehicles from the hub can only be added to one page?
     *
     * @param $vehicleIDFromHub
     * @return string
     */
    private function getVehicleLifeStyleImageLink($vehicleIDFromHub)
    {
        $vehicleFromCMS = VehiclePage::get()->filter('HubVehicleId', $vehicleIDFromHub)->first();
        $lifeStyleImageLink = '';

        if ($vehicleFromCMS instanceof VehiclePage && $vehicleFromCMS->exists()) {

            $lifeStyleImage = $vehicleFromCMS->LifeStyleImage();
            if ($lifeStyleImage instanceof Image && $lifeStyleImage->exists()) {
                $lifeStyleImageLink = $lifeStyleImage->Link();
            }
        }

        return $lifeStyleImageLink;
    }

    /**
     * TODO AS PER TODO FOR getVehicleLifeStyleImageLink
     * TODO (because if a hub vehicle is assigned to 2 vehicle pages the data will come form the first)
     *
     * @param $vehicleIDFromHub
     * @return string
     */
    private function getVehicleDefaultColour($vehicleIDFromHub)
    {
        $vehicleFromCMS = VehiclePage::get()->filter('HubVehicleId', $vehicleIDFromHub)->first();
        $defaultColour = '';

        if ($vehicleFromCMS instanceof VehiclePage && $vehicleFromCMS->exists()) {
            $defaultColour = $vehicleFromCMS->DefaultColour;
        }

        return $defaultColour;
    }

    /**
     * @return formmatted string without break line
     */
    public function removeBreakline($string)
    {
        return str_replace(array("\r", "\n"), '', $string);
    }

    /**
     * Method to get data from vehicle pages and the vehicles they are linked to in the hub to build the vehicle menu
     *
     * @return static
     */
    public function getVehicleMenu()
    {
        $query = $this->vehicleQuery();

        $vehicles = ArrayList::create();

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
                    $logger->notice('Errors from GraphQL, vehicle page ', $errors);
                }
            }

            if (isset($data['data']) && isset($data['data']['vehicles'])) {

                foreach ($data['data']['vehicles'] as $vehicle) {

                    $vehiclePage = VehiclePage::get()->filter('HubVehicleId', $vehicle['id'])->first();

                    if ($vehiclePage instanceof VehiclePage && $vehiclePage->exists()) {
                        $vehicles->push([
                            'Title' => $vehiclePage->Title,
                            'Link' => $vehiclePage->Link(),
                            'Image' => $vehicle['rightClearCut'],
                            'HasPromotion' => $vehicle['hasPromotion']
                        ]);
                    }
                }
            }

            return $vehicles;

        } catch (Exception $e) {
            $this->handleVehicleHubCommunicationException($e);
        }
    }

    /**
     * @return mixed
     */
    protected function graphAuthToken()
    {
        // get it or set it handled in Authenticator
        /** @var GraphQLAuthenticationController $authenticator */
        $authenticator = Injector::inst()->create(GraphQLAuthenticationController::class);

        return $authenticator->getAuthenticationToken();
    }

    /**
     * @return string
     */
    private function vehicleQuery()
    {
        $query = <<<GRAPHQL
    {
        vehicles {
            id
            hasPromotion
            rightClearCut
        }
    }
GRAPHQL;

        return $query;
    }
}
