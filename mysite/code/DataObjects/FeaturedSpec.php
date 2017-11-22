<?php

namespace MitsubishiMotors\DataObjects;

use MitsubishiMotors\Pages\VehiclePage;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\TextareaField;

/**
 * Class FeaturedSpec
 * @package MitsubishiMotors\DataObjects
 */
class FeaturedSpec extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'FeaturedSpec';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Text',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Parent' => VehiclePage::class,
        'Icon' => File::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Icon'
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Title'
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
        $fields = FieldList::create(
            Injector::inst()->create(TextareaField::class, 'Title'),
            Injector::inst()->create(UploadField::class, 'Icon')
                ->setRightTitle('Select an icon for this featured spec. SVG files only.')
                ->setFolderName('Spec Icons')
                ->setAllowedExtensions(['svg'])
        );

        return $fields;
    }
}
