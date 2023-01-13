<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use Pyz\Shared\Planet\PlanetConstants;

class PlanetConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getExampleQueueChunkSize(): int
    {
        return $this->get(PlanetConstants::EXAMPLE_QUEUE_CHUNK_SIZE, 500);
    }
}
