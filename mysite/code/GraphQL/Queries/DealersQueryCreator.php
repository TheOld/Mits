<?php

namespace MitsubishiMotors\GraphQL\Queries;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\OperationResolver;
use SilverStripe\GraphQL\QueryCreator;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\RequestOptions;
use MitsubishiMotors\Constants\VehicleHubURIs;
use MitsubishiMotors\Traits\VehicleHubCommunicationTrait;

/**
 * Class DealersQueryCreator
 * @package MitsubishiMotors\GraphQL\Queries
 */
class DealersQueryCreator extends QueryCreator implements OperationResolver
{
    use VehicleHubCommunicationTrait;

    /**
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'getDealers'
        ];
    }

    /**
     * @return \GraphQL\Type\Definition\ListOfType
     */
    public function type()
    {
        return Type::listOf($this->manager->getType('dealers'));
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
        $dealers = null;
        $query = '{dealers { id name addressLine1 addressLine2 addressLine3 phone website location locationX locationY services}}';

        try {
            $response = $this->getClient()->post(VehicleHubURIs::GET_DEALERS, [
                RequestOptions::HEADERS => [
                    'Authorization' => 'Bearer ' . $this->getAuthenticationToken(),
                    'Accept' => 'application/json'
                ],
                RequestOptions::JSON => [
                    'query' => $query
                ]
            ]);

            $data = json_decode($response->getBody(), true);

            if (isset($data['data']['dealers'])) {
                $dealers = $data['data']['dealers'];
            }

            // todo: wrong exception not showing error nothing

        } catch (BadResponseException $e) {
            return $this->handleVehicleHubCommunicationException($e);
        }

        return $dealers;
    }
}
