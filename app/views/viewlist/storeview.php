<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

if ($params['products'] > 0) :
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
    <!-- 
    <h2 class="text">Recommended</h2>
    <div class="grid-container"> 
    -->
HTML;

// $sample = 4;
// while ($sample > 0) :
//     $body .= <<<HTML
//         <div class="sample-item col-12">
//             <div class="card item-card">
//                 <img src="$root/app/assets/sample/product.png" class="card-img-top" alt="...">
//                 <div class="card-body">
//                     <h5 class="card-title">Telephone Lamp</h5>
//                     <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>                    
//                     <span class="price-tag">RM 32</span>
//                     <div class="rating">
//                         <span><i class="fas fa-star"></i></span>
//                         <span><i class="fas fa-star"></i></span> 
//                         <span><i class="fas fa-star"></i></span>
//                         <span><i class="fas fa-star"></i></span> 
//                         <span><i class="fas fa-star-half-alt"></i></span>
//                         <span>(10)</span>
//                         <span><a href="#" class="order-now"><i class="fas fa-shopping-cart"></i></a></span>
//                     </div>
//                 </div>
//             </div>
//         </div>
//     HTML;
//     $sample--;
// endwhile;

if (isset($products)) :
    $body .= <<<HTML
        <!-- 
        </div> 
        -->
        <h2 class="text">All Products</h2>
        <div class="grid-container">
    HTML;

    $prodCount = count($products);
    $count = 0;
    while ($prodCount > $count) :

        $prodName = $products[$count]['name'];
        $prodDesc = $products[$count]['description'];
        $prodPrice = $products[$count]['price'];

        $body .= <<<HTML
            <div class="sample-item col-12">
                <div class="card item-card">
                    <img src="$root/app/assets/sample/product.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">$prodName</h5>
                        <p class="card-text">$prodDesc</p>
                        <span class="price-tag">RM $prodPrice</span>
                        <div class="rating">
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span> 
                            <span><i class="fas fa-star"></i></span>
                            <span><i class="fas fa-star"></i></span> 
                            <span><i class="fas fa-star-half-alt"></i></span>
                            <span>(10)</span>
                            <span><a href="#" class="order-now"><i class="fas fa-shopping-cart"></i></a></span>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
        $count++;
    endwhile;

    $body .= <<<HTML
        </div>
        <!-- <div class="text-center">
            <button type="button" class="btn2 btn-outline-success">Load More Products</button>
        </div> -->
    HTML;
else :
    $body .= <<<HTML
        <div class="text-center no-prod-text">
            <p>No products available at the moment.</p>
        </div>
    HTML;
endif;
