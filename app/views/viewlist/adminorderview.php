<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <table id="admin-order" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>USER</th>
                <th>ORDER DATE</th>
                <th>TOTAL (RM)</th>
                <th>POINTS USED</th>
                <th>DROP OFF STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
HTML;
