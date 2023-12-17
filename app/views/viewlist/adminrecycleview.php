<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <table id="admin-recycle" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>USER</th>
                <th>ITEM</th>
                <th>DATE</th>
                <th>POINTS</th>
                <th>RECYCLING CENTER</th>
                <th>DROP OFF STATUS</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
HTML;
