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
        //home page
    case '/admin':
        include_once('views/admin/index.php');
        break;

        //login page
    case '/admin/login':
        include_once('views/admin/login.php');
        break;

        //registration page
    case '/admin/register':
        include_once('views/admin/register.php');
        break;

        //logout page
    case '/admin/logout':
        include_once('views/public/logout.php');
        break;

        //admin profile
    case '/admin/profile':
        include_once('views/admin/admin_profile.php');
        break;

        //admin password recovery
    case '/admin/forget':
        include_once('views/admin/admin_forget.php');
        break;

        //admin view registered students
    case '/admin/profile/registered':
        include_once('views/admin/admin_registered.php');
        break;

        //admin password change
    case '/admin/change':
        include_once('views/admin/admin_change.php');
        break;


    // Student interface
        //student home page
    case '/student':
        include_once('views/student/index.php');
        break;

        //student login
    case '/student/login':
        include_once('views/student/login.php');
        break;

        //student registration
    case '/student/register':
        include_once('views/student/register.php');
        break;

        //student logout
    case '/student/logout':
        include_once('views/public/logout.php');
        break;


    // Department interface
        //department home page
    case '/department':
        include_once('views/department/index.php');
        break;

        //department login
    case '/department/login':
        include_once('views/department/login.php');
        break;

        //department registration
    case '/department/register':
        include_once('views/department/register.php');
        break;

        //department logout
    case '/department/logout':
        include_once('views/public/logout.php');
        break;

    // Everything else - The default 404 page
    default:
        header('HTTP/1.0 404 Not Found');
        include_once('views/public/404.php');
        break;
}

    //include footer here, when its done

?>
