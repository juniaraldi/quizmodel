<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/home', 'Home::index');
$routes->get('/about', 'About::index', ['as'=>'about']);

//roue dashboard admin
$routes->get('/dashboard', 'Dashboard/Dashboard::index');

$routes->get('/dashboard/billing', 'Dashboard/Billing::index');

$routes->get('/dashboard/userdatatables', 'Dashboard/UserDatatables::index');

$routes->get('/dashboard/profile/(:segment)', 'Profile::detail/$1');

$routes->get('/dashboard/table', 'Dashboard/Table::loadRecord');

$routes->get('/dashboard/data', 'dashboard/UserDatatables::getdata');

$routes->get('/dashboard/form', 'dashboard/UserDatatables::getform');

$routes->post('/dashboard/insertAjax', 'Dashboard/UserDatatables::insertAjax');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
