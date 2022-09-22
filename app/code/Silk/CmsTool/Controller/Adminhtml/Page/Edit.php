<?php



namespace Silk\CmsTool\Controller\Adminhtml\Page;

use Magento\Framework\Controller\ResultFactory;
use Silk\CmsTool\Api\Data\PageInterface;

class Edit extends AbstractPage
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $pageId = (int)$this->getRequest()->getParam(PageInterface::PAGE_ID);

        try {
            if ($pageId) {
                /** @var  \Silk\CmsTool\Model\Page $model */
                $model = $this->pageRepository->getById($pageId);
            } else {
                $model = $this->PageFactory->create();
            }

        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage(__('This Page no longer exists.'));
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('*/*/');
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $text = $model->getId() ? __('Edit Cms Page "%1"', $model->getName()) : __('New Cms Page');
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend($text);

        return $resultPage;
    }
}
