<?php

namespace Silk\CmsTool\Model\Config\Source;


class RegionId implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 'cn-shanghai', 'label' => __('cn-shanghai')],
            ['value' => 'cn-beijing', 'label' => __('cn-beijing')],
            ['value' => 'cn-shenzhen', 'label' => __('cn-shenzhen')],
            ['value' => 'ap-southeast-1', 'label' => __('ap-southeast-1')],
            ['value' => 'ap-southeast-5', 'label' => __('ap-southeast-5')],
            ['value' => 'ap-south-1', 'label' => __('ap-south-1')],
            ['value' => 'eu-central-1', 'label' => __('eu-central-1')],
            ['value' => 'ap-northeast-1', 'label' => __('ap-northeast-1')]
        ];
    }

    /**
     * Get options in "key-value" format
     *
     * @return array
     */
    public function toArray()
    {
        return [
            'cn-shanghai' => __('cn-shanghai'),
            'cn-beijing' => __('cn-beijing'),
            'cn-shenzhen' => __('cn-shenzhen'),
            'ap-southeast-1' => __('ap-southeast-1'),
            'ap-southeast-5' => __('ap-southeast-5'),
            'ap-south-1' => __('ap-south-1'),
            'eu-central-1' => __('eu-central-1'),
            'ap-northeast-1' => __('ap-northeast-1')
        ];
    }
}
