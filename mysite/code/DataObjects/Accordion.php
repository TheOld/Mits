<?php

namespace MitsubishiMotors\DataObjects;

use SilverStripe\ORM\DataObject;

/**
 * Class Accordion
 * @package MitsubishiMotors\DataObjects
 */
class Accordion extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'Accordion';

    /**
     * @var string
     */
    private static $singular_name = 'Accordion';

    /**
     * @var string
     */
    private static $plural_name = 'Accordions';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Slice' => Slice::class
    ];

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName(['SliceID', 'Sort']);

        return $fields;
    }
}
