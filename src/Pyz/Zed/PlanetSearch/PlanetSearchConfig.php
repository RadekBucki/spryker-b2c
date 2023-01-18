<?php

declare(strict_types = 1);

namespace Pyz\Zed\PlanetSearch;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use Pyz\Shared\PlanetSearch\PlanetSearchConstants;

class PlanetSearchConfig extends AbstractBundleConfig
{
    /**
     * @return int
     */
    public function getExampleQueueChunkSize(): int
    {
        return $this->get(PlanetSearchConstants::EXAMPLE_QUEUE_CHUNK_SIZE, 500);
    }
}
