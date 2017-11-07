<?php

namespace Evangelos\SearchResultsAggregator\SearchEngines;

use Evangelos\SearchResultsAggregator\Results\ResultEntity;
use Evangelos\SearchResultsAggregator\Results\ResultsCollection;
use Evangelos\SearchResultsAggregator\SearchEngineInterface;
use GuzzleHttp\ClientInterface;

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

    public function search($query)
    {
        $response = $this->client->request('GET', self::BASE_URL, ['query' => 'q=' . $query]);
        $body = $response->getBody()->getContents();
        $dom = new \DOMDocument();

        @$dom->loadHTML($body);
        $h3Tags = $dom->getElementsByTagName('h3');
        foreach ($h3Tags as $h3Tag) {
            $class = $h3Tag->getAttribute('class');
//            if ($class == 'title') {
                $aTag = $h3Tag->getElementsByTagName('a')[0];
                $result = new ResultEntity();
                $result->setTitle($h3Tag->nodeValue);
                $result->setUrl($aTag->getAttribute('href'));
                $this->resultsCollection->appendResultEntity($result, self::SOURCE);
//            }
        }

        return $response;
    }
}
