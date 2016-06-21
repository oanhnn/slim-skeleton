<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace App\Provider;

use Pimple\Container;
use Slim\HttpCache\CacheProvider;

/**
 * Http cache service provider
 * Require slim/http-cache ^0.3.0
 */
class HttpCacheServiceProvider extends AbstractServiceProvider
{
    /**
     * @var string
     */
    protected $key = 'http-cache';

    /**
     * Register Http Cache Service Provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['http-cache'] = function () {
            return new CacheProvider();
        };
    }
}
