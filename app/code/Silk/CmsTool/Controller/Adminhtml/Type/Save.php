<?php

namespace Silk\CmsTool\Controller\Adminhtml\Type;

use Silk\CmsTool\Api\Data\TypeInterface;

class Save extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $blockTypeId = (int)$this->getRequest()->getParam(TypeInterface::BLOCK_TYPE_ID);
        try {
            if ($blockTypeId) {
                /** @var  \Silk\CmsTool\Model\CmstoolBlockType $model */
                $model = $this->typeFactory->create()->load($blockTypeId);
            } else {
                $model = $this->typeFactory->create();
            }   
            $model->setData('name',$this->getRequest()->getParam(TypeInterface::NAME));
            $model->setData('width',$this->getRequest()->getParam(TypeInterface::WIDTH));
            $model->setData('height',$this->getRequest()->getParam(TypeInterface::HEIGHT));
            $model->save($model);
            $this->messageManager->addSuccessMessage(__('You have saved the Block Type.'));
        } catch (\Magento\Framework\Exception\AlreadyExistsException $e) {
            $this->messageManager->addErrorMessage(
                __('A Page with the same term already exists in an associated store.')
            );
        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage(__('This Block Type no longer exists.'));
            $resultRedirect = $this->resultRedirectFactory->create();
        }
        return $resultRedirect->setPath('*/*/');
    }
}
