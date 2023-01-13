<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Business\Writer;

use Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface;

class PlanetWriter implements PlanetWriterInterface
{
    private PlanetEntityManagerInterface $planetEntityManager;

    /**
     * @param \Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface $planetEntityManager
     */
    public function __construct(PlanetEntityManagerInterface $planetEntityManager)
    {
        $this->planetEntityManager = $planetEntityManager;
}
}