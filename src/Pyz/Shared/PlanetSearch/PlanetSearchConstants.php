<?php

declare(strict_types = 1);

namespace Pyz\Shared\PlanetSearch;

interface PlanetSearchConstants
{
    /**
     * Specification:
     * - Queue name as used for processing planet messages
     *
     * @api
     *
     * @var string
     */
    public const PLANET_SYNC_SEARCH_QUEUE = 'sync.search.planet';
}
