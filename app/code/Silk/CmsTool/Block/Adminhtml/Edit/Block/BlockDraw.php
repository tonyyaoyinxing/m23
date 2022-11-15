<?php

namespace Silk\CmsTool\Block\Adminhtml\Edit\Block;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Registry;
use Silk\CmsTool\Model\VueProvider;

class BlockDraw extends Template
{
    const IMAGE_UPLOAD_URL = 'cmstool/common/uploadimage';
    const SAVE_URL = 'cmstool/block/saveelement';
    const MEMBER_URL = 'customer/account/index';
    const REGISTER_URL = 'customer/account/create';
    const LOGIN_URL = 'customer/account/login';
    const SKU_URL = 'cmstool/common/validatesku';
    protected $_template = 'block/draw.phtml';
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var VueProvider
     */
    private $vueProvider;
    /**
     * @var \Silk\CmsTool\Model\CmsToolBlockTypeFactory
     */
    protected $typeFactory;
/**
     * @var \Silk\CmsTool\Model\CmsToolBlockFactory
     */
    protected $blockFactory;

    protected $categoryManagement;

     /**
     * App Emulator
     *
     * @var \Magento\Store\Model\App\Emulation
     */
    protected $_emulation;
    protected $urlHelper;
    public function __construct(
        Template\Context $context,
        Registry $registry,
        VueProvider $vueProvider,
        \Silk\CmsTool\Model\CmstoolBlockTypeFactory $typeFactory,
        \Silk\CmsTool\Model\CmstoolBlockFactory $blockFactory,
        \Magento\Catalog\Api\CategoryManagementInterface $categoryManagement,
        \Magento\Store\Model\App\Emulation $emulation,
        \Magento\Framework\Url $urlHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->vueProvider = $vueProvider;
        $this->typeFactory = $typeFactory;
        $this->blockFactory = $blockFactory;
        $this->categoryManagement = $categoryManagement;
        $this->urlHelper = $urlHelper;
        $this->_emulation = $emulation;
    }

    /**
     * @return string
     */
    public function getImageUploadUrl()
    {
        return $this->getUrl(self::IMAGE_UPLOAD_URL);
    }
    /**
     * @return string
     */
    public function getSaveUrl()
    {
        return $this->getUrl(self::SAVE_URL);
    }
    /**
     * @return string
     */
    public function getSkuUrl()
    {
        return $this->getUrl(self::SKU_URL);
    }
    public function getMemeberUrl()
    {
        $this->_emulation->startEnvironmentEmulation(null, \Magento\Framework\App\Area::AREA_FRONTEND, true);
        $url = $this->urlHelper->getUrl(self::MEMBER_URL);
        $this->_emulation->stopEnvironmentEmulation();
        return $url;
    }
    public function getRegisterUrl()
    {
        $this->_emulation->startEnvironmentEmulation(null, \Magento\Framework\App\Area::AREA_FRONTEND, true);
        $url = $this->urlHelper->getUrl(self::REGISTER_URL);
        $this->_emulation->stopEnvironmentEmulation();
        return $url;
    }
    public function getLoginUrl()
    {
        $this->_emulation->startEnvironmentEmulation(null, \Magento\Framework\App\Area::AREA_FRONTEND, true);
        $url = $this->urlHelper->getUrl(self::LOGIN_URL);
        $this->_emulation->stopEnvironmentEmulation();
        return $url;
    }
    /**
     * @return array
     */
    public function getVueComponents()
    {
        return $this->vueProvider->getComponents();
    }
    public function renderElements()
    {
        $model = $this->blockFactory->create();
        $model->load($this->getRequest()->getParam('block_id'));
        $this->registry->register('block',$model);
        $data = [];
        $data = json_decode($model->getData('block_json'),true);
        return $data;
    }
    public function getBlockWidth()
    {
        $model = $this->registry->registry('block');
        return $model->getWidth();
    }
    public function getBlockHeight()
    {
        $model = $this->registry->registry('block');
        return $model->getHeight();
    }
    public function getBlockId()
    {
        return $this->getRequest()->getParam('block_id');
    }
    public function getFontSize()
    {
        $result = [];
        for($i=1;$i<80;$i++)
        {
            $data['label'] = $i;
            $data['key'] = $i.'px';
            $result[] = $data;
        }
        return $result;
    }
    public function renderMenus()
    {
        $modelData = $this->typeFactory->create()->getAllActiveModelMenu();
        // var_dump($modelData);
        // exit;
        $result = [
        [
            'title' => '模板',
            'class' => 'el-icon-button',
            'items' => $modelData,
        ],[
            'title' => '图片',
            'class' => 'el-icon-picture',
            'items' => [
                [
                    'title'=>'图片'
                ]
            ],
        ],[
            'title' => '视频',
            'class' => 'el-icon-video-camera',
            'items' => [
                [
                    'title'=>'视频'
                ]
            ],
        ],[
            'title' => '文本',
            'class' => 'el-icon-document',
            'items' => [
                [
                    'title'=>'文本'
                ]
            ],
        ],[
            'title' => '倒计时',
            'class' => 'el-icon-time',
            'items' => [
                [
                    'title'=>'倒计时'
                ]
            ],
        ],[
            'title' => '跳转',
            'class' => 'el-icon-button',
            'items' => [
                [
                    'title'=>'跳转'
                ]
            ],
        ]];
        return $result;
    }
    public function getAllActiveModel()
    {
        return $this->typeFactory->create()->getAllActiveModel();
    }
    public function getCategoryTree()
    {
        try {
            $categoryTreeList = $this->categoryManagement->getTree(2);
            $result = [];
            if($categoryTreeList->getChildrenData())
            {
                $result = $this->getChildrenData($categoryTreeList->getChildrenData());
            }
            return $result;
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
    }
    protected function getChildrenData($childrenData)
    {
        $result = [];
        foreach($childrenData as $child)
        {
            $data['value'] = $child->getId();
            $data['label'] = $child->getName();
            if($child->getChildrenData())
            {
                $data['children'] = $this->getChildrenData($child->getChildrenData());
            }
            $result[] = $data;
        }
        return $result;
    }
    
}
