<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;

$vm = new ViewManager();

// Add navbars here
$vm->addNav(
    'publicnav',
    ['publicnav.css']);

$vm->addNav(
    'sidepublicnav',
    ['sidepublicnav.css']);

$vm->addNav(
    'adminnav',
    ['adminnav.css']);

$vm->addNav(
    'artistnav',
    ['artistnav.css']);

// Add views here
$vm->addView(
    'installerview', 
    'Installer', 
    ['installerview.css']);

$vm->addview(
    'invalidview', 
    '404', 
    ['invalidview.css']);

$vm->addView(
    'indexview', 
    'Home', 
    ['indexview.css']);

$vm->addView(
    'registerview',
    'Register',
    ['registerview.css'],
    ['registerview.js']);

$vm->addView(
    'loginview',
    'Login',
    ['loginview.css'],
    ['loginview.js']);

$vm->addView(
    'editprofileview',
    'Profile',
    ['editprofileview.css'],
    [],
    ['public'],
    true);

$vm->addView(
    'pointsview',
    'Points',
    ['pointsview.css'],
    ['pointsview.js'],
    ['public'],
    true);

$vm->addView(
    'storeview',
    'Store',
    ['storeview.css']);

$vm->addView(
    'cartview',
    'Cart',
    ['cartview.css'],
    ['cartview.js'],
    ['public'],
    true);

$vm->addView(
    'productfocusview',
    'Product Focus',
    ['productfocusview.css'],
    ['productfocusview.js']);

$vm->addView(
    'recycleformview',
    'Recycle Form',
    ['recycleformview.css'],
    ['recycleformview.js'],
    ['public'],
    true);

$vm->addView(
    'ordersview',
    'Orders',
    ['ordersview.css'],
    ['ordersview.js'],
    ['public'],
    true);

$vm->addView(
    'artistproductsview',
    'Artist Products',
    ['artistproductsview.css'],
    ['artistproductsview.js'],
    ['artist'],
    true);

$vm->addView(
    'artistprofileview',
    'Artist Profile',
    ['artistprofileview.css'],
    ['artistprofileview.js'],
    ['artist'],
    true);

$vm->addView(
    'userrecycleview',
    'My Recycle',
    ['userrecycleview.css'],
    ['userrecycleview.js'],
    ['public'],
    true);

$vm->addView(
    'adminrecycleview',
    'Admin Recycle',
    ['adminrecycleview.css'],
    ['adminrecycleview.js'],
    ['admin'],
    true);

$vm->addView(
    'adminorderview',
    'Admin Order',
    ['adminorderview.css'],
    ['adminorderview.js'],
    ['admin'],
    true);

// Add segments here
$vm->addSeg(
    'sample');
