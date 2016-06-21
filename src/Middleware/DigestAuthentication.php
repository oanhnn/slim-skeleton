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

/**
 * Digest authentication middleware
 */
class DigestAuthentication extends BasicAuthentication
{
    /**
     * Nonce of authentication
     *
     * @var string
     */
    protected $nonce;

    /**
     * Set the nonce value.
     *
     * @param string $nonce
     * @return self
     */
    public function nonce($nonce)
    {
        $this->nonce = $nonce;

        return $this;
    }

    /**
     * Validate the user and password.
     *
     * @param array                  $credentials   Return value of self::parseAuthorizationHeader()
     * @param ServerRequestInterface $request
     * @return boolean
     */
    protected function login(array $credentials, ServerRequestInterface $request)
    {
        if (isset($this->users[$credentials['username']])) {
            $password = $this->users[$credentials['username']];

            $a1 = md5(sprintf('%s:%s:%s', $credentials['username'], $this->realm, $password));
            $a2 = md5(sprintf('%s:%s', $request->getMethod(), $credentials['uri']));

            $validResponse = md5(sprintf(
                '%s:%s:%s:%s:%s:%s',
                $a1,
                $credentials['nonce'],
                $credentials['nc'],
                $credentials['cnonce'],
                $credentials['qop'],
                $a2
            ));

            return $credentials['response'] === $validResponse;
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
        if (strpos($header, 'Digest') !== 0) {
            return false;
        }
        $needed_parts = [
            'nonce' => 1,
            'nc' => 1,
            'cnonce' => 1,
            'qop' => 1,
            'username' => 1,
            'uri' => 1,
            'response' => 1,
        ];
        $data = [];

        preg_match_all(
            '@('.implode('|', array_keys($needed_parts)).')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@',
            substr($header, 7),
            $matches,
            PREG_SET_ORDER
        );
        if ($matches) {
            foreach ($matches as $m) {
                $data[$m[1]] = $m[3] ? $m[3] : $m[4];
                unset($needed_parts[$m[1]]);
            }
        }

        return empty($needed_parts) ? $data : false;
    }

    /**
     * Make WWW-Authenticate header
     *
     * @param DigestAuthentication $auth
     * @return string
     */
    protected static function makeAuthenticateHeader($auth)
    {
        return sprintf(
            'Digest realm="%s",qop="auth",nonce="%s",opaque="%s"',
            $auth->realm,
            $auth->nonce?: uniqid(),
            md5($auth->realm)
        );
    }
}
