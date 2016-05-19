<?php


namespace App\Controller;

use Slim\App;

class AbstractController
{
    /** @var App $app */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }
}
