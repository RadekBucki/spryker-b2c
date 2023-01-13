<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Business\Reader;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Generated\Shared\Transfer\PlanetCriteriaTransfer;
use Pyz\Zed\Planet\Persistence\PlanetRepositoryInterface;

class PlanetReader implements PlanetReaderInterface
{
    private PlanetRepositoryInterface $planetRepository;

    /**
     * @param \Pyz\Zed\Planet\Persistence\PlanetRepositoryInterface $planetRepository
     */
    public function __construct(PlanetRepositoryInterface $planetRepository)
    {
        $this->planetRepository = $planetRepository;
    }

    /**
    * @param \Generated\Shared\Transfer\PlanetCriteriaTransfer $planetCriteriaTransfer
    *
    * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
    */
    public function findPlanet(PlanetCriteriaTransfer $planetCriteriaTransfer): PlanetCollectionTransfer
    {
        // ToDo: Implementation
        // $this->planetRepository->findPlanet($planetCriteriaTransfer);
    }
}
