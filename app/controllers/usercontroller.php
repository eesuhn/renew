<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;
use App\Models\UserModel;
use App\Utils\AjaxUtil;

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
        return ViewManager::renderView(
            'pointsview', 
            [], 
            ['publicnav', 'sidepublicnav']);
    }

    public function cartView()
    {
        return ViewManager::renderView('cartview', [], ['publicnav']);
    }

    public function ordersView()
    {
        return ViewManager::renderView('ordersview', [], ['publicnav']);
    }
}
