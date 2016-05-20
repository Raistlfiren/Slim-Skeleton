<?php


namespace App\Controller;

use Slim\App;

abstract class AbstractController implements ControllerInterface
{
    /** @var App $app */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    abstract function registerRoutes();
}
