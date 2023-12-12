<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;
use App\Utils\AjaxUtil;
use App\Models\ProductModel;
use App\Models\UserModel;
use App\Models\ImageModel;

class ArtistController
{
    public function addProductView()
    {
        return ViewManager::renderView('addproductview', [], ['artistnav']);
    }

    public function addProduct()
    {
        $userId = UserModel::getCurUserId();
        $userDir = UserModel::getUserDir($userId);

        $name = $_POST['name'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $image = $_FILES['image'];

        $imgUploadInfo = ImageModel::uploadImage($image, $userDir);
        
        $pm = new ProductModel();
        $result = $pm->addProduct(
            $userId,
            $name,
            $price,
            $quantity,
            $description,
            $imgUploadInfo
        );
        $flag = !is_array($result);

        AjaxUtil::sendAjax($flag, $result);
    }

    public function productModalView()
    {
        return ViewManager::renderView('productmodalview', [], ['artistnav']);
    }
}
