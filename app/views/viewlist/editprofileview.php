<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

if (isset($params['user'])) {
    $user = $params['user'];

    $displayName = $user['user_name'];
    $realName = $user['real_name'];
    $email = $user['email'];

    if ($realName == '') {
        $realName = 'Enter Real Name';
    }
}

$body = <<<HTML
    <div class="col-10">
        <div class="content">
            <span class="edit-user-title"><h2>Edit Account</h2></span>

            <form class="form-horizontal" id="edit-profile-form" method="POST">
                <h5 class="edit-profile-title">Account Info</h5>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="display-name">DISPLAY NAME</label>
                        <input type="text" class="form-control" id="display-name" name="display-name" placeholder="$displayName" value="$displayName">
                        <span id="userNameError" class="errorText"></span>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="real-name">REAL NAME</label>
                        <input type="text" class="form-control" id="real-name" name="real-name" placeholder="$realName" value="">
                        <span id="realNameError" class="errorText"></span>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="email">EMAIL</label>
                        <input type="email" class="form-control" id="email" placeholder="$email" disabled>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </div>
            </form>

            <form class="form-horizontal" method="POST">
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

                <div class="button-group">
                    <button type="submit" class="btn btn-primary btn-pwd">Update Password</button>
                </div>
            </form>
        </div>
    </div>
HTML;
