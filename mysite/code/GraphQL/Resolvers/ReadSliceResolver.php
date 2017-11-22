<?php

namespace MitsubishiMotors\GraphQL\Resolvers;

use SilverStripe\GraphQL\Scaffolding\Interfaces\ResolverInterface;
use SilverStripe\ORM\DataObjectInterface;
use MitsubishiMotors\DataObjects\Slice;

/**
 * Class ReadSliceResolver
 * @package MitsubishiMotors\GraphQL\Resolvers
 */
class ReadSliceResolver implements ResolverInterface
{
    /**
     * @param DataObjectInterface $object
     * @param array $args
     * @param array $context
     * @param \GraphQL\Type\Definition\ResolveInfo $info
     * @return $this
     */
    public function resolve($object, $args, $context, $info)
    {
        return Slice::get()->filter($args['ParentID']);
    }
}
