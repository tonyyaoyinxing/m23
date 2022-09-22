<?php
namespace Silk\CmsTool\Model;

class CmstoolPage extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Silk\CmsTool\Model\ResourceModel\CmstoolPage');
    }
}