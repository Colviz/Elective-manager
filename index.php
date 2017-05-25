<?php
// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
//$request_uri = explode('?', basename($_SERVER['PHP_SELF']), 2);
echo basename($_SERVER['PHP_SELF']);
echo "<br>";
print_r($request_uri);
echo "<br>";
// Route it up!
switch ($request_uri[0]) {
    // Home page
    case '/':
        echo "/ here\n";
        break;
    // About page
    case '/about':
        echo "about.php is opened from here\n";
        break;
    // Everything else
    default:
        header('HTTP/1.0 404 Not Found');
        echo "404 is opened from here \n";
        break;
}
?>
