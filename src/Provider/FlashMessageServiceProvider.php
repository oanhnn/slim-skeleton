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
use Slim\Flash\Messages;

/**
 * Flash message service provider
 * Require slim/flash ^0.1.0
 */
class FlashMessageServiceProvider extends AbstractServiceProvider
{
    /**
     * Register Flash Message Service Provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['flash'] = function () {
            return new Messages();
        };
    }
}
