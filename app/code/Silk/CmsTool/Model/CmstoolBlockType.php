<?php
namespace Silk\CmsTool\Model;

class CmstoolBlockType extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Silk\CmsTool\Model\ResourceModel\CmstoolBlockType');
    }
    public function getAllActiveModel()
    {
        $connection = $this->getResource()->getConnection();
        $select = $connection->select()->from($this->getResource()->getTable('cmstool_block_type'), ['block_type_id','type_json'])->where(
            'is_active = 1'
        );
        $data = $connection->fetchAll($select);
        if($data)
        {
            foreach($data as $key=>$val)
            {
                $data[$key]['type_json'] = json_decode($data[$key]['type_json'],true);
            }
        }
        return $data;
    }
    public function getAllActiveModelMenu()
    {
        $connection = $this->getResource()->getConnection();
        $select = $connection->select()->from($this->getResource()->getTable('cmstool_block_type'), ['block_type_id','name as title'])->where(
            'is_active = 1'
        );
        return $connection->fetchAll($select);
    }
}