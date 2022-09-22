<?php

namespace Silk\CmsTool\Controller\Adminhtml\Page;

use Magento\Framework\Controller\ResultFactory;

class Index extends AbstractPage
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $this->initPage($resultPage)
            ->getConfig()->getTitle()->prepend(__('Manage Cms Page'));
        return $resultPage;
    }
}
