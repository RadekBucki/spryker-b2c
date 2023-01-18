<?php

declare(strict_types = 1);

namespace Pyz\Zed\PlanetSearch\Business;

use Pyz\Zed\PlanetSearch\Business\Writer\PlanetSearchWriter;
use Pyz\Zed\PlanetSearch\Business\Writer\PlanetSearchWriterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\PlanetSearch\PlanetSearchConfig getConfig()
 */
class PlanetSearchBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \Pyz\Zed\PlanetSearch\Business\Writer\PlanetSearchWriterInterface
     */
    public function createPlanetSearchWriter(): PlanetSearchWriterInterface
    {
        return new PlanetSearchWriter();
    }
}
