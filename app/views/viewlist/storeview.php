<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

/**
 * Check if products are available
 */
if (count($params['products']) > 0) :
    $products = $params['products'];
endif;

$body = <<<HTML
	<div class="container search-box-bar">
        <div class="row">
            <div class="col-md-6 mt-4">
                <form class="form-inline my-2">
                    <div class="input-group w-75 mt-4 search-bar">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-light border-0"><i class="fas fa-search"></i></span>
                        </div>
                        <input class="form-control border-0 bg-light" type="search" placeholder="What products are you looking for?" aria-label="Search" name="search">
                    </div>
                </form>
            </div>
            <!-- 
            <div class="col-md-6 text-right mt-5">
                <button type="button" class="btn btn-outline-success my-2 my-sm-0">
                    <i class="fas fa-filter"></i>
                </button>
            </div> 
            -->
        </div>
    </div>
HTML;

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
HTML;

if (isset($products)) :
    $body .= <<<HTML
        <div class="grid-container product-grid">
    HTML;

    $count = 0;
    while (count($products) > $count) :

        $prodName = $products[$count]['prod_name'];
        $prodImgPath = $products[$count]['img_path'];
        $prodDesc = $products[$count]['description'];
        $prodPrice = $products[$count]['price'];
        $dirName = 'dirName=' . $products[$count]['dir_name'];

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
        <div class="text-center no-prod-text">
            <p>No products available at the moment.</p>
        </div>
    HTML;
endif;
