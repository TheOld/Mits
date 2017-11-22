<?php

namespace MitsubishiMotors\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;

/**
 * Class PageTypeCreator
 * @package MitsubishiMotors\GraphQL\Types
 */
class PageTypeCreator extends TypeCreator
{
    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'pages'
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'ID' => ['type' => Type::nonNull(Type::id())],
            'MenuTitle' => ['type' => Type::string()],
            'Link' => ['type' => Type::string()],
            'Sort' => ['type' => Type::int()],
            'IsNewWindow' => ['type' => Type::boolean()]
        ];
    }

    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()

    /**
     * @param $root
     * @param $args
     * @return mixed
     */
    public function resolveLinkField($root, $args)
    {
        return $root->Link();
    }
}
