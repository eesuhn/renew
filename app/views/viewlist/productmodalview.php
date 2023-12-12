<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <!-- modal -->
    <div class="container-fluid">
        <div class="row">
            <div class="col text-right mt-2">
                <button type="button" class="btn btn-accent" data-toggle="modal" data-target="#exampleModal" data-whatever="">Add Product</button>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form>
            <div class="form-group">
                <label for="prod-name" class="col-form-label">Name:</label>
                <input type="text" class="form-control" id="prod-name">
            </div>
            <div class="form-group">
                <label for="prod-price" class="col-form-label">Price</label>
                <input type="text" class="form-control" id="prod-price">
            </div>
            <div class="form-group">
                <label for="prod-qty" class="col-form-label">Quantity</label>
                <input type="number" class="form-control" id="prod-qty">
            </div>
            <div class="form-group">
                <label for="prod-desc" class="col-form-label">Description:</label>
                <textarea class="form-control" id="prod-desc"></textarea>
            </div>
            <!-- upload image -->
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">Image</span> 
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                    aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Submit</button>
        </div>
        </div>
    </div>
    </div>


    <form id="add-prod-form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" id="name" name="name">
            <span id="prodNameError" class="errorText"></span>
        </div>

        <div class="form-group">
            <label for="price">price</label>
            <input type="number" id="price" name="price" step="0.01">
            <span id="prodPriceError" class="errorText"></span>
        </div>

        <div class="form-group">
            <label for="quantity">quantity</label>
            <input type="number" id="quantity" name="quantity" step="1">
            <span id="prodQtyError" class="errorText"></span>
        </div>

        <div class="form-group">
            <label for="description">description</label>
            <input type="text" id="description" name="description">
            <span id="prodDescError" class="errorText"></span>
        </div>

        <div class="form-group">
            <label for="image">image</label>
            <input type="file" id="image" name="image" accept="image/*">
            <span id="prodImgError" class="errorText"></span>
        </div>

        <button type="submit">submit</button>
    </form>
HTML;
