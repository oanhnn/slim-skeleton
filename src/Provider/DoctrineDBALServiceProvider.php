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
     * Default config
     *
     * @var array
     */
    protected $defaults = [
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
            'proxy_dir' => ROOT_PATH . '/tmp/cache/proxies',
            'cache' => null,
        ],
    ];

    /**
     * Config key for service
     *
     * @var string
     */
    protected $key = 'database';

    /**
     * Register log service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $doctrine = $this->getConfig($container['settings']);
        $config = new Configuration();
        $params = $doctrine['connection'];

        $container['database'] = DriverManager::getConnection($params, $config);
    }
}
