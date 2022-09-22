<?php

namespace Silk\CmsTool\Model\Api\Data;

use Magento\Framework\Api\AbstractSimpleObject;
use Silk\CmsTool\Api\Data\PageInterface;

class Page extends AbstractSimpleObject implements PageInterface
{
    /**
     * Get page id
     *
     * @return int
     */
    public function getPageId()
    {
        return $this->_get(self::PAGE_ID);
    }

    /**
     * Set page id
     *
     * @param int $pageId
     *
     * @return $this
     */
    public function setPageId($pageId)
    {
        return $this->setData(self::PAGE_ID, $pageId);
    }
}
