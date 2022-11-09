<?php
namespace Silk\CmsTool\Controller\Adminhtml\Common;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory as JsonResultFactory;
use Magento\Framework\Webapi\Exception as WebapiException;
use Psr\Log\LoggerInterface;
use Silk\CmsTool\Model\Image\File as ImageFile;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\CsrfAwareActionInterface;
class UploadImage extends Action implements HttpPostActionInterface,CsrfAwareActionInterface
{

    /**
     * @var JsonResultFactory
     */
    private $jsonResultFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var ImageFile
     */
    private $imageFile;


    public function __construct(
        Context $context,
        JsonResultFactory $jsonResultFactory,
        LoggerInterface $logger,
        ImageFile $imageFile
    ) {
        $this->jsonResultFactory = $jsonResultFactory;
        $this->logger = $logger;
        $this->imageFile = $imageFile;

        parent::__construct($context);
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $jsonResult = $this->jsonResultFactory->create();
        $request = $this->getRequest();
        $currentImage = $request->getPost('current_image');
        try {
            if ($currentImage) {
                $this->imageFile->delete($currentImage);
            }
            $result = $this->imageFile->upload();
    
        } catch (Exception $exception) {
            $this->logger->critical($exception);
            $jsonResult->setHttpResponseCode(WebapiException::HTTP_INTERNAL_ERROR);

            $result = ['error' => __('image upload failed.')];
        }

        $jsonResult->setData($result['url']);

        return $jsonResult;
    }
    public function createCsrfValidationException(RequestInterface $request): ? InvalidRequestException
    {
        return null;
    }
        
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return true;
    }
}
