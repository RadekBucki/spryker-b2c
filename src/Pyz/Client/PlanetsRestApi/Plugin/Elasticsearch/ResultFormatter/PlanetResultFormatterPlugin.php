<?php

namespace Pyz\Client\PlanetsRestApi\Plugin\Elasticsearch\ResultFormatter;

use Elastica\ResultSet;
use Spryker\Client\SearchElasticsearch\Plugin\ResultFormatter\AbstractElasticsearchResultFormatterPlugin;

class PlanetResultFormatterPlugin extends AbstractElasticsearchResultFormatterPlugin
{
    public const NAME = 'planet';

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @param \Elastica\ResultSet $searchResult
     * @param array $requestParameters
     *
     * @return array
     */
    protected function formatSearchResult(ResultSet $searchResult, array $requestParameters): array
    {
        foreach ($searchResult->getResults() as $document) {
            return $document->getSource();
        }

        return [];
    }
}
