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

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Abstract controller class
 */
abstract class Base
{
    /**
     * @var \Interop\Container\ContainerInterface
     */
    protected $container;

    /**
     * Controller Contructor.
     *
     * @param \Interop\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Render a view.
     *
     * @param ResponseInterface $response
     * @param string            $view
     * @param array             $data
     * @return ResponseInterface
     */
    protected function render(ResponseInterface $response, $view, $data = [])
    {
        /* @var $renderer \Slim\Views\PhpRenderer */
        $renderer = $this->container->get('renderer');
        $templateFinder = $this->container->get('templateFinder');

        return $renderer->render($response, $templateFinder($view), $data);
    }
}
