<?php


namespace App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use App\Listener\FlashListener;

class FlashListenerServiceProvider implements ServiceProviderInterface
{

    public function register(Container $c)
    {
        $c['flashListener'] = function ($c) {
            return new FlashListener($c['flash']);
        };
    }
}
