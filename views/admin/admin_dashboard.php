<?php
    include_once('dbconnect.php');
    include_once('views/admin/admin_session.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Introducing Lollipop, a sweet new take on Android.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <link rel="icon" href="../../images/book.png">
    <title>Elective Manager</title>

    <!-- Page styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../views/design/css/material.css">
    <link rel="stylesheet" href="../../views/design/css/style.css">
    <!-- Below script is for captcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
  <body>
    <!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><a href="/admin/profile" style="text-decoration: none; color: black">Welcome <?php echo $login_session; ?></a></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
      <!-- Displaying notification here -->
      <a href="/admin/notifications" class="notification"><sup>
      <?php  
              $user = "admin";
              $usertype = 0;
           $noti = Database::notificationcount($user,$usertype);  ?></sup>
      <?php if($noti == 0) {?>
            <i class="material-icons md-inactive md-dark">notifications</i>
      <?php   }
      else  {
        ?>
            <div class="material-icons mdl-badge mdl-badge--overlap orange" data-badge="<?php echo $noti; ?>">notifications_active</div>
        <?php
        }  ?></a>
        <!-- Displaying notification ends -->
        <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="/admin/profile">Profile</a>
        <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" href="/admin/profile/registered">Registered Students</a>
        <a href="/admin/logout"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">Logout</button></a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/about">About</a>
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/contact">Contact</a>
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/admin/profile">Profile</a>
      <!-- Displaying notification here -->
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/admin/notifications" class="notification"><sup>
      <?php  
            Database::notificationcount($user,$usertype);  ?>
      <?php if($noti == 0) {?>
            No Notifications <i class="material-icons md-inactive md-dark">notifications</i>
      <?php   }
      else  {
        ?>
            New Notifications <span class="mdl-badge" data-badge="<?php echo $noti; ?>"><i class="material-icons orange">notifications_active</i></span>
        <?php
        }  ?></a>
        <!-- Displaying notification ends -->

      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/admin/change">Change Password</a>
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/admin/profile/registered">Registered Students</a>
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/admin/logout">Logout</a>
    </nav>
  </div>