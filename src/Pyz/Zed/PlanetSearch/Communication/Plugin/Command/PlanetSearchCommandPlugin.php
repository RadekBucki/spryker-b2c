<?php

declare(strict_types = 1);

namespace Pyz\Zed\PlanetSearch\Communication\Plugin\Command;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\StateMachine\Dependency\Plugin\CommandPluginInterface;

/**
 * @method \Pyz\Zed\PlanetSearch\Communication\PlanetSearchCommunicationFactory getFactory()
 * @method \Pyz\Zed\PlanetSearch\Business\PlanetSearchFacadeInterface getFacade()
 */
class PlanetSearchCommandPlugin  extends AbstractPlugin implements CommandPluginInterface
{
}
