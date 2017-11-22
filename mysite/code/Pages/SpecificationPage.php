<?php

namespace MitsubishiMotors\Pages;

use SilverStripe\Forms\FieldList;

/**
 * Class SpecificationPage
 * @package MitsubishiMotors\Pages
 */
class SpecificationPage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/spec.png';

    /**
     * @var string
     */
    private static $description = 'The page to list the specs of a car';

    /**
     * @var string
     */
    private static $table_name = 'SpecificationPage';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Content');
        $fields->removeByName('Banner');
        $fields->removeByName('Slices');

        return $fields;
    }
}
