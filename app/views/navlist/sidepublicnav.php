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
                            <a class="nav-link" href="$root/edit-profile"><i class="fas fa-user"></i>Profile and Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="$root/points"><i class="fas fa-bell"></i>My Points</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href=""><i class="fas fa-puzzle-piece"></i>BECOME AN ARTIST</a>
                        </li>
                        <div class="logout">
                            <li class="nav-item">
                                <a class="nav-link logout" href="#"><i class="fas fa-sign-out-alt"></i>Log out</a>
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
