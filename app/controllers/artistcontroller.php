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
    public function addProduct()
    {
        $userId = UserModel::getCurUserId();
        $userDir = UserModel::getUserDir($userId);

        $name = $_POST['prod-name'];
        $price = $_POST['prod-price'];
        $quantity = $_POST['prod-qty'];
        $description = $_POST['prod-desc'];
        $image = $_FILES['prod-img'];

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

    public function artistProductsView()
    {
        return ViewManager::renderView('artistproductsview', [], ['artistnav']);
    }

    public function getProductByArtist()
    {
        $userId = UserModel::getCurUserId();

        $pm = new ProductModel();
        $result = $pm->getProdByUserId($userId);

        AjaxUtil::sendAjax(true, $result);
    }

    public function artistProfileView()
    {
        return ViewManager::renderView('artistprofileview', [], ['artistnav']);
    }
}
