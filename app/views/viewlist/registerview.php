<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <p>Register View</p>
    <!-- Only div -->
HTML;
