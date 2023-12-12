<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

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
                <a href="$root/store" class="btn1"><i class="fas fa-chevron-left"></i>&nbsp&nbspBack</a>
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
    <!-- <h2 class="text">You may also like</h2>
    <div class="grid-container"> -->
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
//                     <div class="ratings">
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

// $body .= <<<HTML
//     </div>
// HTML;
