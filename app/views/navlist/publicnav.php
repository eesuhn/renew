<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

use App\Models\UserModel;

$curRole = UserModel::getCurUserRole();

if ($curRole == 'guest' || $curRole == 'public') :
    $navBtnUrl = 'recycle-form';
    $navCartUrl = 'cart';
    $navProfileUrl = 'edit-profile';

    $navBtn = 'RECYCLE NOW';

elseif ($curRole == 'artist') :
    $navBtnUrl = 'artist-products';
    $navProfileUrl = $navCartUrl = $navBtnUrl;

    $navBtn = "ARTIST VIEW";

elseif ($curRole == 'admin') :
    $navBtnUrl = 'admin-recycle';
    $navProfileUrl = $navCartUrl = $navBtnUrl;

    $navBtn = 'ADMIN VIEW';
endif;

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
            </ul>
            <div class="my-2 my-lg-0">
                <a href="$root/$navBtnUrl" class="btn btn-outline-success my-2 my-sm-0 nav-btn" type="submit"><i class="fas fa-star"></i>&nbsp $navBtn</a>
                <a href="$root/$navCartUrl"><i class="nav-right-icon cart fas fa-shopping-cart"></i></a>
                <a href="$root/$navProfileUrl"><i class="nav-right-icon user fas fa-user"></i></a>
            </div>
        </div>
    </nav>
HTML;

$nav['bottom'] = <<<HTML
HTML;
