<?php

namespace Pyz\Zed\Planet\Communication\Table;

use Orm\Zed\Planet\Persistence\Map\PyzPlanetTableMap;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Spryker\Service\UtilText\Model\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class PlanetTable extends AbstractTable
{
    public const ACTION = 'action';
    public const UPDATE_PLANET_URL = '/planet/edit';
    public const PARAM_ID_PLANET = 'id-planet';

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
            PyzPlanetTableMap::COL_INTERESTING_FACT => 'Interesting fact',
            static::ACTION                          => static::ACTION,
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
        $planetDataItems = $this->runQuery($this->planetQuery, $config);
        $planetTableRows = [];
        foreach ($planetDataItems as $planetDataItem) {
            $planetTableRows[] = [
                PyzPlanetTableMap::COL_NAME             => $planetDataItem[PyzPlanetTableMap::COL_NAME],
                PyzPlanetTableMap::COL_INTERESTING_FACT => $planetDataItem[PyzPlanetTableMap::COL_INTERESTING_FACT],
                static::ACTION                          => $this->createActionButtons($planetDataItem)
            ];
        }
        return $planetTableRows;
    }

    /**
     * @param array $planetDataItem
     *
     * @return array
     */
    private function createActionButtons(array $planetDataItem)
    {
        $urls = [];
        $urls[] = $this->generateEditButton(
            Url::generate(static::UPDATE_PLANET_URL, [
                static::PARAM_ID_PLANET => $planetDataItem[PyzPlanetTableMap::COL_ID_PLANET],
            ]),
            'Edit'
        );
        return $urls;
    }
}
