<?php

use \App\Vending;
require './vendor/autoload.php';

$config = require 'config.php';
$app = new \Slim\App($config);

$container = $app->getContainer();
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')['db']);
$capsule->bootEloquent();

$app->get('/vendings', function ($request, $response) {
  return $response->withJson(Vending::get_all());
});

$app->get('/vending/{char}', function ($request, $response, $args) {
  return $response->withJson(Vending::from($args['char']));
});

$app->run();
