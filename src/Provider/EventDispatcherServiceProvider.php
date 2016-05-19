<?php


namespace App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

class EventDispatcherServiceProvider implements ServiceProviderInterface
{

    public function register(Container $c)
    {
        $c['dispatcher'] = function ($c) {
            $dispatcher = new EventDispatcher();
            $dispatcher->addSubscriber($c['flashListener']);
            return $dispatcher;
        };
    }
}
