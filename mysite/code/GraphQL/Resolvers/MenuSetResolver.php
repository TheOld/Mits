<?php

namespace MitsubishiMotors\GraphQL\Resolvers;

use SilverStripe\GraphQL\Scaffolding\Interfaces\ResolverInterface;
use Heyday\MenuManager\MenuSet;

/**
 * Class MenuItemResolver
 * @package MitsubishiMotors\GraphQL\Resolvers
 */
class MenuItemResolver implements ResolverInterface
{
    /**
     * @param \SilverStripe\ORM\DataObjectInterface $object
     * @param array $args
     * @param array $context
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     * @return $this|\SilverStripe\ORM\DataList
     */
    public function resolve($object, $args, $context, $info)
    {
        $list = MenuSet::get();

        // Optional filtering by properties
        if (isset($args['Name'])) {
            $list = $list->filter('Name', $args['Name']);
        }

        return $list;
    }
}
