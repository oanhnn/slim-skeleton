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
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

/**
 * Twig view service provider
 * Require slim/twig-view ^2.0
 */
class TwigViewServiceProvider extends AbstractServiceProvider
{
    /**
     * Default config
     *
     * @var array
     */
    protected $defaults = [
        'template_path' => APP_PATH . '/views',
        'twig' => [
            'cache' => ROOT_PATH . '/tmp/cache/twig',
            'debug' => false,
            'auto_reload' => true,
        ],
    ];

    /**
     * Config key for service
     *
     * @var string
     */
    protected $key = 'view';

    /**
     * Register Twig Service Provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $config = $this->getConfig($container['settings']);

        $container['view'] = function (Container $container) use ($config) {
            $engine = new Twig($config['template_path'], $config['twig']);
            // Add extensions
            $engine->addExtension(new TwigExtension($container->get('router'), $container->get('request')->getUri()));
            $engine->addExtension(new \Twig_Extension_Debug());

            return $engine;
        };
    }

    /**
     * @param \Slim\Collection $settings
     * @return array
     */
    protected function getConfig($settings)
    {
        $config = parent::getConfig($settings);
        $config['template_path'] = rtrim($config['template_path'], '/\\') . DIRECTORY_SEPARATOR;

        return $config;
    }
}
