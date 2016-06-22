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
     * Get default settings
     *
     * @return array
     */
    public static function getDefaultSettings()
    {
        return [
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
    }

    /**
     * Register log service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $settings = array_merge([], self::getDefaultSettings(), $container['settings']['database']);

        $container['database'] = function () use ($settings) {
            return new \Cake\Database\Connection($settings['connection']);
        };
    }
}
