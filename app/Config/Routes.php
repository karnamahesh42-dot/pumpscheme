<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/home', 'Dashboard::index');

$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->post('/login', 'Login::checkLogin');

$routes->get('/user', 'User::index');
$routes->post('/user/create', 'User::create');
$routes->get('/userlist', 'User::userListData');
$routes->get('/user/get/(:num)', 'User::get/$1');
$routes->post('user/update', 'User::update');
$routes->post('user/toggleStatus', 'User::toggleStatus');

// $routes->get('/', 'VisitorController::create');
// $routes->get('/visitor/create','VisitorController::create');
// $routes->post('/visitor/submit','VisitorController::submit');
// $routes->get('/visitor/success','VisitorController::success');

// $routes->get('/admin/pending','AdminController::pending');
// $routes->post('/admin/approve','AdminController::approve');

// $routes->get('/security/scanner','SecurityController::scannerView');
// $routes->post('/security/verify','SecurityController::verify');