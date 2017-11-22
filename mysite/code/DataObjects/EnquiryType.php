<?php

namespace MitsubishiMotors\DataObjects;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\EmailField;
use SilverStripe\ORM\ValidationResult;
use MitsubishiMotors\Pages\ContactPage;

/**
 * Class EnquiryType
 * @package MitsubishiMotors\DataObjects
 */
class EnquiryType extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'EnquiryType';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'EmailTo' => 'Varchar(255)',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'ContactPage' => ContactPage::class
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Title' => 'Title',
        'EmailTo' => 'EmailTo'
    ];

    /**
     * @var string
     */
    private static $default_sort = 'Sort ASC';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Sort');
        $fields->removeByName('ContactPageID');

        $fields->dataFieldByName('Title')->setDescription('This is what the user will see as an option in the drop down on the contact form.');

        $fields->insertAfter('Title', new EmailField('EmailTo'));
        $fields->dataFieldByName('EmailTo')->setDescription('What email address would you like these enquiry types to be sent to?');

        return $fields;
    }

    /**
     * @return ValidationResult
     */
    public function validate()
    {
        $valid = parent::validate();

        if (empty($this->Title)) {
            $valid->error("The Title cannot be empty. Please set a Title.");
        }

        if (empty($this->EmailTo)) {
            $valid->error("The 'Email To' cannot be empty. Please set an email address to send these enquiry types to.");
        }

        return $valid;
    }
}
