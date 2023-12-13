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
}
