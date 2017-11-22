<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\DataObjects\Slice;
use MitsubishiMotors\DataObjects\VehicleFeature;
use MitsubishiMotors\Traits\GlobalVariables;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Assets\Image;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use Mobile_Detect;


/**
 * Class Page
 * @package MitsubishiMotors\Pages
 */
class Page extends SiteTree
{
    use GlobalVariables;

    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/page1.png';

    /**
     * @var string
     */
    private static $description = 'Basic content page';

    /**
     * @var string
     */
    private static $table_name = 'Page';

    /**
     * @var bool
     */
    private static $hide_ancestor = true;

    /**
     * @var array
     */
    private static $db = [
        'BannerTitle' => 'Varchar(255)',
        'BannerLeadIn' => 'Varchar(255)'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'BannerImage' => Image::class // todo: will also be the video cover image
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'Slices' => Slice::class
    ];

    /**
     * @var array
     */
    private static $belongs_many_many = [
        'VehicleFeatures' => VehicleFeature::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'BannerImage'
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Content');

        $fields->addFieldsToTab('Root.Banner', [
            Injector::inst()->create(UploadField::class, 'BannerImage')
                ->setRightTitle('Background image. Should be 1400 pixels wide by 650 pixels high.')
                ->setFolderName('Banners')
                ->setAllowedFileCategories('image/supported'),
            Injector::inst()->create(TextField::class, 'BannerTitle')
                ->setRightTitle('This is the small grey text (shown above the bold black page title'),
            Injector::inst()->create(TextareaField::class, 'BannerLeadIn'),
            Injector::inst()->create(HTMLEditorField::class, 'Content')
        ]);

        $fields->replaceField('Title', Injector::inst()->create(TextareaField::class, 'Title'));

        $fields->addFieldsToTab('Root.Slices', [
            GridField::create(
                'Slices',
                'Slices',
                $this->Slices(),
                $config = GridFieldConfig_RecordEditor::create()
            )
        ]);

        $config->addComponent(GridFieldOrderableRows::create('Sort'));

        return $fields;
    }

    /**
     * @return bool
     */
    public function getIsMobile()
    {
        $detect = new Mobile_Detect();

        if (($detect->isMobile() && !$detect->isTablet())) {
            return true;
        }

        return false;
    }

    /**
     * @return bool
     */
    public function getIsTablet()
    {
        $detect = new Mobile_Detect();

        if ($detect->isTablet()) {
            return true;
        }

        return false;
    }
}
