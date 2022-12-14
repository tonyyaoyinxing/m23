<?php

namespace Silk\CmsTool\Block\Adminhtml\Edit\BlockType;

use Magento\Backend\Block\Template;
use Magento\Framework\Registry;
use Silk\CmsTool\Model\VueProvider;

class Edit extends Template
{
    const DRAW_URL = 'cmstool/type/draw';
    protected $_template = 'type/edit.phtml';
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

    public function __construct(
        Template\Context $context,
        Registry $registry,
        VueProvider $vueProvider,
        \Silk\CmsTool\Model\CmstoolBlockTypeFactory $typeFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->vueProvider = $vueProvider;
        $this->typeFactory = $typeFactory;
    }
    /**
     * @return string
     */
    public function getDrawUrl()
    {
        return $this->getUrl(self::DRAW_URL,['block_type_id'=>$this->getRequest()->getParam('block_type_id')]);
    }
    public function renderElement()
    {
        $model = $this->typeFactory->create();
        $model->load($this->getRequest()->getParam('block_type_id'));
        $this->registry->register('block',$model);
        $data = [];
        $data = json_decode($model->getData('type_json'),true);
        if($data)
        {
            foreach($data as $k=>$v)
            {
                $data[$k]['draggable'] = false;
                $data[$k]['resizable'] = false;
            }
        }
        return $data;
    }
    /**
     * @return array
     */
    public function getVueComponents()
    {
        return $this->vueProvider->getComponents();
    }
    public function getBlockWidth()
    {
        $model = $this->registry->registry('block');
        return $model->getWidth()?$model->getWidth():0;
    }
    public function getBlockHeight()
    {
        $model = $this->registry->registry('block');
        return $model->getHeight()?$model->getHeight():0;
    }
}
