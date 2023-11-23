<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;

class UserController
{
    public function register(){
        return ViewManager::renderView('registerview');
    }
}
