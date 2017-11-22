<?php

namespace MitsubishiMotors\DataObjects;

use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;
use MitsubishiMotors\Traits\ColourHelper;

/**
 * Class Document
 * @package MitsubishiMotors\DataObjects
 */
class Document extends DataObject
{
    use ColourHelper;

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Image' => Image::class,
        'File' => File::class,
        'Slice' => Slice::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Slice',
        'Image',
        'File'
    ];
    /**
     * @var array
     */
    private static $summary_fields = [
        'Title'
    ];

    /**
     * @var array
     */
    private static $extensions = [
        Versioned::class
    ];

    /**
     * @var string
     */
    private static $default_sort = 'Sort ASC';

    /**
     * @return \SilverStripe\Forms\FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('SliceID');
        $fields->removeByName('Sort');

        return $fields;
    }
}
