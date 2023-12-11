<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;
use App\Utils\AjaxUtil;

class StoreController
{
    public function storeView()
    {
        return ViewManager::renderView('storeview');
    }

    public function productFocusView()
    {
        return ViewManager::renderView('productfocusview');
    }
}
