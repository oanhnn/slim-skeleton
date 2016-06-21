<?php

/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace App\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Basic authentication middleware
 */
class BasicAuthentication
{
    /**
     * Attribute key for storing username
     */
    const ATTR_KEY = 'USERNAME';

    /**
     * List users [username => password]
     *
     * @var array
     */
    protected $users = [];

    /**
     * Realm of authentication
     *
     * @var string
     */
    protected $realm = 'Login';

    /**
     * Contructor
     *
     * @param array $users List users [username => password]
     */
    public function __construct(array $users)
    {
        $this->users = $users;
    }

    /**
     * Execute the middleware.
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     * @return ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $credentials = self::parseAuthorizationHeader($request->getHeaderLine('Authorization'));
        if ($credentials && $this->login($credentials, $request)) {
            return $next(
                $request->withAttribute(self::ATTR_KEY, $credentials['username']),
                $response
            );
        }

        return $response
            ->withStatus(401)
            ->withHeader('WWW-Authenticate', self::makeAuthenticateHeader($this));
    }

    /**
     * Set the realm value.
     *
     * @param string $realm
     * @return self
     */
    public function realm($realm)
    {
        $this->realm = $realm;

        return $this;
    }

    /**
     * Validate the user and password.
     *
     * @param array                  $credentials  Return value of self::parseAuthorizationHeader()
     * @param ServerRequestInterface $request
     * @return boolean
     */
    protected function login(array $credentials, ServerRequestInterface $request)
    {
        if (isset($credentials['username']) && isset($credentials['password'])) {
            $username = $credentials['username'];
            $password = $credentials['password'];

            return isset($this->users[$username]) && ($this->users[$username] === $password);
        }

        return false;
    }

    /**
     * Parses the authorization header for a basic authentication.
     *
     * @param string $header
     * @return boolean|array
     */
    protected static function parseAuthorizationHeader($header)
    {
        if (strpos($header, 'Basic') !== 0) {
            return false;
        }
        $header = explode(':', base64_decode(substr($header, 6)), 2);

        return [
            'username' => $header[0],
            'password' => isset($header[1]) ? $header[1] : null,
        ];
    }

    /**
     * Make WWW-Authenticate header
     *
     * @param BasicAuthentication $auth
     * @return string
     */
    protected static function makeAuthenticateHeader($auth)
    {
        return sprintf('Basic realm="%s"', $auth->realm);
    }
}
