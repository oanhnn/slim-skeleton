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

/**
 * CakePHP 3 Database service provider
 * Require cakephp/database ^3.1
 */
class CakeDatabaseServiceProvider extends AbstractServiceProvider
{
    /**
     * Default config
     *
     * @var array
     */
    protected $defaults = [
        'connection' => [
            'driver'     => 'Cake\Database\Driver\Mysql',
            'host'       => 'localhost',
            'database'   => 'your-db',
            'username'   => 'your-user-name',
            'password'   => 'your-password',
            'encoding'   => 'utf8',
            'timezone'   => 'UTC',
            'persistent' => false,
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
        $config = $this->getConfig($container['settings']);

        $container['database'] = function () use ($config) {
            return new \Cake\Database\Connection($config['connection']);
        };
    }
}
