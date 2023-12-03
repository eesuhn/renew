<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="$root/app/assets/public/light-icon.png" alt="" class="navbar-logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="vl"></div>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Store</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Artists</a></li>
                <li class="nav-item"><a class="nav-link" href="#">My Orders</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Recycle</a></li>
            </ul>
            <div class="my-2 my-lg-0">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-star"></i>&nbspRECYCLE NOW</button>
                <a href=""><i class="nav-right-icon cart fas fa-shopping-cart"></i></a>
                <a href=""><i class="nav-right-icon user fas fa-user"></i></a>
            </div>
        </div>
    </nav>
    <div class="hero-image">
        <img src="$root/app/assets/public/hero.png" alt="Hero Image" style="width:100%; height: auto;">
        <div class="carousel-caption1">
            <h3>Reaching for global sustainability</h3>
            <p>ReNew, is a pioneering eco-conscious company on a mission to redefine sustainability and foster community engagement in recycling.</p>
            <button class="btn4 btn-primary">Go to Store</button>
        </div>
    </div>
    <div class="center-text">
        <p>Most Popular</p>
        <h2 style="font-weight: bold;">Our Exclusive Upcycled Products</h2>
    </div>
HTML;

$body .= '<div class="grid-container">';

$sample = 3;

while ($sample > 0) :
    $body .= <<<HTML
        <div class="sample-item col-12">
            <div class="card" style="width: 70%;">
            <img src="$root/app/assets/public/sample.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Upcycled Glass Vases</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="btn1 btn-primary">Order Now</a>
                <span class="price-tag">RM 25</span>
            </div>
        </div>
        </div>
HTML;

    $sample--;
endwhile;

$body .= '</div>';

$body .= <<<HTML

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">  
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="$root/app/assets/public/carousel1.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5>Get reward points by recycling!</h5>
                <p>A sustainable marketplace that promotes the circular economy, reduces waste, and showcases the potential of repurposed materials.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="$root/app/assets/public/carousel2.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5>Get reward points by recycling!</h5>
                <p>A sustainable marketplace that promotes the circular economy, reduces waste, and showcases the potential of repurposed materials.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="$root/app/assets/public/carousel3.jpg" class="d-block w-100" alt="...">
            <div class="carousel-caption">
                <h5>Get reward points by recycling!</h5>
                <p>A sustainable marketplace that promotes the circular economy, reduces waste, and showcases the potential of repurposed materials.</p>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="center-text3">
                <h1 class="">Recycle now to save the planet!</h1>
            </div>
        </div>
        <div class="col">
            <div class="center-text2">
                <button class="btn3 btn-primary"><i class="fas fa-star"></i>&nbspRECYCLE NOW</button>
                <p>Our mission is to create a sustainable marketplace that promotes the circular economy, reduces waste, and showcases the potential of repurposed materials.</p>
            </div>        
        </div>
    </div>
HTML;


