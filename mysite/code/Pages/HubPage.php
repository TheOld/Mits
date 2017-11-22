<?php

namespace MitsubishiMotors\Pages;

use SilverStripe\Forms\FieldList;

/**
 * Class HubPage
 * @package MitsubishiMotors\Pages
 */
class HubPage extends Page
{
    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/book.png';

    /**
     * @var string
     */
    private static $description = 'Hub page, will redirect to first child page';

    /**
     * @var string
     */
    private static $table_name = 'HubPage';

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Content');
        $fields->removeByName('Banner');
        $fields->removeByName('Slices');

        $urlSegment = $fields->dataFieldByName('URLSegment');
        $urlSegment->setDescription('This page type redirects to its first child page. '
            . ' If it has no child pages it will redirect to the home page.');

        return $fields;
    }
}
