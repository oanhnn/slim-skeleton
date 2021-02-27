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
 * Disallow robots middleware
 * It provides a default robots.txt for non-production environments.
 */
class DisallowRobots
{
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
        if ($request->getUri()->getPath() === '/robots.txt') {
            $body = $response->getBody();
            $body->rewind();

            return $response
                ->withStatus(200)
                ->withHeader('Content-type', 'text/plain')
                ->withBody($body->write("User-Agent: *\nDisallow: /"));
        }

        $response = $next($request, $response);

        return $response->withHeader('X-Robots-Tag', 'noindex, nofollow, noarchive');
    }
}
