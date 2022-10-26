<?php

namespace Silk\CmsTool\Block\Adminhtml\Edit\Button\Block;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;
use Silk\CmsTool\Block\Adminhtml\Edit\Button\AbstractButton;

class Save extends AbstractButton implements ButtonProviderInterface
{
    public function getButtonData(): array
    {
        $data = [
            'class' => 'save primary',
            'sort_order' => 50,
            'class_name' => Container::SPLIT_BUTTON,
            'options' => $this->getButtonOptionsList()
        ];

        return array_merge($this->getData('Save', 'continue'), $data);
    }

    private function getButtonOptionsList(): array
    {
        return [
            $this->getData('Save & Duplicate', 'duplicate', 'save_and_duplicate'),
            $this->getData('Save & Close', 'close', 'save_and_close')
        ];
    }

    private function getData(string $label, string $backParam, ?string $idHard = null): array
    {
        $data = [
            'label' => __($label),
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'silk_cmstool_block_form.silk_cmstool_block_form',
                                'actionName' => 'save',
                                'params' => [true, ['back' => $backParam]]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        return $data;
    }
}
