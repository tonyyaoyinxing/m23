<?php

namespace Silk\CmsTool\Block\Adminhtml\Edit\Block;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Registry;
use Silk\CmsTool\Model\VueProvider;

class MainDraw extends Template implements TabInterface
{
    const IMAGE_UPLOAD_URL = 'cmstool/block/uploadimage';
    protected $_template = 'block/draw.phtml';
    /**
     * @var Registry
     */
    private $registry;

    /**
     * @var VueProvider
     */
    private $vueProvider;


    public function __construct(
        Template\Context $context,
        Registry $registry,
        VueProvider $vueProvider,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->registry = $registry;
        $this->vueProvider = $vueProvider;
    }
    /**
     * Return Tab label
     *
     * @return string
     * @api
     */
    public function getTabLabel()
    {
        return __("Blocks");
    }

    /**
     * Return Tab title
     *
     * @return string
     * @api
     */
    public function getTabTitle()
    {
        return __("Blocks");
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     * @api
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     * @api
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * @return string
     */
    public function getImageUploadUrl()
    {
        return $this->getUrl(self::IMAGE_UPLOAD_URL);
    }
    /**
     * @return array
     */
    public function getVueComponents(): array
    {
        return $this->vueProvider->getComponents();
    }
    public function renderElements(): array
    {
        $data = [];
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
}
