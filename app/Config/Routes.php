<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/home', 'Dashboard::index');
$routes->post('land/pattadarDetails', 'Dashboard::pattadarDetails');
$routes->get('land/pattadarDetails', 'Dashboard::pattadarDetails');
$routes->post('land/payUpdate', 'Dashboard::payUpdate');
$routes->get('land/receipt/(:num)', 'Dashboard::receipt/$1');




$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->post('/login', 'Login::checkLogin');

$routes->get('/user', 'User::index');
$routes->post('/user/create', 'User::create');
$routes->get('/userlist', 'User::userListData');
$routes->get('/user/get/(:num)', 'User::get/$1');
$routes->post('user/update', 'User::update');
$routes->post('user/toggleStatus', 'User::toggleStatus');

$routes->get('land/import', 'LandImportController::index');
$routes->post('land/import-excel', 'LandImportController::importExcel');
// $routes->get('land/list', 'LandImportController::landListView');

$routes->get('land/list', 'LandImportController::landList');
$routes->post('land/list', 'LandImportController::landList');

$routes->get('testLib', 'TestExcel::loadExcel');

$routes->get('land/create', 'LandImportController::createform');
$routes->post('land/store', 'LandImportController::saveLandData');






// $routes->get('/', 'VisitorController::create');
// $routes->get('/visitor/create','VisitorController::create');
// $routes->post('/visitor/submit','VisitorController::submit');
// $routes->get('/visitor/success','VisitorController::success');

// $routes->get('/admin/pending','AdminController::pending');
// $routes->post('/admin/approve','AdminController::approve');

// $routes->get('/security/scanner','SecurityController::scannerView');
// $routes->post('/security/verify','SecurityController::verify');