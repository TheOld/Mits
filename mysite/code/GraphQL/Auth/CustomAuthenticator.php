<?php

namespace MitsubishiMotors\GraphQL\Auth;

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse_Exception;
use SilverStripe\ORM\ValidationException;
use SilverStripe\Security\BasicAuth;
use SilverStripe\GraphQL\Auth\AuthenticatorInterface;

/**
 * Class CustomAuthenticator
 * @package MitsubishiMotors\GraphQL\Auth
 */
class CustomAuthenticator implements AuthenticatorInterface
{
    /**
     * @param HTTPRequest $request
     * @return bool|\SilverStripe\Security\Member
     * @throws ValidationException
     */
    public function authenticate(HTTPRequest $request)
    {
        return true;

        try {

            return BasicAuth::requireLogin($request, 'Restricted resource');

        } catch (HTTPResponse_Exception $ex) {
            // BasicAuth::requireLogin may throw its own exception with an HTTPResponse in it
            $failureMessage = (string)$ex->getResponse()->getBody();
            throw new ValidationException($failureMessage, 401);
        }
    }

    /**
     * @param HTTPRequest $request
     * @return bool
     */
    public function isApplicable(HTTPRequest $request)
    {
        return false;
    }

    /**
     * Check for $_SERVERVAR with basic auth credentials
     *
     * @param  string $servervar
     * @return bool
     */
    protected function hasAuthHandler($servervar)
    {
        return isset($_SERVER[$servervar]) && preg_match('/Basic\s+(.*)$/i', $_SERVER[$servervar]);
    }
}
