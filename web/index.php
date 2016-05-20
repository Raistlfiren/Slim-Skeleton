<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

use Slim\App;
use App\Loader\Kernel;
use Slim\Middleware\DebugBar;
use Slim\Routes\DebugBarRoutes;

session_start();

// Instantiate the app
$settings = require __DIR__ . '/../config/settings.php';
$app = new App($settings);

if ($app->getContainer()->get('settings')['debugbar'] === true) {
    $debugbar = new DebugBar(null, ['logger' => 'logger']);
    $app->add($debugbar);
    $routes = new DebugBarRoutes($app);
    $routes->registerRoutes();
}

$kernel = new Kernel($app, $app->getContainer());
$kernel->registerServices();
$kernel->registerRoutes();

// Run app
$app->run();
