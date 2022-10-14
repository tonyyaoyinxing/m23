<?php

namespace Silk\CmsTool\Block\Adminhtml\Edit\Block;

use Magento\Backend\Block\Template;


class Edit extends Template
{
    const DRAW_URL = 'cmstool/block/draw';
    protected $_template = 'block/edit.phtml';
    /**
     * @return string
     */
    public function getDrawUrl()
    {
        return $this->getUrl(self::DRAW_URL);
    }
}
