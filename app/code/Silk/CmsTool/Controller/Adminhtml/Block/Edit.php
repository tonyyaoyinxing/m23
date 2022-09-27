<?php



namespace Silk\CmsTool\Controller\Adminhtml\Block;

use Magento\Framework\Controller\ResultFactory;
use Silk\CmsTool\Api\Data\BlockInterface;
use \Silk\CmsTool\Controller\Adminhtml\Block\AbstractBlock;
class Edit extends AbstractBlock
{
    const REGISTRY_CODE = 'cmstool_block';
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $blockId = (int)$this->getRequest()->getParam(BlockInterface::BLOCK_ID);
        try {
            if ($blockId) {
                /** @var  \Silk\CmsTool\Model\Block $model */
                $model = $this->blockRepository->getById($blockId);
            } else {
                $model = $this->blockFactory->create();
            }
        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage(__('This Page no longer exists.'));
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('*/*/');
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $text = $model->getId() ? __('Edit Cms Block "%1"', $model->getName()) : __('New Cms Block');
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend($text);

        return $resultPage;
    }
}
