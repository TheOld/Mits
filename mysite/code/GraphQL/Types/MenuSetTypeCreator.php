<?php

namespace MitsubishiMotors\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;

/**
 * Class MenuSetTypeCreator
 * @package MitsubishiMotors\GraphQL\Types
 */
class MenuSetTypeCreator extends TypeCreator
{
    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'menuset'
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'ID' => ['type' => Type::nonNull(Type::id())],
            'Name' => ['type' => Type::string()],
            'Items' => ['type' => Type::listOf($this->manager->getType('menuitem'))]
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()

    /**
     * @param $root
     * @param $args
     * @return mixed
     */
    public function resolveItemsField($root, $args)
    {
        return $root->MenuItems();
    }
}
