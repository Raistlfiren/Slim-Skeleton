<?php


namespace App\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Twig_Extension_Debug;

class TwigServiceProvider implements ServiceProviderInterface
{

    public function register(Container $c)
    {
        $c['view'] = function ($c) {
            $view = new Twig(__DIR__ . '/../../templates/view', [
                'cache' => __DIR__ . '/../../templates/cache',
                'autoreload' => true,
                'debug' => true
            ]);

            $view->getEnvironment()->addGlobal('flash', $c['flash']);
            $view->getEnvironment()->addGlobal('session', $_SESSION);
            $view->getEnvironment()->addGlobal('current_uri', $c['request']->getUri()->getPath());

            $view->addExtension(new TwigExtension(
                $c['router'],
                $c['request']->getUri()
            ));

            $view->addExtension(new Twig_Extension_Debug());

            return $view;
        };
    }
}
