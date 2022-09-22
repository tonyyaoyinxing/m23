<?php
namespace Silk\CmsTool\Api\Data;

interface BlockInterface{
	/**#@+
     * Constants defined for keys of data array
     */
    const BLOCK_ID = 'block_id';
    /**
     * @return int
     */
    public function getBlockId();
    /**
     * @param int $blockId
     *
     * @return $this
     */
    public function setBlockId($blockId);
    
}
?>