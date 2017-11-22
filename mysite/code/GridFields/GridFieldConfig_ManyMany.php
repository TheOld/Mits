<?php

namespace MitsubishiMotors\GridField;

use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class GridFieldConfig_ManyMany
 * @package MitsubishiMotors\GridField
 */
class GridFieldConfig_ManyMany extends GridFieldConfig_RelationEditor
{
    /**
     * @param null $itemsPerPage How many items per page should show up
     * @param null $sortField
     */
    public function __construct($itemsPerPage = null, $sortField = null)
    {
        parent::__construct($itemsPerPage);
        if ($sortField) {
            $this->addComponent(GridFieldOrderableRows::create($sortField));
        }

        $this->removeComponentsByType('GridFieldDeleteAction');
    }
}
