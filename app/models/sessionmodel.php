<?php

namespace App\Models;

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

class SessionModel
{
    /**
     * Start session if not started.
     * 
     * @return void
     */
    private static function startSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set session data after encrypting it.
     * 
     * @param string|array $params
     * @param string $cookie
     * @param string $name
     * 
     * @return void|bool Returns false if cookie is not set or empty
     */
    public static function setSession($params, $cookie, $name)
    {
        self::startSession();

        if (!isset($cookie) || empty($cookie)) {
            return false;
        }

        $_SESSION[$name] = self::encryptSession($params, $cookie);
    }

    /**
     * Get session data after decrypting it.
     * 
     * @param string $name
     * 
     * @return string|array|bool Returns decrypted data, false otherwise
     */
    public static function getSession($name)
    {
        self::startSession();

        $cookie = $_COOKIE[$name];

        if (!isset($cookie) || empty($cookie)) {
            return false;
        }

        if (!isset($_SESSION[$name])) {
            return false;
        }
        return self::decryptSession($_SESSION[$name], $cookie);
    }

    /**
     * Destroy session.
     * 
     * @return void
     */
    public static function destroySession()
    {
        self::startSession();
        session_destroy();
    }

    /**
     * Encrypt session data.
     * 
     * @param string|array $data
     * @param string $key
     * 
     * @return string|bool Returns encrypted data, false otherwise
     */
    private static function encryptSession($data, $key)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }
        $ivSize = openssl_cipher_iv_length($cipher = "AES-256-CBC");
        $iv = openssl_random_pseudo_bytes($ivSize);
        $encryptedData = openssl_encrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);
        $result = base64_encode($iv . $encryptedData);
        
        return $result;
    }

    /**
     * Decrypt session data.
     * 
     * @param string $data
     * @param string $key
     * 
     * @return string|array|bool Returns decrypted data, false otherwise
     */
    private static function decryptSession($data, $key)
    {
        $data = base64_decode($data);
        $ivSize = openssl_cipher_iv_length($cipher = "AES-256-CBC");
        $iv = substr($data, 0, $ivSize);
        $data = substr($data, $ivSize);
        $decryptedData = openssl_decrypt($data, $cipher, $key, OPENSSL_RAW_DATA, $iv);

        if (is_array(json_decode($decryptedData, true))) {
            $decryptedData = json_decode($decryptedData, true);
        }
        return $decryptedData;
    }
}
