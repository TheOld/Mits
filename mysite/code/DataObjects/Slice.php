<?php

namespace MitsubishiMotors\DataObjects;

use MitsubishiMotors\Pages\ContactPage;
use MitsubishiMotors\Pages\Page;
use MitsubishiMotors\Pages\VehiclePage;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Versioned\Versioned;
use SilverStripe\Assets\Image;
use Symfony\Component\Config\Definition\Exception\Exception;
use MitsubishiMotors\GridField\GridFieldConfig_ManyMany;
use MitsubishiMotors\GridField\GridFieldConfig_HasMany;

/**
 * Class Slice
 * @package MitsubishiMotors\DataObjects
 */
class Slice extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'Slice';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Subtitle' => 'Text',
        'Blurb' => 'Text',
        'Copy' => 'HTMLText',
        'Type' => 'Varchar(255)',
        'ShowImageRight' => 'Boolean',
        'Image2Copy' => 'HTMLText',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Parent' => Page::class,
        'Image' => Image::class,
        'Image2' => Image::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image',
        'Image2'
    ];

    /**
     * @var array
     */
    private static $has_many = [
        'TileGroups' => TileGroup::class,
        'CarouselItems' => CarouselItem::class,
        'RelatedContent' => RelatedContent::class,
        'Accordions' => Accordion::class,
        'Documents' => Document::class
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
        'Title',
        'Subtitle',
        'SliceType'
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
     * @return FieldList
     */
    public function getCMSFields()
    {
        $sliceTypes = $this->determineSliceTypeOptions();

        // if first create then show type dropdown
        if (!$this->ID) {
            $fields = FieldList::create(
                DropdownField::create(
                    'Type',
                    'Slice type',
                    $sliceTypes
                )->setDescription('Save after changing this, to see the different slice fields.')
            );

            // if first create then show type dropdown
        } else {

            $fields = FieldList::create();

            // Add FieldTypes
            $fieldsForType = $this->getFieldsForType();

            foreach ($fieldsForType as $name => $config) {

                if (!isset($config['type'])) {
                    $defaultFieldType = $this->dbObject($name)->scaffoldFormField();
                    $fields->add(
                        $f = $defaultFieldType::create($name)
                            ->setTitle($name)
                    );
                } else {
                    $fieldType = "SilverStripe\\Forms\\" . $config['type'] . "Field";
                    $fields->add(
                        $f = $fieldType::create($name)
                            ->setTitle($config['label'])
                    );
                }

                if (isset($config['help'])) {
                    $f->setDescription($config['help']);
                }
            }

            // Add has_one
            $hasOnes = $this->getHasOneForType();
            if (count($hasOnes)) {
                foreach ($hasOnes as $name => $config) {
                    $fieldType = "SilverStripe\AssetAdmin\Forms\\" . $config['type'] . "Field";
                    $fields->add(
                        $f = $fieldType::create($name)
                            ->setTitle($config['label'])
                    );

                    if (isset($config['help'])) {
                        $f->setRightTitle($config['help']);
                    }
                }
            }

            // Add has_many
            $hasMany = $this->getHasManyForType();
            if (count($hasMany)) {
                foreach ($hasMany as $name => $config) {
                    $fields->add(
                        GridField::create(
                            $name,
                            $config['label'],
                            $this->$name(),
                            GridFieldConfig_HasMany::create(10, 'Sort')
                        )
                    );
                }
            }

            // Add many_many
            $manyMany = $this->getManyManyForType();
            if (count($manyMany)) {
                foreach ($manyMany as $name => $config) {
                    $fields->add(
                        GridField::create(
                            $name,
                            $config['label'],
                            $this->$name(),
                            $config = GridFieldConfig_ManyMany::create(10, 'Sort')
                        )
                    );
                }
            }
        }

        return $fields;
    }

    /**
     * @return array
     */
    protected function getTypeConfig()
    {
        $allTypes = $this->config()->get('types');

        if (!isset($allTypes[$this->Type])) {
            throw new Exception("No config set for : $this->Type");
        }

        $config = $allTypes[$this->Type];

        if (isset($config) && is_array($config)) {
            return $this->normaliseTypeConfig($config);
        }

    }

    /**
     * @return array|mixed
     */
    protected function getFieldsForType()
    {
        $config = $this->getTypeConfig();
        return isset($config['fields']) ? $config['fields'] : [];

    }

    /**
     * @return array|mixed
     */
    protected function getHasOneForType()
    {
        $config = $this->getTypeConfig();
        return isset($config['has_one']) ? $config['has_one'] : [];

    }

    /**
     * @return array|mixed
     */
    protected function getHasManyForType()
    {
        $config = $this->getTypeConfig();
        return isset($config['has_many']) ? $config['has_many'] : [];

    }

    /**
     * @return array|mixed
     */
    protected function getManyManyForType()
    {
        $config = $this->getTypeConfig();
        return isset($config['many_many']) ? $config['many_many'] : [];

    }

    /**
     * @param array $config
     * @return array
     */
    protected function normaliseTypeConfig(array $config)
    {
        // Transform "FieldName: 'Field title'" into "FieldName.label: 'Field title'" as a config shortcut
        if (isset($config['fields'])) {
            foreach ($config['fields'] as $fieldName => &$fieldConfig) {
                if (!is_array($fieldConfig)) {
                    $fieldConfig = [
                        'label' => $fieldConfig
                    ];
                }
            }
        }

        if (isset($config['has_many'])) {
            foreach ($config['has_many'] as $fieldName => &$fieldConfig) {
                if (!is_array($fieldConfig)) {
                    $fieldConfig = [
                        'label' => $fieldConfig
                    ];
                }
            }
        }

        if (isset($config['many_many'])) {
            foreach ($config['many_many'] as $fieldName => &$fieldConfig) {
                if (!is_array($fieldConfig)) {
                    $fieldConfig = [
                        'label' => $fieldConfig
                    ];
                }
            }
        }

        return $config;
    }

    /**
     * @return bool
     */
    public function hasTileGroups()
    {
        return $this->TileGroups()->count() >= 1;
    }

    /**
     * @return bool
     */
    public function hasFAQs()
    {
        return $this->FAQs()->count() >= 1;
    }

    /**
     * @return bool
     */
    public function hasAccordions()
    {
        return $this->Accordions()->count() >= 1;
    }

    /**
     * @return bool
     */
    public function hasCarouselItems()
    {
        return $this->Carouselitems()->count() >= 1;
    }

    /**
     * @return bool
     */
    public function hasRelatedContent()
    {
        return $this->RelatedContent()->count() >= 1;
    }

    /**
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function forTemplate()
    {
        $namespace = str_replace('\\', '/', $this->ClassName);

        return $this->renderWith($namespace . '/' . $this->Type);
    }

    /**
     * @return int|mixed
     */
    public function getOrder()
    {
        if (!$this->Sort == 0) {
            return $this->Sort;
        }

        // else work out a Order form the IDs
        //get siblings
        $siblings = Slice::get()->where('ParentID', $this->ParentID)->sort('ID ASC');
        $order = 0;

        foreach ($siblings as $sibling) {
            $order++;

            if ($sibling->ID == $this->ID) {
                return $order;
            }
        }
    }

    /**
     * @return array
     */
    private function determineSliceTypeOptions()
    {
        $sliceTypesRaw = $this->config()->get('types');
        $sliceTypes = [];

        foreach ($sliceTypesRaw as $key => $sliceType) {
            $sliceTypes[$key] = $sliceType['name'];
        }

        // The Editorial (Image) and Carousel slices are the only ones needed on the VehiclePage
        if ($this->Parent() && $this->Parent()->ClassName == VehiclePage::class) {
            foreach ($sliceTypes as $key => $sliceType) {
                if (!in_array($key, ['Image', 'Carousel'])) {
                    unset($sliceTypes[$key]);
                }
            }
        }

        // The tabbed content and related content slices are the only ones needed on the ContactPage
        if ($this->Parent() && $this->Parent()->ClassName == ContactPage::class) {
            foreach ($sliceTypes as $key => $sliceType) {
                if (!in_array($key, ['TabbedContent', 'RelatedContent'])) {
                    unset($sliceTypes[$key]);
                }
            }
        }

        return $sliceTypes;
    }

    /**
     * @return mixed
     */
    public function getSliceType()
    {
        $sliceTypesRaw = $this->config()->get('types');
        $sliceTypes = [];

        foreach ($sliceTypesRaw as $key => $sliceType) {
            $sliceTypes[$key] = $sliceType['name'];
        }

        return $sliceTypes[$this->Type];
    }
}
