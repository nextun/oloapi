<?php

use Illuminate\Container\Container as IlluminateContainer;
// use Illuminate\Database\Connection;
use Illuminate\Database\Capsule\Manager as Connection;
use Illuminate\Database\Connectors\ConnectionFactory;
use Psr\Container\ContainerInterface;
use Selective\Config\Configuration;
use Slim\App;
use Slim\Factory\AppFactory;

return [

    // ...

    // Database connection
    Connection::class => function (ContainerInterface $container) {
        $capsule = new Connection;
        $capsule->addConnection($container->get(Configuration::class)->getArray('db'));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();


        $factory = new ConnectionFactory(new IlluminateContainer());

        $connection = $factory->make($container->get(Configuration::class)->getArray('db'));

        // Disable the query log to prevent memory issues
        $connection->disableQueryLog();

        return $connection;
    },

    PDO::class => function (ContainerInterface $container) {
        return $container->get(Connection::class)->getPdo();
    },
];
