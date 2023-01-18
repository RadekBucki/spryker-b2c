<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Generated\Shared\Transfer\PlanetTransfer;

interface PlanetRepositoryInterface
{
	/**
	 * @param int $idPlanet
	 *
	 * @return \Generated\Shared\Transfer\PlanetTransfer|null
	 */
	public function findPlanetById(int $idPlanet): ?PlanetTransfer;

    /**
     * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
     */
    public function getAllPlanets(): PlanetCollectionTransfer;
}
