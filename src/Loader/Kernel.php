<?php


namespace App\Loader;

use Interop\Container\ContainerInterface;
use Pimple\ServiceProviderInterface;
use Slim\App;
use Slim\Container;
use WHCPC\Provider\TwigServiceProvider;


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
            new DashboardHandlerServiceProvider(),
            new NewsRepositoryServiceProvider(),
            new CSRFServiceProvider(),
            new NewsHandlerServiceProvider(),
            new AdminHandlerServiceProvider(),
            new DocumentsRepositoryServiceProvider(),
            new StatusesRepositoryServiceProvider(),
            new ValidatorServiceProvider(),
            new NewsValidationServiceProvider(),
            new EventDispatcherServiceProvider(),
            new FlashServiceProvider(),
            new FlashListenerServiceProvider(),
            new LoggerServiceProvider(),
            new DocumentsHandlerServiceProvider(),
            new DocumentsValidationServiceProvider(),
            new DocumentsFileUploaderServiceProvider(),
            new GraphGuzzleServiceProvider(),
            new GraphServiceProvider(),
            new EventsHandlerServiceProvider(),
            new AuthenticationMiddlewareServiceProvider()
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
