<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

/**
 * Dump and die.
 * Default is var_dump.
 * 
 * @param mixed $var
 * @param bool $varDump (Optional) print_r if false
 * 
 * @return void
 */
function dd($var, $varDump = true)
{
    echo <<<HTML
        <style>
            pre {
                background-color: #000;
                color: #fff;
                padding: 6px;
                border-radius: 4px;
            }
        </style>
        <pre>
    HTML;

    if ($varDump) {
        var_dump($var);
    } else {
        print_r($var);
    }

    echo '</pre>';
    die();
}
