<?php

namespace MitsubishiMotors\DataObjects;

use SilverStripe\Forms\FileHandleField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;

/**
 * Class CarouselItem
 * @package MitsubishiMotors\DataObjects
 */
class CarouselItem extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'CarouselItem';

    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'Subtitle' => 'Text',
        'Copy' => 'Text',
        'YouTubeId' => 'Varchar(255)',
        'Sort' => 'Int'
    ];

    /**
     * @var array
     */
    private static $has_one = [
        'Parent' => Slice::class,
        'Image' => Image::class,
        'File' => File::class
    ];

    /**
     * @var array
     */
    private static $owns = [
        'Image',
        'File'
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title' => 'Title',
        'Subtitle' => 'Subtitle',
        'Copy' => 'Copy'
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
            Injector::inst()->create(TextareaField::class, 'Copy'),
            Injector::inst()->create(TextField::class, 'YouTubeId')
                ->setDescription('Place the YouTube video ID here. eg. https://www.youtube.com/watch?v='
                    . '<strong style="font-size: larger">bfpxENfiBBU</strong>&nohtml5=False'),
            Injector::inst()->create(FileHandleField::class, 'Image')
                ->setRightTitle('Should measure 1900 pixels wide by 950 pixels high. Upload a cover '
                    . 'image if this is a video carousel item.')
                ->setFolderName('Carousel'),
            Injector::inst()->create(FileHandleField::class, 'File')
                ->setRightTitle('Video upload field.')
                ->setFolderName('Carousel')
        );

        return $fields;
    }
}
