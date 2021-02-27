<?php

use App\Providers\Psr7ServiceProvider;
use App\Providers\SlimServiceProvider;
use League\Container\Container;
use League\Container\ReflectionContainer;
use Psr\Container\ContainerInterface;

/**
 * Config built-in web server.
 */
if (php_sapi_name() === 'cli-server') {
    $_SERVER['PHP_SELF'] = '/' . basename(__FILE__);

    $url = parse_url(urldecode($_SERVER['REQUEST_URI']));
    $file = __DIR__ . $url['path'];
    if (strpos($url['path'], '..') === false && strpos($url['path'], '.') !== false && is_file($file)) {
        return false;
    }
}

/**
 * Defines constants
 */
define('ROOT_PATH', dirname(__DIR__));

/**
 * Autoload classes
 */
require_once ROOT_PATH . '/vendor/autoload.php';

/**
 * Make container
 */
$container = new Container();
$container->delegate((new ReflectionContainer())->cacheResolutions(true));
$container->share(ContainerInterface::class, $container);

/**
 * Add service providers
 */
$container->addServiceProvider(Psr7ServiceProvider::class);
$container->addServiceProvider(SlimServiceProvider::class);
$container->addServiceProvider(LogServiceProvider::class);

/**
 * Run application.
 */
$container->get(\Slim\App::class)->run();
