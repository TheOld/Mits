<?php

namespace MitsubishiMotors\DataObjects;

use MitsubishiMotors\Pages\VehiclePage;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\TextareaField;

/**
 * Class SafetyAnimation
 * @package MitsubishiMotors\DataObjects
 */
class SafetyAnimation extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'SafetyAnimation';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Description' => 'Text',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Parent' => VehiclePage::class,
        'Icon' => File::class,
        'CoverImage' => Image::class,
        'Animation' => File::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Icon',
        'CoverImage',
        'Animation'
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Title',
        'Description'
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
                ->setRightTitle('SVG files only.')
                ->setFolderName('SafetyIcons')
                ->setAllowedExtensions(['svg']),
            Injector::inst()->create(UploadField::class, 'CoverImage')
                ->setFolderName('SafetyCoverImages')
                ->setRightTitle('Used as a cover for the video while it is loading. It disappears once the video has '
                    . 'downloaded because it plays automatically. Should measure 1600 pixels wide by 660 pixels high.')
                ->setAllowedFileCategories('image'),
            Injector::inst()->create(UploadField::class, 'Animation')
                ->setRightTitle('Restricted to mp4 files only.')
                ->setAllowedExtensions(['mp4'])
                ->setFolderName('SafetyAnimations'),
            Injector::inst()->create(TextareaField::class, 'Description')
        );

        return $fields;
    }
}
