<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

/**
 * Database configuration.
 * 
 * @var array $dbConfig
 */
$dbConfig = [
    'host' => 'localhost:3307',
    'username' => 'root',
    'password' => '',
    'database' => 'renew'
];
