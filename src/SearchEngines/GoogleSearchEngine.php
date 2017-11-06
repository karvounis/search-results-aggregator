<?php

namespace Evangelos\SearchResultsAggregator\SearchEngines;

use Evangelos\SearchResultsAggregator\SearchEngineInterface;
use GuzzleHttp\ClientInterface;

class GoogleSearchEngine implements SearchEngineInterface
{
    private $client = null;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getData()
    {
        // TODO: Implement getData() method.
    }

    public function parseBody()
    {
        // TODO: Implement parseBody() method.
    }
}
