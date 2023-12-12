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
    '/edit-profile',
    'UserController@editProfileView');

$rm->get(
    '/points',
    'UserController@pointsView');

$rm->get(
    '/store',
    'StoreController@storeView');

$rm->get(
    '/cart',
    'UserController@cartView');
    
$rm->get(
    '/product-focus',
    'StoreController@productFocusView');

$rm->get(
    '/recycle-form',
    'IndexController@recycleFormView');

$rm->get(
    '/orders',
    'UserController@ordersView');

$rm->get(
    '/artist-products',
    'ArtistController@artistProductsView');

$rm->get(
    '/artist-profile',
    'ArtistController@artistProfileView'
);

// Add GET routes for AJAX here
$rm->get(
    '/get-artist-products',
    'ArtistController@getProductByArtist');

// Add POST routes here
$rm->post(
    '/register',
    'UserController@register');

$rm->post(
    '/login',
    'UserController@login');

$rm->post(
    '/add-product',
    'ArtistController@addProduct');

$rm->handleRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
