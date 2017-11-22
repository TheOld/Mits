<?php

namespace MitsubishiMotors\GridField;

use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class GridFieldConfig_HasManyRelationEditor
 * @package MitsubishiMotors\GridField
 */
class GridFieldConfig_HasManyRelationEditor extends GridFieldConfig_RelationEditor
{
    /**
     * @param null $itemsPerPage How many items per page should show up
     * @param null $sortField
     */
    public function __construct($itemsPerPage = null, $sortField = null)
    {
        parent::__construct($itemsPerPage);

        $this->removeComponentsByType('GridFieldAddNewButton');

        if ($sortField) {
            $this->addComponent(new GridFieldOrderableRows($sortField));
        }
    }
}