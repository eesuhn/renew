<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;
use App\Utils\AjaxUtil;
use App\Models\ProductModel;

class StoreController
{
    public function storeView()
    {
        $pm = new ProductModel();
        $products = $pm->getAllProdDesc();

        $params['products'] = $products;

        return ViewManager::renderView('storeview', $params, ['publicnav']);
    }

    public function productFocusView()
    {
        return ViewManager::renderView('productfocusview', [], ['publicnav']);
    }
}
