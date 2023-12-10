<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <form id="add-prod-form" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="price">price</label>
            <input type="number" id="price" name="price" step="0.01">
        </div>

        <div class="form-group">
            <label for="quantity">quantity</label>
            <input type="number" id="quantity" name="quantity" step="1">
        </div>

        <div class="form-group">
            <label for="description">description</label>
            <input type="text" id="description" name="description">
        </div>

        <div class="form-group">
            <label for="image">image</label>
            <input type="file" id="image" name="image">
        </div>

        <button type="submit">submit</button>
    </form>
HTML;
