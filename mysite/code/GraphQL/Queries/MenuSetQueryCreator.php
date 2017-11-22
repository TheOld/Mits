<?php

namespace MitsubishiMotors\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Heyday\MenuManager\MenuSet;

use SilverStripe\GraphQL\OperationResolver;
use SilverStripe\GraphQL\QueryCreator;

/**
 * Class MenuSetQueryCreator
 * @package MitsubishiMotors\GraphQL\Queries
 */
class MenuSetQueryCreator extends QueryCreator implements OperationResolver
{
    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'getMenus'
        ];
    }

    /**
     * @return array
     */
    public function args()
    {
        return [
            'Name' => ['type' => Type::string()]
        ];
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf($this->manager->getType('menuset'));
    }

    /**
     * @param mixed $object
     * @param array $args
     * @param mixed $context
     * @param ResolveInfo $info
     * @return $this|\SilverStripe\ORM\DataList
     */
    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        $list = MenuSet::get();

        // Optional filtering by properties
        if (isset($args['Name'])) {
            $list = $list->filter('Name', $args['Name']);
        }

        return $list;
    }
}
