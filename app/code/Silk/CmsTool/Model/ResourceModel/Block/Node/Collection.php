<?php
namespace Silk\CmsTool\Model\ResourceModel\Menu\Node;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Silk\CmsTool\Model\Block\Node::class,
            \Silk\CmsTool\Model\ResourceModel\Block\Node::class
        );
    }
}
