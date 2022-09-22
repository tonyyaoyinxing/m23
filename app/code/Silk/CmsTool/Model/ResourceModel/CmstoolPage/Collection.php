<?php
namespace Silk\CmsTool\Model\ResourceModel\CmstoolPage;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            \Silk\CmsTool\Model\CmstoolPage::class,
            \Silk\CmsTool\Model\ResourceModel\CmstoolPage::class
        );
    }
}