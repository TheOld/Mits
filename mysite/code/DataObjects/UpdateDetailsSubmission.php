<?php

namespace MitsubishiMotors\DataObjects;

use MitsubishiMotors\Pages\UpdateDetailsPage;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyTransformation;
use SilverStripe\ORM\DataObject;

/**
 * Class UpdateDetailsSubmission
 * @package MitsubishiMotors\DataObjects
 */
class UpdateDetailsSubmission extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'UpdateDetailsSubmission';

    /**
     * @var array
     */
    private static $db = [
        'FirstName' => 'Varchar(255)',
        'LastName' => 'Varchar(255)',
        'VIN' => 'Varchar(255)',
        'Email' => 'Varchar(255)',
        'Phone' => 'Varchar(255)',
        'Details' => 'Text'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'UpdateDetailsPage' => UpdateDetailsPage::class
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Created' => 'Date submitted',
        'FirstName' => 'First name',
        'LastName' => 'Last name',
        'VIN' => 'Varchar(255)',
        'Email' => 'Email',
        'Phone' => 'Phone',
        'Details.Summary' => 'Details to update'
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
