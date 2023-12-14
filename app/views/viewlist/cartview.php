<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$totalCurrency = $params['totalCurrency'];

if (count($params['cart']) > 0) :
    $cart = $params['cart'];
endif;

$body = <<<HTML
    <div class="px-4 px-lg-0">
        <div class="container py-4 cart-title-box">
            <div class="row">
                <div class="col-lg-12">
                    <a href="" class="btn1"><i class="fa fa-arrow-left"></i>&nbsp&nbsp&nbspBack to Home</a>
                </div>
            </div>
            <h1 class="display-4 py-2 cart-title">Cart&nbsp<span class="badge badge-secondary">3</span></h1>
        </div>
    </div>

    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 bg-white rounded shadow-sm cart-table-box">
                    <div class="table-responsive">
                        
HTML;

if (isset($cart)) :

    $body .= <<<HTML
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="p-2 px-3 text-uppercase">Product</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Price</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase">Quantity</div>
                                    </th>
                                    <th scope="col" class="border-0 bg-light">
                                        <div class="py-2 text-uppercase text-center">Remove Item</div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
    HTML;

    $count = 0;
    while (count($cart) > $count) :
        
        $buyerId = $cart[$count]['buyer_id'];
        $prodId = $cart[$count]['prod_id'];
        $prodName = $cart[$count]['prod_name'];
        $prodDesc = $cart[$count]['description'];
        $prodImgPath = $cart[$count]['img_path'];
        $prodPrice = $cart[$count]['price'];
        $cartProdQty = $cart[$count]['quantity'];

        $body .= <<<HTML
                                <tr>
                                    <th scope="row" class="border-0">
                                        <div class="p-2">
                                            <img src="$root/$prodImgPath" alt="" width="70" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"><a href="#" class="text-dark d-inline-block align-middle">$prodName</a></h5>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>RM $prodPrice</strong></td>
                                    <td class="align-middle border-0">
                                        <div class="input-group mb-3 qty-input">
                                            <!-- <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary js-btn-minus" type="button"><i class="fas fa-minus"></i></button>
                                            </div> -->
                                            <input type="text" class="form-control text-center cart-prod-qty" value="$cartProdQty" readonly>
                                            <!-- <div class="input-group-append">
                                                <button class="btn btn-outline-secondary js-btn-plus" type="button"><i class="fas fa-plus"></i></button>
                                            </div> -->
                                        </div>
                                    </td>
                                    <td class="text-center align-middle border-0">
                                        <a href="#" class="text-dark"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
        HTML;

        $count++;
    endwhile;

    $body .= <<<HTML
                            </tbody>
                        </table>
    HTML;

else :
        $body .= <<<HTML
                        <div class="text-center empty-cart">
                            <h3 class="text-center">Your cart is empty!</h3>
                            <a href="$root/store" class="btn btn-dark">Go to Store</a>
                        </div>
        HTML;
endif;

$body .= <<<HTML
                    </div>
                </div>
            </div>
    
            <div class="section-up">
                <div class="row py-5 p-4 bg-white rounded shadow-sm">
                    <div class="col-lg-6">
                        <div class="bg-light rounded-pill px-4 py-1 text-uppercase font-weight-bold points-worth">
                            <div class="points-worth">
                                <p class="points-worth-text">Points Worth :</p>
                                <span class="badge badge-pill badge-price">RM $totalCurrency</span>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="input-group mb-4 border rounded-pill p-2">
                                <input type="text" placeholder="Enter amount (RM) to redeem" class="form-control border-0" id="redeem-point" value="">
                                <div class="input-group-append border-0">
                                    <button id="redeem-point-btn" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Redeem</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary</div>
                        <form class="p-4" method="POST" id="checkout-form">
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex justify-content-between py-3 border-bottom">
                                    <strong class="text-muted">Order Subtotal</strong><strong id="sub-total" value=""><!-- Set with JS --></strong>
                                    <input type="hidden" id="sub-total-hidden" value="">
                                </li>
                                <li class="d-flex justify-content-between py-3 border-bottom">
                                    <strong class="text-muted">Discount</strong><strong id="discount-total" value=""><!-- Set with JS --></strong>
                                    <input type="hidden" id="discount-total-hidden" name="discount-total-hidden" value="">
                                </li>
                                <li class="d-flex justify-content-between py-3 border-bottom">
                                    <strong class="text-muted">Total</strong>
                                    <h5 class="font-weight-bold" id="total-rm"><!-- Set with JS --></h5>
                                    <input type="hidden" id="total-rm-hidden" value="">
                                 </li>
                            </ul>
                            <a id="cart-checkout-btn" class="btn btn-dark rounded-pill py-2 btn-block">Proceed to checkout</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;
