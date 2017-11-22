<?php

namespace MitsubishiMotors\Controllers;

use Elastica\Query\BoolQuery;
use Elastica\Query\QueryString;
use Elastica\Query\Type;
use Heyday\Elastica\ElasticaService;
use Heyday\Elastica\PaginatedList;
use MitsubishiMotors\DataObjects\Slice;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Core\Convert;

/**
 * Class SearchController
 * @package MitsubishiMotors\Controllers
 */
class SearchController extends ContentController
{
    /**
     * @var ElasticaService
     */
    protected $searchService;

    /**
     * @return \SilverStripe\ORM\FieldType\DBHTMLText
     */
    public function index()
    {
        return $this->renderWith(['SearchResults', 'Page']);
    }

    /**
     * @param ElasticaService $searchService
     */
    public function setSearchService(ElasticaService $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * @return bool|PaginatedList
     */
    public function Results()
    {
        $request = $this->getRequest();

        if ($string = $request->requestVar('for')) {

            $query = new BoolQuery();

            $query->addMust(
                new QueryString(strval($string))
            );

            $query->addMustNot([
                new Type(Slice::class)
            ]);

            $results = $this->searchService->search($query);
            $results->getQuery()->setSize(1000);

            return new PaginatedList($results, $request);
        }

        return false;
    }

    /**
     * @return array|string
     */
    public function Query()
    {
        return Convert::raw2xml($this->getRequest()->requestVar('for'));
    }

    /**
     * @return string
     */
    public function Title()
    {
        return 'Search';
    }
}
