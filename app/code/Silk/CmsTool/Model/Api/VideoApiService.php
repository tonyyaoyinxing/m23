<?php

namespace Silk\CmsTool\Model\Api;

class VideoApiService
{
    const MIN_VIDEO_SIZE_BYTE = 1024*20;
    private $format;
    private $version;
    private $accessKeyId;
    private $accessKeySecret;
    private $signature = null;
    private $signatureMethod;
    private $timestamp;
    private $signatureVersion;
    private $securityToken = null;
    protected $httpClientFactory;
    protected $jsonHelper;
    protected $logger;
    private $dateTimeFormat = 'Y-m-d\TH:i:s\Z';
    protected $stringToBeSigned = '';
    protected $regionId;
    /**
     * @var array
     */
    private $domainParameters = array();
    /**
     * @var string
     */
    protected $method = 'GET';

    protected $uploadVideoRequest;

    protected $helper;

    protected $productRepository;

    public function __construct(
        \Magento\Framework\HTTP\ClientFactory $httpClientFactory,
        \Magento\Framework\Json\Helper\Data $jsonHelper,
        \Silk\CmsTool\Helper\Logger $logger,
        \Silk\CmsTool\Helper\Data $helper,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository;
        $this->httpClientFactory = $httpClientFactory;
        $this->jsonHelper = $jsonHelper;
        $this->logger = $logger;
        $this->helper = $helper;
        $this->accessKeyId = $this->helper->getStoreConfigValue('video/settings/access_key_id');
        $this->accessKeySecret = $this->helper->getStoreConfigValue('video/settings/access_key_secret');
        $this->regionId = $this->helper->getStoreConfigValue('video/settings/region_id');
        $this->signatureMethod = 'HMAC-SHA1';
        $this->timestamp = gmdate($this->dateTimeFormat);
        $this->signatureVersion = '1.0';
        $this->version = '2017-03-21';
        $this->format = 'JSON';
    }

    public function getResult($params)
    {
        $url = "https://vod." . $this->regionId . ".aliyuncs.com";
        $method = "GET";
        $publicParams = $this->getPublicRequestParameters();
        $params = array_merge($params, $publicParams);
        $params['Signature'] = $this->getSignature($params, $method);
        $result = $this->requestApi($url, $params, $method);
        return $result;
    }

    public function getUrl($params)
    {
        $url = "https://vod." . $this->regionId . ".aliyuncs.com";
        $method = "GET";
        $publicParams = $this->getPublicRequestParameters();
        $params = array_merge($params, $publicParams);
        $params['Signature'] = $this->getSignature($params, $method);
        $result = $this->requestApiUrl($url, $params, $method);
        return $result;
    }

    private function getPublicRequestParameters()
    {
        $params['Format'] = $this->format;
        $params['Version'] = $this->version;
        $params['AccessKeyId'] = $this->accessKeyId;
        $params['SignatureMethod'] = $this->signatureMethod;
        $params['Timestamp'] = $this->timestamp;
        $params['SignatureVersion'] = $this->signatureVersion;
        return $params;
    }

    protected function requestApiUrl($url, $params = [], $method = "POST")
    {
        if (strtoupper($method) == 'POST') {
            $apiUrl = $url;
        } elseif (strtoupper($method) == 'GET' && !empty($params)) {
            $apiUrl = $url . "?" . http_build_query($params);
        }
        return $apiUrl;
    }

