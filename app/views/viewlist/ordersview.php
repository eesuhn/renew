<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="col-10">
        <div class="content">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="content">
                            <h2 class="table-title order-title">My Orders</h2>
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="order-history" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ORDERS</th>
                                                    <th>ORDER DATE</th>
                                                    <th>STATUS</th>
                                                    <th>TOTAL (RM)</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;
