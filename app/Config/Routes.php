<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->setDefaultNamespace('App\\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('login', 'Auth::login', ['filter' => 'guest']);
$routes->post('login', 'Auth::attemptLogin', ['filter' => 'guest']);

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Dashboard::index');
    $routes->get('about', 'Pages::about');

    $routes->get('products', 'Products::index');
    $routes->get('products/new', 'Products::newForm');
    $routes->post('products', 'Products::create');
    $routes->get('products/(:num)/edit', 'Products::edit/$1');
    $routes->post('products/(:num)', 'Products::update/$1');
    $routes->post('products/(:num)/archive', 'Products::archive/$1');

    $routes->get('customers', 'Customers::index');
    $routes->get('customers/new', 'Customers::newForm');
    $routes->post('customers', 'Customers::create');
    $routes->get('customers/(:num)/edit', 'Customers::edit/$1');
    $routes->post('customers/(:num)', 'Customers::update/$1');
    $routes->post('customers/(:num)/delete', 'Customers::delete/$1');

    $routes->get('users', 'Users::index');
    $routes->get('users/new', 'Users::newForm');
    $routes->post('users', 'Users::create');
    $routes->get('users/(:num)/edit', 'Users::edit/$1');
    $routes->post('users/(:num)', 'Users::update/$1');
    $routes->post('users/(:num)/archive', 'Users::archive/$1');

    $routes->get('sales', 'Sales::index');
    $routes->get('sales/new', 'Sales::newForm');
    $routes->post('sales', 'Sales::create');
    $routes->get('sales/(:num)/receipt', 'Sales::receipt/$1');

    $routes->post('logout', 'Auth::logout');
});