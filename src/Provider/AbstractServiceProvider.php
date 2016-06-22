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

use Pimple\ServiceProviderInterface;
use Pimple\Container;

/**
 * Abstract provider
 */
abstract class AbstractServiceProvider implements ServiceProviderInterface
{
    /**
     * Get default settings
     *
     * @return array
     */
    public static function getDefaultSettings()
    {
        return [];
    }

    /**
     * Register service
     *
     * @param Container $container
     */
    abstract public function register(Container $container);
}
