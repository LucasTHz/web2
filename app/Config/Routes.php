<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'AuthController::login');
$routes->get('/logout', 'AuthController::logout');
$routes->post('/auth/login', 'AuthController::auth');
$routes->get('/unauthorized', 'AuthController::unauthorized');

$routes->group('user', function ($routes) {
    $routes->group('producer', ['filter' => 'gamesproducer'], function ($routes) {
        $routes->get('create', 'ProducerController::create');
        $routes->post('store', 'ProducerController::store');

        $routes->group('game', function ($routes) {
            $routes->get('create', 'GameController::create');
            $routes->post('store', 'GameController::store');
            $routes->get('edit/(:num)', 'GameController::edit/$1');
            $routes->post('update/(:num)', 'GameController::update/$1');
            $routes->get('delete/(:num)', 'GameController::delete/$1');
        });
    });

    $routes->group('client', function ($routes) {
        $routes->get('create', 'ClientController::create');
        $routes->post('store', 'ClientController::store');
    });
});
