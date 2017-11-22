<?php

namespace MitsubishiMotors\Pages;

/**
 * Class LocatorPage
 * @package MitsubishiMotors\Pages
 */
class LocatorPage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/search.png';

    /**
     * @var string
     */
    private static $description = 'A find a Dealer Page';

    /**
     * @var string
     */
    private static $table_name = 'LocatorPage';

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Content');
        $fields->removeByName('Banner');
        $fields->removeByName('Slices');

        return $fields;
    }
}
