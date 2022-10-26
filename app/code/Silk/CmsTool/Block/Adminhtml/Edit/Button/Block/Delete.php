<?php

namespace Silk\CmsTool\Block\Adminhtml\Edit\Button\Block;
use Silk\CmsTool\Block\Adminhtml\Edit\Button\AbstractButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Delete extends AbstractButton implements ButtonProviderInterface
{
    public function getButtonData(): array
    {
        return [
            'label' => __('Delete'),
            'on_click' => sprintf(
                "location.href = '%s';",
                $this->getUrl(
                    '*/*/delete',
                    ['block_id' => $this->getBlockId()]
                )
            ),
            'class' => 'delete',
            'sort_order' => 20
        ];
    }
}
