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
        $pm = new ProductModel();
        $products = $pm->getRecProd();

        /**
         * Replace img_path with the actual path
         */
        foreach ($products as $key => $product) {
            $userId = $product['user_id'];
            $products[$key]['img_path'] = ImageModel::getImgDir($userId, $product['img_path']);
        }

        $params['products'] = $products;

        $dirName = $_GET['product-name'];

        $pm = new ProductModel();
        $product = $pm->getProdByDirName($dirName);

        $userId = $product['user_id'];
        $product['img_path'] = ImageModel::getImgDir($userId, $product['img_path']);

        $params['product'] = $product;

        return ViewManager::renderView('productfocusview', $params, ['publicnav']);
    }
}
