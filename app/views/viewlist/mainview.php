<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$mainView = <<<HTML
    <!DOCTYPE html>
    <html>
        <head>
            <title>{$viewInfo['title']}</title>

            <link rel="shortcut icon" type="image/png" href="$root/app/assets/public/favicon.png" />
            
            <!-- Include Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            
            <!-- Include jQuery -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            
            <!-- Include Bootstrap JS -->
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            
            <!-- Include Roboto font -->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap">
            
            <!-- Include Font Awesome -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

            <!-- Include DataTable CSS -->
            <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

            <!-- Include DataTable JS -->
            <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

            <link rel="stylesheet" href="$root/app/views/css/main.css" />

            <script src="$root/app/views/js/main.js"></script>
            <script src="$root/app/views/js/notification.js"></script>
HTML;

        // Include view-specific CSS.
        foreach ($viewInfo['css'] as $css) :
            $mainView .= <<<HTML
            <link rel="stylesheet" href="$root/app/views/css/{$css}" />
            HTML;
        endforeach;

$mainView .= <<<HTML
        </head>
        <body>
HTML;

        // Render navigation. [top]
        $mainView .= $viewInfo['nav']['top'];

        // Render view body.
        $mainView .= $viewInfo['body'];

        // Render navigation. [bottom]
        $mainView .= $viewInfo['nav']['bottom'];

        // Include view-specific JS.
        foreach ($viewInfo['js'] as $js) :
            $mainView .= <<<HTML
            <script src="$root/app/views/js/{$js}"></script>
            HTML;
        endforeach;
            
$mainView .= <<<HTML
            <!-- Notification -->
            <div class="notification" id="notification-div">
                <div class="alert alert-info alert-dismissible fade notification-box" role="alert" id="notification">
                    <p id="notification-text">&nbsp;</p>
                    <button type="button" class="close notification-close" data-dismiss="alert">&times;</button>
                </div>
            </div>
            
            <!-- Include Popper JS -->
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        </body>
    </html>
HTML;

echo $mainView;
