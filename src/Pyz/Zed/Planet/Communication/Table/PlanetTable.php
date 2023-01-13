<?php

namespace Pyz\Zed\Planet\Communication\Table;

use Orm\Zed\Planet\Persistence\Map\PyzPlanetTableMap;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class PlanetTable extends AbstractTable
{
    /** @var \Orm\Zed\Planet\Persistence\PyzPlanetQuery */
    private PyzPlanetQuery $planetQuery;

    /**
     * @param \Orm\Zed\Planet\Persistence\PyzPlanetQuery $planetQuery
     */
    public function __construct(PyzPlanetQuery $planetQuery)
    {
        $this->planetQuery = $planetQuery;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            PyzPlanetTableMap::COL_NAME             => 'Planet name',
            PyzPlanetTableMap::COL_INTERESTING_FACT => 'Interesting fact'
        ]);
        $config->setSortable([
            PyzPlanetTableMap::COL_NAME,
            PyzPlanetTableMap::COL_INTERESTING_FACT
        ]);
        $config->setSearchable([
            PyzPlanetTableMap::COL_NAME
        ]);
        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config): array
    {
        return $this->runQuery($this->planetQuery, $config);
    }
}
