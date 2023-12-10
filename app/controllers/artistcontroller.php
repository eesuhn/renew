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
        $name = $_POST['name'];
        $image = $_FILES['image'];

        $flag = true;
        $result = $image;

        AjaxUtil::sendAjax($flag, $result);
    }
}
