<?php
namespace Silk\CmsTool\Api\Data;

interface TypeInterface{
	/**#@+
     * Constants defined for keys of data array
     */
    const TYPE_ID = 'type_id';
    const BLOCK_TYPE_ID = 'block_type_id';
    const NAME = 'name';
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
}
?>