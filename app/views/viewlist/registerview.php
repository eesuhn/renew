<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-0">
                <img src="$root/app/assets/public/register.jpg" class="img-fluid" alt="Registration Image">
            </div>

            <div class="col-md-6 row d-flex align-items-center">
                <div class="mx-auto col-sm-12 col-lg-6">
                    <img src="$root/app/assets/public/light-icon.png" class="logo" alt="Logo">
                    <h2 class="text-center text-md-left mb-4 font-weight-bold reg-title">Create your account today</h2>
                    <p class="title-small">Earn rewards while saving the planet.</p>

                    <!-- Registration Form -->
                    <form id="user-register" method="post" class="mt-2">

                        <div class="reg-input">
                            <label for="name" class="reg-label">How should we address you?</label>
                            <input type="text" id="name" name="name" placeholder="Enter your name" class="form-control mb-3">
                            <span id="nameError" class="errorText"></span>
                        </div>

                        <div class="reg-input">
                            <label for="email" class="reg-label">Email</label>
                            <input type="email" id="email" name="email" placeholder="Type your e-mail" class="form-control mb-3">
                            <span id="emailError" class="errorText"></span>
                        </div>

                        <div class="reg-input">
                            <label for="password" class="reg-label">Password</label>
                            <input type="password" id="password" name="password" placeholder="Type your password" class="form-control mb-3">
                            <p class="text-muted pwd-text">*At least 8 characters, 1 alphabet, 1 number and 1 special character</p>
                            <span id="passwordError" class="errorText"></span>
                        </div>

                        <button type="submit" class="btn btn-success mt-3" style="border-radius: 90px;">Sign Up</button>
                        <p class="mt-3 text-center">Already have an account? <a href="$root/login" class="log-link">Log in here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
