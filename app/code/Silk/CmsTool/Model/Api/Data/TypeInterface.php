<?php

namespace Silk\CmsTool\Model\Api\Data;

use Magento\Framework\Api\AbstractSimpleObject;
use Silk\CmsTool\Api\Data\TypeInterface;

class Type extends AbstractSimpleObject implements TypeInterface
{
    /**
     * Get type id
     *
     * @return int
     */
    public function getTypeId()
    {
        return $this->_get(self::TYPE_ID);
    }

    /**
     * Set type id
     *
     * @param int $typeId
     *
     * @return $this
     */
    public function setTypeId($typeId)
    {
        return $this->setData(self::TYPE_ID, $typeId);
    }
    /**
     * Get block type id
     *
     * @return int
     */
    public function getBlockTypeId()
    {
        return $this->_get(self::BLOCK_TYPE_ID);
    }

    /**
     * Set block type id
     *
     * @param int $blockTypeId
     *
     * @return $this
     */
    public function setBlockTypeId($blockTypeId)
    {
        return $this->setData(self::BLOCK_TYPE_ID, $blockTypeId);
    }
    /**
     * Get name
     *
     * @return int
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Set name
     *
     * @param int $name
     *
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
    /**
     * Get width
     *
     * @return int
     */
    public function getWidth()
    {
        return $this->_get(self::WIDTH);
    }

    /**
     * Set width
     *
     * @param int $width
     *
     * @return $this
     */
    public function setWidth($width)
    {
        return $this->setData(self::WIDTH, $width);
    }
    /**
     * Get height
     *
     * @return int
     */
    public function getHeight()
    {
        return $this->_get(self::HEIGHT);
    }

    /**
     * Set height
     *
     * @param int $height
     *
     * @return $this
     */
    public function setHeight($height)
    {
        return $this->setData(self::HEIGHT, $height);
    }
}
