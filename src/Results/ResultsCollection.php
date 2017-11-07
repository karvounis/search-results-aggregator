<?php

namespace Evangelos\SearchResultsAggregator\Results;

/**
 * Class ResultsCollection
 * Class used to store objects of ResultEntity type.
 * @package Evangelos\SearchResultsAggregator\Results
 */
class ResultsCollection extends \ArrayIterator
{
    /**
     * Appends to the collection an instance of ResultEntity type.
     * @param ResultEntity $resultEntity
     * @param $source
     */
    public function appendResultEntity(ResultEntity $resultEntity, $source): void
    {
        $hashedUrl = hash('sha256', $resultEntity->getUrl());
        if (!isset($this[$hashedUrl])) {
            $resultEntity->addSource($source);
            $this[$hashedUrl] = $resultEntity;
            return;
        }
        $resultEntity = $this[$hashedUrl];
        $resultEntity->addSource($source);
    }
}
