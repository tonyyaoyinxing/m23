<?php
namespace Silk\CmsTool\Model\Api;

use Silk\CmsTool\Api\TypeRepositoryInterface;
use Magento\Framework\Serialize\SerializerInterface;
class TypeRepository implements TypeRepositoryInterface
{
    /**
    * @var \Magento\Framework\App\Config\ScopeConfigInterface
    */
    protected $scopeConfig;
    protected $cache;
    /**
     * @var SerializerInterface
     */
    private $serializer;
    public function __construct(
        SerializerInterface $serializer,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Framework\App\CacheInterface $cache
    ){
        $this->scopeConfig = $scopeConfig;
        $this->serializer   = $serializer;
        $this->cache = $cache;
    }
    /**
     * Get Page
     * @param int $typeId
     * @return mixed
     */
    public function getById($typeId)
    {
        $data = [];
    
        $result['ret_code'] = 200;
        $result['data'] = $this->serializer->unserialize($data);
        return $data;
    }
}