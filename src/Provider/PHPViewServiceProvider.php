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
use Slim\Views\PhpRenderer;

/**
 * Twig view service provider
 * Require slim/php-view ^2.0
 */
class PHPViewServiceProvider extends AbstractServiceProvider
{
    /**
     * Default config
     *
     * @var array
     */
    protected $defaults = [
        'template_path' => APP_PATH . '/templates/',
    ];

    /**
     * Config key for service
     *
     * @var string
     */
    protected $key = 'view';

    /**
     * Register PHP view service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $config = $this->getConfig($container['settings']);


        $container['view'] = function () use ($config) {
            $engine = new PhpRenderer($config['template_path']);

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
