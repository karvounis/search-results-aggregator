<?php

namespace Evangelos\SearchResultsAggregator;

use Evangelos\SearchResultsAggregator\Exceptions\SearchEngineAlreadyAddedException;

class Aggregator
{
    /** @var SearchEngineInterface[] */
    private $searchEngines = [];
    private $results = [];

    public function search($queryString)
    {
        foreach ($this->searchEngines as $existingEngine) {
            $this->results = $existingEngine->search($queryString);
        }
    }

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
