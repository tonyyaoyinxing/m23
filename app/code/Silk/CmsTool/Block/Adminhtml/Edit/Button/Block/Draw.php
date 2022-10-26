<?php

declare(strict_types=1);

namespace Silk\CmsTool\Block\Adminhtml\Edit\Button\Block;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Silk\CmsTool\Block\Adminhtml\Edit\Button\AbstractButton;
class Draw extends AbstractButton implements ButtonProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getButtonData(): array
    {
        return $this->getBlockId()?[
            'label' => __('Draw'),
            'class' => 'import',
            'on_click' => '',
            'sort_order' => 30
        ]:[];
    }
}
