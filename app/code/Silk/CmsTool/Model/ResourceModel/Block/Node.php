<?php

declare(strict_types=1);

namespace Silk\CmsTool\Model\ResourceModel\Block;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Node extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('snowmenu_node', 'node_id');
    }

    public function getFields(): array
    {
        return $this->getConnection()->describeTable($this->getMainTable());
    }
}
