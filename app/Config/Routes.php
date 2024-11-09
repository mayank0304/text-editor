<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Auth::login');
$routes->post('/loginUser', 'Auth::loginUser');
$routes->get('/register', 'Auth::register');
$routes->post('/registerUser', 'Auth::registerUser');
$routes->get('/logout', 'Auth::logout');
$routes->get('/editor', 'EditorController::index');
$routes->post('/editor/save', 'EditorController::save');
$routes->get('/editor/content', 'EditorController::getContent');