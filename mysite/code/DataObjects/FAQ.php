<?php

namespace MitsubishiMotors\DataObjects;

use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Forms\TextField;

/**
 * Class FAQ
 * @package MitsubishiMotors\DataObjects
 */
class FAQ extends DataObject
{
    /**
     * @var string
     */
    private static $table_name = 'FAQ';

    /**
     * @var string
     */
    private static $singular_name = 'FAQ';

    /**
     * @var string
     */
    private static $plural_name = 'FAQs';

    /**
     * @var array
     */
    private static $db = [
        'Question' => 'Text',
        'Answer' => 'HTMLText'
    ];

    /**
     * @var array
     */
    private static $belongs_many_many = [
        'TileGroup' => TileGroup::class,
        'Slice' => Slice::class
    ];

    /**
     * @var array
     */
    private static $searchable_fields = [
        'Question' => [
            'title' => 'Question',
            'type' => 'PartialMatchFilter'
        ],
        'Answer' => [
            'title' => 'Answer',
            'type' => 'PartialMatchFilter'
        ],
    ];

    /**
     * @var array
     */
    private static $summary_fields = [
        'Question' => 'Question',
        'Answer.Summary' => 'Answer',
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields()
    {
        $fields = FieldList::create(
            Injector::inst()->create(TextareaField::class, 'Question'),
            Injector::inst()->create(HTMLEditorField::class, 'Answer')
        );

        return $fields;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->Question;
    }
}
