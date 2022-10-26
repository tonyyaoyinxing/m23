<?php
namespace Silk\CmsTool\Controller\Adminhtml\Type;

use Magento\Framework\Controller\ResultFactory;
use Silk\CmsTool\Controller\Adminhtml\Type\AbstractType;
class Drawmb extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        return $resultPage;
    }
}
