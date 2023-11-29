<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"><img src="$root/app/assets/public/light-icon.png" height="30" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="vl"></div> 
            <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Store</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Artists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">My Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Recycle</a>
            </li>
            </ul>
            <div class="my-2 my-lg-0">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-star"></i> RECYCLE NOW</button>
                <a href=""><i class="cart fas fa-shopping-cart"></i></a>            
                <a href=""><i class="user fas fa-user"></i></a>   
            </div>
        </div>    
        </nav>
HTML;
