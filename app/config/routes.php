<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * LavaLust - an opensource lightweight PHP MVC Framework
 * ------------------------------------------------------------------
 *
 * MIT License
 *
 * Copyright (c) 2020 Ronald M. Marasigan
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
// AUTHENTICATION
// ==========================================================

// LOGIN PAGE
$router->get('/login', 'AuthController::login');

// LOGIN PROCESS
$router->post('/login/authenticate', 'AuthController::authenticate');

// LOGOUT
$router->get('/logout', 'AuthController::logout');


// ==========================================================
// PRODUCTS
// ==========================================================

// READ - Product List
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
       ->where_number('id');


// END OF ROUTES
?>