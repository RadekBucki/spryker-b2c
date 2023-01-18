<?php

declare(strict_types = 1);

namespace Pyz\Zed\PlanetSearch\Business\Reader;

interface PlanetSearchReaderInterface
{
    /**
    * @param \Generated\Shared\Transfer\PlanetSearchCriteriaTransfer $planetSearchCriteriaTransfer
    *
    * @return \Generated\Shared\Transfer\PlanetSearchCollectionTransfer
    */
    public function findPlanetSearch(PlanetSearchCriteriaTransfer $planetSearchCriteriaTransfer): PlanetSearchCollectionTransfer;
}
