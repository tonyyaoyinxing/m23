<?php
namespace Silk\CmsTool\Api\Data;

interface PageInterface{
	/**#@+
     * Constants defined for keys of data array
     */
    const PAGE_ID = 'page_id';
    /**
     * @return int
     */
    public function getPageId();
    /**
     * @param int $pageId
     *
     * @return $this
     */
    public function setPageId($pageId);
    
}
?>