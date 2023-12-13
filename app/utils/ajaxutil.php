<?php

namespace App\Utils;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

class AjaxUtil
{
    /**
     * AJAX: Handle data and return JSON response
     * 
     * @param bool $success
     * @param array $data (Optional)
     * 
     * @return void
     */
    public static function sendAjax(
        $success, 
        $data = [])
    {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => $success, 
            'data' => $data]);
        exit();
    }
}
