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
                            <h2 class="table-title recycle-title">My Recycles</h2>
                            <div class="container mt-5">
                                <div class="row">
                                    <div class="col-12">
                                        <table id="recycle-history" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>NAME</th>
                                                    <th>DATE</th>
                                                    <th>RECYCLING CENTER</th>
                                                    <th>DROP OFF STATUS</th>
                                                    <th></th>
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
