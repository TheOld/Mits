<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\DataObjects\AccessoriesWishListSubmission;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordViewer;

/**
 * Class AccessoriesPage
 * @package MitsubishiMotors\Pages
 */
class AccessoriesPage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/accessories.png';

    /**
     * @var string
     */
    private static $description = 'The parts and accessories section (search for parts)';

    /**
     * @var string
     */
    private static $table_name = 'AccessoriesPage';

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
        'Submissions' => AccessoriesWishListSubmission::class
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Content');
        $fields->removeByName('Banner');
        $fields->removeByName('Slices');

        $fields->addFieldsToTab('Root.AccessoriesWishListForm', [
            $ef = TextField::create('EmailSubmissionsTo', 'The call center email to send the wish list to.'),
            GridField::create(
                'Submissions',
                'Submissions',
                $this->Submissions(),
                $gridConfig = GridFieldConfig_RecordViewer::create()
            )
        ]);

        $ef->setDescription('The accessories wish list will also be sent to the selected dealership.');

        return $fields;
    }
}
