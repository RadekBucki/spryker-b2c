<?php

declare(strict_types=1);

namespace Pyz\Zed\Planet\Business\Writer;

use Generated\Shared\Transfer\PlanetTransfer;

interface PlanetWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\PlanetTransfer $planetTransfer
     *
     * @return \Generated\Shared\Transfer\PlanetTransfer
     */
    public function save(PlanetTransfer $planetTransfer): PlanetTransfer;
}
