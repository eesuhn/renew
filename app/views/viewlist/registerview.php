<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 p-0">
                <img src="$root/app/assets/images/register.jpg" class="img-fluid" alt="Registration Image">
            </div>

            <div class="col-md-6 row d-flex align-items-center">
                <div class="mx-auto col-sm-12 col-lg-6">
                    <h2 class="text-center text-md-left mb-4 font-weight-bold">Create your account now</h2>
                    <p class="title-small">Earn rewards while saving the planet.</p>

                    <!-- Registration Form -->
                    <form action="" method="post" class="mt-2">
                        <label for="name">How should we address you?</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" class="form-control mb-3" required>

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Type your e-mail" class="form-control mb-3" required>

                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Type your password" class="form-control mb-3" required>
                        <small class="text-muted">Must be 8 characters at least</small>
                        <br>

                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" id="agreeTerms" required>
                            <label class="form-check-label text-justify" for="agreeTerms">
                                By creating an account means you agree to the Terms and Conditions and our Privacy Policy
                            </label>
                        </div>

                        <button type="submit" class="btn btn-success mt-3" style="border-radius: 90px;">Sign Up</button>
                        <p class="mt-3 text-center">Already have an account? <a href="#" class="log-link">Log in here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
