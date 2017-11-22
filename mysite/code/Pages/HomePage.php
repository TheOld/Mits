<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\DataObjects\TileGroup;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use MitsubishiMotors\DataObjects\VehicleFeature;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\CheckboxField;
use MitsubishiMotors\Traits\ColourHelper;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class HomePage
 * @package MitsubishiMotors\Pages
 */
class HomePage extends Page
{
    use ColourHelper;

    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/home.png';

    /**
     * @var string
     */
    private static $description = 'The Homepage';

    /**
     * @var string
     */
    private static $table_name = 'HomePage';

    /**
     * @var array
     */
    private static $db = [
        'BannerTitle' => 'Varchar(255)',
        'BannerSubtitle' => 'Varchar(255)',
        'SpecialOfferTitle' => 'Text',
        'SpecialOfferSubtitle' => 'Text',
        'SpecialOfferButtonText' => 'Text',
        'SpecialOfferVisibility' => 'Boolean'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'BannerVideo' => File::class,
        'SpecialOffer' => VehiclePage::class
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'VehicleFeatures' => VehicleFeature::class,
        'TileGroups' => TileGroup::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'BannerVideo'
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('Content');
        $fields->removeByName('Slices');
        $fields->removeByName('BannerTitle');
        $fields->removeByName('BannerLeadIn');

        $fields->addFieldsToTab('Root.Banner', [
            Injector::inst()->create(TextField::class, 'BannerTitle'),
            Injector::inst()->create(TextField::class, 'BannerSubtitle'),
            Injector::inst()->create(UploadField::class, 'BannerVideo')
                ->setRightTitle('Upload video')
                ->setFolderName('Banners') //todo: add video specs
        ]);

        $fields->dataFieldByName('BannerImage')->setRightTitle('Background image or video cover image. Should '
            . ' measure 1900 pixels wide x 700 pixels high.');

        // Vehicle Features
        $fields->addFieldsToTab('Root.VehicleFeatures', [
            GridField::create(
                'VehicleFeatures',
                'Vehicle Features',
                $this->VehicleFeatures(),
                GridFieldConfig_RecordEditor::create()->addComponent(GridFieldOrderableRows::create('Sort'))
            )
        ]);

        $fields->addFieldsToTab('Root.SpecialOffer', [
            Injector::inst()->create(TextField::class, 'SpecialOfferTitle'),
            Injector::inst()->create(TextField::class, 'SpecialOfferSubtitle')->setTitle('Subtitle'),
            Injector::inst()->create(TextField::class, 'SpecialOfferButtonText')->setTitle('Button text'),
            Injector::inst()->create(CheckboxField::class, 'SpecialOfferVisibility')->setTitle('Display special offer slice?'),
            $vehiclePage = Injector::inst()->create(DropdownField::class, 'SpecialOfferID'),
        ]);

        $vehiclePage->setTitle('Select vehicle');
        $vehiclePage->setSource(VehiclePage::get()->map()->toArray());

        Injector::inst()->create(Tab::class, 'FeaturedContent');

        $fields->addFieldsToTab('Root.Tiles', [
            GridField::create(
                'Tiles',
                'Tiles',
                $this->TileGroups(),
                GridFieldConfig_RecordEditor::create()->addComponent(GridFieldOrderableRows::create('Sort'))
            )
        ]);

        return $fields;
    }
}
