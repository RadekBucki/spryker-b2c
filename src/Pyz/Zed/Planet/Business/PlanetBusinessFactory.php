<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Business;

use Pyz\Zed\Planet\Business\Writer\PlanetWriterInterface;
use Pyz\Zed\Planet\Business\Writer\PlanetWriter;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\Planet\PlanetConfig getConfig()
 * @method \Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface getEntityManager()
 */
class PlanetBusinessFactory extends AbstractBusinessFactory
{
	/**
	* @return \Pyz\Zed\Planet\Business\Writer\PlanetWriterInterface
	*/
	public function createPlanetSaver(): PlanetWriterInterface
	{
		return new PlanetWriter(
			$this->getEntityManager()
		);
	}
}
