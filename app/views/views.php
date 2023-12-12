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
    ['editprofileview.css']);

$vm->addView(
    'pointsview',
    'Points',
    ['pointsview.css'],
    ['pointsview.js']);

$vm->addView(
    'storeview',
    'Store',
    ['storeview.css']);

$vm->addView(
    'cartview',
    'Cart',
    ['cartview.css']);

$vm->addView(
    'productfocusview',
    'Product Focus',
    ['productfocusview.css'],
    ['productfocusview.js']);

$vm->addView(
    'recycleformview',
    'Recycle Form',
    ['recycleformview.css'],
    ['recycleformview.js']);

$vm->addView(
    'ordersview',
    'Orders',
    ['ordersview.css'],
    ['ordersview.js']);

$vm->addView(
    'artistproductsview',
    'Artist Products',
    ['artistproductsview.css'],
    ['artistproductsview.js']);

$vm->addView(
    'artistprofileview',
    'Artist Profile',
    ['artistprofileview.css'],
    ['artistprofileview.js']);

// Add segments here
$vm->addSeg(
    'sample');
