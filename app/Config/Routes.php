<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
|--------------------------------------------------------------------------
| Public authentication routes
|--------------------------------------------------------------------------
*/

$routes->get('login', 'Auth::login', [
    'filter' => 'guest',
]);

$routes->post('login', 'Auth::attemptLogin', [
    'filter' => 'guest',
]);

/*
|--------------------------------------------------------------------------
| Public information route
|--------------------------------------------------------------------------
*/

$routes->get('about', 'Pages::about');

/*
|--------------------------------------------------------------------------
| Authenticated routes
|--------------------------------------------------------------------------
*/

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Pages::index');

    $routes->get('customers', 'Customers::index');

    /*
     * The controller method is newForm(), not new().
     */
    $routes->get(
        'customers/new',
        'Customers::newForm'
    );

    $routes->post(
        'customers',
        'Customers::create'
    );

    $routes->get(
        'customers/(:num)/edit',
        'Customers::edit/$1'
    );

    $routes->post(
        'customers/(:num)',
        'Customers::update/$1'
    );

    $routes->get(
        'users',
        'Users::index'
    );

    $routes->get(
        'users/new',
        'Users::new'
    );

    $routes->post(
        'users',
        'Users::create'
    );

    $routes->get(
        'users/(:num)/edit',
        'Users::edit/$1'
    );

    $routes->post(
        'users/(:num)',
        'Users::update/$1'
    );

    $routes->post(
        'logout',
        'Auth::logout'
    );
});