<?php

declare(strict_types=1);

namespace Pyz\Zed\PlanetSearch\Business\Writer;

use Generated\Shared\Transfer\PlanetTransfer;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Orm\Zed\PlanetSearch\Persistence\Base\PyzPlanetSearchQuery;
use Pyz\Zed\PlanetSearch\Persistence\PlanetSearchEntityManagerInterface;

class PlanetSearchWriter implements PlanetSearchWriterInterface
{
    /**
     * @param int $idPlanet
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function publish(int $idPlanet): void
    {
        $planetEntity = PyzPlanetQuery::create()
            ->filterByIdPlanet($idPlanet)
            ->findOne();

        $planetTransfer = new PlanetTransfer();
        $planetTransfer->fromArray($planetEntity->toArray());

        $searchEntity = PyzPlanetSearchQuery::create()
            ->filterByFkPlanet($idPlanet)
            ->findOneOrCreate();
        $searchEntity->setFkPlanet($idPlanet);
        $searchEntity->setData($planetTransfer->toArray());

        $searchEntity->save();
    }

}
