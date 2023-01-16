<?php

declare(strict_types = 1);

namespace Pyz\Zed\PlanetSearch\Business\Writer;

interface PlanetSearchWriterInterface
{
    /**
     * @param int $idPlanet
     *
     * @return void
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function publish(int $idPlanet): void;
}
