<?php


namespace Silk\CmsTool\Controller\Adminhtml\Page;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;

abstract class AbstractPage extends Action
{
    const ADMIN_RESOURCE = 'Silk_CmsTool::page_manage';

    /**
     * @var \Magento\Backend\Model\View\Result\ForwardFactory
     */
    protected $resultForwardFactory;

    /**
     * @var \Silk\CmsTool\Model\PageRepository
     */
    protected $pageRepository;

    /**
     * @var \Silk\CmsTool\Model\PageFactory
     */
    protected $pageFactory;

    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    public function __construct(
        Context $context,
        \Magento\Backend\Model\View\Result\ForwardFactory $resultForwardFactory,
        \Silk\CmsTool\Model\Api\PageRepository $pageRepository,
        \Silk\CmsTool\Model\CmstoolPageFactory $pageFactory,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context);
        $this->resultForwardFactory = $resultForwardFactory;
        $this->pageRepository = $pageRepository;
        $this->pageFactory = $pageFactory;
        $this->registry = $registry;
    }

    /**
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('Silk_CmsTool::page_manage');
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Cms Page'));
        return $resultPage;
    }
}
