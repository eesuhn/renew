<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

class ValidateModel
{
    /**
     * Validate email with regex
     * 
     * @param string $email
     * 
     * @return bool Returns true if email is valid, false otherwise
     */
    public static function validateEmail($email)
    {
        $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        return preg_match($regex, $email);
    }

    /**
     * Validate password.
     * At least 8 characters long
     * At least 1 alphabet character
     * At least 1 numeric character
     * At least 1 special character
     * 
     * @param string $password
     * 
     * @return bool Returns true if password is valid, false otherwise
     */
    public static function validatePassword($password)
    {
        $regex = '/^(?=.*[A-Za-z])(?=.*\d)(?=.*\W)[A-Za-z\d\W]{8,}$/';
        return preg_match($regex, $password);
    }

    /**
     * AJAX: Handle errors and return JSON response
     * 
     * @param array $errors
     * 
     * @return void
     * 
     * @deprecated Use App\Utils\AjaxUtil::sendAjax() instead
     */
    public static function handleErrors($errors)
    {
        header('Content-Type: application/json');
        if (is_array($errors)) {
            echo json_encode(['success' => false, 'errors' => $errors]);
        } else {
            echo json_encode(['success' => true]);
        }
        exit();
    }

    /**
     * Validate login.
     * 
     * @return bool Returns true if user is logged in, false otherwise
     */
    public static function validateLogin()
    {
        return isset($_SESSION['renew_user']);
    }
}
