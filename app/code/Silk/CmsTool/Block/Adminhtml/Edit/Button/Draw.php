<?php

declare(strict_types=1);

namespace Silk\CmsTool\Block\Adminhtml\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Draw extends AbstractButton implements ButtonProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Draw'),
            'class' => 'import',
            'data_attribute' => [
                'mage-init' => [
                    'Magento_Ui/js/form/button-adapter' => [
                        'actions' => [
                            [
                                'targetName' => 'silk_cmstool_block_form.silk_cmstool_block_form.import_categories_tree_modal',
                                'actionName' => 'toggleModal'
                            ]
                        ]
                    ]
                ]
            ],
            'on_click' => '',
            'sort_order' => 45
        ];
    }
}
