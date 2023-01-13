<?php

declare(strict_types=1);

namespace Pyz\Zed\Planet\Communication;

use Generated\Shared\Transfer\PlanetTransfer;
use Orm\Zed\Planet\Persistence\PyzPlanetQuery;
use Pyz\Zed\Planet\Communication\Form\PlanetForm;
use Pyz\Zed\Planet\Communication\Table\PlanetTable;
use Pyz\Zed\Planet\PlanetDependencyProvider;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Symfony\Component\Form\FormInterface;

/**
 * @method \Pyz\Zed\Planet\PlanetConfig getConfig()
 */
class PlanetCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @return \Pyz\Zed\Planet\Communication\Table\PlanetTable
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createPlanetTable(): PlanetTable
    {
        return new PlanetTable($this->getPlanetPropelQuery());
    }

    /**
     * @return \Orm\Zed\Planet\Persistence\PyzPlanetQuery
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    private function getPlanetPropelQuery(): PyzPlanetQuery
    {
        return $this->getProvidedDependency(PlanetDependencyProvider::QUERY_PLANET);
    }

    /**
     * @param \Generated\Shared\Transfer\PlanetTransfer|null $planetTransfer
     * @param array                                          $options
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createPlanetForm(?PlanetTransfer $planetTransfer = null, array $options = []): FormInterface
    {
        return $this->getFormFactory()->create(
            PlanetForm::class,
            $planetTransfer,
            $options
        );
    }
}
