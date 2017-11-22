<?php

namespace MitsubishiMotors\Pages;
use SilverStripe\Forms\FieldList;

/**
 * Class VehicleHubPage
 * @package MitsubishiMotors\Pages
 */
class VehicleHubPage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/folder.png';

    /**
     * @var string
     */
    private static $description = 'A Vehicle Hub Page';

    /**
     * @var string
     */
    private static $table_name = 'VehicleHubPage';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Slices');
        $fields->removeByName('Banner');
        $fields->removeByName('Content');

        return $fields;
    }
}
