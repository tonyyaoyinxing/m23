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
        $data = $this->getRequest()->getParams();
        $blockId = $this->getRequest()->getParam('block_id');
        $resultRedirect = $this->resultRedirectFactory->create();
        try {
            if ($blockId) {
                $model = $this->blockFactory->create()->load($blockId);
            } else {
                $model = $this->blockFactory->create();
            }   
            $model->setData('name',$data['name']);
            $model->setData('width',$data['width']);
            $model->setData('height',$data['height']);
            $model->save();
            $this->messageManager->addSuccessMessage(__('You have saved the Block Type.'));
        } catch (\Magento\Framework\Exception\AlreadyExistsException $e) {
            $this->messageManager->addErrorMessage(
                __('A Page with the same term already exists in an associated store.')
            );
        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage(__('This Block Type no longer exists.'));
        }
        return $resultRedirect->setPath('*/*/');
    }
}
