<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Business\Reader;

interface PlanetReaderInterface
{
    /**
    * @param \Generated\Shared\Transfer\PlanetCriteriaTransfer $planetCriteriaTransfer
    *
    * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
    */
    public function findPlanet(PlanetCriteriaTransfer $planetCriteriaTransfer): PlanetCollectionTransfer;
}
