<?php
   //start session
   session_start();
   
   //checking user for sessions
   $user_check = $_SESSION['login_user'];
   
   
   //checking in database username
   if(!empty($user_check))  {
   $admses = Database::adminsession($user_check);
   }

   if($admses == 1)  {

      $login_session = $user_check;
      $_SESSION['login_user'] = $user_check;
      //echo "session set as $login_session<br>";
   }
   
   if(!isset($_SESSION['login_user'])|| $login_session=='')
   {
      header("location:/admin/login");
      //echo "no login user set<br>";
   }
?>