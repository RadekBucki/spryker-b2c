<?php

declare(strict_types=1);

namespace Pyz\Zed\Planet\Business\Writer;

use Generated\Shared\Transfer\PlanetTransfer;
use Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface;

class PlanetWriter implements PlanetWriterInterface
{
    private PlanetEntityManagerInterface $planetEntityManager;

    /**
     * @param \Pyz\Zed\Planet\Persistence\PlanetEntityManagerInterface $planetEntityManager
     */
    public function __construct(PlanetEntityManagerInterface $planetEntityManager)
    {
        $this->planetEntityManager = $planetEntityManager;
    }

	/**
	 * @param \Generated\Shared\Transfer\PlanetTransfer $planetTransfer
	 *
	 * @return \Generated\Shared\Transfer\PlanetTransfer
	 */
	public function save(PlanetTransfer $planetTransfer): PlanetTransfer
	{
		return $this->planetEntityManager->savePlanet($planetTransfer);
	}
}
