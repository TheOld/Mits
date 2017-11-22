<?php

namespace MitsubishiMotors\DataObjects;

use MitsubishiMotors\Pages\HomePage;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class TileGroup
 * @package MitsubishiMotors\DataObjects
 */
class TileGroup extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'TileGroup';

    /**
     * @var string
     */
    private static $singular_name = 'Tile Group';

    /**
     * @var string
     */
    private static $plural_name = 'Tile Groups';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Type' => 'Varchar(255)',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Slice' => Slice::class,
        'HomePage' => HomePage::class
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'Tiles' => Tile::class
    ];

    /**
     * @var array
     */
    private static $many_many = [
        'FAQs' => FAQ::class
    ];

    /**
     * @var array
     */
    private static $many_many_extraFields = [
        'FAQs' => [
            'Sort' => 'Int'
        ]
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Type' => 'Type',
        'Title' => 'Title'
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
        $fields = FieldList::create();

        $fields->add(Injector::inst()->create(TextField::class, 'Title'));
        $fields->add(
            $typesField = DropdownField::create(
                'Type',
                'Type',
                [
                    'FAQ' => 'FAQ',
                    'Tiles' => 'Tiles'
                ])->setEmptyString('Please choose')
        );

        if ($this->Type === 'Tiles') {
            $gridField = GridField::create(
                'Tiles',
                'Tiles',
                $this->Tiles(),
                GridFieldConfig_RecordEditor::create()->addComponent(GridFieldOrderableRows::create('Sort'))
            );
        } elseif ($this->Type === 'FAQ') {
            $gridField = GridField::create(
                'FAQ',
                'FAQ',
                $this->FAQs(),
                GridFieldConfig_RelationEditor::create()->addComponent(GridFieldOrderableRows::create('Sort'))
            );
        } else {
            $typesField->setDescription('Please choose a type and save so you can add items');
        }

        if (isset($gridField)) {
            $fields->add($gridField);
        }

        return $fields;
    }

    /**
     * @return bool
     */
    public function hasFAQs()
    {
        return $this->FAQs()->count() >= 1;
    }

    /**
     * @return RequiredFields
     */
    public function getCMSValidator()
    {
        return new RequiredFields('Type');
    }
}
