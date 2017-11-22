<?php

namespace MitsubishiMotors\GridField;

use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class GridFieldConfig_HasMany
 * @package MitsubishiMotors\GridField
 */
class GridFieldConfig_HasMany extends GridFieldConfig_RecordEditor
{
    /**
     * @param null $itemsPerPage How many items per page should show up
     * @param null $sortField
     */
    public function __construct($itemsPerPage = null, $sortField = null)
    {
        parent::__construct($itemsPerPage);

        if ($sortField) {
            $this->addComponent(new GridFieldOrderableRows($sortField));
        }
    }
}
