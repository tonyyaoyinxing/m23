<?php

namespace Silk\CmsTool\Model\Api\Data;

use Magento\Framework\Api\AbstractSimpleObject;
use Silk\CmsTool\Api\Data\BlockInterface;

class Block extends AbstractSimpleObject implements BlockInterface
{
    /**
     * Get block id
     *
     * @return int
     */
    public function getBlockId()
    {
        return $this->_get(self::BLOCK_ID);
    }

    /**
     * Set block id
     *
     * @param int $blockId
     *
     * @return $this
     */
    public function setBlockId($blockId)
    {
        return $this->setData(self::BLOCK_ID, $blockId);
    }
}
