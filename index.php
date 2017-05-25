<?php

use \App\Vending;
use \App\Char;
use \App\BuyingStore;
require './vendor/autoload.php';

$config = require 'config.php';
$app = new \Slim\App($config);

$container = $app->getContainer();
$capsule = new Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container->get('settings')['db']);
$capsule->bootEloquent();

$app->get('/selling', function ($request, $response) {
  return $response->withJson(Vending::get_all());
});

$app->get('/buying', function ($request, $response) {
  return $response->withJson(BuyingStore::get_all());
});

$app->get('/merchant/{char}', function ($request, $response, $args) {
  $char_id = Char::where('name', $args['char'])->first()->char_id;
  $buying = BuyingStore::where('char_id', $char_id);
  $vending = Vending::where('char_id', $char_id);

  if(!$buying->get()->isEmpty()) {
    $output = [
      'type' => 'buying',
      'data' => $buying->first()->build()
    ];
  } else if(!$vending->get()->isEmpty()) {
    $output = [
      'type' => 'vending',
      'data' => $vending->first()->build()
    ];
  } else {
    $output = [
      'data' => []
    ];
  }

  return $response->withJson((object) $output);
});

$app->run();
