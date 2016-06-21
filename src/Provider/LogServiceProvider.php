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

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Pimple\Container;

/**
 * Log service provider
 * Require monolog/monolog
 */
class LogServiceProvider extends AbstractServiceProvider
{
    /**
     * Default config
     *
     * @var array
     */
    protected $defaults = [
        'name' => 'app',
        'path' => ROOT_PATH . '/tmp/logs/app.log',
    ];

    /**
     * Config key for service
     *
     * @var string
     */
    protected $key = 'logger';

    /**
     * Register log service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $config = $this->getConfig($container['settings']);

        $container['logger'] = function () use ($config) {
            $logger = new Logger($config['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(new StreamHandler($config['path'], Logger::DEBUG));

            return $logger;
        };
    }
}
