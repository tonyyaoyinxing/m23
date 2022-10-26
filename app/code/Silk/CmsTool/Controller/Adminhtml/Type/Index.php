<?php

namespace Silk\CmsTool\Controller\Adminhtml\Type;

use Magento\Framework\Controller\ResultFactory;

class Index extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $this->initPage($resultPage)
            ->getConfig()->getTitle()->prepend(__('Manage Cms Type'));
        return $resultPage;
    }
}
