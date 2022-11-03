<?php

namespace Silk\CmsTool\Model\Config\Source;


class TemplateId implements \Magento\Framework\Option\ArrayInterface
{
    protected $apiService;

    public function __construct(
        \Silk\CmsTool\Model\Api\VideoApiService $apiService
    ){
        $this->apiService = $apiService;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        $params['Action'] = 'ListTranscodeTemplateGroup';
        $params['SignatureNonce'] = md5(uniqid(mt_rand(), true));
        $result = $this->apiService->getResult($params);
        if(isset($result['TranscodeTemplateGroupList'])&&!empty($result['TranscodeTemplateGroupList']))
        {
            foreach($result['TranscodeTemplateGroupList'] as $attribute)
            {
                $options[] = ['label' => __($attribute['Name']), 'value' => $attribute['TranscodeTemplateGroupId']];
            }
        }
        return $options;
    }
}
