<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

/**
 * Generate random string.
 * 
 * @param string $var
 * @param int $length (Optional)
 * @param string $prefix (Optional)
 * @param string $suffix (Optional)
 * 
 * @return string
 */
function getRand($var, $length = 10, $prefix = '', $suffix = '')
{
    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($char);
    $randVar = $prefix . $var . '_';

    for ($i = 0; $i < $length; $i++) {
        $randVar .= $char[rand(0, $charLength - 1)];
    }

    return $randVar . $suffix;
}

/**
 * Autoload classes.
 * 
 * @param string $className
 * 
 * @return void|Exception Returns Exception if class or file not found
 */
function autoload($className)
{
    $className = str_replace('\\', '/', $className);
    $filePath = ROOT . '/' . $className . '.php';

    if (file_exists($filePath)) {
        require_once $filePath;

    } else {
        throw new \Exception("Class $className not found in $filePath");
    }
}

spl_autoload_register('autoload');
