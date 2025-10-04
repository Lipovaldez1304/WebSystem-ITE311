<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/**
 * Lab 3 - Basic Pages
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/contact', 'Home::contact');

/**
 * Lab 4 - User Authentication
 */
// Registration
$routes->get('/register', 'Auth::new');
$routes->post('/register', 'Auth::create');
$routes->get('/register/success', 'Auth::success');

// Login
$routes->get('/login', 'Auth::index');
$routes->post('/login/auth', 'Auth::auth');

// Logout
$routes->get('/logout', 'Auth::logout');

/**
 * Lab 5 - Role-Based Dashboard
 */
$routes->get('/dashboard', 'Auth::dashboard');

// Enable auto-routing
$routes->setAutoRoute(true);