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

$app->get('/', function($request, $response) {
  return $response->withJson((object) [
    'buyings' => BuyingStore::all()->map(function($store) {
      return $store->load('char', 'items');
    }),
    'vendings' => Vending::all()->map(function($store) {
      return $store->load('char', 'items', 'items.attributes');
    })
  ]);
});

$app->get('/vending/{item}', function($request, $response, $args) {
  return $response->withJson(Vending::item($args['item']));
});

$app->get('/vending', function ($request, $response) {
  return $response->withJson(Vending::all()->map(function($store) {
    return $store->load('char', 'items', 'items.attributes');
  }));
});

$app->get('/buying/{item}', function($request, $response, $args) {
  return $response->withJson(BuyingStore::item($args['item']));
});

$app->get('/buying', function ($request, $response) {
  return $response->withJson(BuyingStore::all()->map(function($store) {
    return $store->load('char', 'items');
  }));
});

$app->get('/item/{item}', function($request, $response, $args) {
  return $response->withJson((object) [
    'buying' => BuyingStore::item($args['item']),
    'vending' => Vending::item($args['item'])
  ]);
});

$app->get('/merchant/{char}', function ($request, $response, $args) {
  $char = Char::where('name', $args['char'])->first();
  return is_null($char) ? $response->withStatus(404) : $response->withJson($char->store());
});

$app->run();
