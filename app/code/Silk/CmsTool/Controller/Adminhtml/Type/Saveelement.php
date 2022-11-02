<?php

namespace Silk\CmsTool\Controller\Adminhtml\Type;

use Silk\CmsTool\Controller\Adminhtml\Type\AbstractType;

class Saveelement extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $data = $this->getRequest()->getParam('data');
        $blockTypeId = $this->getRequest()->getParam('block_type_id');
        $jsonResult = $this->jsonResultFactory->create();
        try {
            if ($blockTypeId) {
                /** @var  \Silk\CmsTool\Model\CmstoolBlockType $model */
                $model = $this->typeFactory->create();
                $model->load($blockTypeId);
            } else {
                $model = $this->typeFactory->create();
            }
            $model->setData('type_json',$data);
            $model->save();
            $jsonResult->setData(['code'=>200,'message'=>'success']);
        } catch (\Magento\Framework\Exception\AlreadyExistsException $e) {
            $jsonResult->setData(['code'=>500,'message'=>'failed']);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $jsonResult->setData(['code'=>500,'message'=>'failed']);
        }
        return $jsonResult;
    }
}
