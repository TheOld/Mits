<?php

namespace MitsubishiMotors\Pages;

/**
 * Class VehicleHubPageController
 * @package MitsubishiMotors\Pages
 */
class VehicleHubPageController extends PageController
{
    /**
     * Redirect to first child page if possible
     * Otherwise redirect to the home page
     *
     * @return \SilverStripe\Control\HTTPResponse
     */
    public function init()
    {
        parent::init();

        $children = $this->AllChildren();

        if ($children && $firstChild = $children->first()) {
            if ($firstChild instanceof Page && $firstChild->exists()) {
                return $this->redirect($firstChild->Link());
            }
        }

        return $this->redirect('/');
    }
}
