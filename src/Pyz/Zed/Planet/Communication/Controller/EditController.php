<?php

declare(strict_types=1);

namespace Pyz\Zed\Planet\Communication\Controller;

use Generated\Shared\Transfer\PlanetCriteriaTransfer;
use Generated\Shared\Transfer\PlanetTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 * @method \Pyz\Zed\Planet\Business\PlanetFacadeInterface getFacade()
 */
class EditController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request): RedirectResponse|array
    {
        $idPlanet = $this->castId($request->query->get('id-planet'));

        $planetTransfer = $this->getFacade()->findPlanet(
            (new PlanetCriteriaTransfer())->setIdPlanet($idPlanet)
        );
        $planetForm = $this->getFactory()
            ->createPlanetForm($planetTransfer)
            ->handleRequest($request);
        if ($planetForm->isSubmitted() && $planetForm->isValid()) {
            $this->getFacade()
				->savePlanet($planetForm->getData());
            $this->addSuccessMessage('Planet was updated.');
            return $this->redirectResponse('/planet/list');
        }
        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }
}
