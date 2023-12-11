<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="hero-image">
        <img src="$root/app/assets/public/hero.png" alt="Hero Image" class="hero-img">
        <div class="overlay"></div>
        <div class="carousel-caption1">
            <h3>Reaching for global sustainability</h3>
            <p>ReNew, is a pioneering eco-conscious company on a mission to redefine sustainability and foster community engagement in recycling.</p>
            <button class="btn4 btn-primary">Go to Store</button>
        </div>
    </div>
    <div class="center-text">
        <p>Most Popular</p>
        <h2 class="hero-title">Our Exclusive Upcycled Products</h2>
    </div>
    <div class="grid-container">
HTML;

// SAMPLE: Popular products
$sample = 3;
while ($sample > 0) :
    $body .= <<<HTML
        <div class="sample-item col-12">
            <div class="card item-card">
                <img src="$root/app/assets/sample/product.png" class="card-img-top" alt="...">
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

$body .= <<<HTML
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">  
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="$root/app/assets/public/carousel1.jpg" class="d-block w-100" alt="...">
                <div class="overlay"></div>
                <div class="carousel-caption">
                    <h5>Get reward points by recycling!</h5>
                    <p>A sustainable marketplace that promotes the circular economy, reduces waste, and showcases the potential of repurposed materials.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="$root/app/assets/public/carousel2.jpg" class="d-block w-100" alt="...">
                <div class="overlay"></div>
                <div class="carousel-caption">
                    <h5>Get reward points by recycling!</h5>
                    <p>A sustainable marketplace that promotes the circular economy, reduces waste, and showcases the potential of repurposed materials.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="$root/app/assets/public/carousel3.jpg" class="d-block w-100" alt="...">
                <div class="overlay"></div>
                <div class="carousel-caption">
                    <h5>Get reward points by recycling!</h5>
                    <p>A sustainable marketplace that promotes the circular economy, reduces waste, and showcases the potential of repurposed materials.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row rec-btn-row">
        <div class="col">
            <div class="center-text3">
                <h1 class="rec-title">Recycle now to</h1>
                <h1 class="rec-title">save the planet!</h1>
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
