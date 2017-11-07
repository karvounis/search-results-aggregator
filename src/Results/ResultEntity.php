<?php

namespace Evangelos\SearchResultsAggregator\Results;

class ResultEntity
{
    /** @var string */
    private $url;
    /** @var string */
    private $title;
    /** @var string[] */
    private $sources;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return string[]
     */
    public function getSources(): array
    {
        return $this->sources;
    }

    /**
     * @param string $source
     */
    public function addSource($source): void
    {
        $this->sources[] = $source;
    }
}
