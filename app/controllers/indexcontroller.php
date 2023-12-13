<?php

namespace App\Controllers;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Utils\AjaxUtil;
use App\Views\ViewManager;
use App\Models\RecycleModel;
use App\Models\UserModel;
use DateTime;
use App\Models\ImageModel;
use App\Models\ProductModel;

class IndexController
{
    public function index(){
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

        return ViewManager::renderView('indexview', $params, ['publicnav']);
    }

    public function recycleFormView()
    {
        $rm = new RecycleModel();
        $recCenters = $rm->getAllRecCenterDesc();

        $params['recCenters'] = $recCenters;

        /**
         * Current date and time.
         * 
         * @var DateTime $curDateTime
         */
        $curDateTime = new DateTime();
        $params['curDate'] = $curDateTime->format('Y-m-d');
        $params['curTime'] = $curDateTime->format('H:i');

        return ViewManager::renderView('recycleformview', $params, ['publicnav']);
    }

    public function recycle()
    {
        $userId = UserModel::getCurUserId();

        $recName = $_POST['rec-name'];
        $recWeight = $_POST['rec-weight'];
        $recCenterId = $_POST['rec-centre'];
        $recDate = $_POST['rec-date'];
        $recTime = $_POST['rec-time'];
        $recImg = $_FILES['rec-img'];

        $dateTime = new DateTime($recDate . ' ' . $recTime);
        $recDateTime = $dateTime->format('Y-m-d H:i:s');

        /**
         * Directory for recyclable.
         * 
         * @var string $recDir
         */
        $recDir = ROOT . '/app/assets/recyclable/';
        $imgUploadInfo = ImageModel::uploadImage($recImg, $recDir);

        $rm = new RecycleModel();
        $result = $rm->recycle(
            $userId,
            $recName,
            $recWeight,
            $recCenterId,
            $recDateTime,
            $imgUploadInfo
        );
        $flag = !is_array($result);

        AjaxUtil::sendAjax($flag, $result);
    }
}
