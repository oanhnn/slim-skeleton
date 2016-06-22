<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace App\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Example controller
 */
class Example extends Base
{

    /**
     * Index action.
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function index(Request $request, Response $response, $args)
    {
        $this->render($response, 'welcome.html');
    }

    /**
     * List orders action.
     *
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     *
     * @return Response
     */
    public function listOrders(Request $request, Response $response, $args)
    {
        /* @var $con \Doctrine\DBAL\Connection */
        $con = $this->container->get('database');
        $stmt = $con->query('SELECT * FROM orders');
        $stmt->setFetchMode(\PDO::FETCH_CLASS, \App\Model\Entity\Order::class);

        $rows = $stmt->fetchAll();

        $this->render($response, 'list_orders.html', ['orders' => $rows]);
    }
}
