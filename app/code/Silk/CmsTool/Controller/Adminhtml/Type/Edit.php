<?php



namespace Silk\CmsTool\Controller\Adminhtml\Type;

use Magento\Framework\Controller\ResultFactory;
use Silk\CmsTool\Api\Data\TypeInterface;

class Edit extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function execute()
    {
        $typeId = (int)$this->getRequest()->getParam(TypeInterface::TYPE_ID);

        try {
            if ($typeId) {
                /** @var  \Silk\CmsTool\Model\Type $model */
                $model = $this->typeRepository->getById($typeId);
            } else {
                $model = $this->typeFactory->create();
            }

        } catch (\Magento\Framework\Exception\NoSuchEntityException $exception) {
            $this->messageManager->addErrorMessage(__('This Type no longer exists.'));
            $resultRedirect = $this->resultRedirectFactory->create();

            return $resultRedirect->setPath('*/*/');
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);

        $text = $model->getId() ? __('Edit Cms Type "%1"', $model->getName()) : __('New Cms Type');
        $this->initPage($resultPage)->getConfig()->getTitle()->prepend($text);

        return $resultPage;
    }
}
