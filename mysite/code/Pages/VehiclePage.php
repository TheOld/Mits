<?php

namespace MitsubishiMotors\Pages;

use MitsubishiMotors\GridField\GridFieldConfig_ManyMany;
use MitsubishiMotors\Constants\VehicleHubURIs;
use MitsubishiMotors\DataObjects\FeaturedSpec;
use MitsubishiMotors\DataObjects\SafetyAnimation;
use MitsubishiMotors\Traits\ColourHelper;
use MitsubishiMotors\DataObjects\FAQ;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Core\Injector\Injector;
use MitsubishiMotors\Traits\VehicleHubCommunicationTrait;
use GuzzleHttp\RequestOptions;
use Exception;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use TractorCow\Colorpicker\Forms\ColorField;
use TractorCow\Colorpicker\Color;
use SilverStripe\Assets\File;


/**
 * Class VehiclePage
 * @package MitsubishiMotors\Pages
 */
class VehiclePage extends Page
{
    use VehicleHubCommunicationTrait;
    use ColourHelper;

    protected $vehicleHubData;

    /**
     * @return mixed
     */
    public function getVehicleHubData()
    {
        if (!isset($this->vehicleHubData)) {
            $this->setVehicleHubData($this->getVehicle());
        }
        return $this->vehicleHubData;
    }

    /**
     * @param mixed $vehicleHubData
     */
    public function setVehicleHubData($vehicleHubData)
    {
        $this->vehicleHubData = $vehicleHubData;
    }

    /**
     * @var string
     */
    private static $icon = 'themes/base/icons/vehiclepage.png';

    /**
     * @var string
     */
    private static $description = 'A Vehicle Page';

    /**
     * @var string
     */
    private static $table_name = 'VehiclePage';

