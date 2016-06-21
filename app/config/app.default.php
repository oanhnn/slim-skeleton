<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

return [
    'settings' => [
        'httpVersion' => '1.1',
        'responseChunkSize' => 4096,
        'outputBuffering' => 'append',
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => false,
        // View settings
        'view' => [
            'template_path' => APP_PATH.'/views',
            'twig' => [
                'cache' => ROOT_PATH.'/tmp/cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],
        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => ROOT_PATH.'/tmp/logs/app.log',
        ],
        'database' => [
            'meta' => [
                'entity_path' => [
                    'app/src/Models/Entity'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' => ROOT_PATH . '/tmp/cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'testdb',
                'user'     => 'root',
                'password' => '',
            ]
        ],
    ],
];
