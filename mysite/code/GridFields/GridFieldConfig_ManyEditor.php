<?php

namespace MitsubishiMotors\GridField;

use SilverStripe\ORM\SS_List;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridFieldButtonRow;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldEditButton;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldPageCount;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Class GridFieldConfig_ManyEditor
 * @package MitsubishiMotors\GridField
 */
class GridFieldConfig_ManyEditor extends GridFieldConfig
{
    /**
     * GridFieldConfig_ManyEditor constructor.
     * @param SS_List|null $searchList
     * @param null $sortField
     * @param null $itemsPerPage
     */
    public function __construct(
        SS_List $searchList = null,
        $sortField = null,
        $itemsPerPage = null
    )
    {
        $this->addComponent(new GridFieldButtonRow('before'));
        $this->addComponent($autoComplete = new GridFieldAddExistingAutocompleter('buttons-before-right'));
        $this->addComponent(new GridFieldToolbarHeader());
        $this->addComponent($sort = new GridFieldSortableHeader());
        $this->addComponent($filter = new GridFieldFilterHeader());
        $this->addComponent(new GridFieldDataColumns());
        $this->addComponent(new GridFieldEditButton());
        $this->addComponent(new GridFieldDeleteAction(true));
        $this->addComponent(new GridFieldPageCount('toolbar-header-right'));
        $this->addComponent($pagination = new GridFieldPaginator($itemsPerPage));
        $this->addComponent(new GridFieldDetailForm());

        $sort->setThrowExceptionOnBadDataType(false);
        $filter->setThrowExceptionOnBadDataType(false);
        $pagination->setThrowExceptionOnBadDataType(false);

        if ($searchList) {
            $autoComplete->setSearchList($searchList);
        }

        if ($sortField) {
            $this->addComponent(new GridFieldOrderableRows($sortField));
        }
    }
}
