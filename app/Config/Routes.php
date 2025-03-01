<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('users', static function ($routes){
    $routes->post('login', 'UserController::login');
    $routes->post('register', 'UserController::register');
}); 

$routes->group('customers', ['filter' => 'jwt'], static function ($routes){
    $routes->get('', 'CustomerController::index');
    $routes->post('', 'CustomerController::store'); 
    $routes->get('(:num)', 'CustomerController::show/$1'); 
    $routes->put('(:num)', 'CustomerController::update/$1'); 
    $routes->delete('(:num)', 'CustomerController::delete/$1'); 
}); 

$routes->group('products', ['filter' => 'jwt'], static function ($routes){
    $routes->get('', 'ProductController::index');
    $routes->post('', 'ProductController::store'); 
    $routes->get('(:num)', 'ProductController::show/$1'); 
    $routes->put('(:num)', 'ProductController::update/$1'); 
    $routes->delete('(:num)', 'ProductController::delete/$1');
}); 

$routes->group('orders', ['filter' => 'jwt'], static function ($routes){
    $routes->get('', 'OrderController::index');
    $routes->post('', 'OrderController::store'); 
    $routes->get('(:num)', 'OrderController::show/$1'); 
    $routes->put('(:num)', 'OrderController::update/$1'); 
    $routes->delete('(:num)', 'OrderController::delete/$1');
}); 

