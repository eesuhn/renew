<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;
use App\Utils\AjaxUtil;
use App\Models\ProductModel;
use App\Models\ImageModel;

class StoreController
{
    public function storeView()
    {
        $pm = new ProductModel();
        $products = $pm->getAllProdDesc();

        /**
         * Replace img_path with the actual path
         */
        foreach ($products as $key => $product) {
            $userId = $product['user_id'];
            $products[$key]['img_path'] = ImageModel::getImgDir($userId, $product['img_path']);
        }

        $params['products'] = $products;

        return ViewManager::renderView('storeview', $params, ['publicnav']);
    }

    public function productFocusView()
    {
        return ViewManager::renderView('productfocusview', [], ['publicnav']);
    }
}
