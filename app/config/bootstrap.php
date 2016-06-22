<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

defined('APP_PATH')  || define('APP_PATH',  dirname(__DIR__));
defined('ROOT_PATH') || define('ROOT_PATH', dirname(APP_PATH));
defined('TMP_PATH')  || define('TMP_PATH',  ROOT_PATH . '/tmp');
defined('LOG_PATH')  || define('LOG_PATH',  ROOT_PATH . '/tmp/logs');
defined('CACHE_PATH')|| define('CACHE_PATH',ROOT_PATH . '/tmp/cache');
defined('VIEW_PATH') || define('VIEW_PATH', ROOT_PATH . '/app/templates');

// Load all class
require_once ROOT_PATH . '/vendor/autoload.php';

// Load application settings
$settings = require APP_PATH . '/config/app.php';

// Create container for application
$container = new \Slim\Container($settings);

// Register service providers & factories
$container->register(new \App\Provider\ViewServiceProvider());
$container->register(new \App\Provider\HttpCacheServiceProvider());
$container->register(new \App\Provider\LogServiceProvider());
$container->register(new \App\Provider\DoctrineDBALServiceProvider());

// Create new application
$app = new \Slim\App($container);

// Register middlewares and routes
require APP_PATH . '/config/routes.php';

return $app;
