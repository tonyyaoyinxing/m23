<?php
namespace Silk\CmsTool\Model\ResourceModel\CmstoolBlock;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            \Silk\CmsTool\Model\CmstoolBlock::class,
            \Silk\CmsTool\Model\ResourceModel\CmstoolBlock::class
        );
    }
}