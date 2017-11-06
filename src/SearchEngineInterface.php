<?php

namespace Evangelos\SearchResultsAggregator;

interface SearchEngineInterface
{
    public function getData();

    public function parseBody();
}
