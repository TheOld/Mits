<?php

namespace MitsubishiMotors\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;

/**
 * Class DealerTypeCreator
 * @package MitsubishiMotors\GraphQL\Types
 */
class DealerTypeCreator extends TypeCreator
{
    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'dealers'
        ];
    }

    /**
     * @return array
     */
    public function fields()
    {
        return [
            'id' => ['type' => Type::nonNull(Type::id())],
            'name' => ['type' => Type::string()],
            'addressLine1' => ['type' => Type::string()],
            'addressLine2' => ['type' => Type::string()],
            'addressLine3' => ['type' => Type::string()],
            'website' => ['type' => Type::string()],
            'phone' => ['type' => Type::string()],
            'location' => ['type' => Type::string()],
            'locationX' => ['type' => Type::string()],
            'locationY' => ['type' => Type::string()],
            'services' => ['type' => Type::string()]
        ];
    }
}
