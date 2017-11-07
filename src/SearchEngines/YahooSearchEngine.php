<?php

namespace Evangelos\SearchResultsAggregator\SearchEngines;

use Evangelos\SearchResultsAggregator\Results\ResultEntity;
use Evangelos\SearchResultsAggregator\Results\ResultsCollection;
use Evangelos\SearchResultsAggregator\SearchEngineInterface;
use GuzzleHttp\ClientInterface;

/**
 * Class YahooSearchEngine
 * @package Evangelos\SearchResultsAggregator\SearchEngines
 */
class YahooSearchEngine implements SearchEngineInterface
{
    const BASE_URL = 'https://search.yahoo.com/search';
    const SOURCE = 'yahoo';

    private $client = null;
    private $resultsCollection = null;

    public function __construct(ClientInterface $client, ResultsCollection $resultsCollection)
    {
        $this->client = $client;
        $this->resultsCollection = $resultsCollection;
    }

    /**
     * Searches Yahoo for the given query.
     * @param $query
     */
    public function search(string $query): void
    {
        $response = $this->client->request('GET', self::BASE_URL, ['query' => 'p=' . $query]);
        $this->parseResponseBody($response->getBody()->getContents());
    }

    /**
     * Parses the response body from the request to Yahoo.
     * For every result, generates a Result Entity and appends it to the Result Collection.
     * @param $body
     */
    private function parseResponseBody($body): void
    {
        $dom = new \DOMDocument();
        @$dom->loadHTML($body);
        $h3Tags = $dom->getElementById('web')->getElementsByTagName('h3');
        foreach ($h3Tags as $h3Tag) {
            $class = $h3Tag->getAttribute('class');
            if ($class == 'title') {
                $aTag = $h3Tag->getElementsByTagName('a')[0];

                $result = new ResultEntity();
                $result->setTitle($h3Tag->nodeValue);
                $result->setUrl($aTag->getAttribute('href'));
                $this->resultsCollection->appendResultEntity($result, self::SOURCE);
            }
        }
    }
}
