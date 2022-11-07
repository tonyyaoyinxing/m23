<?php
namespace Silk\CmsTool\Api\Data;

interface TypeInterface{
	/**#@+
     * Constants defined for keys of data array
     */
    const TYPE_ID = 'type_id';
    const BLOCK_TYPE_ID = 'block_type_id';
    const NAME = 'name';
    const WIDTH = 'width';
    const HEIGHT = 'height';
    /**
     * @return int
     */
    public function getTypeId();
    /**
     * @param int $typeId
     *
     * @return $this
     */
    public function setTypeId($typeId);
    /**
     * @return int
     */
    public function getBlockTypeId();
    /**
     * @param int $blockTypeId
     *
     * @return $this
     */
    public function setBlockTypeId($blockTypeId);
    /**
     * @return string
     */
    public function getName();
    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);
    /**
     * @return string
     */
    public function getWidth();
    /**
     * @param string $width
     *
     * @return $this
     */
    public function setWidth($width);
    /**
     * @return string
     */
    public function getHeight();
    /**
     * @param string $height
     *
     * @return $this
     */
    public function setHeight($height);
}
?>