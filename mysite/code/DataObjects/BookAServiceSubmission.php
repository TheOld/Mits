<?php

namespace MitsubishiMotors\DataObjects;

use MitsubishiMotors\Pages\BookAServicePage;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyTransformation;
use SilverStripe\ORM\DataObject;

/**
 * Class BookAServiceSubmission
 * @package MitsubishiMotors\DataObjects
 */
class BookAServiceSubmission extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'BookAServiceSubmission';

    /**
     * @var array
     */
    private static $db = [
        'FirstName' => 'Varchar(255)',
        'LastName' => 'Varchar(255)',
        'Email' => 'Varchar(255)',
        'Phone' => 'Varchar(255)',
        'Address1' => 'Varchar(255)',
        'Address2' => 'Varchar(255)',
        'Suburb' => 'Varchar(255)',
        'City' => 'Varchar(255)',
        'PreferredDropOff' => 'DBDatetime',
        'PreferredPickUp' => 'DBDatetime',
        'RegistrationPlate' => 'Varchar(255)',
        'ServiceType' =>  'Varchar(255)',
        'OtherServiceType' => 'Varchar(255)'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'BookAServicePage' => BookAServicePage::class
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Created' => 'Date submitted',
        'FirstName' => 'First name',
        'LastName' => 'Last name',
        'Email' => 'Email',
        'Phone' => 'Phone',
        'ServiceType' => 'ServiceType'
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
        $fields->removeByName('BookAServicePageID');
        return $fields->transform(ReadonlyTransformation::create());
    }
}
