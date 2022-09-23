<?php
namespace Silk\CmsTool\Api;

use Silk\CmsTool\Api\Data\NodeInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface NodeRepositoryInterface
{
    /**
     * @param \Silk\CmsTool\Api\Data\NodeInterface $page
     * @return \Silk\CmsTool\Api\Data\NodeInterface
     */
    public function save(NodeInterface $page);

    /**
     * @param int $id
     * @return \Silk\CmsTool\Model\Menu\Node
     */
    public function getById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria);

    /**
     * @param \Silk\CmsTool\Api\Data\NodeInterface $page
     * @return bool
     */
    public function delete(NodeInterface $page);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id);

    /**
     * Return node by menu id
     *
     * @api
     * @param int $menuId
     * @return \Silk\CmsTool\Api\Data\NodeInterface[]
     */
    public function getByMenu($menuId);

    /**
     * Return node by identifier
     *
     * @api
     * @param string $identifier
     * @return \Silk\CmsTool\Api\Data\NodeInterface[]
     */
    public function getByIdentifier($identifier);
}
