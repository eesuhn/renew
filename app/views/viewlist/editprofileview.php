<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="container-fluid">
        <div class="row">
            <div class="col-2">
                <div class="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-user"></i>Profile and Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-bell"></i>My Points</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="fas fa-puzzle-piece"></i>BECOME AN ARTIST</a>
                        </li>
                        <div class="logout">
                            <li class="nav-item">
                                <a class="nav-link logout" href="#"><i class="fas fa-sign-out-alt"></i>Log out</a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>

            <div class="col-10">
                <div class="content">
                    <span><h2>Edit Account</h2><button class="profile">View profile</button></span>

                    <form class="form-horizontal">
                        <h5 class="edit-profile-title">Account Info</h5>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="display-name">DISPLAY NAME</label>
                                <input type="text" class="form-control" id="display-name" placeholder="Display Name">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="real-name">REAL NAME</label>
                                <input type="text" class="form-control" id="real-name" placeholder="Real Name">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="phone-no">PHONE</label>
                                <input type="text" class="form-control" id="phone-no" placeholder="Phone Number">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="email">EMAIL</label>
                                <input type="email" class="form-control" id="email" placeholder="Email" disabled>
                            </div>
                        </div>

                        <div class="form-group address-row">
                            <label for="address">YOUR ADDRESS</label>
                            <input type="text" class="form-control" id="address" placeholder="Address">
                        </div>

                        <h5 class="edit-profile-title">Login Info</h5>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="cur-pwd">CURRENT PASSWORD</label>
                                <input type="password" class="form-control" id="cur-pwd" placeholder="Enter Password">
                            </div>
                        </div>

                        <div class="form-row new-conf-pwd-row">
                            <div class="form-group col-md-6">
                                <label for="new-pwd">NEW PASSWORD</label>
                                <input type="password" class="form-control" id="new-pwd" placeholder="Enter New Password">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="confirm-pwd">CONFIRM PASSWORD</label>
                                <input type="password" class="form-control" id="confirm-pwd" placeholder="Confirm New Password">
                            </div>
                        </div>

                        <hr>
                        <div class="button-group">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <button type="cancel" class="btn cancel-btn"><i class="far fa-times-circle"></i>Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
