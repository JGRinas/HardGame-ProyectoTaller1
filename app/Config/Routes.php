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
$routes->setDefaultController('UserController');
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

//ViewController
$routes->get('/', 'ViewController::index');
$routes->get('/index', 'ViewController::index');
$routes->get('/aboutUs', 'ViewController::aboutUs');
$routes->get('/help', 'ViewController::help', ['filter' => 'auth_user']);
$routes->get('/contact', 'ViewController::contact');
$routes->get('/marketing', 'ViewController::marketing');
$routes->get('/login', 'ViewController::login');
$routes->get('/register', 'ViewController::register');
$routes->get('/terms', 'ViewController::terms');
$routes->get('/products', 'ViewController::products');
$routes->get('/viewInfoProduct', 'ViewController::viewInfoProduct');
$routes->get('/profile', 'ViewController::viewProfile',['filter' => 'auth_user']);
//fin ViewController

//UserController
$routes->post('registerHelp', 'UserController::registerHelp', ['filter' => 'auth_user']);
$routes->post('loginUser', 'UserController::loginUser');
$routes->get('logout', 'UserController::logout', ['filter' => 'auth_user']);
$routes->post('registerUser', 'UserController::registerUser');
$routes->get('editProfile', 'UserController::editProfile', ['filter' => 'auth_user']);
$routes->post('updateProfile', 'UserController::updateProfile', ['filter' => 'auth_user']);
$routes->get('consultSend', 'UserController::consultSend', ['filter' => 'auth_user']);
$routes->get('myPurchases', 'UserController::myPurchases', ['filter' => 'auth_user']);


//fin UserController

//AdminController
$routes->get('/registerProducts', 'AdminController::regProductsView', ['filter' => 'auth']);
$routes->post('regProducts', 'AdminController::regProducts', ['filter' => 'auth']);
$routes->get('/registerCategory', 'AdminController::regCategoryView', ['filter' => 'auth']);
$routes->post('regCategory', 'AdminController::regCategory', ['filter' => 'auth']);
$routes->get('/registerBrand', 'AdminController::regBrandView', ['filter' => 'auth']);
$routes->post('regBrand', 'AdminController::regBrand', ['filter' => 'auth']);
$routes->get('/consults', 'AdminController::viewConsults', ['filter' => 'auth']);
$routes->get('/manageUsers', 'AdminController::viewManageUsers', ['filter' => 'auth']);
$routes->get('/manageProducts', 'AdminController::viewManageProducts', ['filter' => 'auth']);
$routes->get('/consultAnswer', 'AdminController::consultAnswer', ['filter' => 'auth']);
$routes->post('/consultAnswerReg', 'AdminController::consultAnswerReg', ['filter' => 'auth']);
$routes->get('/manageSales', 'AdminController::manageSales', ['filter' => 'auth']);
$routes->get('/viewSaleDetails', 'AdminController::viewSaleDetails', ['filter' => 'auth']);
//fin AdminController

//CartController
$routes->get('cartView', 'CartController::cartView', ['filter' => 'auth_user']);
$routes->post('cartView', 'CartController::cartView', ['filter' => 'auth_user']);
$routes->post('addToCart', 'CartController::addToCart', ['filter' => 'auth_user']);
$routes->get('removeToCart', 'CartController::removeToCart', ['filter' => 'auth_user']);
$routes->post('removeToCart', 'CartController::removeToCart', ['filter' => 'auth_user']);
$routes->get('cartDestroy', 'CartController::cartDestroy', ['filter' => 'auth_user']);
$routes->get('newPurchases', 'CartController::newPurchases', ['filter' => 'auth_user']);
$routes->get('downloadPdfSale', 'CartController::downloadPdfSale', ['filter' => 'auth_user']);
//fin CartController

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
