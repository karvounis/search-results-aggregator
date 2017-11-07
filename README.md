# Search Results Aggregator

This repo contains a simple Search Results Aggregator that aggregates results from various search engines.

## Description:

Write a simple search(engine) result aggregator library. It’s important that this is a 
standalone and framework-independent library so that we can use as a third party library in 
any framework we like.
The search result aggregator has to support: 
- Google 
- Yahoo 
- Potentially more search engines like Bing, Yandex etc. but you don’t have to write an 
implementation for that. 
 
We’re only interested in the result title, url and the source (Google or Yahoo or another 
search engine) and we don’t have to store the results in a database yet.  
 
The search engine aggregator has to combine the results from the first page from every 
search engine. Duplicates are not allowed. In case of a duplicate, you should only add the 
source to the existing search result with the following result: 
  
Title: Duplicate Website

Url: http://www.duplicates.nl

Source: 
- Search engine A
- Search engine B
 
The idea is that the user can use the search result aggregator to search for a keyword on 
multiple search engines at once and to aggregate all the results to one result set. The order 
of the search results is not important.
	
## Example usage
``` 
$client = new \GuzzleHttp\Client();
$resultsCollection = new \Evangelos\SearchResultsAggregator\Results\ResultsCollection();
$google = new \Evangelos\SearchResultsAggregator\SearchEngines\GoogleSearchEngine($client, $resultsCollection);
$yahoo = new \Evangelos\SearchResultsAggregator\SearchEngines\YahooSearchEngine($client, $resultsCollection);

$aggregator = new \Evangelos\SearchResultsAggregator\Aggregator();
try {
    $aggregator->addSearchEngine($google);
    $aggregator->addSearchEngine($yahoo);
    $aggregator->search('Amsterdam');
    var_dump($resultsCollection);
} catch (\Exception $e) {
    var_dump($e->getMessage());
}
```
Steps for the above script:
1. Instantiates a Guzzle Client.
2. Instantiates a Result Collection where the Results are saved.
3. Instantiates Search engines objects.
4. Instantiates an Aggregator.
5. Adds the search engine objects to the Aggregator.
6. Searches with the given query string 'Amsterdam'.
7. Results are saved in the $resultsCollection variable.