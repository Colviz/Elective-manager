<?php
// Grabs the URI and breaks it in parts
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

// URL Routing 
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

    //account activation page
    case '/activate':
        include_once('views/public/public_account_activate.php');
        break;

    //frequently asked questions
    case '/faq':
        include_once('views/public/public_faq.php');
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

        //student list 
    case '/student/list':
        include_once('views/student/student_list.php');
        break;

        //student unregistered account deletion
    case '/student/delete':
        include_once('views/student/student_delete.php');
        break;

        //student login
    case '/student/login':
        include_once('views/student/student_login.php');
        break;

        //student registration
    case '/student/register':
        include_once('views/student/student_register.php');
        break;

        //student profile
    case '/student/profile':
        include_once('views/student/student_profile.php');
        break;

        //student prioritize electives
    case '/student/profile/apply':
        include_once('views/student/student_apply.php');
        break;

        //Student Forget
    case '/student/forget':
        include_once('views/student/student_forget.php');
        break;

        //student applied
    case '/student/profile/applied':
        include_once('views/student/student_applied.php');
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

        //department superuser profile
    case '/department/profile':
        include_once('views/department/department_profile.php');
        break;

        //department normaluser registration
    case '/department/profile/register':
        include_once('views/department/department_register.php');
        break;

    //department elective publish
    case '/department/profile/publish':
        include_once('views/department/department_publish.php');
        break;

        //department password change
    case '/department/change':
        include_once('views/department/department_change.php');
        break;

        //department password recovery
    case '/department/forget':
        include_once('views/department/department_forget.php');
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
