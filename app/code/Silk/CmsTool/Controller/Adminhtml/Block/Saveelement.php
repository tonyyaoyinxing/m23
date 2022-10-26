<?php

namespace Silk\CmsTool\Controller\Adminhtml\Block;


use Silk\CmsTool\Controller\Adminhtml\Block\AbstractBlock;

class Saveelement extends AbstractBlock
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $data = $this->getRequest()->getParam('data');
        $elementId = $this->getRequest()->getParam('type_id');
        $jsonResult = $this->jsonResultFactory->create();
        try {
            if ($elementId) {
                /** @var  \Silk\CmsTool\Model\Module $model */
                $model = $this->elementFactory->load($elementId);
            } else {
                $model = $this->elementFactory->create();
            }
            $model->setData('block_type_id','1');   
            $model->setData('type_json',$data);
            $model->save();
        } catch (\Magento\Framework\Exception\AlreadyExistsException $e) {
            $jsonResult->setData(['code'=>500,'message'=>'failed']);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $jsonResult->setData(['code'=>500,'message'=>'failed']);
        }
        $jsonResult->setData(['code'=>200,'message'=>'success']);
        return $jsonResult;
    }
}
