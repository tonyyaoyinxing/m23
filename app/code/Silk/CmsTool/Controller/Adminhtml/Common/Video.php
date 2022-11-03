<?php


namespace Silk\CmsTool\Controller\Adminhtml\Common;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultFactory;

class Video extends \Magento\Backend\App\Action implements HttpPostActionInterface
{

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJsonFactory;

    protected $apiService;

    protected $helper;
    /**
     * Upload constructor.
     *
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Silksoftwarecorp\CustomerRule\Model\ImageUploader $imageUploader
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Silk\CmsTool\Model\Api\VideoApiService $apiService,
        \Silk\CmsTool\Helper\Data $helper,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->apiService = $apiService;
        $this->helper = $helper;
        parent::__construct($context);
    }

    /**
     * Upload file controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $action = $this->getRequest()->getParam('action');
        $filename = $this->getRequest()->getParam('filename');
        $title = $this->getRequest()->getParam('title');
        $videoId = $this->getRequest()->getParam('video_id');
        $templateType = $this->getRequest()->getParam('template_type');
        $templateIdPc = $this->helper->getStoreConfigValue('video/settings/template_group_id');
        $templateIdMb = $this->helper->getStoreConfigValue('video/settings/template_group_id_mb');
        $authTimeout = $this->helper->getStoreConfigValue('video/settings/auth_timeout');
        $enableUrlAuthentication = $this->helper->getStoreConfigValue('video/settings/enable_url_authentication');
        $enableTranscoding = $this->helper->getStoreConfigValue('video/settings/enable_transcoding');
        if($action=='CreateUploadVideo'){
            $params['Action'] = $action;
            $params['FileName'] = $filename;
            $params['Title'] = $title;
            if($enableTranscoding)
            {
                if($templateType=='1'&&$templateIdPc)
                {
                    $params['TemplateGroupId'] = $templateIdPc;
                }else if($templateType=='2'&&$templateIdMb){
                    $params['TemplateGroupId'] = $templateIdMb;
                }
            }
            $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
            $params['isAjax'] = 'true';
            $data = $this->apiService->getResult($params);
            $response = ['data' => $data, 'code' => 200];
        }else if($action=='RefreshUploadVideo'){
            $params['Action'] = $action;
            $params['VideoId'] = $videoId;
            $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
            $params['isAjax'] = 'true';
            $data = $this->apiService->getResult($params);
            $response = ['data' => $data, 'code' => 200];
        }else if($action=='GetPlayInfo'){
            $params['Action'] = $action;
            $params['VideoId'] = $videoId;
            $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
            $params['isAjax'] = 'true';
            if($enableUrlAuthentication)
            {
                $params['AuthTimeout'] = $authTimeout?$authTimeout:'3600';
            }
            $result = $this->apiService->getResult($params);
            $url = isset($result['PlayInfoList']['PlayInfo'][0]['PlayURL'])?$result['PlayInfoList']['PlayInfo'][0]['PlayURL']:'';
            $coverurl = isset($result['VideoBase']['CoverURL'])?$result['VideoBase']['CoverURL']:'';
            $response = ['url' => $url,'coverurl'=>$coverurl,'code' => 200];
        }else if($action=='GetVideoInfo'){
            $params['Action'] = $action;
            $params['VideoId'] = $videoId;
            $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
            $params['isAjax'] = 'true';
            $result = $this->apiService->getResult($params);
            $response = ['code' => 200];
        }else{
            $response = ['message' => "File not found or System error!", 'errorcode' => 404];
        }

        $resultJson = $this->resultJsonFactory->create();
        
        return $resultJson->setData($response);
    }
}