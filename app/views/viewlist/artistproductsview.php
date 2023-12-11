<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <table id="artist-products" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>PRODUCT NAME</th>
                <th>DESCRIPTION</th>
                <th>PRICE (RM)</th>
                <th>STOCK</th>
                <th></th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
HTML;
