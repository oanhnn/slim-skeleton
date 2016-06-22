<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

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
 * For debug mode only
 * Please comment two lines if not debug mode
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Defines constants
 */
define('ROOT_PATH', dirname(__DIR__));

/**
 * Run application.
 */
/* @var $app \Slim\App */
$app = require_once ROOT_PATH . '/app/config/bootstrap.php';
$app->run();
