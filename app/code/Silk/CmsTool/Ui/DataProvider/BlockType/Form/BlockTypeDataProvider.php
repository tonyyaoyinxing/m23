<?php

declare(strict_types=1);

namespace Silk\CmsTool\Ui\DataProvider\BlockType\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Silk\CmsTool\Model\ResourceModel\CmstoolBlockType\CollectionFactory;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Silk\CmsTool\Model\Block;

class BlockTypeDataProvider extends AbstractDataProvider
{
    /** @var array */
    private $loadedData = [];

    /**
     * @var PoolInterface
     */
    private $pool;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        PoolInterface $pool,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->pool = $pool;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    public function getData(): array
    {
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        /** @var Block $block */
        foreach ($items as $block) {
            $this->loadedData[$block->getId()] = $block->getData();
        }

        return $this->loadedData;
    }

    /**
     * {@inheritdoc}
     */
    public function getMeta()
    {
        $meta = parent::getMeta();

        /** @var ModifierInterface $modifier */
        foreach ($this->pool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }

        return $meta;
    }
}
