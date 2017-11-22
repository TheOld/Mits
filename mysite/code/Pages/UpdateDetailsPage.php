<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\DataObjects\UpdateDetailsSubmission;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordViewer;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TextField;

/**
 * Class UpdateDetailsPage
 * @package MitsubishiMotors\Pages
 */
class UpdateDetailsPage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/hand.png';

    /**
     * @var string
     */
    private static $description = 'A page with an update details form.';

    /**
     * @var string
     */
    private static $table_name = 'UpdateDetailsPage';

    /**
     * @var array
     */
    private static $db = [
        'Subtitle' => 'Varchar(255)',
        'EmailSubmissionsTo' => 'Varchar(255)'
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'Submissions' => UpdateDetailsSubmission::class
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Slices');
        $fields->removeByName('Banner');

        $fields->addFieldToTab('Root.Main', TextField::create('Subtitle'));

        $fields->addFieldsToTab('Root.UpdateDetailsForm', [
            TextField::create('EmailSubmissionsTo', 'Email to send updated details requests to.'),
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
}
