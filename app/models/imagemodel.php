<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

class ImageModel
{
    /**
     * Upload image.
     * Check if file type is allowed.
     * Check if file exists.
     * 
     * @param array $imgFile
     * @param string $dir
     * 
     * @return array Returns array of response
     * - fileName: File name
     * - error: Error message
     */
    public static function uploadImage($imgFile, $dir)
    {
        /**
         * @var array $typeAllowed Allowed file types.
         */
        $typeAllowed = [
            "image/jpeg",
            "image/jpg",
            "image/png"
        ];

        $fileInfo = pathinfo($imgFile["name"]);

        /**
         * TODO: Verify file name.
         */
        $return["fileName"] = getRand($fileInfo["filename"])  . "." . $fileInfo["extension"];
        
        $fileDir = $dir . "/" . $return["fileName"];

        if (!isset($imgFile) && $imgFile["error"] != 0) {
            $return["error"] = "Error: " . $imgFile["error"];
        }

        if ((!in_array($imgFile["type"], $typeAllowed)) 
            && !isset($return["error"])) {

            $return["error"] = "Error: File type not allowed";
        }

        if (!move_uploaded_file($imgFile["tmp_name"], $fileDir) 
            && !isset($return["error"])) {

            $return["error"] = "Error: File not uploaded";
        }

        return $return;
    }
}
