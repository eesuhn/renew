<?php
/**
 * ReNew - A sustainable marketplace that empowers the community to participate in recycling 
 * by providing a platform for both the public to responsibly recycle items and for local 
 * artists to showcase and sell their unique creations made from recycled materials.
 * 
 * @package ReNew
 * @version 0.0.1
 * @author 
 * - github.com/eesuhn
 * - github.com/shai-mohan
 * 
 * @dependencies 
 * [Backend]
 * - PHP 8.1.10
 * - MySQL Ver 15.1 Distrib 10.4.25-MariaDB
 * - jQuery 3.5.1
 * 
 * [Frontend]
 * - Bootstrap 4.5.2
 * - PopperJS v2.11.6
 * - DataTables 1.13.7
 * - Font Awesome 5.15.3
 * - Google Fonts Roboto
 */

 define('ROOT', __DIR__);
 define('ROOT_URI', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/renew');
 define('ACCESS', true);
 
 require_once ROOT . '/app/config/debug.php';
 require_once ROOT . '/app/utils/mainutil.php';
 require_once ROOT . '/app/views/views.php';
 require_once ROOT . '/app/routes/routes.php';
