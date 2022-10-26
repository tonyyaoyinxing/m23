<?php
namespace Silk\CmsTool\Api;

interface TypeRepositoryInterface
{
    /**
     * Get by id
     * @param int $elementId
     * @return mixed
     */
    public function getById($elementId);
}