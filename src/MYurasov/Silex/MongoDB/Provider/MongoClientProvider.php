<?php

namespace MYurasov\Silex\MongoDB\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;

class MongoClientProvider implements ServiceProviderInterface
{
  public function register(Application $app, array $config = [])
  {
    // apply default options

    $defaultClientOptions = [
      'server' => 'mongodb://localhost:27017',
      'options' => ['connect' => true],
      'driver_options' => []
    ];

    if (isset($app['mongodb.mongo_client_options'])) {
      $app['mongodb.mongo_client_options'] = array_merge($defaultClientOptions, $app['mongodb.mongo_client_options']);
    } else {
      $app['mongodb.mongo_client_options'] = $defaultClientOptions;
    }

    // apply config parameter

    if (isset($config['mongodb.mongo_client_options'])) {
      $app['mongodb.mongo_client_options'] = array_merge($app['mongodb.mongo_client_options'], $config['mongodb.mongo_client_options']);
    }

    if (isset($config['mongodb.db'])) {
      $app['mongodb.db'] = $config['mongodb.db'];
    }

    // create service container

    $app['mongodb.mongo_client'] = $app->share(function () use ($app) {
      $mongoClient = new \MongoClient(
        $app['mongodb.mongo_client_options']['server'],
        $app['mongodb.mongo_client_options']['options'],
        $app['mongodb.mongo_client_options']['driver_options']
      );

      if (isset($app['mongodb.db'])) {
        $mongoClient->selectDB($app['mongodb.db']);
      }

      return $mongoClient;
    });
  }

  public function boot(Application $app)
  {

  }
}
