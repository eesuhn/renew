<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="col-10">
        <div class="content">
            <span><h2>My Points</h2><button class="profile">View profile</button></span>
            <h2 class="point-title">Reward Points</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="box1">
                        <h2 class="bold-text">320</h2>
                        <p class="label-text">Points collected</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box2">
                        <h2 class="bold-text">RM 32</h2>
                        <p class="label-text">Worth discount</p>
                    </div>
                </div>
            </div>
        
            <h2 class="history-title">Point History</h2>
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <table id="point-history" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>RECYCLED</th>
                                    <th>DATE & TIME</th>
                                    <th>POINTS WORTH</th>
                                    <th>DROP-OFF STATUS</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;
