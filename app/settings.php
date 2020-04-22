<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {
    // Global Settings Object
    $containerBuilder->addDefinitions([
        'settings' => [
            'displayErrorDetails' => true, // Should be set to false in production
            'logger' => [
                'name' => 'slim-app',
                'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                'level' => Logger::DEBUG,
            ],
            'determineRouteBeforeAppMiddleware' => false,
            'db' => [
               'driver' => 'mysql',
               'host' => 'localhost',
               'database' => 'olo',
               'username' => 'root',
               'password' => 'password',
               'charset'   => 'utf8',
               'collation' => 'utf8_unicode_ci',
               'prefix'    => '',
               'options' => [
                  // Turn off persistent connections
                  PDO::ATTR_PERSISTENT => false,
                  // Enable exceptions
                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                  // Emulate prepared statements
                  PDO::ATTR_EMULATE_PREPARES => true,
                  // Set default fetch mode to array
                  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                  // Set character set
                  PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci'
               ],
            ]

        ],
    ]);
};
