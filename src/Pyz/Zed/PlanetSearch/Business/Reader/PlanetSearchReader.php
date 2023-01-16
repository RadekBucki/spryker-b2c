<?php

declare(strict_types = 1);

namespace Pyz\Zed\PlanetSearch\Business\Reader;

use Generated\Shared\Transfer\PlanetSearchCollectionTransfer;
use Generated\Shared\Transfer\PlanetSearchCriteriaTransfer;
use Pyz\Zed\PlanetSearch\Persistence\PlanetSearchRepositoryInterface;

class PlanetSearchReader implements PlanetSearchReaderInterface
{
    private PlanetSearchRepositoryInterface $planetSearchRepository;

    /**
     * @param \Pyz\Zed\PlanetSearch\Persistence\PlanetSearchRepositoryInterface $planetSearchRepository
     */
    public function __construct(PlanetSearchRepositoryInterface $planetSearchRepository)
    {
        $this->planetSearchRepository = $planetSearchRepository;
    }

    /**
    * @param \Generated\Shared\Transfer\PlanetSearchCriteriaTransfer $planetSearchCriteriaTransfer
    *
    * @return \Generated\Shared\Transfer\PlanetSearchCollectionTransfer
    */
    public function findPlanetSearch(PlanetSearchCriteriaTransfer $planetSearchCriteriaTransfer): PlanetSearchCollectionTransfer
    {
        // ToDo: Implementation
        // $this->planetSearchRepository->findPlanetSearch($planetSearchCriteriaTransfer);
    }
}
