<?php

namespace Silk\CmsTool\Block\Adminhtml\CmsTool;

class BlockList extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * Class constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_cmstool_index';
        parent::_construct();
        $this->_headerText = __('Cmstool Block');
    }
}
