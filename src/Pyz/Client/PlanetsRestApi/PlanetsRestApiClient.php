<?php

declare(strict_types = 1);

namespace Pyz\Client\PlanetsRestApi;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \Pyz\Client\PlanetsRestApi\PlanetsRestApiFactory getFactory()
 */
class PlanetsRestApiClient extends AbstractClient implements PlanetsRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\PlanetCollectionTransfer $planetCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
     * @api
     */
    public function getPlanetCollection(PlanetCollectionTransfer $planetCollectionTransfer): PlanetCollectionTransfer
    {
        return $this->getFactory()
            ->createPlanetZedStub()
            ->getPlanetCollection($planetCollectionTransfer);
    }

    /**
     * @param string $name
     *
     * @return array
     */
    public function getPlanetByName(string $name): array
    {
        $searchQuery = $this->getFactory()
            ->createPlanetQueryPlugin($name);

        $resultFormatters = $this->getFactory()
            ->getSearchQueryFormatters();

        $searchResults = $this->getFactory()
            ->getSearchClient()
            ->search(
                $searchQuery,
                $resultFormatters
            );

        return $searchResults['planet'] ?? [];
    }
}
