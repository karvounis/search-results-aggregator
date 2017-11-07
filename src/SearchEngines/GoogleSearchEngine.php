<?php

namespace Evangelos\SearchResultsAggregator\SearchEngines;

use Evangelos\SearchResultsAggregator\Results\ResultEntity;
use Evangelos\SearchResultsAggregator\Results\ResultsCollection;
use Evangelos\SearchResultsAggregator\SearchEngineInterface;
use GuzzleHttp\ClientInterface;

/**
 * Class GoogleSearchEngine
 * @package Evangelos\SearchResultsAggregator\SearchEngines
 */
class GoogleSearchEngine implements SearchEngineInterface
{
    const BASE_URL = 'https://www.google.com/search';
    const SOURCE = 'google';

    private $client = null;
    private $resultsCollection = null;

    public function __construct(ClientInterface $client, ResultsCollection $resultsCollection)
    {
        $this->client = $client;
        $this->resultsCollection = $resultsCollection;
    }

    /**
     * Searches Google for the given query.
     * @param $query
     */
    public function search(string $query): void
    {
        $response = $this->client->request('GET', self::BASE_URL, ['query' => 'q=' . $query]);
        $this->parseResponseBody($response->getBody()->getContents());
    }

    /**
     * Parses the response body from the request to Google.
     * For every result, generates a Result Entity and appends it to the Result Collection.
     * @param $body
     */
    private function parseResponseBody($body): void
    {
        $dom = new \DOMDocument();
        @$dom->loadHTML($body);
        $h3Tags = $dom->getElementById('search')->getElementsByTagName('h3');
        foreach ($h3Tags as $h3Tag) {
            $parent = $h3Tag->parentNode;
            $citeElement = $parent->getElementsByTagName('cite')[0];

            $result = new ResultEntity();
            $result->setTitle($h3Tag->nodeValue);
            $result->setUrl($citeElement->nodeValue);
            $this->resultsCollection->appendResultEntity($result, self::SOURCE);
        }
    }
}
