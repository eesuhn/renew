<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;
use App\Utils\AjaxUtil;
use App\Models\ProductModel;

class ArtistController
{
    public function addProductView()
    {
        return ViewManager::renderView('addproductview');
    }

    public function addProduct()
    {
        $pm = new ProductModel;

        // TEST: Add product
        $userId = 1;
        $prodName = 'test';
        $prodPrice = 100;
        $quantity = 1;
        $description = 'test';
        $imgPath = 'test';

        $flag = $pm->addProduct(
            $userId, 
            $prodName, 
            $prodPrice, 
            $quantity, 
            $description, 
            $imgPath
        );

        dd($flag);
    }
}
