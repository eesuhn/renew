<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;

class IndexController
{
    public function index(){
        return ViewManager::renderView('indexview', [], ['publicnav']);
    }

    public function recycleFormView()
    {
        return ViewManager::renderView('recycleformview', [], ['publicnav']);
    }

    public function footerView()
    {
        return ViewManager::renderView('footerview', [], []);
    }
}
