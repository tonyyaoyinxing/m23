<?php

namespace Silk\CmsTool\Block\Adminhtml\Edit\BlockType;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Registry;
use Silk\CmsTool\Model\VueProvider;

class TypeDraw extends Template
{
    const IMAGE_UPLOAD_URL = 'cmstool/block/uploadimage';
    const SAVE_URL = 'cmstool/type/saveelement';
    protected $_template = 'type/draw.phtml';
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var VueProvider
     */
    private $vueProvider;
    /**
     * @var \Silk\CmsTool\Model\TypeFactory
     */
    protected $typeFactory;

    protected $categoryManagement;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        VueProvider $vueProvider,
        \Silk\CmsTool\Model\CmstoolBlockTypeFactory $typeFactory,
        \Magento\Catalog\Api\CategoryManagementInterface $categoryManagement,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->vueProvider = $vueProvider;
        $this->typeFactory = $typeFactory;
        $this->categoryManagement = $categoryManagement;
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
     * @return array
     */
    public function getVueComponents()
    {
        return $this->vueProvider->getComponents();
    }
    public function renderElements()
    {
        $model = $this->typeFactory->create();
        $model->load($this->getRequest()->getParam('block_type_id'));
        $data = [];
        $data = json_decode($model->getData('type_json'),true);
        // $element['width'] = 300;
        // $element['height'] = 100;
        // $element['left'] = 10;
        // $element['top'] = 10;
        // $element['isActive'] = false;
        // $element['type'] = '4';
        // $element['element_json']['headline'] = "test";
        // $element['zIndex'] = 1;
        // $data[] = $element;
        return $data;
    }
    public function getBlockTypeId()
    {
        return $this->getRequest()->getParam('block_type_id');
    }
    public function getFontSize()
    {
        $result = [];
        for($i=1;$i<50;$i++)
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
        $result = [[
            'title' => '图片',
            'class' => 'el-icon-picture',
            'items' => [
                [
                    'title'=>'背景图'
                ],
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
            'title' => '按钮',
            'class' => 'el-icon-button',
            'items' => [
                [
                    'title'=>'按钮'
                ]
            ],
        ],[
            'title' => '模板',
            'class' => 'el-icon-button',
            'items' => $modelData,
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
