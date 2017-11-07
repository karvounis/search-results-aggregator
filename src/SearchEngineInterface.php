<?php

namespace Evangelos\SearchResultsAggregator;

interface SearchEngineInterface
{
    public function search(string $query);
}
