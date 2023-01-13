<?php

declare(strict_types=1);

namespace Pyz\Zed\Planet\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 * @method \Pyz\Zed\Planet\Business\PlanetFacadeInterface getFacade()
 */
class ListController extends AbstractController
{
    /**
     * @return array
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function indexAction(): array
    {
        $planetTable = $this->getFactory()->createPlanetTable();
        return $this->viewResponse([
            'planetTable' => $planetTable->render()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function tableAction(): JsonResponse
    {
        $planetTable = $this->getFactory()->createPlanetTable();
        return $this->jsonResponse($planetTable->fetchData());
    }
}
