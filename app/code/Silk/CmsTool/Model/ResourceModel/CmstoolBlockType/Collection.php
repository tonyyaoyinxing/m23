<?php
namespace Silk\CmsTool\Model\ResourceModel\CmstoolBlockType;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            \Silk\CmsTool\Model\CmstoolBlockType::class,
            \Silk\CmsTool\Model\ResourceModel\CmstoolBlockType::class
        );
    }
}