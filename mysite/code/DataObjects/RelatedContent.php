<?php

namespace MitsubishiMotors\DataObjects;

use MitsubishiMotors\Pages\Page;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\CMS\Model\SiteTree;

/**
 * Class RelatedContent
 * @package MitsubishiMotors\DataObjects
 */
class RelatedContent extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'RelatedContent';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Copy' => 'HTMLText',
        'Sort' => 'Int',
        "MyFile" => "DBFile('image/supported')"
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Parent' => Slice::class,
        'Image' => Image::class,
        'Link' => Page::class
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Title',
        'Copy.Summary' => 'Copy'
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
            TextField::create('Title'),
            TextareaField::create('Copy'),
            $if = UploadField::create('Image'),
            TreeDropdownField::create(
                'LinkID',
                _t(__CLASS__ . '.SELECT_PAGE', 'Select a page'),
                SiteTree::class,
                'ID',
                'TreeTitle'
            )
        );

        $if->setAllowedFileCategories('image/supported');
        $if->setRightTitle('Should measure 305 pixels wide by 205 pixels high.');
        $if->setFolderName('RelatedContent');

        return $fields;
    }
}
