<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <table id="admin-user-list" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>USER NAME</th>
                <th>EMAIL</th>
                <th>JOINED DATE</th>
                <th>ROLE</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
HTML;
