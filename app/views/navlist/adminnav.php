<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$nav['top'] = <<<HTML
    <nav class="navbar navbar-light justify-content-between">
        <a class="navbar-brand" href="# ">
            <img src="$root/app/assets/public/light-icon.png" class="d-inline-block align-top" alt="logo">
        </a>
        <form class="form-inline form-view">
            <button class="btn btn-outline-success my-2 my-sm-0 btn-view" type="submit"><i class="fas fa-star"></i>&nbsp&nbsp&nbspVIEW AS PUBLIC</button>
            <div class="user-icon">
                <i class="fas fa-user"></i>
            </div>
        </form>
    </nav>

    <div class="sidebar">
        <a class="active" href=""><i class="fas fa-chart-pie"></i>Dashboard</a>
        <a href=""><i class="fas fa-users"></i>Users</a>
        <a href=""><i class="fas fa-puzzle-piece"></i>Artists</a>
        <a href=""><i class="fas fa-tree"></i>Recycling Log</a>
        <hr>
        <a href=""><i class="fas fa-edit"></i>Profile</a>
        <a href="" class="logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>

    <div class="content">
HTML;

$nav['bottom'] = <<<HTML
    </div>
HTML;
