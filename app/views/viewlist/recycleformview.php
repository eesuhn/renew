<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$recCenters = $params['recCenters'];
$curDate = $params['curDate'];
$curTime = $params['curTime'];

$body = <<<HTML
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="#" class="btn1"><i class="fas fa-chevron-left"></i>&nbsp&nbspBack</a>
            </div>
        </div>
    </div>

    <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11">
                <h3 class="form-title">Recycle Form</h3>
                <div class="card">
                    <h5 class="mb-4">Item details</h5>
                    <form class="form-card" id="recycle-form">
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label">Item Name</label>
                                <input type="text" id="rec-name" name="rec-name" placeholder="Enter item name">
                                <span id="recNameError" class="errorText"></span>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label">Estimated Weight (Kg)</label>
                                <input type="text" id="rec-weight" name="rec-weight" placeholder="Enter weight in KG(s)">
                                <span id="recWeightError" class="errorText"></span>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-12 col-6">
                                <div class="form-group">
                                    <label class="form-control-label">Recycle Centre</label>
                                    <select class="form-control" id="rec-centre" name="rec-centre">
HTML;

$count = 0;
while (count($recCenters) > $count) :
    $recCenter = $recCenters[$count];
    $recCenterId = $recCenter['center_id'];
    $recCenterName = $recCenter['center_name'];

    $body .= <<<HTML
                                        <option value="$recCenterId">$recCenterName</option>
    HTML;

    $count++;
endwhile;

$body .= <<<HTML
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-between text-left">
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label">Date</label>
                                <input type="date" id="rec-date" name="rec-date" value="$curDate">
                                <span id="recDateTimeError" class="errorText"></span>
                            </div>
                            <div class="form-group col-sm-6 flex-column d-flex">
                                <label class="form-control-label">Time</label>
                                <input type="time" id="rec-time" name="rec-time" value="$curTime">
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-12 col-6">
                                <label class="form-control-label">Upload Image</label> 
                                <div class="upload-container">
                                    <input type="file" name="rec-img" class="upload-img" id="rec-img">
                                    <label for="rec-img" class="custom-file-upload">Choose File</label>
                                    <div class="file-name" id="rec-img-name">No file chosen</div>
                                </div>
                                <span id="recImgError" class="errorText"></span>
                            </div>
                        </div>
                        <div class="row justify-content-between">
                            <div class="form-group col-sm-8">
                                <p class="disclaimer-text">By clicking, you agree to our <strong>T&C</strong> and <strong>Personal Data Protection Policy</strong></p>
                            </div>
                            <div class="form-group col-sm-4">
                                <button type="submit" class="btn-block btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
HTML;
