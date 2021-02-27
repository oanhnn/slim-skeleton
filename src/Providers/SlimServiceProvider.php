<?php

namespace App\Providers;

use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use League\Container\ServiceProvider\ServiceProviderInterface;
use Slim\App;
use Slim\Factory\AppFactory;
use Slim\Middleware\ContentLengthMiddleware;
use Slim\Middleware\MethodOverrideMiddleware;
use Slim\Middleware\OutputBufferingMiddleware;

class SlimServiceProvider extends AbstractServiceProvider implements
    ServiceProviderInterface,
    BootableServiceProviderInterface
{
    /**
     * The provided array is a way to let the container
     * know that a service is provided by this service
     * provider. Every service that is registered via
     * this service provider must have an alias added
     * to this array or it will be ignored.
     *
     * @var array
     */
    protected $provides = [
        App::class,
    ];

    /**
     * This is where the magic happens, within the method you can
     * access the container and register or retrieve anything
     * that you need to, but remember, every alias registered
     * within this method must be declared in the `$provides` array.
     */
    public function register()
    {
        $this->getContainer()->share(App::class, function () {
            return AppFactory::createFromContainer($this->getContainer());
        });
    }

    /**
     * Method will be invoked on registration of a service provider implementing
     * this interface. Provides ability for eager loading of Service Providers.
     *
     * @return void
     */
    public function boot()
    {
        $this->getContainer()->inflector(App::class, function (App $app) {
            $steamFactory = $app->getContainer()->get(StreamFactoryInterface::class);

            // config route cache
            $app->getRouteCollector()->setCacheFile(ROOT_PATH . '/storage/cache/routes.cache');

            // add global middleware
            $app->addRoutingMiddleware();
            $app->addBodyParsingMiddleware();
            $app->addErrorMiddleware(true, true, false);
            $app->add(new MethodOverrideMiddleware());
            $app->add(new OutputBufferingMiddleware($steamFactory, OutputBufferingMiddleware::APPEND));
            $app->add(new ContentLengthMiddleware());

            // load routes
            include_once ROOT_PATH . '/routes/api.php';
        });
    }
}
