<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <div class="col-10">
        <div class="content">
            <span class="text-mt"><h2>Edit Account</h2><button class="profile">View profile</button></span>

            <form class="form-horizontal">
                <h5 class="edit-profile-title">Account Info</h5>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="display-name">DISPLAY NAME</label>
                        <input type="text" class="form-control" id="display-name" placeholder="Display Name">
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="real-name">REAL NAME</label>
                        <input type="text" class="form-control" id="real-name" placeholder="Real Name">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="dob">DOB</label>
                        <input type="date" class="form-control" id="dob" placeholder="Date of Birth">
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

                <h5 class="edit-profile-title">Displayed Info</h5>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="desc">DESCRIPTION</label>
                        <textarea class="form-control description" id="desc" name="desc" placeholder="Add description to be displayed"></textarea>
                    </div>
                </div>
                
                <div class="row justify-content-start">
                    <div class="col-12 col-6">
                        <label class="form-control-label">UPLOAD IMAGE</label> 
                        <div class="upload-container">
                            <input type="file" name="file" class="upload-img" id="file-input">
                            <label for="file-input" class="custom-file-upload">Choose File</label>
                            <div class="file-name" id="file-name">No file chosen</div>
                        </div>
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
    
HTML;
