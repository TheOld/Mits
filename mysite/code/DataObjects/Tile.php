<?php

namespace MitsubishiMotors\DataObjects;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\TextField;
use MitsubishiMotors\Traits\ColourHelper;

/**
 * Class Tile
 * @package MitsubishiMotors\DataObjects
 */
class Tile extends DataObject
{
    use ColourHelper;

    /**
     * @var string
     */
    private static $table_name = 'Tile';

    /**
     * @var string
     */
    private static $singular_name = 'Tile';

    /**
     * @var string
     */
    private static $plural_name = 'Tiles';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Subtitle' => 'Varchar(255)',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Title',
        'Subtitle'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Image' => Image::class,
        'ParentGroup' => TileGroup::class,
        'LinkedPage' => SiteTree::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image'
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
            Injector::inst()->create(TextField::class, 'Subtitle'),
            Injector::inst()->create(UploadField::class, 'Image')
                ->setFolderName('Home Tiles')
                ->setRightTitle('Should measure 410 pixels wide and 490 pixels high.')
                ->setAllowedFileCategories('image'),
            TreeDropdownField::create(
                'LinkedPageID',
                _t(__CLASS__ . '.SELECT_PAGE', 'Select a page'),
                SiteTree::class
            )
        );

        return $fields;
    }

    /**
     * @return RequiredFields
     */
    public function getCMSValidator()
    {
        return RequiredFields::create('Title', 'Image');
    }
}
