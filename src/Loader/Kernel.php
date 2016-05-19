<?php


namespace App\Loader;

use App\Provider\EventDispatcherServiceProvider;
use App\Provider\FlashListenerServiceProvider;
use App\Provider\FlashServiceProvider;
use App\Provider\LoggerServiceProvider;
use App\Provider\PDOServiceProvider;
use App\Provider\TwigServiceProvider;
use Interop\Container\ContainerInterface;
use Pimple\ServiceProviderInterface;
use Slim\App;
use Slim\Container;


class Kernel
{

    /** @var Container $container */
    protected $container;

    /** @var App $app */
    protected $app;

    /**
     * Kernel constructor.
     * @param App $app
     * @param ContainerInterface $container
     */
    public function __construct(App $app, ContainerInterface $container)
    {
        $this->app = $app;
        $this->container = $container;
    }

    /**
     * @todo Move services to configuration value so it can be tested with different services.
     */
    public function registerServices()
    {
        /** @var ServiceProviderInterface[] $services */
        $services = [
            new TwigServiceProvider(),
            new PDOServiceProvider(),
            new EventDispatcherServiceProvider(),
            new FlashServiceProvider(),
            new FlashListenerServiceProvider(),
            new LoggerServiceProvider(),
        ];

        foreach ($services as $service) {
            if ($service instanceof ServiceProviderInterface) {
                $this->container->register($service);
            }
        }
    }

    /**
     * @todo Move services to configuration value so it can be tested with different services.
     */
    public function registerRoutes()
    {
        /** @var ControllerInterface[] $controllers */
        $controllers = [
            
        ];

        foreach ($controllers as $controller) {
            if ($controller instanceof ControllerInterface) {
                $controller->registerRoutes();
            }
        }
    }
}
