<?php


namespace Silk\CmsTool\Controller\Adminhtml\Type;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory as JsonResultFactory;
abstract class AbstractType extends Action
{
    const ADMIN_RESOURCE = 'Silk_CmsTool::type_manage';

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;


    /**
     * @var \Silk\CmsTool\Model\TypeFactory
     */
    protected $typeFactory;

    /**
     * @var \Silk\CmsTool\Model\Api\TypeRepository
     */
    protected $typeRepository;
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
        \Silk\CmsTool\Model\CmstoolBlockTypeFactory $typeFactory,
        \Silk\CmsTool\Model\Api\TypeRepository $typeRepository,
        JsonResultFactory $jsonResultFactory,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
        $this->typeRepository = $typeRepository;
        $this->typeFactory = $typeFactory;
        $this->jsonResultFactory = $jsonResultFactory;
        $this->registry = $registry;
    }

    /**
     * @param \Magento\Backend\Model\View\Result\Type $resultType
     * @return \Magento\Backend\Model\View\Result\Type
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Silk_CmsTool::type_manage');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Cms Type'));
        return $resultPage;
    }
}
