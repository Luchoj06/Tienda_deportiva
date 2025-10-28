<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 🏠 Ruta principal → Login
$routes->get('/', 'AuthController::login');

// 🔐 Autenticación
$routes->get('login', 'AuthController::login');
$routes->post('login/doLogin', 'AuthController::doLogin');
$routes->get('logout', 'AuthController::logout');

// 👤 Usuarios
$routes->group('usuarios', static function ($routes) {
    $routes->get('/', 'UsuarioController::index');
    $routes->get('create', 'UsuarioController::create');
    $routes->post('store', 'UsuarioController::store');
    $routes->get('edit/(:num)', 'UsuarioController::edit/$1');
    $routes->post('update/(:num)', 'UsuarioController::update/$1');
    $routes->get('delete/(:num)', 'UsuarioController::delete/$1');
});

// 📦 Productos
$routes->group('productos', static function ($routes) {
    $routes->get('/', 'ProductoController::index');
    $routes->get('create', 'ProductoController::create');
    $routes->post('store', 'ProductoController::store');
    $routes->get('edit/(:num)', 'ProductoController::edit/$1');
    $routes->post('update/(:num)', 'ProductoController::update/$1');
    $routes->get('delete/(:num)', 'ProductoController::delete/$1');
});

// 🧾 Ventas
$routes->group('ventas', static function ($routes) {
    $routes->get('/', 'VentaController::index');
    $routes->post('store', 'VentaController::store');
    $routes->post('update/(:num)', 'VentaController::update/$1');
    $routes->get('delete/(:num)', 'VentaController::delete/$1');
});

// 👥 Clientes
$routes->group('clientes', static function ($routes) {
    $routes->get('/', 'ClienteController::index');
    $routes->post('store', 'ClienteController::store');
    $routes->post('update/(:num)', 'ClienteController::update/$1');
    $routes->get('delete/(:num)', 'ClienteController::delete/$1');
    $routes->get('compras/(:num)', 'ClienteController::compras/$1');
});

// 📊 Dashboard
$routes->get('dashboard', 'Dashboard::index');

// 🧩 Tipos de productos (nuevo módulo)
$routes->group('tipoproducto', static function ($routes) {
    $routes->get('/', 'TipoProductoController::index');
    $routes->get('create', 'TipoProductoController::create');
    $routes->post('store', 'TipoProductoController::store');
    $routes->get('edit/(:num)', 'TipoProductoController::edit/$1');
    $routes->post('update/(:num)', 'TipoProductoController::update/$1');
    $routes->get('delete/(:num)', 'TipoProductoController::delete/$1');
});
