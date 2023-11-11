<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="center-box">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="text-center">
                        <img src="$root/app/assets/public/light-icon.png" class="logo" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card text-center warning-box">
                        <div class="card-body">
                            <p>Please create the database named<br><strong>renew</strong> and try again.</p>
                            <button class="submit" onclick="location.reload()">Try Again</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;
