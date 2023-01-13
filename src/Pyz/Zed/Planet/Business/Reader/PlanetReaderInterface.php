<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Business\Reader;

use Generated\Shared\Transfer\PlanetCriteriaTransfer;
use Generated\Shared\Transfer\PlanetTransfer;

interface PlanetReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PlanetCriteriaTransfer $planetCriteriaTransfer
     *
     * @return \Generated\Shared\Transfer\PlanetTransfer
     */
    public function findPlanet(PlanetCriteriaTransfer $planetCriteriaTransfer): PlanetTransfer;
}
