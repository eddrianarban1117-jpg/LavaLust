<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 */


/** @var object $router */


// ==========================================================
// HOME
// ==========================================================

$router->get('/', 'Welcome::index');


// ==========================================================
// USERS
// ==========================================================

// READ
$router->get('/users', 'UsersController::index');

// CREATE
$router->get('/users/create', 'UsersController::create');
$router->post('/users/store', 'UsersController::store');

// UPDATE
$router->get('/users/edit/{id}', 'UsersController::edit')
       ->where_number('id');

$router->post('/users/update/{id}', 'UsersController::update')
       ->where_number('id');

// DELETE
$router->get('/users/delete/{id}', 'UsersController::delete')
       ->where_number('id');


// ==========================================================
// STUDENT
// ==========================================================

$router->get('/student', 'StudentController::index');

$router->get('/student/profile', 'StudentController::profile')
       ->middleware('student');


// ==========================================================
// AUTHENTICATION - OLD LAB 5 WEB LOGIN
// ==========================================================

$router->get('/login', 'AuthController::login');

$router->post('/login/authenticate', 'AuthController::authenticate');

$router->get('/logout', 'AuthController::logout');


// ==========================================================
// PRODUCTS - OLD LAB 5 WEB ROUTES
// ==========================================================

// READ
$router->get('/products', 'ProductController::index')
       ->middleware('auth');

// CREATE - Show Form
$router->get('/products/create', 'ProductController::create')
       ->middleware('auth');

// CREATE - Save Product
$router->post('/products/store', 'ProductController::store')
       ->middleware('auth');

// UPDATE - Show Edit Form
$router->get('/products/edit/{id}', 'ProductController::edit')
       ->where_number('id')
       ->middleware('auth');

// UPDATE - Save Changes
$router->post('/products/update/{id}', 'ProductController::update')
       ->where_number('id')
       ->middleware('auth');

// DELETE
$router->get('/products/delete/{id}', 'ProductController::delete')
       ->middleware('auth');


// ==========================================================
// LAB 6 - API AUTHENTICATION
// ==========================================================

// OPTIONS - CORS Preflight
$router->options('/api/login', 'ApiAuthController::login');

// POST - API Login
$router->post('/api/login', 'ApiAuthController::login');


// ==========================================================
// LAB 6 - PRODUCT API
// ==========================================================

// OPTIONS - CORS Preflight
$router->options('/api/products', 'ProductApiController::index');

// GET - Get all products
$router->get('/api/products', 'ProductApiController::index');

// POST - Create product
$router->post('/api/products', 'ProductApiController::store');


// OPTIONS - CORS Preflight for single product
$router->options('/api/products/{id}', 'ProductApiController::show');

// GET - Get single product
$router->get('/api/products/{id}', 'ProductApiController::show')
       ->where_number('id');

// PUT - Update product
$router->put('/api/products/{id}', 'ProductApiController::update');

// DELETE - Delete product
$router->delete('/api/products/{id}', 'ProductApiController::delete');


// ==========================================================
// END OF ROUTES
// ==========================================================

?>