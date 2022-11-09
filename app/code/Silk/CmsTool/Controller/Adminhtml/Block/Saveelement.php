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
        $blockId = $this->getRequest()->getParam('block_id');
        $jsonResult = $this->jsonResultFactory->create();
        try {
            if ($blockId) {
                /** @var  \Silk\CmsTool\Model\CmsToolBlockFactory $model */
                $model = $this->blockFactory->create()->load($blockId);
            } else {
                $model = $this->blockFactory->create();
            }
            $model->setData('block_json',$data);
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
