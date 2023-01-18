<?php

declare(strict_types = 1);

namespace Pyz\Client\PlanetsRestApi;

use Pyz\Client\PlanetsRestApi\Plugin\Elasticsearch\Query\PlanetQueryPlugin;
use Pyz\Client\PlanetsRestApi\Zed\PlanetsRestApiZedStub;
use Pyz\Client\PlanetsRestApi\Zed\PlanetsRestApiZedStubInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;

class PlanetsRestApiFactory extends AbstractFactory
{
    public function createPlanetZedStub(): PlanetsRestApiZedStubInterface
    {
        return new PlanetsRestApiZedStub($this->getZedRequestClient());
    }

    /**
     * @return \Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected function getZedRequestClient(): ZedRequestClientInterface
    {
        return $this->getProvidedDependency(PlanetsRestApiDependencyProvider::CLIENT_ZED_REQUEST);
    }


    /**
     * @param string $name
     *
     * @return \Pyz\Client\PlanetsRestApi\Plugin\Elasticsearch\Query\PlanetQueryPlugin
     */
    public function createPlanetQueryPlugin(string $name): PlanetQueryPlugin
    {
        return new PlanetQueryPlugin($name);
    }

    /**
     * @return array
     */
    public function getSearchQueryFormatters()
    {
        return $this->getProvidedDependency(PlanetsRestApiDependencyProvider::PLANET_RESULT_FORMATTER_PLUGINS);
    }

    /**
     * @return \Spryker\Client\Search\SearchClientInterface
     */
    public function getSearchClient()
    {
        return $this->getProvidedDependency(PlanetsRestApiDependencyProvider::CLIENT_SEARCH);
    }
}
