<?php

namespace MitsubishiMotors\DataObjects;

use MitsubishiMotors\Pages\AccessoriesPage;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyTransformation;
use SilverStripe\ORM\DataObject;

/**
 * Class AccessoriesWishListSubmission
 * @package MitsubishiMotors\DataObjects
 */
class AccessoriesWishListSubmission extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'AccessoriesWishListSubmission';

    /**
     * @var array
     */
    private static $db = [
        'FullName' => 'Varchar(255)',
        'Email' => 'Varchar(255)',
        'Phone' => 'Varchar(255)',
        'Address1' => 'Varchar(255)',
        'Address2' => 'Varchar(255)',
        'Suburb' => 'Varchar(255)',
        'City' => 'Varchar(255)',
        'Dealership' => 'Varchar(255)',
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'AccessoriesPage' => AccessoriesPage::class
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Created' => 'Date submitted',
        'FullName' => 'Full name',
        'Email' => 'Email',
        'Phone' => 'Phone'
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
        $fields->removeByName('AccessoriesPageID');
        return $fields->transform(ReadonlyTransformation::create());
    }
}
