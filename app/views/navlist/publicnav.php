<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$nav['top'] = <<<HTML
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="$root/">
            <img src="$root/app/assets/public/light-icon.png" alt="" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="vl"></div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="$root/">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="$root/store">Store</a></li>
                <li class="nav-item"><a class="nav-link" href="">Artists</a></li>
                <li class="nav-item"><a class="nav-link" href="$root/orders">My Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="$root/recycle-form">Recycle</a></li>
            </ul>
            <div class="my-2 my-lg-0">
                <button class="btn btn-outline-success my-2 my-sm-0 nav-btn" type="submit"><i class="fas fa-star"></i>&nbspRECYCLE NOW</button>
                <a href="$root/cart"><i class="nav-right-icon cart fas fa-shopping-cart"></i></a>
                <a href="$root/edit-profile"><i class="nav-right-icon user fas fa-user"></i></a>
            </div>
        </div>
    </nav>
HTML;

$nav['bottom'] = <<<HTML
HTML;
