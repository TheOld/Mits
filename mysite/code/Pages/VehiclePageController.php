<?php

namespace MitsubishiMotors\Pages;

use SilverStripe\Core\Injector\Injector;
use MitsubishiMotors\Traits\VehicleHubCommunicationTrait;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;


/**
 * Class VehiclePageController
 * @package MitsubishiMotors\Pages
 */
class VehiclePageController extends PageController
{
    use VehicleHubCommunicationTrait;

    /**
     * @return mixed
     */
    public function getModels()
    {
        $vehicleHubData = $this->getVehicleHubData();
        $list = Injector::inst()->create(ArrayList::class);

        if (!is_null($vehicleHubData)) {

            $vehicle = $vehicleHubData->first();

            // TODO Without calling $Vehicle before this method, $vehicle is an array but we need ArrayData
            if (is_array($vehicle)) {
                $vehicle = new ArrayData($vehicle);
            }

            if (isset($vehicle->models)) {

                if (is_array($vehicle->models)) {
                    foreach ($vehicle->models as $model) {

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
                                $searchFilterList = ArrayList::create();
                                foreach ($model['searchFilters'] as $filter) {
                                    $searchFilterList->push(ArrayData::create($filter));
                                }
                                $model['searchFilters'] = $searchFilterList;
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

                        $list->push(ArrayData::create($model));
                    }
                }
            }
        }

        return $list;
    }

    /**
     * @return mixed
     */
    public function getSwatches()
    {
        $list = Injector::inst()->create(ArrayList::class);
        $vehicleHubData = $this->getVehicleHubData();

        if (!is_null($vehicleHubData)) {

            $vehicle = $vehicleHubData->first();

            // TODO Without calling $Vehicle before this method, $vehicle is an array but we need ArrayData
            if (is_array($vehicle)) {
                $vehicle = new ArrayData($vehicle);
            }

            $swatches = json_decode($vehicle->swatchesWith360s, true);

            if (isset($swatches)) {
                if (is_array($swatches)) {
                    foreach ($swatches as $swatch) {
                        if ($swatch['total360s'] > 0) { // remove swatch if we have not 360s as design is broken!
                            $list->push(ArrayData::create($swatch));
                        }
                    }
                }
            }

        }
        return $list;
    }

    /**
     * @return mixed
     */
    public function getFilters()
    {
        $list = Injector::inst()->create(ArrayList::class);
        $vehicleHubData = $this->getVehicleHubData();

        if (!is_null($vehicleHubData)) {

            $vehicle = $vehicleHubData->first();

            // TODO Without calling $Vehicle before this method, $vehicle is an array but we need ArrayData
            if (is_array($vehicle)) {
                $vehicle = new ArrayData($vehicle);
            }

            if (isset($vehicle->searchFilters)) {

                $filters = $vehicle->searchFilters;

                if (is_array($filters)) {
                    foreach ($filters as $filter) {
                        $list->push(ArrayData::create($filter));
                    }
                }
            }
        }

        return $list;
    }

    /**
     * @return mixed
     */
    public function getGroupedAccessories()
    {
        $groupedList = Injector::inst()->create(ArrayList::class);
        $vehicleHubData = $this->getVehicleHubData();

        if (!is_null($vehicleHubData)) {
            $vehicle = $vehicleHubData->first();

            // TODO Without calling $Vehicle before this method, $vehicle is an array but we need ArrayData
            if (is_array($vehicle)) {
                $vehicle = new ArrayData($vehicle);
            }

            if (isset($vehicle->accessories)) {
                if (is_array($vehicle->accessories)) {
                    $groupedAccessories = [];

                    foreach ($vehicle->accessories as $accessory) {
                        if (count($accessory['category'])) {
                            if (is_array($accessory['category']) && isset($accessory['category']['name'])) {
                                $groupedAccessories[$accessory['category']['name']]['accessories'][] = ArrayData::create($accessory);
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
            }

        }

        return $groupedList;
    }

    /**
     * @return mixed
     */
    public function getAccessoryPacks()
    {
        $packsList = Injector::inst()->create(ArrayList::class);
        $vehicleHubData = $this->getVehicleHubData();

        if (!is_null($vehicleHubData)) {
            $vehicle = $vehicleHubData->first();

            // TODO Without calling $Vehicle before this method, $vehicle is an array but we need ArrayData
            if (is_array($vehicle)) {
                $vehicle = new ArrayData($vehicle);
            }

            // add accessory packs
            if (isset($vehicle->accessoryPacks)) {
                if (is_array($vehicle->accessoryPacks)) {
                    foreach ($vehicle->accessoryPacks as $pack) {
                        $pack['accessories'] = ArrayList::create($pack['accessories']);
                        $packs[] = $pack;
                        $packsList->push(ArrayData::create($pack));
                    }
                }

            }

        }

        return $packsList;
    }
}
