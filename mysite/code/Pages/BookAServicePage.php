<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\DataObjects\BookAServiceSubmission;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordViewer;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TextField;

/**
 * Class BookAServicePage
 * @package MitsubishiMotors\Pages
 */
class BookAServicePage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/service.png';

    /**
     * @var string
     */
    private static $description = 'A page with a book a service form.';

    /**
     * @var string
     */
    private static $table_name = 'BookAServicePage';

    /**
     * @var array
     */
    private static $db = [
        'EmailSubmissionsTo' => 'Varchar(255)'
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'Submissions' => BookAServiceSubmission::class
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Slices');
        $fields->removeByName('Banner');
        $fields->insertAfter('Main', Tab::create('BookAServiceForm', 'Book A Service Form'));

        $fields->addFieldsToTab('Root.BookAServiceForm', [
            $ef = TextField::create('EmailSubmissionsTo', 'The call center email to send booking requests to.'),
            GridField::create(
                'Submissions',
                'Submissions',
                $this->Submissions(),
                $gridConfig = GridFieldConfig_RecordViewer::create()
            )
        ]);

        $ef->setDescription('The booking request will also be sent to the selected dealership.');

        $gridConfig->removeComponentsByType('GridFieldAddNewButton');

        return $fields;
    }
}
