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
                        <img src="$root/app/assets/public/light-logo.png" class="logo" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card text-center warning-box">
                        <div class="card-body">
                            <p class="invalid-text-1"><strong>Error 404</strong>: Page Not Found</p>
                            <p class="invalid-text-2">The page you are looking for does not exist.</p>
                            <button onclick="window.location.href = '/renew/'" class="submit">Back to Home</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;
