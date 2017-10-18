<?php
   //start session
   session_start();
   
   //checking user for sessions
   $user_check = $_SESSION['login_user'];
   $_SESSION['tempcount'];
   
   
   //checking in database username
   if(!empty($user_check))  {
      $stuses = Database::studentsession($user_check);
   }

   if($stuses == 1)  {

      $login_session = $user_check;
      $_SESSION['login_user'] = $user_check;
      
   }
   
   if(!isset($_SESSION['login_user'])|| $login_session=='' || $stuses != 1)
   {
      header("location:/student/logout");
   }
?>
