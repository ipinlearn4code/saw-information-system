<?php

use App\Controllers\PenilaianController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index');

$routes->group(
    'users',
    function ($routes) {
        $routes->get('/', 'UserController::index');
        $routes->get('create', 'UserController::create');
        $routes->post('store', 'UserController::store');
        $routes->get('edit/(:num)', 'UserController::edit/$1');
        $routes->post('update/(:num)', 'UserController::update/$1');
        $routes->get('delete/(:num)', 'UserController::delete/$1');
    }
);
$routes->group(
    'mahasiswa',
    function ($routes) {
        $routes->get('/', 'MahasiswaController::index');
        $routes->get('create', 'MahasiswaController::create');
        $routes->post('store', 'MahasiswaController::store');
        $routes->get('edit/(:num)', 'MahasiswaController::edit/$1');
        $routes->put('(:num)', 'MahasiswaController::update/$1');
        $routes->get('delete/(:num)', 'MahasiswaController::delete/$1');
    }


);

$routes->group(
    'kriteria',
    function ($routes) {
        $routes->get('/', 'KriteriaController::index');
        $routes->get('create', 'KriteriaController::create');
        $routes->post('store', 'KriteriaController::store');
        $routes->get('edit/(:num)', 'KriteriaController::edit/$1');
        $routes->put('(:num)', 'KriteriaController::update/$1');
        $routes->get('delete/(:num)', 'KriteriaController::delete/$1');
        $routes->get('sub_kriteria/(:num)', 'KriteriaController::sub_kriteria/$1');
    }
);  

$routes->group('penilaian', function($routes) {
    $routes->get('/', 'PenilaianController::index');

    $routes->post('submit', 'PenilaianController::submit');

    $routes->get('hasil/(:num)', 'PenilaianController::hasil');
});