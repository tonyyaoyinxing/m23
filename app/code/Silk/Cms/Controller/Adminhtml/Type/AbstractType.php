<?php


namespace Silk\Cms\Controller\Adminhtml\Type;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory as JsonResultFactory;
abstract class AbstractType extends Action
{
    const ADMIN_RESOURCE = 'Silk_Cms::type_manage';

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;
    /**
     * @var JsonResultFactory
     */
    protected $jsonResultFactory;
    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    public function __construct(
        Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        JsonResultFactory $jsonResultFactory,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
        $this->jsonResultFactory = $jsonResultFactory;
        $this->registry = $registry;
    }

    /**
     * @param \Magento\Backend\Model\View\Result\Type $resultType
     * @return \Magento\Backend\Model\View\Result\Type
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Silk_Cms::type_manage');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Cms Type'));
        return $resultPage;
    }
}
