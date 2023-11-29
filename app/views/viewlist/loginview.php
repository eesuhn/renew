<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-0">
                <img src="$root/app/assets/public/login.jpg" class="img-fluid" alt="Login Image">
            </div>

            <div class="col-md-6 row d-flex align-items-center">
                <div class="mx-auto col-sm-12 col-lg-6">
                    <img src="$root/app/assets/public/light-icon.png" class="logo" alt="Logo">
                    <h2 class="text-center text-md-left mb-4 font-weight-bold">Welcome back</h2>
                    <p class="title-small">Get recycling today.</p>

                    <!-- Log In Form -->
                    <form action="" method="post" class="mt-2">
                        <label for="email" class="login-label">Email</label>
                        <input type="email" id="email" name="email" placeholder="Type your e-mail" class="form-control mb-3" required>

                        <label for="password" class="login-label">Password</label>
                        <input type="password" id="password" name="password" placeholder="Type your password" class="form-control mb-3" required>

                        <button type="submit" class="btn btn-success mt-3" style="border-radius: 90px;">Log In</button>
                        <p class="mt-3 text-center">Don't have an account? <a href="#" class="log-link">Sign up here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
