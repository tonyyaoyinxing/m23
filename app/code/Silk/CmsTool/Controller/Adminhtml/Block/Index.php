<?php

namespace Silk\CmsTool\Controller\Adminhtml\Block;

use Magento\Framework\Controller\ResultFactory;
use Silk\CmsTool\Controller\Adminhtml\Block\AbstractBlock;

class Index extends AbstractBlock
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $this->initPage($resultPage)
            ->getConfig()->getTitle()->prepend(__('Manage Cms Block'));
        return $resultPage;
    }
}
