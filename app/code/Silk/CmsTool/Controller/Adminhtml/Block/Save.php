<?php

namespace Silk\CmsTool\Controller\Adminhtml\Block;

use Silk\CmsTool\Api\Data\BlockInterface;
use Silk\CmsTool\Controller\Adminhtml\Block\AbstractBlock;

class Save extends AbstractBlock
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        // $resultRedirect = $this->resultRedirectFactory->create();
        // $moduleId = (int)$this->getRequest()->getParam(ModuleInterface::PAGE_ID);

        // try {
        //     if ($moduleId) {
        //         /** @var  \Silk\CmsTool\Model\Module $model */
        //         $model = $this->moduleRepository->getById($moduleId);
        //     } else {
        //         $model = $this->moduleFactory->create();
        //     }   
        //     $model->setData($this->getRequest()->getParams());
        //     $this->moduleRepository->save($model);
        //     $this->messageManager->addSuccessMessage(__('You have saved the Module.'));
        // } catch (\Magento\Framework\Exception\AlreadyExistsException $e) {
        //     $this->messageManager->addErrorMessage(
        //         __('A Module with the same term already exists in an associated store.')
        //     );
        // } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
        //     $this->messageManager->addErrorMessage(__('This Module no longer exists.'));
        //     $resultRedirect = $this->resultRedirectFactory->create();
        // }

        return $resultRedirect->setPath('*/*/');
    }
}
