<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$nav['top'] = <<<HTML
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="$root/edit-profile"><i class="fas fa-user"></i>Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="$root/points"><i class="fas fa-bell"></i>Points</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="$root/orders"><i class="fas fa-shopping-cart"></i>Orders</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="$root/user-recycle"><i class="fas fa-recycle"></i>Recycles</a>
                        </li>
                        <div class="logout">
                            <li class="nav-item">
                                <a class="nav-link logout" href="$root/logout"><i class="fas fa-sign-out-alt"></i>Log out&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
HTML;

$nav['bottom'] = <<<HTML
        </div>
    </div>
HTML;
