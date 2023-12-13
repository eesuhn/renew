<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Views\ViewManager;
use App\Utils\AjaxUtil;
use App\Models\RecycleModel;

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
}
