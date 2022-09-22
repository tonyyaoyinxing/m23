<?php
namespace Silk\CmsTool\Model;

class CmstoolBlock extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Silk\CmsTool\Model\ResourceModel\CmstoolBlock');
    }
}