<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Routes\RouteManager;

$rm = new RouteManager;

// Add GET routes here
$rm->get(
    '/', 
    'IndexController@index');

$rm->get(
    '/index.php', 
    'IndexController@index');

$rm->get(
    '/register',
    'UserController@registerView');

$rm->get(
    '/login',
    'UserController@loginView');

$rm->get(
    '/admin-navbar',
    'IndexController@adminNavbarView');

// Add POST routes here
$rm->post(
    '/register',
    'UserController@register');

$rm->post(
    '/login',
    'UserController@login');

$rm->handleRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
