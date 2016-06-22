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
     * Get default settings
     *
     * @return array
     */
    public static function getDefaultSettings()
    {
        return [
            'engine' => 'twig',
            'template_path' => VIEW_PATH,
            'config' => [
                'cache' => CACHE_PATH . '/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ];
    }

    /**
     * Register Twig Service Provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $settings = array_merge([], self::getDefaultSettings(), $container['settings']['renderer']);

        $templatePath = rtrim($settings['template_path'], '/\\') . DIRECTORY_SEPARATOR;
        $config = $settings['config'];

        $container['renderer'] = function (Container $c) use ($templatePath, $config) {
            $renderer = new Twig($templatePath, $config);
            // Add extensions
            $renderer->addExtension(new TwigExtension($c['router'], $c['request']->getUri()));
            $renderer->addExtension(new \Twig_Extension_Debug());

            return $renderer;
        };

        $container['templateFinder'] = $container->protect(function ($template) {
            return $template . '.twig';
        });
    }
}
