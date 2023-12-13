<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

/**
 * Number of recommended products to display.
 * 
 * @var int $numRecProds
 */
$numRecProds = 4;

if (count($params['products']) == $numRecProds) :
    $products = $params['products'];
endif;

$body = <<<HTML
    <div class="hero-image">
        <img src="$root/app/assets/public/hero.png" alt="Hero Image" class="hero-img">
        <div class="overlay"></div>
        <div class="carousel-caption1">
            <h3>Reaching for global sustainability</h3>
            <p>ReNew, is a pioneering eco-conscious company on a mission to redefine sustainability and foster community engagement in recycling.</p>
            <a href="$root/store"><button class="btn4 btn-primary">Go to Store</button></a>
        </div>
    </div>
HTML;

if (isset($products)) :
    $body .= <<<HTML
        <div class="center-text rec-prod-title-box">
            <p class="rec-prod-title-text">Most Popular</p>
            <h2 class="hero-title">Our Exclusive Upcycled Products</h2>
        </div>
        <div class="grid-container product-grid">
    HTML;

    $count = 0;
    while (count($products) > $count) :

        $prodName = $products[$count]['prod_name'];
        $prodImgPath = $products[$count]['img_path'];
        $prodDesc = $products[$count]['description'];
        $prodPrice = $products[$count]['price'];
        $dirName = 'product-name=' . $products[$count]['dir_name'];

        $body .= <<<HTML
            <div class="sample-item col-12">
                <div class="card item-card">
                    <img src="$root/$prodImgPath" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title prod-name">$prodName</h5>
                        <p class="card-text prod-desc">$prodDesc</p>
                        <span class="price-tag">RM $prodPrice</span>
                        <a href="$root/product-focus?$dirName" class="order-now"><i class="fas fa-shopping-cart"></i>View More</a>
                    </div>
                </div>
            </div>
        HTML;
        $count++;
    endwhile;

    $body .= <<<HTML
        </div>
    HTML;
else :
    $body .= <<<HTML
        <div class="center-text rec-prod-title-box">
            <h2 class="hero-title">Stay tune for more!</h2>
            <p class="rec-prod-title-text">Our Exclusive Upcycled Products</p>
        </div>
    HTML;
endif;

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
                <a href="$root/recycle-form">
                    <button class="btn3 btn-primary"><i class="fas fa-star"></i>&nbspRECYCLE NOW</button>
                </a>
                <p>Our mission is to create a sustainable marketplace that promotes the circular economy, reduces waste, and showcases the potential of repurposed materials.</p>
            </div>        
        </div>
    </div>
HTML;
