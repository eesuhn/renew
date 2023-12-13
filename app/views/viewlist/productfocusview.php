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
    $recProds = $params['products'];
endif;

if (is_array($params['product'])) :
    $product = $params['product'];

    $prodName = $product['prod_name'];
    $prodImgPath = $product['img_path'];
    $prodPrice = $product['price'];
    $prodDesc = $product['description'];
endif;

$body = <<<HTML
    <div class="container product-back">
        <div class="row">
            <div class="col-md-12">
                <a id="goBackBtn" class="btn1"><i class="fas fa-chevron-left"></i>&nbsp&nbspBack</a>
            </div>
        </div>
    </div>

    <div class="container product" id="product-section">
        <div class="row">
            <div class="col-md-6 image">
                <img src="$root/$prodImgPath" alt="sample" class="focus-image"/>
            </div>
            <div class="col-md-6 product-section">
                <div class="row product-title-box">
                    <div class="col-md-12">
                        <h1 class="product-title">$prodName</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <span>
                            <h2 class="product-price">RM $prodPrice</h2>
                        </span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="product-desc">$prodDesc</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
                                    <span class=""><i class="fas fa-minus"></i></span>
                                </button>
                            </span>
                            <input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
                                    <span class=""><i class="fas fa-plus"></i></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 top-10">
                        <button class="add-to-cart"><i class="fas fa-shopping-cart"></i>&nbsp&nbspAdd to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;

if (isset($recProds)) :
    $body .= <<<HTML
        <h2 class="text rec-prod-text">You may also like</h2>
        <div class="grid-container product-grid">
    HTML;

    $count = 0;
    while (count($recProds) > $count) :

        $prodName = $recProds[$count]['prod_name'];
        $prodImgPath = $recProds[$count]['img_path'];
        $prodDesc = $recProds[$count]['description'];
        $prodPrice = $recProds[$count]['price'];
        $dirName = 'product-name=' . $recProds[$count]['dir_name'];

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
endif;
