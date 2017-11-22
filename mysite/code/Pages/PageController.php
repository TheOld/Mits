<?php

namespace MitsubishiMotors\Pages;

use GuzzleHttp\RequestOptions;
use MitsubishiMotors\Auth\GraphQLAuthenticationController;
use MitsubishiMotors\Constants\VehicleHubURIs;
use MitsubishiMotors\Traits\VehicleHubCommunicationTrait;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\ArrayList;
use MitsubishiMotors\Traits\ReusableMethods;
use Exception;

/**
 * Class PageController
 * @package MitsubishiMotors\Pages
 */
class PageController extends ContentController
{
    use VehicleHubCommunicationTrait, ReusableMethods;

    /**
     * @return bool
     */
    public function hasSlices()
    {
        return $this->Slices()->count() >= 1;
    }

}
