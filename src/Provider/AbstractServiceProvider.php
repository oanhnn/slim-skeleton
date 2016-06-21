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
     * Default config of service
     *
     * @var array
     */
    protected $defaults = [];

    /**
     * Config key of service
     *
     * @var string
     */
    protected $key = 'service_name';

    /**
     * Get config of service
     *
     * @param \Slim\Collection $settings
     * @return array
     */
    protected function getConfig($settings)
    {
        return array_merge($this->defaults, $settings->get($this->key, []));
    }

    /**
     * Register service
     *
     * @param Container $container
     */
    abstract public function register(Container $container);
}
