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
$routes->get('/dashboard', 'Home::dashboard');

$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('users', 'AdminController::listUsers');
    $routes->post('updateUserRole/(:num)', 'AdminController::updateUserRole/$1');
});

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
        $routes->get('edit/(:num)', 'ClientController::edit/$1');
        $routes->post('update/(:num)', 'ClientController::update/$1');
        $routes->post('update_balance/(:num)', 'ClientController::updateBalance/$1');
    });
});

$routes->group('cart', ['filter' => 'auth'],function ($routes) {
    $routes->post('add/(:num)', 'CartController::add/$1');
    $routes->get('remove/(:num)', 'CartController::remove/$1');
    $routes->get('/', 'CartController::show');
    $routes->post('buy', 'CartController::buy');
    $routes->get('purchase_history', 'CartController::purchaseHistory');
    $routes->get('deposit_history', 'CartController::depositHistory');
});
