<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace App\Tests;

use Slim\Http\Body;
use Slim\Http\Environment;
use Slim\Http\Headers;
use Slim\Http\Request;
use Slim\Http\Uri;

/**
 * Trait integration test aware
 *
 * @method \Slim\App getApp()
 */
trait IntegrationTestAwareTrait
{
    /**
     * Call the given URI and return the Response.
     *
     * @param string $method        Request method. Eg: GET, POST, PUT, DELETE, ...
     * @param string $path          Request path. Eg: /api/user
     * @param array  $queries       Query parameters
     * @param array  $cookies       Cookie parameters
     * @param array  $servers       Server parameters
     * @param string $content       POST content
     * @return \Slim\Http\Response
     */
    protected function call($method, $path, $queries = [], $cookies = [], $servers = [], $content = null)
    {
        $method = strtoupper($method);

        // Prepare request and response objects
        $env = Environment::mock([
            'SCRIPT_NAME'    => '/index.php',
            'REQUEST_URI'    => $path,
            'REQUEST_METHOD' => $method,
            'QUERY_STRING'   => http_build_query($queries),
        ]);

        $uri = Uri::createFromEnvironment($env);

        $headers = Headers::createFromEnvironment($env);
        $servers = array_merge($env->all(), $servers);

        $body = new Body(fopen('php://temp', 'r+'));
        if ('POST' === $method) {
            $body->write($content);
        }

        $request = new Request($method, $uri, $headers, $cookies, $servers, $body);

        return self::getApp()->process($request, self::getApp()->getContainer()->get('response'));
    }
}
