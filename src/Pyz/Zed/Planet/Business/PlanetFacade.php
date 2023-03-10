<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Business;

use Generated\Shared\Transfer\PlanetCollectionTransfer;
use Generated\Shared\Transfer\PlanetCriteriaTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Planet\Business\PlanetBusinessFactory getFactory()
 */
class PlanetFacade extends AbstractFacade implements PlanetFacadeInterface
{
    /**
	 * {@inheritDoc}
	 *
	 * @api
	 *
	 * @param \Generated\Shared\Transfer\PlanetTransfer $planetTransfer
	 *
	 * @return \Generated\Shared\Transfer\PlanetTransfer
	 */
	public function savePlanet(PlanetTransfer $planetTransfer): PlanetTransfer
	{
		return $this->getFactory()
			->createPlanetSaver()
			->save($planetTransfer);
	}

    /**
	 * {@inheritDoc}
	 *
	 * @api
	 *
	 * @param int $idPlanet
	 *
	 * @return \Generated\Shared\Transfer\PlanetTransfer|null
	 */
	public function findPlanet(PlanetCriteriaTransfer $planetCriteriaTransfer): ?PlanetTransfer
	{
		return $this->getFactory()
			->createPlanetReader()
			->findPlanet($planetCriteriaTransfer);
	}

    /**
     * @return \Generated\Shared\Transfer\PlanetCollectionTransfer
     */
    public function getAllPlanets(): PlanetCollectionTransfer
    {
		return $this->getFactory()
			->createPlanetReader()
			->getAllPlanets();
    }


}
