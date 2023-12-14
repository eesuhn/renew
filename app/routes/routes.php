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
    'ArtistController@artistProfileView');

$rm->get(
    '/user-recycle',
    'UserController@userRecycleView');

$rm->get(
    '/admin-recycle',
    'AdminController@adminRecycleView');

$rm->get(
    '/logout',
    'UserController@logout');

$rm->get(
    '/admin-order',
    'AdminController@adminOrderView');

$rm->get(
    '/admin-user-list',
    'AdminController@adminUserListView');

$rm->get(
    '/delete-cart-item',
    'UserController@deleteCartItem');

// Add GET routes for AJAX here
$rm->get(
    '/get-artist-products',
    'ArtistController@getProductByArtist');

$rm->get(
    '/get-user-recycle',
    'UserController@getUserRecycle');

$rm->get(
    '/get-admin-recycle',
    'AdminController@getAdminRecycle');

$rm->get(
    '/get-user-rec-point',
    'UserController@getUserRecPoint');

$rm->get(
    '/get-all-orders',
    'UserController@getAllOrders');

$rm->get(
    '/get-cart-total',
    'UserController@getCartTotal');

$rm->get(
    '/get-admin-orders',
    'AdminController@getAdminOrders');

$rm->get(
    '/get-user-list',
    'AdminController@getUserList');

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

$rm->post(
    '/recycle',
    'IndexController@recycle');

$rm->post(
    '/update-recycle',
    'AdminController@updateRecycle');

$rm->post(
    '/update-order',
    'AdminController@updateOrder');

$rm->post(
    '/delete-recycle',
    'AdminController@deleteRecycle');

$rm->post(
    '/add-to-cart',
    'UserController@addToCart');

$rm->post(
    '/checkout',
    'UserController@checkout');

$rm->post(
    '/update-user',
    'AdminController@updateUser');

$rm->post(
    '/delete-user',
    'AdminController@deleteUser');

$rm->post(
    '/update-profile',
    'UserController@updateProfile');

$rm->handleRoute($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
