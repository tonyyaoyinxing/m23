<?php
namespace Silk\CmsTool\Model\ResourceModel;

class CmstoolBlockType extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cmstool_block_type', 'block_type_id');
    }
}