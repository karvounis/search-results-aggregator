<?php

namespace Evangelos\SearchResultsAggregator\Results;

class ResultEntity
{
    private $url;
    private $title;
    private $sources;

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string[]
     */
    public function getSources()
    {
        return $this->sources;
    }

    /**
     * @param string $source
     */
    public function addSource($source)
    {
        $this->sources[] = $source;
    }
}
