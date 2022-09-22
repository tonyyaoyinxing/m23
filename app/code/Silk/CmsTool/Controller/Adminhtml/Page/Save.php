<?php

namespace Silk\CmsTool\Controller\Adminhtml\Page;

use Silk\CmsTool\Api\Data\PageInterface;

class Save extends AbstractPage
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        // $resultRedirect = $this->resultRedirectFactory->create();
        // $pageId = (int)$this->getRequest()->getParam(PageInterface::PAGE_ID);

        // try {
        //     if ($pageId) {
        //         /** @var  \Silk\CmsTool\Model\Page $model */
        //         $model = $this->pageRepository->getById($pageId);
        //     } else {
        //         $model = $this->pageFactory->create();
        //     }   
        //     $model->setData($this->getRequest()->getParams());
        //     $this->pageRepository->save($model);
        //     $this->messageManager->addSuccessMessage(__('You have saved the Page.'));
        // } catch (\Magento\Framework\Exception\AlreadyExistsException $e) {
        //     $this->messageManager->addErrorMessage(
        //         __('A Page with the same term already exists in an associated store.')
        //     );
        // } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
        //     $this->messageManager->addErrorMessage(__('This Page no longer exists.'));
        //     $resultRedirect = $this->resultRedirectFactory->create();
        // }

        return $resultRedirect->setPath('*/*/');
    }
}
