<?php

declare(strict_types = 1);

namespace Pyz\Glue\PlanetsRestApi;

use Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapper;
use Pyz\Glue\PlanetsRestApi\Processor\Planets\PlanetsReader;
use Pyz\Glue\PlanetsRestApi\Processor\Planets\PlanetsReaderInterface;
use Spryker\Glue\Kernel\AbstractFactory;

/**
 * @method \Pyz\Client\PlanetsRestApi\PlanetsRestApiClientInterface getClient()
 */
class PlanetsRestApiFactory extends AbstractFactory
{
    /**
     * @return \Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapper
     */
    public function createPlanetsResourceMapper(): PlanetsResourceMapper
    {
        return new PlanetsResourceMapper();
    }

    /**
     * @return \Pyz\Glue\PlanetsRestApi\Processor\Planets\PlanetsReaderInterface
     */
    public function createPlanetsReader(): PlanetsReaderInterface
    {
        return new PlanetsReader(
            $this->getClient(),
            $this->getResourceBuilder(),
            $this->createPlanetsResourceMapper()
        );
    }
}
