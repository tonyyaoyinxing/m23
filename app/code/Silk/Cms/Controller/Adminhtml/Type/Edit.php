<?php



namespace Silk\Cms\Controller\Adminhtml\Type;

use Magento\Framework\Controller\ResultFactory;

class Edit extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend("Test");
        return $resultPage;
    }
}
