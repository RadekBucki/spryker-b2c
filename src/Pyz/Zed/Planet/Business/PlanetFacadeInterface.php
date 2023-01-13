<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Business;

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
}
