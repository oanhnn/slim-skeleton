<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace App\Tests;

/**
 * Abstract test case
 */
abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    use \App\Tests\LoadFixturesAwareTrait;
    use \App\Tests\IntegrationTestAwareTrait;

    /**
     * Slim app
     *
     * @var \Slim\App
     */
    protected static $app;

    /**
     * Get Slim application instance
     */
    protected static function getApp()
    {
        if (null === self::$app) {
            self::$app = require dirname(__DIR__) . '/app/config/bootstrap.php';
        }

        return self::$app;
    }
}
