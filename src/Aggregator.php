<?php

namespace Evangelos\SearchResultsAggregator;

use Evangelos\SearchResultsAggregator\Exceptions\SearchEngineAlreadyAddedException;

/**
 * Class Aggregator
 * @package Evangelos\SearchResultsAggregator
 */
class Aggregator
{
    /** @var SearchEngineInterface[] */
    private $searchEngines = [];

    /**
     * Iterates through all the added Search engine objects and calls the search function for every single one of them.
     * @param $queryString
     */
    public function search($queryString)
    {
        foreach ($this->searchEngines as $existingEngine) {
            $existingEngine->search($queryString);
        }
    }

    /**
     * Adds a search engine object to the array of available search engines.
     * Multiple instances of the same type are not allowed.
     *
     * @param SearchEngineInterface $searchEngine
     * @throws SearchEngineAlreadyAddedException
     */
    public function addSearchEngine(SearchEngineInterface $searchEngine)
    {
        foreach ($this->searchEngines as $existingEngine) {
            if ($existingEngine instanceof $searchEngine) {
                throw new SearchEngineAlreadyAddedException('Search engine has already been added to the aggregator');
            }
        }
        $this->searchEngines[] = $searchEngine;
    }
}
