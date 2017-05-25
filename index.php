<?php
// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
//$request_uri = explode('?', basename($_SERVER['PHP_SELF']), 2);

// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        include_once('views/public/index.php');
        break;
    // About page
    case '/about':
        include_once('views/public/about.php');
        break;
    // Everything else
    default:
        header('HTTP/1.0 404 Not Found');
        include_once('views/public/404.php');
        break;
}
?>
