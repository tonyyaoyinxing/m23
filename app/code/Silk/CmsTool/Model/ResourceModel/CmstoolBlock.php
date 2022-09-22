<?php
namespace Silk\CmsTool\Model\ResourceModel;

class CmstoolBlock extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cmstool_block', 'block_id');
    }
}