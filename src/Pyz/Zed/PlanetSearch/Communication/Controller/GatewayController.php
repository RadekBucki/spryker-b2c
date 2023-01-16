<?php

declare(strict_types = 1);

namespace Pyz\Zed\PlanetSearch\Communication\Controller;

use Generated\Shared\Transfer\PlanetSearchTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \Pyz\Zed\PlanetSearch\Communication\PlanetSearchCommunicationFactory getFactory()
 * @method \Pyz\Zed\PlanetSearch\Business\PlanetSearchFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\PlanetSearchTransfer $planetSearchTransfer
     *
     * @return \Generated\Shared\Transfer\PlanetSearchTransfer $planetSearchTransfer
     */
    public function customAction(PlanetSearchTransfer $planetSearchTransfer): PlanetSearchTransfer
    {
        return $this->getFacade()
                ->customAction($planetSearchTransfer);
    }
}
