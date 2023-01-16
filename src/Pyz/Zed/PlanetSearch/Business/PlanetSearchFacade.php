<?php

declare(strict_types = 1);

namespace Pyz\Zed\PlanetSearch\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\PlanetSearch\Business\PlanetSearchBusinessFactory getFactory()
 */
class PlanetSearchFacade extends AbstractFacade implements PlanetSearchFacadeInterface
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
        $this->getFactory()
            ->createPlanetSearchWriter()
            ->publish($idPlanet);
    }
}
