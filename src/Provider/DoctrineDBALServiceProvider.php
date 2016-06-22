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

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;
use Pimple\Container;

/**
 * Doctrine DBAL service provider
 * Require doctrine/dbal ^2.5
 */
class DoctrineDBALServiceProvider extends AbstractServiceProvider
{
    /**
     * Get default settings
     *
     * @return array
     */
    public static function getDefaultSettings()
    {
        return [
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'your-db',
                'user'     => 'your-user-name',
                'password' => 'your-password',
            ],
            'meta' => [
                'entity_path' => [
                    ROOT_PATH . '/src/Models/Entity'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' => CACHE_PATH . '/proxies',
                'cache' => null,
            ],
        ];
    }

    /**
     * Register log service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $settings = array_merge([], self::getDefaultSettings(), $container['settings']['database']);
        $config = new Configuration();

        $container['database'] = DriverManager::getConnection($settings['connection'], $config);
    }
}
