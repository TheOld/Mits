<?php

namespace MitsubishiMotors\DataObjects;

use MitsubishiMotors\Pages\HomePage;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\FileHandleField;
use MitsubishiMotors\Traits\ColourHelper;
use SilverStripe\Forms\TextareaField;

/**
 * Class VehicleFeature
 * @package MitsubishiMotors\DataObjects
 */
class VehicleFeature extends DataObject
{
    use ColourHelper;

    /**
     * @var string
     */
    private static $table_name = 'VehicleFeature';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Text',
        'Subtitle' => 'Text',
        'ButtonText' => 'Varchar(255)',
        'BackgroundColour' => 'Varchar(10)', // todo: will need a colour picker field for this
        'Image1Title' => 'Text',
        'Image1Subtitle' => 'Text',
        'Image1Copy' => 'HTMLText',
        'Image2Title' => 'Text',
        'Image2Subtitle' => 'Text',
        'Image2Copy' => 'HTMLText',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Parent' => HomePage::class,
        'BackgroundImage' => Image::class,
        'Link' => SiteTree::class,
        'Image1' => Image::class,
        'Image2' => Image::class
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Title' => 'Text',
        'Subtitle' => 'Text',
    ];

    /**
     * @var array
     */
    private static $owns = [
        'BackgroundImage',
        'Image1',
        'Image2'
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
            Injector::inst()->create(TextField::class, 'Title'),
            Injector::inst()->create(TextareaField::class, 'Subtitle'),
            Injector::inst()->create(TextField::class, 'ButtonText'),
            Injector::inst()->create(TextField::class, 'BackgroundColour'),
            Injector::inst()->create(UploadField::class, 'BackgroundImage')
                ->setRightTitle('Should measure at least 1980 pixels wide by at least 1000 pixels high and '
                    . 'be a JPG file.')
                ->setFolderName('FeaturedVehicleBackground')
                ->setAllowedExtensions(['jpg']),
            TreeDropdownField::create(
                'LinkID',
                _t(__CLASS__ . '.SELECT_PAGE', 'Select a page'),
                SiteTree::class,
                'ID',
                'TreeTitle'
            ),
            // Text fields Image 1 (PRimary iamge)
            Injector::inst()->create(LiteralField::class, 'PrimaryImage', '<h5>Primary Image Fields</h5>'),
            Injector::inst()->create(FileHandleField::class, 'Image1')
                ->setTitle('Image')
                ->setRightTitle('Should measure 600 pixels high and 600 pixels wide.'),
            Injector::inst()->create(TextField::class, 'Image1Title')->setTitle('Title'),
            Injector::inst()->create(TextField::class, 'Image1Subtitle')->setTitle('Subtitle'),
            Injector::inst()->create(TextareaField::class, 'Image1Copy')->setTitle('Copy'),
            // Text fields Image 2 (Secondary image)
            Injector::inst()->create(LiteralField::class, 'SecondaryImage', '<h5>Secondary Image Fields</h5>'),
            Injector::inst()->create(FileHandleField::class, 'Image2')
                ->setTitle('Image')
                ->setRightTitle('Should measure 800 pixels wide by 625 pixels high.'),
            Injector::inst()->create(TextField::class, 'Image2Title')->setTitle('Title'),
            Injector::inst()->create(TextField::class, 'Image2Subtitle')->setTitle('Subtitle'),
            Injector::inst()->create(TextareaField::class, 'Image2Copy')->setTitle('Copy')
        );

        return $fields;
    }
}
