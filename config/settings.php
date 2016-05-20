<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],
        
        'determineRouteBeforeAppMiddleware' => true,

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../../var/logs/app.log',
        ],

        // PDO settings
        'pdo' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'db',
            'username' => 'user',
            'password' => 'pwd',
        ],

        //Change to false to remove debug bar
        'debugbar' => true,
    ],
];
