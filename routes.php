<?php

$routes = [
    '' => function()    {
        //home, root    
        include_once('views/public/public_index.php');
    },
    'about' => function()   {
        //about page
        include_once('views/public/public_about.php');
    },
    'contact' => function()    {
        //contact page
        include_once('views/public/public_contact.php');
    },
    'credits' => function()    {
        //credits page
        include_once('views/public/public_credits.php');
    },
    'activate' => function()    {
        //account activation page
        include_once('views/public/public_account_activate.php');
    },
    'faq' => function()    {
        //frequently asked questions
        include_once('views/public/public_faq.php');
    },
    //Interfaces   

    // Admin interface
    'admin' => function()    {
        //home page  
        include_once('views/admin/admin_index.php');
    },
    'admin/login' => function()    {
        //login page
        include_once('views/admin/admin_login.php');
    },
    'admin/register' => function()    {
        //registration page
        include_once('views/admin/admin_register.php');
    },
    'admin/logout' => function()    {
        //logout page
        include_once('views/public/public_logout.php');
    },
    'admin/profile' => function()    {
        //admin profile  
        include_once('views/admin/admin_profile.php');
    },
    'admin/forget' => function()    {
        //admin password recovery
        include_once('views/admin/admin_forget.php');
    },
    'admin/notifications' => function()    {
        //admin password recovery
        include_once('views/admin/admin_notifications.php');
    },
    'admin/profile/registered' => function()    {
        //admin view registered students
        include_once('views/admin/admin_registered.php');
    },
    'admin/change' => function()    {
        //admin password change
        include_once('views/admin/admin_change.php');
    },
    'admin/security' => function()    {
        //admin security & backup settings
        include_once('views/admin/admin_security.php');
    },
    'admin/alloted' => function()    {
        //admin security & backup settings
        include_once('views/admin/admin_alloted.php');
    },

    // Student interface

    'student' => function()    {
        //student home page
        include_once('views/student/student_index.php');
    },
    'student/list' => function()    {
        //student list    
        include_once('views/student/student_list.php');
    },
    'student/delete' => function()    {
        //student unregistered account deletion
        include_once('views/student/student_delete.php');
    },
    'student/login' => function()    {
        //student login    
        include_once('views/student/student_login.php');
    },
    'student/register' => function()    {
        //student registration  
        include_once('views/student/student_register.php');
    },
    'student/profile' => function()    {
        //student profile
        include_once('views/student/student_profile.php');
    },
    'student/change' => function()    {
        //student password change
        include_once('views/student/student_change.php');
    },
    'student/notifications' => function()    {
        //admin password recovery
        include_once('views/student/student_notifications.php');
    },
    'student/profile/apply' => function()    {
        //student prioritize electives
        include_once('views/student/student_apply.php');
    },
    'student/forget' => function()    {
        //Student Forget
        include_once('views/student/student_forget.php');
    },
    'student/profile/applied' => function()    {
        //student applied
        include_once('views/student/student_applied.php');
    },
    'student/logout' => function()    {
        //student logout
        include_once('views/public/public_logout.php');
    },
    // Department interface

    'department' => function()    {
        //department home page  
        include_once('views/department/department_index.php');
    },
    'department/login' => function()    {
        //department login
        include_once('views/department/department_login.php');
    },
    'department/register' => function()    {
        //department registration 
        include_once('views/department/department_register.php');
    },
    'department/profile' => function()    {
        //department users profile
        include_once('views/department/department_profile.php');
    },
    'department/notifications' => function()    {
        //admin password recovery
        include_once('views/department/department_notifications.php');
    },
    'department/profile/register' => function()    {
        //department normaluser registration
        include_once('views/department/department_register.php');
    },
    'department/profile/publish' => function()    {
        //department elective publish
        include_once('views/department/department_publish.php');
    },
    'department/change' => function()    {
        //department password change
        include_once('views/department/department_change.php');
    },
    'department/forget' => function()    {
        //department password recovery
        include_once('views/department/department_forget.php');
    },
    'department/logout' => function()    {
        //department logout
        include_once('views/public/public_logout.php');
    },

    //Other routes
    'github' => function()    {
        //department logout
        include_once('views/public/public_github.php');
    }
];


?>
