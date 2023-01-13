<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Communication\Controller;

use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \Pyz\Zed\Planet\Communication\PlanetCommunicationFactory getFactory()
 * @method \Pyz\Zed\Planet\Business\PlanetFacadeInterface getFacade()
 */
class CreateController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction(Request $request): RedirectResponse|array
    {
        $planetForm = $this->getFactory()
            ->createPlanetForm()
            ->handleRequest($request);

        if ($planetForm->isSubmitted() && $planetForm->isValid()) {
            $this->addSuccessMessage('Planet was created. Well not yet :)');

            return $this->redirectResponse('/planet/list');
        }

        return $this->viewResponse([
            'planetForm' => $planetForm->createView()
        ]);
    }
}
