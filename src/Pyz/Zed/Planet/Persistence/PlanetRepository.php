<?php

declare(strict_types=1);

namespace Pyz\Zed\Planet\Persistence;

use Generated\Shared\Transfer\PlanetTransfer;
use Orm\Zed\Planet\Persistence\PyzPlanet;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \Pyz\Zed\Planet\Persistence\PlanetPersistenceFactory getFactory()
 */
class PlanetRepository extends AbstractRepository implements PlanetRepositoryInterface
{
    /**
     * @param int $idPlanet
     *
     * @return \Generated\Shared\Transfer\PlanetTransfer|null
     */
    public function findPlanetById(int $idPlanet): ?PlanetTransfer
    {
        $planetEntity = $this->createPyzPlanetQuery()
            ->findOneByIdPlanet($idPlanet);
        if (!$planetEntity) {
            return null;
        }
        return $this->mapEntityToTransfer($planetEntity);
    }

    /**
     * @return \Orm\Zed\Planet\Persistence\PyzPlanetQuery
     */
    private function createPyzPlanetQuery(): PyzPlanetQuery
    {
        return PyzPlanetQuery::create();
    }

    /**
     * @param \Orm\Zed\Planet\Persistence\PyzPlanet $planetEntity
     *
     * @return \Generated\Shared\Transfer\PlanetTransfer
     */
    private function mapEntityToTransfer(PyzPlanet $planetEntity): PlanetTransfer
    {
        return (new PlanetTransfer())->fromArray($planetEntity->toArray());
    }
}
