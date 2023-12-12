<?php

if (!defined('ACCESS')) {
    http_response_code(404);
    die();
}

$body = <<<HTML
    <footer id="sticky-footer" class="footer-bg flex-shrink-0 py-4">
        <div class="container text-center">
            <small class="small-text"><i class="fas fa-quote-left"></i>&nbspReNew: Transforming Waste into Art, Empowering Communities for a Sustainable Future.&nbsp<i class="fas fa-quote-right"></i></small>
        </div>
        <div class="container text-center mt-3">
            <small class="copyright-text">Copyright&nbsp<i class="far fa-copyright"></i>&nbsp<a href="$root/">ReNew | Upcycle & Recycle</a></small>
        </div>
  </footer>
HTML;
