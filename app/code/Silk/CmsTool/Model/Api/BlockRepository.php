<?php
namespace Silk\CmsTool\Model\Api;

use Silk\CmsTool\Api\BlockRepositoryInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
class BlockRepository implements BlockRepositoryInterface
{
    /**
    * @var \Magento\Framework\App\Config\ScopeConfigInterface
    */
    protected $scopeConfig;
    protected $cache;
    protected $blockFactory;
    /**
     * @var SerializerInterface
     */
    private $serializer;
    public function __construct(
        SerializerInterface $serializer,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\CacheInterface $cache,
        \Silk\CmsTool\Model\CmstoolBlockFactory $blockFactory
    ){
        $this->scopeConfig = $scopeConfig;
        $this->serializer   = $serializer;
        $this->cache = $cache;
        $this->blockFactory = $blockFactory;
    }
    /**
     * Get Page
     *
     * @return mixed
     */
    public function getBlock()
    {
        $data = [];
    
        $result['ret_code'] = 200;
        $result['data'] = $this->serializer->unserialize($data);
        return $data;
    }
    /**
     * Get Page
     * @param int $blockId
     * @return mixed
     */
    public function getById($blockId)
    {
        $blockModel = $this->blockFactory->create();
        $blockModel->load($blockId);
        if (!$blockModel->getId()) {
            throw new NoSuchEntityException(__('Object with id "%1" does not exist.', $blockId));
        }
        return $blockModel;
    }
}