<?php

namespace MitsubishiMotors\Traits;
use MitsubishiMotors\Pages\AccessoriesPage;
use MitsubishiMotors\Pages\LocatorPage;

/**
 * Class GlobalVariables
 * @package MitsubishiMotors\Traits
 */
trait GlobalVariables
{
    /**
     * Fixes <br /> showing in <title> tag when it was changed from a text field to a text area field
     *
     * @return mixed
     */
    public function getCleanTitle()
    {
        return preg_replace('/\s+/', ' ', $this->Title);
    }

    /**
     * @return string
     */
    public function getLocatorPageLink()
    {
        $locatorPage = LocatorPage::get()->first();

        if ($locatorPage instanceof LocatorPage && $locatorPage->exists()) {
            return $locatorPage->Link();
        }

        return '';
    }

    /**
     * @return string
     */
    public function getAccessoriesPageLink()
    {
        $accessoriesPage = AccessoriesPage::get()->first();

        if ($accessoriesPage instanceof AccessoriesPage && $accessoriesPage->exists()) {
            return $accessoriesPage->Link();
        }

        return '';
    }
}
