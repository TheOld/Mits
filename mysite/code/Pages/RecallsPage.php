<?php

namespace MitsubishiMotors\Pages;
use SilverStripe\Forms\FieldList;

/**
 * Class RecallsPage
 * @package MitsubishiMotors\Pages
 */
class RecallsPage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/content.png';

    /**
     * @var string
     */
    private static $description = 'Recalls page';

    /**
     * @var string
     */
    private static $table_name = 'RecallsPage';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Slices');
        $fields->removeByName('Banner');

        return $fields;
    }
}