    protected function requestApi($url, $params = [], $method = "POST")
    {
        if (strtoupper($method) == 'POST') {
            $apiUrl = $url;
        } elseif (strtoupper($method) == 'GET' && !empty($params)) {
            $apiUrl = $url . "?" . http_build_query($params);
        }
        $headers = [
            'Content-Type' => 'application/json',
            'Expect' => '100-continue'
        ];
        try {
            $client = $this->httpClientFactory->create();
            $client->setHeaders($headers);
            $client->setTimeout(30);
            $client->setOption(CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            if (strtoupper($method) == 'POST') {
                $client->post($apiUrl, $this->jsonHelper->jsonEncode($params));
            } else {
                $client->get($apiUrl);
            }
            $response = $client->getBody();
            $result = $this->processResponse($response, $apiUrl, $params);
            return $result;
        } catch (\Exception $e) {
            $this->logger->writeInfo("aliyun_video", 'Error', $e->getMessage());
            return null;
        }
    }

    /**
     * @param $response
     * @param $apiUrl
     * @param $request
     * @return mixed
     */
    protected function processResponse($response, $apiUrl, $request)
    {
        $request['api_url'] = $apiUrl;
        $this->logger->writeInfo('aliyun_video', 'Request', $this->jsonHelper->jsonEncode($request));
        $this->logger->writeInfo('aliyun_video', 'Response', $response);
        $result = $this->jsonHelper->jsonDecode($response);
        return $result;
    }

    private function getSignature($apiParams, $method)
    {
        $signature = $this->computeSignature($apiParams, $this->helper->getStoreConfigValue('video/settings/access_key_secret'), $method);
        return $signature;
    }

    public function signString($source, $accessSecret)
    {
        return base64_encode(hash_hmac('sha1', $source, $accessSecret, true));
    }

    /**
     * @param $parameters
     * @param $accessKeySecret
     *
     * @return mixed
     */
    private function computeSignature($parameters, $accessKeySecret, $method)
    {
        ksort($parameters);
        $canonicalizedQueryString = '';
        foreach ($parameters as $key => $value) {
            $canonicalizedQueryString .= '&' . $this->percentEncode($key) . '=' . $this->percentEncode($value);
        }
        $this->stringToBeSigned =
            $method . '&%2F&' . $this->percentEncode(substr($canonicalizedQueryString, 1));
        return $this->signString($this->stringToBeSigned, $accessKeySecret . '&');
    }

    /**
     * @param $str
     *
     * @return string|string[]|null
     */
    protected function percentEncode($str)
    {
        $res = urlencode($str);
        $res = str_replace(array('+', '*'), array('%20', '%2A'), $res);
        $res = preg_replace('/%7E/', '~', $res);
        return $res;
    }


    /**
     * @param $videoId
     * @return mixed
     */
    public function getVideoDetailInfo($videoId)
    {
        if (!empty($videoId)) {
            try {
                $params['Action'] = 'GetPlayInfo';
                $params['VideoId'] = $videoId;
                $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
                $params['isAjax'] = 'true';
                $authTimeout = $this->helper->getStoreConfigValue('video/settings/auth_timeout');
                $enableUrlAuthentication = $this->helper->getStoreConfigValue('video/settings/enable_url_authentication');
                if ($enableUrlAuthentication) {
                    $params['AuthTimeout'] = $authTimeout ? $authTimeout : '3600';
                }
                $result = $this->getResult($params);
                $size = isset($result['PlayInfoList']['PlayInfo'][0]['Size']) ? $result['PlayInfoList']['PlayInfo'][0]['Size'] : 0;
                $validSize = ($size >= self::MIN_VIDEO_SIZE_BYTE) ? true:false;
                $data['video_url'] = ($validSize && isset($result['PlayInfoList']['PlayInfo'][0]['PlayURL'])) ? $result['PlayInfoList']['PlayInfo'][0]['PlayURL'] : '';
                $data['video_cover_url'] = ($validSize && isset($result['VideoBase']['CoverURL'])) ? $result['VideoBase']['CoverURL'] : '';
                $data['video_height'] = ($validSize && isset($result['PlayInfoList']['PlayInfo'][0]['Height'])) ? $result['PlayInfoList']['PlayInfo'][0]['Height'] . 'px' : '';
                $data['video_width'] = ($validSize && isset($result['PlayInfoList']['PlayInfo'][0]['Width'])) ? $result['PlayInfoList']['PlayInfo'][0]['Width'] . 'px' : '';
                $data['video_duration'] = ($validSize && isset($result['PlayInfoList']['PlayInfo'][0]['Duration'])) ? $result['PlayInfoList']['PlayInfo'][0]['Duration'] : '';
                $data['video_size'] =$size;
                $this->logger->writeInfo('aliyun_video', 'VideoDetail', $this->jsonHelper->jsonEncode($data));
            } catch (\Exception $exception) {
                $data['video_url'] = $data['video_height'] = $data['video_width'] = $data['video_duration'] = $data['video_cover_url'] = '';
                $this->logger->writeInfo('aliyun_video', 'VideoDetail', $exception->getMessage());
            }
        } else {
            $data['video_url'] = $data['video_height'] = $data['video_width'] = $data['video_duration'] = $data['video_cover_url'] = '';
        }
        return $data;
    }


    /**
     * 获取媒体上传详情 可批量查询
     * @param $mediaIds 媒资ID。多个支持视频ID，请使用英文逗号（,）分隔，最多支持20个
     * @return mixed|null
     */
    public function GetUploadDetails($mediaIds)
    {
        if (is_array($mediaIds)) {
            $mediaIds = implode(',', $mediaIds);
        }
        $params['Action'] = 'GetUploadDetails';
        $params['MediaIds'] = $mediaIds;
        $params['MediaType'] = 'video';//非必传
        $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
        $data = $this->getResult($params);
        return $data;

    }


    /**
     * 获取video上传凭证信息
     * @param $fileData
     * @return mixed|null
     */
    public function createUploadVideo($fileData)
    {
        $templateGroupId = $this->helper->getStoreConfigValue('video/settings/template_group_id');
        $enableTranscoding = $this->helper->getStoreConfigValue('video/settings/enable_transcoding');
        $params['Action'] = 'CreateUploadVideo';
        $params['FileName'] = $fileData['fileName'];
        $params['Title'] = $fileData['fileTitle'];
        if ($enableTranscoding) {
            if ($templateGroupId) {
                $params['TemplateGroupId'] = $templateGroupId;
            }
        }
        $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
        $params['isAjax'] = 'true';
        $data = $this->getResult($params);
        return $data;

    }

    public function GetVideoPlayAuth($videoId)
    {

        $params['Action'] = 'GetVideoPlayAuth';
        $params['VideoId'] = $videoId;
        $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
        $data = $this->getResult($params);
        return $data;
    }

    public function getRefreshVideo($videoId)
    {
        $params['Action'] = 'RefreshUploadVideo';
        $params['VideoId'] = $videoId;
        $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
        $data = $this->getResult($params);
        return $data;
    }

    public function getPlayInfo($videoId)
    {
        $params['Action'] = 'GetPlayInfo';
        $params['VideoId'] = $videoId;
        $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
        $data = $this->getResult($params);
        return $data;
    }

    /**
     * @param $sku
     * @param $storeId
     * @param $id
     * @return array
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getProductVideoId($id = false, $sku, $storeId): array
    {
        if ($sku && !$id) {
            $product = $this->productRepository->get($sku, false, $storeId);
        } else {
            $product = $this->productRepository->getById($id, false, $storeId);
        }

        $uploadVideoId = $product->getData('upload_video_id');
        $paiVideoId = $product->getData('pai_video_id');
        $paiSyncStatus = $product->getData('is_sync_video');
        //todo::获取视屏播放链接
        $videoId = $uploadVideoId ? $uploadVideoId : (($paiSyncStatus && $paiVideoId) ? $paiVideoId : "");
        return array($product, $videoId);
    }


}
