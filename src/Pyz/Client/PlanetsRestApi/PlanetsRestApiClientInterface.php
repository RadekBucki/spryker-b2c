<?php

declare(strict_types = 1);

namespace Pyz\Client\PlanetsRestApi;

use Generated\Shared\Transfer\PlanetCollectionTransfer;

interface PlanetsRestApiClientInterface
{
    /**
     * @api
     * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
     */
    public function getPlanetCollection(PlanetCollectionTransfer $planetCollectionTransfer): PlanetCollectionTransfer;

    /**
     * @param string $name
     *
     * @return array
     */
    public function getPlanetByName(string $name): array;
}
