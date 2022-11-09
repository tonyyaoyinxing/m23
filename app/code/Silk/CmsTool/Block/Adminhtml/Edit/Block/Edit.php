<?php

namespace Silk\CmsTool\Block\Adminhtml\Edit\Block;

use Magento\Backend\Block\Template;
use Magento\Framework\Registry;
use Silk\CmsTool\Model\VueProvider;

class Edit extends Template
{
    const DRAW_URL = 'cmstool/block/draw';
    protected $_template = 'block/edit.phtml';
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var VueProvider
     */
    private $vueProvider;
    /**
     * @var \Silk\CmsTool\Model\CmstoolBlockFactory
     */
    protected $typeFactory;

    public function __construct(
        Template\Context $context,
        Registry $registry,
        VueProvider $vueProvider,
        \Silk\CmsTool\Model\CmstoolBlockFactory $blockFactory,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->vueProvider = $vueProvider;
        $this->blockFactory = $blockFactory;
    }
    /**
     * @return string
     */
    public function getDrawUrl()
    {
        return $this->getUrl(self::DRAW_URL,['block_id'=>$this->getRequest()->getParam('block_id')]);
    }
    public function renderElement()
    {
        $model = $this->blockFactory->create();
        $model->load($this->getRequest()->getParam('block_id'));
        $this->registry->register('block',$model);
        $data = [];
        if($model->getData('block_json'))
        {
            $data = json_decode($model->getData('block_json'),true);
            if($data)
            {
                foreach($data as $k=>$v)
                {
                    $data[$k]['draggable'] = false;
                    $data[$k]['resizable'] = false;
                }
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
}
