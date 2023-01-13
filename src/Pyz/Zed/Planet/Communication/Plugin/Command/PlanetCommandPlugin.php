<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Communication\Plugin\Command;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\StateMachine\Dependency\Plugin\CommandPluginInterface;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 * @method \Pyz\Zed\Planet\Business\PlanetFacadeInterface getFacade()
 */
class PlanetCommandPlugin  extends AbstractPlugin implements CommandPluginInterface
{
}
