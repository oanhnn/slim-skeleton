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
     * Get default settings
     *
     * @return array
     */
    public static function getDefaultSettings()
    {
        return [
            'name' => 'app',
            'path' => LOG_PATH . '/app.log',
            'level' => Logger::DEBUG,
        ];
    }

    /**
     * Register log service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $config = array_merge([], self::getDefaultSettings(), $container['settings']['logger']);
        $container['logger'] = function (Container $c) use ($config) {
            $logger = new Logger($config['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(new StreamHandler($config['path'], $config['level']));

            return $logger;
        };
    }
}
