<?php

namespace Silk\CmsTool\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Filesystem\DirectoryList;

class Data extends AbstractHelper
{

    protected $_storeManager;

    protected $_localeDate;

    /**
     * @param \Magento\Framework\App\Helper\Context $context
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Stdlib\DateTime\TimezoneInterface $_localeDate
    ) {
        parent::__construct($context);
        $this->_storeManager = $storeManager;
        $this->_localeDate = $_localeDate;
    }

    /**
     * [getLocaleTimestamp description]
     * @return \DateTime
     */
    public function getLocaleDateTime()
    {
        return $this->_localeDate->date();
    }

    public function getStoreConfigValue($path, $storeId = null)
    {
        if($storeId == null){
            $storeId = $this->_storeManager->getStore()->getId();
        }
        return $this->scopeConfig->getValue(
            $path, \Magento\Store\Model\ScopeInterface::SCOPE_STORE, $storeId
        );
    }
}
