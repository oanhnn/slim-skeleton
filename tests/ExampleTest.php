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

class ExampleTest extends \PHPUnit_Framework_TestCase
{

    use \App\Tests\LoadFixturesAwareTrait;
    use \App\Tests\IntegrationTestAwareTrait;

    /**
     * Setting up before test
     */
    protected function setUp()
    {
        $this->initialize();
    }

    /**
     * A basic functional test example.
     */
    public function testBasicExample()
    {
        $res = $this->call('GET', '/');

        $this->assertSame('1.1', $res->getProtocolVersion());
        $this->assertSame(200, $res->getStatusCode());
        $this->assertSame('text/html; charset=UTF-8', $res->getHeaderLine('Content-Type'));
    }

    public function testBasicExampleWithDb()
    {
        $this->loadFixtures(['orders']);

        $res = $this->call('GET', '/orders');
        $this->assertContains('<li>1|hovaten@gmail.com||2016-04-22T00:00:00+00:00</li>', $res->getBody()->__toString());
    }
}
