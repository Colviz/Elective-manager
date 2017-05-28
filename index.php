<?php
// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
//$request_uri = explode('?', basename($_SERVER['PHP_SELF']), 2);

// Route it up!
switch ($request_uri[0]) {
    
    case '/':
        include_once('views/public/index.php');
        break;
    
    case '/about':
        include_once('views/public/about.php');
        break;
    
    case '/contact':
        include_once('views/public/contact.php');
        break;

     //Interfaces   
    // Admin interface
    case '/admin':
        include_once('views/admin/index.php');
        break;

    case '/admin/login':
        include_once('views/admin/login.php');
        break;

    case '/admin/register':
        include_once('views/admin/register.php');
        break;

    case '/admin/logout':
        include_once('views/public/logout.php');
        break;

    case '/admin/profile':
        include_once('views/admin/admin_profile.php');
        break;

    case '/admin/profile/registered':
        include_once('views/admin/admin_registered.php');
        break;

    // Student interface
    case '/student':
        include_once('views/student/index.php');
        break;

    case '/student/login':
        include_once('views/student/login.php');
        break;

    case '/student/register':
        include_once('views/student/register.php');
        break;

    case '/student/logout':
        include_once('views/public/logout.php');
        break;


    // Department interface
    case '/department':
        include_once('views/department/index.php');
        break;

    case '/department/login':
        include_once('views/department/login.php');
        break;

    case '/department':
        include_once('views/department/register.php');
        break;

    case '/department/logout':
        include_once('views/public/logout.php');
        break;

    // Everything else
    default:
        header('HTTP/1.0 404 Not Found');
        include_once('views/public/404.php');
        break;
}
?>
