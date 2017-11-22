<?php

namespace MitsubishiMotors\Traits;

use MitsubishiMotors\Constants\VehicleHubURIs;
use MitsubishiMotors\Constants\JsonResponseKeys;
use GuzzleHttp\Client;
use Exception;
use SilverStripe\Control\Director;
use GuzzleHttp\RequestOptions;
use SilverStripe\Dev\Debug;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Core\Environment;

/**
 * Trait VehicleHubCommunicationTrait
 * @package MitsubishiMotors\Traits
 */
trait VehicleHubCommunicationTrait
{
    use HasLogger;

    /**
     * @var \GuzzleHttp\Client
     */
    private $client;

    /**
     * @return \GuzzleHttp\Client
     * @throws Exception
     */
    protected function getClient()
    {
        if (is_null($this->client)) {

            if (!Environment::getEnv('VEHICLE_HUB_API_URL')) {
                throw new Exception('The constant VEHICLE_HUB_API_URL must be defined in your environment configuration');
            } else {
                $baseUri = Environment::getEnv('VEHICLE_HUB_API_URL');

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
        $siteConfig = SiteConfig::get()->first();

        $expired = strtotime($siteConfig->VehicleHubTokenExpires) < strtotime(date("m/d/Y h:i:s a", time()));
        $token = $siteConfig->VehicleHubAuthToken;

        if (!isset($token) || empty($token) || $expired) {

            return $this->setAuthenticationToken();
        }

        return $token;

    }

    /**
     * @return mixed
     */
    protected function setAuthenticationToken()
    {
        $siteConfig = SiteConfig::get()->first();
        $tokenDetails = $this->requestToken();

        $expiresOn = date("m/d/Y h:i:s a", time() + $tokenDetails['expires_in']);

        $siteConfig->VehicleHubAuthToken = $tokenDetails['access_token'];
        $siteConfig->VehicleHubRefreshToken = $tokenDetails['refresh_token'];
        $siteConfig->VehicleHubTokenExpires = $expiresOn;
        $siteConfig->write();

        return $siteConfig->VehicleHubAuthToken;
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
        $response = $this->getClient()->post(VehicleHubURIs::REQUEST_TOKEN, [
            RequestOptions::FORM_PARAMS => [
                'grant_type' => 'password',
                'client_id' => getenv('VEHICLE_HUB_CLIENT_ID'),
                'client_secret' => getenv('VEHICLE_HUB_CLIENT_SECRET'),
                'username' => getenv('VEHICLE_HUB_USERNAME'),
                'password' => getenv('VEHICLE_HUB_PASSWORD'),
                'scope' => '*',
            ]
        ]);

        return json_decode((string)$response->getBody(), true);
    }

    /**
     * Get the IP address of the computer asking for stuff
     *
     * @return string
     */
    protected function getClientIPAddress()
    {
        foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR'] as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);

                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }

        return 'invalid';
    }

    /**
     * TODO: catch & log (to Sentry) GraphQL errors
     *
     * Log the exception, no error page
     *
     * @param \Exception $e
     *
     */
    protected function handleVehicleHubCommunicationException(Exception $e)
    {
        /** @var \Monolog\Logger $logger */
        $logger = Injector::inst()->create('Logger');
        $logger->notice($e->getMessage(), $e->getTrace());
    }
}
