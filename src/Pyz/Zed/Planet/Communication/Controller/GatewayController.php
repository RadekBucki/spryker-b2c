<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 * @method \Pyz\Zed\Planet\Business\PlanetFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
     */
    public function getPlanetCollectionAction(): PlanetCollectionTransfer
    {
        return $this->getFacade()
            ->getAllPlanets();
    }
}
