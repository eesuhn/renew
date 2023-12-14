<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;
use App\Utils\AjaxUtil;
use App\Models\RecycleModel;
use App\Models\UserModel;
use App\Models\OrderModel;

class AdminController
{
    public function adminRecycleView()
    {
        return ViewManager::renderView('adminrecycleview', [], ['adminnav']);
    }

    public function getAdminRecycle()
    {
        $rm = new RecycleModel;
        $result = $rm->getAllRec();

        // Add user name to result
        $um = new UserModel;

        foreach ($result as &$res) {
            $user = $um->getUserById($res['user_id']);
            $res['user_name'] = $user['user_name'];
        }

        AjaxUtil::sendAjax(true, $result);
    }

    public function updateRecycle()
    {
        $recId = $_GET['rec-id'];
        $recPoint = $_POST['rec-point'];
        $recStatus = $_POST['rec-status'];

        $rm = new RecycleModel;
        $result = $rm->updateRec($recId, $recPoint, $recStatus);

        AjaxUtil::sendAjax($result);
    }

    public function updateOrder()
    {
        $orderId = $_GET['order-id'];
        $orderStatus = $_POST['order-status'];

        $om = new OrderModel;
        $result = $om->updateOrderStatus($orderId, $orderStatus);

        AjaxUtil::sendAjax($result);
    }

    public function deleteRecycle()
    {
        $recId = $_GET['rec-id'];

        $rm = new RecycleModel;
        $result = $rm->deleteRec($recId);

        AjaxUtil::sendAjax($result);
    }

    public function adminOrderView()
    {
        return ViewManager::renderView('adminorderview', [], ['adminnav']);
    }

    public function getAdminOrders()
    {
        $om = new OrderModel;
        $result = $om->getAllOrder();

        AjaxUtil::sendAjax(true, $result);
    }
}
