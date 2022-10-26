<?php

namespace Silk\CmsTool\Controller\Adminhtml\Block;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory as JsonResultFactory;
abstract class AbstractBlock extends Action
{
    const ADMIN_RESOURCE = 'Silk_CmsTool::block_manage';

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Silk\CmsTool\Model\BlockRepository
     */
    protected $blockRepository;

    /**
     * @var \Silk\CmsTool\Model\BlockFactory
     */
    protected $blockFactory;

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
        \Silk\CmsTool\Model\Api\BlockRepository $blockRepository,
        \Silk\CmsTool\Model\CmstoolBlockFactory $blockFactory,
        JsonResultFactory $jsonResultFactory,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
        $this->blockRepository = $blockRepository;
        $this->blockFactory = $blockFactory;
        $this->jsonResultFactory = $jsonResultFactory;
        $this->registry = $registry;
    }

    /**
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Silk_CmsTool::block_manage');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Cms Block'));
        return $resultPage;
    }
}
