<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Models\CartModel;
use App\Views\ViewManager;
use App\Models\UserModel;
use App\Utils\AjaxUtil;
use App\Models\RecycleModel;
use App\Models\ImageModel;
use App\Models\OrderModel;

class UserController
{
    public function registerView()
    {
        return ViewManager::renderView('registerview');
    }

    public function register()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $pwd = $_POST['password'];

        $um = new UserModel;
        $result = $um->register($name, $email, $pwd);
        $flag = !is_array($result);

        AjaxUtil::sendAjax($flag, $result);
    }

    public function loginView()
    {
        return ViewManager::renderView('loginview');
    }

    public function login()
    {
        $email = $_POST['email'];
        $pwd = $_POST['password'];

        $um = new UserModel;
        $result = $um->login($email, $pwd);
        $flag = !is_array($result);

        AjaxUtil::sendAjax($flag, $result);
    }

    public function editProfileView()
    {
        return ViewManager::renderView(
            'editprofileview', 
            [], 
            ['publicnav', 'sidepublicnav']);
    }

    public function pointsView()
    {
        $userId = UserModel::getCurUserId();

        $rm = new RecycleModel();

        $totalRecPointUnused = $rm->getTotalRecPointLeftByUserId($userId);
        $totalCurrency = $rm->recPointToCurrency($totalRecPointUnused);
        
        $params['totalRecPointUnused'] = $totalRecPointUnused;
        $params['totalCurrency'] = $totalCurrency;

        return ViewManager::renderView(
            'pointsview', 
            $params, 
            ['publicnav', 'sidepublicnav']);
    }

    public function cartView()
    {
        $userId = UserModel::getCurUserId();

        $rm = new RecycleModel();

        $totalRecPointUnused = $rm->getTotalRecPointLeftByUserId($userId);
        $totalCurrency = $rm->recPointToCurrency($totalRecPointUnused);

        $cm = new CartModel();
        $cart = $cm->getCartProdByUserId($userId);

        /**
         * Replace img_path with the actual path
         */
        foreach ($cart as $key => $product) {
            $cart[$key]['img_path'] = ImageModel::getImgDir($product['seller_id'], $product['img_path']);
        }

        $params['cart'] = $cart;
        $params['totalCurrency'] = $totalCurrency;

        return ViewManager::renderView('cartview', $params, ['publicnav']);
    }

    public function ordersView()
    {
        return ViewManager::renderView('ordersview', [], ['publicnav', 'sidepublicnav']);
    }

    public function userRecycleView()
    {
        return ViewManager::renderView('userrecycleview', [], ['publicnav', 'sidepublicnav']);
    }

    public function getUserRecycle()
    {
        $userId = UserModel::getCurUserId();

        $rm = new RecycleModel();
        $result = $rm->getRecByUserId($userId);

        AjaxUtil::sendAjax(true, $result);
    }

    public function getUserRecPoint()
    {
        $userId = UserModel::getCurUserId();

        $rm = new RecycleModel();
        $result = $rm->getRecByUserId($userId);

        AjaxUtil::sendAjax(true, $result);
    }

    public function addToCart()
    {
        $userId = UserModel::getCurUserId();
        $prodDirName = $_GET['prod-dir-name'];
        $prodCount = $_GET['prod-count'];

        $cm = new CartModel();
        $result = $cm->addToCart($userId, $prodDirName, $prodCount);

        AjaxUtil::sendAjax(true, $result);
    }

    public function checkout()
    {
        $discountTotal = $_GET['disc-total'];

        $cm = new CartModel();
        $cm->checkout($discountTotal);

        AjaxUtil::sendAjax(true);
    }

    public function getCartTotal()
    {
        $om = new OrderModel();
        $total = $om->getOrderTotalByCart();

        AjaxUtil::sendAjax(true, $total);
    }

    public function getAllOrders()
    {
        $userId = UserModel::getCurUserId();

        $om = new OrderModel();
        $orders = $om->getAllOrderByUserId($userId);

        AjaxUtil::sendAjax(true, $orders);
    }
}
