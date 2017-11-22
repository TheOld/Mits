<?php

namespace MitsubishiMotors\DataObjects;

use SilverStripe\Assets\File;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\ReadonlyTransformation;
use SilverStripe\ORM\DataObject;
use MitsubishiMotors\Pages\ContactPage;

/**
 * Class Submission
 * @package MitsubishiMotors\DataObjects
 */
class Submission extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'Submission';

    /**
     * @var array
     */
    private static $db = [
        'Name' => 'Varchar(255)',
        'Email' => 'Varchar(255)',
        'Phone' => 'Varchar(255)',
        'Message' => 'Text',
        'EnquiryType' => 'Varchar(255)'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'ContactPage' => ContactPage::class,
        'File' => File::class
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Created' => 'Date submitted',
        'Name' => 'Name',
        'Email' => 'Email',
        'Phone' => 'Phone',
        'EnquiryType' => 'Enquiry Type',
        'Message.Summary' => 'Message'
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
