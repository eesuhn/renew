<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;

$vm = new ViewManager();

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
    ['indexview.css'],
    ['indexview.js']);

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
    'adminnavbarview',
    'Admin Navbar',
    ['adminnavbarview.css'],
    ['adminnavbarview.js']);

$vm->addView(
    'editprofileview',
    'Profile',
    ['editprofileview.css'],
    ['editprofileview.js']);

// Add segments here
$vm->addSeg(
    'sample');
