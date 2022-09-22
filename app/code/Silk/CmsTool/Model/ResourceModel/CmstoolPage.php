<?php
namespace Silk\CmsTool\Model\ResourceModel;

class CmstoolPage extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('cmstool_page', 'page_id');
    }
}