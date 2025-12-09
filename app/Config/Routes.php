<?php

namespace Config;

$routes = Services::routes();

// Default page → login
$routes->get('/', 'Auth::login', ['filter' => 'auth:noauth']);

// Authentication
$routes->get('login', 'Auth::login', ['filter' => 'auth:noauth']);
$routes->post('login', 'Auth::loginPost', ['filter' => 'auth:noauth']);
$routes->get('register', 'Auth::register', ['filter' => 'auth:noauth']);
$routes->post('register', 'Auth::registerPost', ['filter' => 'auth:noauth']);
$routes->get('logout', 'Auth::logout', ['filter' => 'auth']); 

// Dashboard (now handled by Auth controller)
$routes->get('dashboard', 'Auth::dashboard', ['filter' => 'auth']);

// Admin
$routes->group('admin', ['filter' => 'role:admin'], function($routes) {
    $routes->get('manage-users', 'Admin::manageUsers');
    $routes->get('add-user', 'Admin::addUserForm');
    $routes->post('add-user', 'Admin::saveUser');
    $routes->get('edit-user/(:num)', 'Admin::editUser/$1');
    $routes->post('update-user/(:num)', 'Admin::updateUser/$1');
    $routes->get('restrict-user/(:num)', 'Admin::restrictUser/$1');
    $routes->get('unrestrict-user/(:num)', 'Admin::unrestrictUser/$1');
});

// Teacher & Student groups (future)
$routes->group('teacher', ['filter' => 'role:teacher'], function($routes){});
$routes->group('student', ['filter' => 'role:student'], function($routes){});

$routes->setAutoRoute(false);
