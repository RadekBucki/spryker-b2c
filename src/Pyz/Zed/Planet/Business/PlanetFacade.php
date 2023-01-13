<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\Planet\Business\PlanetBusinessFactory getFactory()
 */
class PlanetFacade extends AbstractFacade implements PlanetFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\QueueReceiveMessageTransfer[] $queueMessageTransfers
     *
     * @return \Generated\Shared\Transfer\QueueReceiveMessageTransfer[]
     */
    public function processMessages(array $queueMessageTransfers): array
    {
        // return $this->getFactory()->createExampleQueueMessageProcessor()->processMessages($queueMessageTransfers);
    }
}
