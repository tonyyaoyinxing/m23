<?php

declare(strict_types=1);

namespace Silk\CmsTool\Block\Adminhtml\Edit\Button;

use Magento\Backend\Block\Widget\Context;

class AbstractButton
{
    /** @var Context */
    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }

    protected function getUrl(string $route, array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    protected function getBlockTypeId()
    {
        return $this->context->getRequest()->getParam('block_type_id');
    }
    protected function getBlockId()
    {
        return $this->context->getRequest()->getParam('block_id');
    }
}
