<?php

use CodeIgniter\Router\RouteCollection; // Imports the necessary class for defining routes.

/**
 * @var RouteCollection $routes // Defines the $routes variable as an instance of RouteCollection.
 */

/**
 * Lab 3 ni sya dre // This is a comment block, likely marking routes for "Lab 3".
 */
$routes->get('/', 'Home::index'); // Maps a GET request to the root URL (/) to the Home controller's index method.
$routes->get('/about', 'Home::about'); // Maps a GET request to /about to the Home controller's about method.
$routes->get('/contact', 'Home::contact'); // Maps a GET request to /contact to the Home controller's contact method.
/**
 *Lab 4 ni sya dre // This is a comment block, likely marking routes for "Lab 4".
 */
$routes->get('/register', 'Auth::new'); // Maps a GET request to /register to the Auth controller's new method (for showing the form).
$routes->get('/login', 'Auth::index'); // Maps a GET request to /login to the Auth controller's index method (for showing the login form).
$routes->post('/login/auth', 'Auth::auth'); // Maps a POST request to /login/auth to the Auth controller's auth method (for processing login data).
$routes->get('/logout', 'Auth::logout'); // Maps a GET request to /logout to the Auth controller's logout method.
$routes->get('/dashboard', 'Auth::dashboard'); // Maps a GET request to /dashboard to the Auth controller's dashboard method (a restricted page).
$routes->post('/register', 'Auth::create'); // Maps a POST request to /register to the Auth controller's create method (for saving user registration data).
$routes->get('/register/success', 'Auth::success'); // Maps a GET request to /register/success to the Auth controller's success method (to display a success message).

$routes->setAutoRoute(true); // Enables CodeIgniter's automatic routing feature for controllers that don't have explicit routes.