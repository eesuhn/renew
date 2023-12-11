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
     * - fileName: File name, if upload is successful
     * - error: Error message, if upload is failed
     */
    public static function uploadImage($imgFile, $dir)
    {
        if (!isset($imgFile) || $imgFile['error'] == UPLOAD_ERR_NO_FILE) {
            $result["error"] = "*File is required";
        }

        if ($imgFile['error'] == UPLOAD_ERR_INI_SIZE) {
            $result["error"] = "*File exceeds maximum size allowed";
        }
        
        /**
         * @var array $typeAllowed Allowed file types.
         */
        $typeAllowed = [
            "image/jpeg",
            "image/jpg",
            "image/png"
        ];
        
        if (!isset($result["error"])) {
            if ((!in_array($imgFile["type"], $typeAllowed))) {
                $result["error"] = "Invalid file type. Only JPG, JPEG, PNG files are allowed";
            }
        }

        if (!isset($result["error"])) {
            $fileInfo = pathinfo($imgFile["name"]);

            /**
             * TODO: Verify file name.
             */
            $result["fileName"] = getRand($fileInfo["filename"])  . "." . $fileInfo["extension"];

            $fileDir = $dir . "/" . $result["fileName"];

            if (!move_uploaded_file($imgFile["tmp_name"], $fileDir)) {
                $result["error"] = "Error: File not uploaded";
            }
        }

        return $result;
    }
}
