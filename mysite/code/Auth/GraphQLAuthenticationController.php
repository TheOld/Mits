<?php

namespace MitsubishiMotors\Auth;

use MitsubishiMotors\Constants\GraphQLURIs;
use MitsubishiMotors\Traits\HasLogger;
use GuzzleHttp\Client;
use SilverStripe\Control\Director;
use SilverStripe\Dev\Debug;
use SilverStripe\SiteConfig\SiteConfig;
use Exception;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTPRequest;
use GuzzleHttp\RequestOptions;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Core\Environment;

/**
 * Class GraphQLAuthenticationController
 * @package MitsubishiMotors\Auth
 */
class GraphQLAuthenticationController extends Controller
{
    use HasLogger;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @var
     */
    private $config;

    /**
     * @var array
     */
    private static $allowed_actions = [
        'reset'
    ];

    /**
     * @param HTTPRequest $request
     */
    public function index(HTTPRequest $request)
    {
        var_dump($this->getAuthenticationToken());
    }

    /**
     * @param HTTPRequest $request
     */
    public function reset(HTTPRequest $request)
    {
        $config = $this->getSiteConfig();
        $config->GraphQLAuthToken = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiIsImp0aSI6Im1WaThmbkdlZldBYzU5YmE3OTU2MjhkYzU5LjU1NjEzMDgzIn0.eyJpc3MiOiJodHRwczpcL1wvczItbW1uei5oZXlkYXkubmV0Lm56XC8iLCJhdWQiOiJjaHJvbWUtZXh0ZW5zaW9uOlwvXC9maGJqZ2JpZmxpbmpiZGdnZWhjZGRjYm5jZGRkb21vcCIsImp0aSI6Im1WaThmbkdlZldBYzU5YmE3OTU2MjhkYzU5LjU1NjEzMDgzIiwiaWF0IjoxNTA1MzkyOTgyLCJuYmYiOjE1MDUzOTI5ODIsImV4cCI6MTUwNTM5NjU4MiwidWlkIjozfQ.GLhFkQGlUx4zQcVxqEfrl6puNQr4xtnbF0hpCQb44ZA';
        $config->GraphQLAuthTokenExpires = date('Y-m-d',strtotime(date("m/d/Y h:i:s a", time()) . " + 365 day"));

        if ($config->write()) {
            Debug::dump($config->GraphQLAuthToken);
            Debug::dump($config->GraphQLAuthTokenExpires);
        }

    }

    /**
     * @return \SilverStripe\ORM\DataObject
     */
    public function getSiteConfig()
    {
        if (!isset($this->config)) {
            $this->config = SiteConfig::get()->first();
        }

        return $this->config;

    }

    /**
     * @return \GuzzleHttp\Client
     * @throws Exception
     */
    protected function getClient()
    {
        if (is_null($this->client)) {
            if (!Environment::getEnv('GRAPHQL_URL')) {
                throw new Exception('The constant GRAPHQL_URL must be defined in your environment configuration');
            } else {
                $baseUri = getenv('GRAPHQL_URL');

                $this->client = new Client([
                    'base_uri' => $baseUri,
                    'verify' => Director::isLive() || Director::isTest()
                ]);
            }
        }

        return $this->client;
    }

    /**
     * @return mixed
     */
    public function getAuthenticationToken()
    {
        $config = $this->getSiteConfig();

        if (!$this->authTokenIsValid()) {
            $config->GraphQLAuthToken = $this->setAuthenticationToken();
        }

        return $config->GraphQLAuthToken;

    }

    /**
     * @return mixed
     */
    protected function setAuthenticationToken()
    {
        $config = $this->getSiteConfig();
        $tokenDetails = $this->requestToken();

        $config->GraphQLAuthToken = $tokenDetails['data']['createToken']['Token'];
        $config->write();

        return $config->GraphQLAuthToken;
    }

    /**
     * @param $token
     * @param $expires
     * @return bool|mixed
     */
    protected function authTokenIsValid()
    {
        $config = $this->getSiteConfig();

        $expired = $config->GraphQLAuthTokenExpires < date("m/d/Y h:i:s a", time());
        $token = $config->GraphQLAuthToken;

        if (!isset($token) || empty($token) || $expired) {
            return false;
        }

        //todo ?? could check for 2 periods i.e 3 part string JWT
        return true;
    }

    /**
     *
     *  returns access token details :
     *   {
     *       "token_type": "Bearer",
     *       "expires_in": 31536000,  // number of seconds until the access token expires
     *       "access_token": "xxx.xxxx.xx-xxx-x-xx",
     *       "refresh_token": "XXXXxxXX"
     *   }
     *
     * @return mixed
     */
    protected function requestToken()
    {
        $username = getenv('GRAPHQL_USER');
        $password = getenv('GRAPHQL_PASSWORD');

        $query = <<<QUERY
mutation {
  createToken(Email: "$username", Password: "$password") {
    Token,
    ID,
    FirstName,
    Surname
  }
}
QUERY;

        $response = $this->getClient()->post(GraphQLURIs::REQUEST_TOKEN, [
            RequestOptions::FORM_PARAMS => [
                'query' => $query
            ]
        ]);

        // if 401 then try again
        if ($response->getStatusCode() == '401') {

            $logger = Injector::inst()->create('Logger');
            $logger->warning($response->getReasonPhrase(), $query);

            // then try again?


        }

        return json_decode((string)$response->getBody(), true);
    }

}
