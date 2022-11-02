<?php

namespace Silk\CmsTool\Controller\Adminhtml\Common;

use Magento\Backend\App\Action\Context;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory as JsonResultFactory;
class Validatesku extends Action
{
    const ADMIN_RESOURCE = 'Silk_CmsTool::type_manage';

    /**
     * @var JsonResultFactory
     */
    protected $jsonResultFactory;
    protected $productRepository;
    public function __construct(
        Context $context,
        JsonResultFactory $jsonResultFactory,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    ) {
        parent::__construct($context);
        $this->jsonResultFactory = $jsonResultFactory;
        $this->productRepository = $productRepository;
    }
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $sku = $this->getRequest()->getParam('sku');
        $jsonResult = $this->jsonResultFactory->create();
        try {
            if ($sku) {
                $product = $this->productRepository->get($sku);
                $data['name'] = $product->getName();
                $data['price'] = $product->getPrice();
                $jsonResult->setData(['code'=>200,'message'=>'success']);
            }
        } catch (\Magento\Framework\Exception\AlreadyExistsException $e) {
            $jsonResult->setData(['code'=>500,'message'=>$e->getMessage()]);
        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $jsonResult->setData(['code'=>500,'message'=>$exception->getMessage()]);
        }
        return $jsonResult;
    }
}
