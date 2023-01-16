<?php

namespace Pyz\Glue\PlanetsRestApi\Processor\Planets;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Pyz\Client\PlanetsRestApi\PlanetsRestApiClientInterface;
use Pyz\Glue\PlanetsRestApi\PlanetsRestApiConfig;
use Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapper;
use Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PlanetsReader implements PlanetsReaderInterface
{

    /** @var \Pyz\Client\PlanetsRestApi\PlanetsRestApiClientInterface */
    private PlanetsRestApiClientInterface $planetsRestApiClient;

    /** @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface */
    private RestResourceBuilderInterface $restResourceBuilder;

    /** @var \Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapper */
    private PlanetsResourceMapper $planetMapper;

    /**
     * @param \Pyz\Client\PlanetsRestApi\PlanetsRestApiClientInterface                 $planetsRestApiClient
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface  $restResourceBuilder
     * @param \Pyz\Glue\PlanetsRestApi\Processor\Mapper\PlanetsResourceMapperInterface $planetMapper
     */
    public function __construct(
        PlanetsRestApiClientInterface $planetsRestApiClient,
        RestResourceBuilderInterface $restResourceBuilder,
        PlanetsResourceMapperInterface $planetMapper
    ) {
        $this->planetsRestApiClient = $planetsRestApiClient;
        $this->restResourceBuilder  = $restResourceBuilder;
        $this->planetMapper         = $planetMapper;
    }

    /**
     * @param RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getPlanets(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder->createRestResponse();
        $planetCollectionTransfer = $this->planetsRestApiClient->getPlanetCollection(new PlanetCollectionTransfer());
        foreach (
            $planetCollectionTransfer->getPlanets()
            as $planetTransfer
        ) {
            $restResource = $this->restResourceBuilder->createRestResource(
                PlanetsRestApiConfig::RESOURCE_PLANETS,
                $planetTransfer->getIdPlanet(),
                $this->planetMapper->mapPlanetDataToPlanetRestAttributes(
                    $planetTransfer->toArray()
                )
            );
            $restResponse->addResource($restResource);
        }
        return $restResponse;
    }
}
