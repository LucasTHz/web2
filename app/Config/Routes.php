<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/auth/login', 'AuthController::auth');

$routes->group('user', function ($routes) {
  $routes->group('producer', function ($routes) {
    $routes->get('create', 'ProducerController::create');
    $routes->post('store', 'ProducerController::store');
});

$routes->group('client', function ($routes) {
    $routes->get('create', 'ClientController::create');
    $routes->post('store', 'ClientController::store');
});
});
