<?php
// Grabs the URI and breaks it apart in case we have querystring stuff
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);
//$request_uri = explode('?', basename($_SERVER['PHP_SELF']), 2);

// Route it up!
switch ($request_uri[0]) {

    //home, root    
    case '/':
        include_once('views/public/public_index.php');
        break;
    
    //about page
    case '/about':
        include_once('views/public/public_about.php');
        break;
    
    //contact page
    case '/contact':
        include_once('views/public/public_contact.php');
        break;

    //bugs reporting page
    case '/bugs':
        include_once('views/public/public_bugs.php');
        break;

    //credits page
    case '/credits':
        include_once('views/public/public_credits.php');
        break;

     //Interfaces   

    // Admin interface
        //home page
    case '/admin':
        include_once('views/admin/admin_index.php');
        break;

        //login page
    case '/admin/login':
        include_once('views/admin/admin_login.php');
        break;

        //registration page
    case '/admin/register':
        include_once('views/admin/admin_register.php');
        break;

        //logout page
    case '/admin/logout':
        include_once('views/public/public_logout.php');
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
        include_once('views/student/student_index.php');
        break;

        //student login
    case '/student/login':
        include_once('views/student/student_login.php');
        break;

        //student registration
    case '/student/register':
        include_once('views/student/student_register.php');
        break;

        //student logout
    case '/student/logout':
        include_once('views/public/public_logout.php');
        break;


    // Department interface
        //department home page
    case '/department':
        include_once('views/department/department_index.php');
        break;

        //department login
    case '/department/login':
        include_once('views/department/department_login.php');
        break;

        //department registration
    case '/department/register':
        include_once('views/department/department_register.php');
        break;

        //department logout
    case '/department/logout':
        include_once('views/public/public_logout.php');
        break;

    // Everything else - The default 404 page
    default:
        header('HTTP/1.0 404 Not Found');
        include_once('views/public/public_404.php');
        break;
}

    //footer here
    include_once('views/includes/includes_footer.php');

?>
