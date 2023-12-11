<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="px-4 px-lg-0">
        <div class="container py-4">
            <div class="row">
                <div class="col-lg-12">
                    <a href="" class="btn1"><i class="fa fa-arrow-left"></i>&nbspBack to Home</a>
                </div>
            </div>
            <h1 class="display-4 py-4">Cart&nbsp<span class="badge badge-secondary">3</span></h1>
        </div>
    </div>

    <div class="pb-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 bg-light"><div class="p-2 px-3 text-uppercase">Product</div></th>
                                    <th scope="col" class="border-0 bg-light"><div class="py-2 text-uppercase">Price</div></th>
                                    <th scope="col" class="border-0 bg-light"><div class="py-2 text-uppercase">Quantity</div></th>
                                    <th scope="col" class="border-0 bg-light"><div class="py-2 text-uppercase text-center">Remove Item</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" class="border-0"><div class="p-2"><img src="$root/app/assets/sample/product.png" alt="" width="70" class="img-fluid rounded shadow-sm">
                                            <div class="ml-3 d-inline-block align-middle">
                                                <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle">Upcycled Glass Vases</a></h5><span class="text-muted font-weight-normal font-italic d-block">Desc</span>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="border-0 align-middle"><strong>RM 79.00</strong></td>
                                    <td class="align-middle">
                                        <div class="input-group mb-3" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary js-btn-minus" type="button"><i class="fas fa-minus"></i></button>
                                        </div>
                                        <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary js-btn-plus" type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div class="p-2">
                                        <img src="$root/app/assets/sample/product.png" alt="" width="70" class="img-fluid rounded shadow-sm">
                                        <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0"><a href="#" class="text-dark d-inline-block">Upcycled Glass Vases</a></h5><span class="text-muted font-weight-normal font-italic">Desc</span>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle"><strong>RM 79.00</strong></td>
                                <td class="align-middle">
                                    <div class="input-group mb-3" style="max-width: 120px;">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary js-btn-minus" type="button"><i class="fas fa-minus"></i></button>
                                    </div>
                                    <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary js-btn-plus" type="button"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                            </td>
                                <td class="text-center align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            <tr>
                                <th scope="row">
                                    <div class="p-2">
                                        <img src="$root/app/assets/sample/product.png" alt="" width="70" class="img-fluid rounded shadow-sm">
                                        <div class="ml-3 d-inline-block align-middle">
                                            <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block">Upcycled Glass Vases</a></h5><span class="text-muted font-weight-normal font-italic">Desc</span>
                                        </div>
                                    </div>
                                    <td class="align-middle"><strong>RM 79.00</strong></td>
                                    <td class="align-middle">
                                        <div class="input-group mb-3" style="max-width: 120px;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary js-btn-minus" type="button"><i class="fas fa-minus"></i></button>
                                        </div>
                                        <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary js-btn-plus" type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle"><a href="#" class="text-dark"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="section-up">
        <div class="row py-5 p-4 bg-white rounded shadow-sm">
            <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Points Worth :
                    <span class="badge badge-pill badge-success">RM 32</span>
                </div>
                <div class="p-4">
                    <p class="font-italic mb-4">Use your points to get a discount!</p>
                    <div class="input-group mb-4 border rounded-pill p-2">
                        <input type="text" placeholder="Enter amount (RM) to redeem" aria-describedby="button-addon3" class="form-control border-0">
                        <div class="input-group-append border-0">
                            <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Redeem</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary</div>
                <div class="p-4">
                    <ul class="list-unstyled mb-4">
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>RM 390.00</strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Discount</strong><strong>- RM 0.00</strong></li>
                        <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
                            <h5 class="font-weight-bold">RM 400.00</h5>
                        </li>
                    </ul><a href="#" class="btn btn-dark rounded-pill py-2 btn-block">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
HTML;
