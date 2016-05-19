<?php


namespace App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Flash\Messages;

class FlashServiceProvider implements ServiceProviderInterface
{

    public function register(Container $c)
    {
        $c['flash'] = function () {
            return new Messages();
        };
    }
}
