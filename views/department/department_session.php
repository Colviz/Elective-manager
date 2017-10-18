<?php
   //start session
   session_start();
   
   //checking user for sessions
   $user_check = $_SESSION['login_user'];
   $user_type = $_SESSION['usertype'];
   $type = $_SESSION['temptype'];
   
   
   //checking in database username
   if(!empty($user_check))  {
      $deptses = Database::departmentsession($user_check,$user_type);
   }

   if($deptses == 1)  {

      $login_session = $user_check;
      $_SESSION['login_user'] = $user_check;
      $_SESSION['usertype'] = $user_type;
   }
   
   if(!isset($_SESSION['login_user'])|| $login_session=='' || $deptses != 1)
   {
      header("location:/department/logout");
   }
?>
