<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\DataObjects\Slice;
use MitsubishiMotors\DataObjects\Submission;
use MitsubishiMotors\DataObjects\TileGroup;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use MitsubishiMotors\DataObjects\EnquiryType;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordViewer;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;

/**
 * Class ContactPage
 * @package MitsubishiMotors\Pages
 */
class ContactPage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/speakbubble.png';

    /**
     * @var string
     */
    private static $description = 'A contact page with contact form.';

    /**
     * @var string
     */
    private static $table_name = 'ContactPage';

    /**
     * @var array
     */
    private static $db = [
        'Blurb' => 'Text',
        'Email' => 'Varchar(255)',
        'Phone' => 'Varchar(255)',
        'PostalAddress' => 'Text',
        'StreetAddress' => 'Text'
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'Submissions' => Submission::class,
        'EnquiryTypes' => EnquiryType::class
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Banner');
        $fields->removeByName('Content');

        $fields->addFieldsToTab('Root.Main', [
            Injector::inst()->create(TextareaField::class, 'Blurb'),
            Injector::inst()->create(TextField::class, 'Email'),
            Injector::inst()->create(TextField::class, 'Phone'),
            Injector::inst()->create(TextareaField::class, 'PostalAddress'),
            Injector::inst()->create(TextareaField::class, 'StreetAddress')
        ]);

        $fields->insertBefore('Slices', Tab::create('ContactForm', 'Contact Form'));
        $fields->addFieldsToTab('Root.ContactForm', [
            GridField::create(
                'EnquiryTypes',
                'Enquiry Types',
                $this->EnquiryTypes(),
                GridFieldConfig_RecordEditor::create()
            ),
            GridField::create(
                'Submissions',
                'Submissions',
                $this->Submissions(),
                $gridConfig = GridFieldConfig_RecordViewer::create()
            )
        ]);

        $gridConfig->removeComponentsByType('GridFieldAddNewButton');

        return $fields;
    }

    /**
     * Retun the phone number with no spaces so it can be used in the tel to open the phone to make a call on mobile
     *
     * @return mixed
     */
    public function getPhoneNice()
    {
        if ($this->Phone) {
            return str_replace(' ', '', $this->Phone);
        }
    }
}
