<?php

namespace MitsubishiMotors\Pages;
use SilverStripe\Forms\FieldList;

/**
 * Class ComponentsPage
 * @package MitsubishiMotors\Pages
 */
class ComponentsPage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/tools.png';

    /**
     * @var string
     */
    private static $description = 'A sample components Page';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Slices');
        $fields->removeByName('Banner');

        return $fields;
    }
}
