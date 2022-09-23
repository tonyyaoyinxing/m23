<?php
//declare(strict_types=1);

namespace Silk\CmsTool\Model\Resolver;

use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Query\ResolverInterface;

class GetCountNumberDays implements ResolverInterface
{
    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        if (!isset($args['input']['month']) || !isset($args['input']['year'])) {
            throw new GraphQlInputException(__('Month or Year not indicated'));
        }

        return [
            'days' => date('t', mktime(0, 0, 0, $args['input']['month'], 1, $args['input']['year']))
        ];
    }
}