    /**
     * @var array
     */
    private static $db = [
        'DefaultColour' => Color::class,
        'OverviewTitle' => 'Text',
        'OverviewSubtitle' => 'Text',
        'OverviewIntro' => 'HTMLText',
        'ColourTitle' => 'Text',
        'ColourSubtitle' => 'Text',
        'ColourIntro' => 'HTMLText',
        'FAQsTitle' => 'Varchar(255)',
        'HubVehicleId' => 'Int',
        'BrochureBlurb' => 'Text'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'BannerLogo' => File::class,
        'BannerVideo' => File::class,
        'BrochureImage' => Image::class,
        'Brochure' => File::class,
        'UpsellVehicleImage' => Image::class,
        'UpsellVehicleLink' => VehiclePage::class,
        'HomePageParent' => HomePage::class,
        'LifeStyleImage' => Image::class
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'FeaturedSpecs' => FeaturedSpec::class,
        'SafetyAnimations' => SafetyAnimation::class
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
    private static $owns = [
        'BannerLogo',
        'BannerVideo',
        'BrochureImage',
        'Brochure',
        'UpsellVehicleImage',
        'LifeStyleImage'
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $vehicles = $this->retrieveVehicles();

        $fields = parent::getCMSFields();
        $fields->removeByName('Content');
        $fields->removeByName('BannerLeadIn');

        // Main Tab
        $fields->addFieldsToTab('Root.Main', [
            Injector::inst()->create(DropdownField::class, 'HubVehicleId')
                ->setTitle('Select a vehicle')
                ->setDescription('This list comes from the hub and fetches data based on your choice')
                ->setEmptyString('Please choose')
                ->setSource($this->getValuesForDropDown($vehicles)),
            Injector::inst()->create(UploadField::class, 'LifeStyleImage')
                ->setRightTitle('Life style image. Should measure 1250 pixels wide by 575 pixels high.')
                ->setFolderName('LifeStyleImages')
                ->setAllowedFileCategories('image')
        ]);

        // Banner Tab
        $fields->addFieldsToTab('Root.Banner', [
            Injector::inst()->create(TextField::class, 'BannerTitle'),
            Injector::inst()->create(UploadField::class, 'BannerLogo')
                ->setRightTitle('Vehicle logo in banner. This should be an SVG file as it is used across this page.')
                ->setFolderName('Banners')
                ->setAllowedExtensions(['svg']),
            Injector::inst()->create(UploadField::class, 'BannerVideo')
                ->setRightTitle('Upload video (MP4 files only).')
                ->setAllowedExtensions(['mp4'])
                ->setFolderName('Banners') //todo: add video specs
        ]);

        $fields->dataFieldByName('BannerImage')->setRightTitle('Used as a background image and gets hidden when the'
            . ' user plays the banner video (if one is uploaded here at the bottom). This image should'
            . ' measure 1900 pixels wide by 950 pixels high.');

        // Overview slice
        $fields->insertBefore('Slices',
            Injector::inst()->create(Tab::class, 'Overview')
        );

        $fields->addFieldsToTab('Root.Overview', [
            Injector::inst()->create(ColorField::class, 'DefaultColour'),
            Injector::inst()->create(TextField::class, 'OverviewTitle'),
            Injector::inst()->create(TextareaField::class, 'OverviewSubtitle'),
            Injector::inst()->create(HTMLEditorField::class, 'OverviewIntro')
                ->setRows(5),
            Injector::inst()->create(GridField::class,
                'FeaturedSpec',
                'Featured Spec for this Vehicle.',
                $this->FeaturedSpecs(),
                GridFieldConfig_RecordEditor::create()->addComponent(GridFieldOrderableRows::create('Sort'))
            )
        ]);

        // Colour Slice
        $fields->insertBefore('Slices',
            Injector::inst()->create(Tab::class, 'ColourSlice')
        );

        $fields->addFieldsToTab('Root.ColourSlice', [
            Injector::inst()->create(TextField::class, 'ColourTitle'),
            Injector::inst()->create(TextareaField::class, 'ColourSubtitle'),
            Injector::inst()->create(HTMLEditorField::class, 'ColourIntro')
                ->setRows(5)
        ]);

        // Safety Animations Slice
        $fields->addFieldsToTab('Root.SafetyAnimations', [
            Injector::inst()->create(GridField::class,
                'SafetyAnimations',
                'Safety Animations',
                $this->SafetyAnimations(),
                GridFieldConfig_RecordEditor::create()->addComponent(GridFieldOrderableRows::create('Sort'))
            )
        ]);

        // FAQs
        $fields->addFieldsToTab('Root.FAQs', [
            Injector::inst()->create(TextField::class, 'FAQsTitle'),
            Injector::inst()->create(GridField::class,
                'FAQs',
                'FAQs',
                $this->FAQs(),
                GridFieldConfig_ManyMany::create(10, 'Sort')
            )
        ]);

        // Brochure
        $fields->addFieldsToTab('Root.Brochure', [
            Injector::inst()->create(UploadField::class, 'BrochureImage')
                ->setRightTitle('Should measure 320 pixels wide by 445 pixels high.')
                ->setFolderName('VehicleBrochures')
                ->setAllowedFileCategories('image'),
            Injector::inst()->create(UploadField::class, 'Brochure')
                ->setFolderName('VehicleBrochures')
                ->setAllowedFileCategories('document')
                ->setRightTitle('Documents only.'),
            Injector::inst()->create(TextareaField::class, 'BrochureBlurb')
        ]);

        // Upsell slice
        $fields->addFieldsToTab('Root.Upsell', [
            Injector::inst()->create(UploadField::class, 'UpsellVehicleImage')
                ->setRightTitle('Should measure 695 pixels wide by 355 pixels high.')
                ->setFolderName('VehicleUpsells')
                ->setAllowedFileCategories('image'),
            Injector::inst()->create(DropdownField::class, 'UpsellVehicleLinkID')
                ->setTitle('Select vehicle')
                ->setSource(VehiclePage::get()->map()->toArray())
        ]);

        return $fields;
    }

    /**
     * @return mixed
     */
    protected function retrieveVehicles()
    {
        $vehicles = null;
        $query = <<<GRAPHQL
{
    vehicles { 
        id 
        name 
    }
}
GRAPHQL;

        try {
            $response = $this->getClient()->post(VehicleHubURIs::GET_VEHICLES, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->getAuthenticationToken(),
                    'Accept' => 'application/json'
                ],
                RequestOptions::JSON => [
                    'query' => $query
                ]
            ]);


            if (!$response->getStatusCode() == '200') {
                throw new Exception("Got this bad response code: {$response->getStatusCode()}");
            }

            $data = json_decode($response->getBody(), true);

            if (isset($data['data']['vehicles'])) {

                return $data['data']['vehicles'];
            }

            // todo: wrong exception not showing error nothing
        } catch (Exception $e) {

            $this->handleVehicleHubCommunicationException($e);
        }

    }

    /**
     * @param $vehiclesArray
     * @return array
     */
    public function getValuesForDropDown($vehiclesArray)
    {
        $map = [];

        if (is_array($vehiclesArray)) {

            foreach ($vehiclesArray as $vehicle) {

                $map[$vehicle['id']] = $vehicle['name'];

            }
        }

        return $map;
    }

    /**
     * @return bool
     */
    public function hasFAQs()
    {
        return $this->FAQs()->count() >= 1;
    }

    /**
     * Compute the number of items based on a total number
     * and a specific step
     *
     * @param int $total
     * @param int $step
     * @return int
     */
    public function paginate($total, $step)
    {
        return floor(($total / $step) + ($total % $step));
    }

    /**
     * @return string
     */
    protected function graphQLQuery()
    {
        $query = <<<GRAPHQL
{
    vehicles  (id: "$this->HubVehicleId")  {
        id
        name
        slug
        logo
        defaultClearCut
        defaultModel {
            id
            name
            defaultAngleImage
        }
        swatchesWith360s
        defaultSwatchWith360s
        searchFilters {
            id
            name
        }
        models {
            id
            name
            slug
            defaultRightAngleClearCut
            defaultAngleName
            defaultAngleImageTitle
            defaultAngleImage
            rrp
            onPromotion
            co2
            fuelConsumption
            crashRatingProvider
            crashRatingStars
            searchFilters {
                id
                name
            }
            uniqueSpecs {
                id
                name
                icon
            }
            specLabels {
                id
                name
                description
                category
                group
            }
        }
        accessories {
            id
            name
            partNumber
            category {
              id
              name
              description
            }
            description
            disclaimer
            rrp
            image
        }
        accessoryPacks {
            id
            name
            accessories {
                id
                name
                partNumber
                category {
                  id
                  name
                  description
                }
                description
                disclaimer
                rrp
                image
            }
            partNumber
            vehicle {
                id
                name
            }
            description
            rrp
            image
        }
    }
}
GRAPHQL;

        return $query;
    }

    /**
     * @return mixed
     */
    public function getVehicle()
    {
        $query = $this->graphQLQuery();

        try {

            $response = $this->getClient()->post(VehicleHubURIs::GET_VEHICLES, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->getAuthenticationToken(),
                    'Accept' => 'application/json'
                ],
                RequestOptions::JSON => [
                    'query' => $query
                ]
            ]);

            // todo: if 401 then request token again (or setToken from VehicleHubCommunication)

            if (!$response->getStatusCode() == '200') {
                throw new Exception("Got this bad response code: {$response->getStatusCode()}");
            }

            $data = json_decode($response->getBody(), true);

            // log errors in response json
            if (isset($data['errors'])) {
                if (count($errors = $data['errors'])) {
                    /** @var \Monolog\Logger $logger */
                    $logger = Injector::inst()->create('Logger');
                    $logger->notice('Errors from GraphQL, vehicle page ', $errors);
                }
            }

            if (isset($data['data'])) {
                if (isset($data['data']['vehicles']) && isset($data['data']['vehicles'][0]) && is_array($data['data']['vehicles'][0])) {

                    // Logos come from the hub with the start of the URL even if there is no logo attached to a vehicle
                    // We cannot use the URL so make sure it is blank if there is no logo
                    if(isset($data['data']['vehicles'][0]['logo'])){
                        $endsWithSvg = substr_compare( $data['data']['vehicles'][0]['logo'], 'svg', -strlen( 'svg' ) ) === 0;

                        if(!$endsWithSvg){
                            $data['data']['vehicles'][0]['logo'] = '';
                        }
                    }

                    return ArrayList::create($data['data']['vehicles']);
                }

            }

        } catch (Exception $e) {

            $this->handleVehicleHubCommunicationException($e);
        }

    }

    /**
     * @return string
     */
    public function getDefaultVehicleModelAngleImage()
    {
        $data = $this->getVehicleHubData();

        if ($data) {
            $vehicle = $data->first();

            if (isset($vehicle['defaultModel']) && isset($vehicle['defaultModel']['defaultAngleImage'])) {
                return $vehicle['defaultModel']['defaultAngleImage'];
            }
        }

        return '';
    }

}
