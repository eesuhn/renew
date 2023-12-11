<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$pointsData = [
    ['Recycled Type 1', '2023-12-11 10:30:00', '50', 'Completed'],
    ['Recycled Type 2', '2023-12-12 15:45:00', '30', 'In Progress'],
    ['Recycled Type 3', '2023-12-13 08:00:00', '20', 'Cancelled'],
];

// Build DataTables rows dynamically
$tableRows = '';
foreach ($pointsData as $row) {
    $tableRows .= '<tr>';
    $tableRows .= '<td>' . $row[0] . '</td>';
    $tableRows .= '<td>' . $row[1] . '</td>';
    $tableRows .= '<td>' . $row[2] . '</td>';
    $tableRows .= '<td>' . $row[3] . '</td>';
    $tableRows .= '</tr>';
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
                    <span><h2>My Points</h2><button class="profile">View profile</button></span>
                    <div>
                        <h2 class="header-text">Reward Points</h2>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="box1">
                                <h2 class="bold-text">320</h2>
                                <p class="label-text">Points collected</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="box2">
                                <h2 class="bold-text">RM 32</h2>
                                <p class="label-text">Worth discount</p>
                            </div>
                        </div>
                    </div>
                    </div>  
                
                <div class="container mt-5">
                    <div class="row">
                        <div class="col-12">
                            <h2 class="header-text">Point History</h2>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>RECYCLED</th>
                                        <th>DATE & TIME</th>
                                        <th>POINTS WORTH</th>
                                        <th>DROP-OFF STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
HTML;
