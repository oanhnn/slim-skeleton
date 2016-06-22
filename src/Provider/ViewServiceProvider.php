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

/**
 * View service provider
 */
class ViewServiceProvider extends AbstractServiceProvider
{
    /**
     * List engine class for renderer
     *
     * @var array
     */
    private $providerClass = [
        'php' => 'PHPViewServiceProvider',
        'twig' => 'TwigViewServiceProvider',
    ];

    /**
     * Get default settings
     *
     * @return array
     */
    public static function getDefaultSettings()
    {
        return [
            'engine' => 'php',
            'template_path' => VIEW_PATH,
            'config' => [],
        ];
    }

    /**
     * Register PHP view service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $settings = array_merge([], self::getDefaultSettings(), $container['settings']['renderer']);

        $engine = strtolower($settings['engine']);
        if (!isset($this->providerClass[$engine])) {
            throw new \InvalidArgumentException('Invalid view engine');
        }

        $providerClass = __NAMESPACE__ . '\\' . $this->providerClass[$engine];
        $provider = new $providerClass();
        $provider->register($container);
    }
}
