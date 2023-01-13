<?php

declare(strict_types = 1);

namespace Pyz\Zed\Planet\Communication\Plugin\Queue;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Queue\Dependency\Plugin\QueueMessageProcessorPluginInterface;

/**
 * @method \Pyz\Zed\Planet\PlanetConfig getConfig()
 * @method \Pyz\Zed\Planet\Business\PlanetFacadeInterface getFacade()
 */
class PlanetQueueMessageRetryProcessorPlugin extends AbstractPlugin implements QueueMessageProcessorPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QueueReceiveMessageTransfer[] $queueMessageTransfers
     *
     * @return \Generated\Shared\Transfer\QueueReceiveMessageTransfer[]
     */
    public function processMessages(array $queueMessageTransfers): array
    {
        // return $this->getFacade()->processRetryMessages($queueMessageTransfers);
    }

    /**
    * {@inheritDoc}
    *
    * @api
    *
    * @return int
    */
    public function getChunkSize(): int
    {
        return $this->getConfig()->getExampleQueueChunkSize();
    }
}
