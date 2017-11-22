<?php

namespace MitsubishiMotors\DataObjects;

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyTransformation;
use SilverStripe\ORM\DataObject;

/**
 * Class VehicleBuilder
 * @package MitsubishiMotors\DataObjects
 */
class VehicleBuilder extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'VehicleBuilder';

    /**
     * @var array
     */
    private static $db = [
        'Vehicle' => 'Varchar(255)',
        'Model' => 'Varchar(255)',
        'Colour' => 'Varchar(255)',
        'Accessories' => 'Text',
        'AccessoryPacks' => 'Text',
        'Name' => 'Varchar(255)',
        'Email' => 'Varchar(255)'
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Created' => 'Date submitted',
        'Vehicle' => 'Vehicle',
        'Model' => 'Model'
    ];

    /**
     * @var string
     */
    private static $default_sort = 'Created DESC';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        return $fields->transform(ReadonlyTransformation::create());
    }
}
