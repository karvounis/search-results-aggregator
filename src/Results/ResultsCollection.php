<?php

namespace Evangelos\SearchResultsAggregator\Results;

class ResultsCollection extends \ArrayIterator
{
    public function appendResultEntity(ResultEntity $resultEntity, $source)
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
