<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Business;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Generated\Shared\Transfer\PlanetCriteriaTransfer;
use Generated\Shared\Transfer\PlanetTransfer;

interface PlanetFacadeInterface
{
	/**
	 * Specification:
	 * - stores Planet to the database based on input transfer
	 * - returns enhanced `PlanetTransfer` with ID
	 *
	 * @api
	 *
	 * @param \Generated\Shared\Transfer\PlanetTransfer $planetTransfer
	 *
	 * @return \Generated\Shared\Transfer\PlanetTransfer
  	 */
	public function savePlanet(PlanetTransfer $planetTransfer): PlanetTransfer;

    /**
 	 * Specification:
	 * - returns Planet if exists based on PlanetCriteriaTransfer
	 * - returns null if no such record is found
	 *
	 * @param \Generated\Shared\Transfer\PlanetCriteriaTransfer $planetCriteriaTransfer
	 *
	 * @return \Generated\Shared\Transfer\PlanetTransfer|null
	 */
	public function findPlanet(PlanetCriteriaTransfer $planetCriteriaTransfer): ?PlanetTransfer;

    /**
 	 * Specification:
	 * - returns all Planets in PlanetCollection
     *
     * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
     */
    public function getAllPlanets(): PlanetCollectionTransfer;
}
