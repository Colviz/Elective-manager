<?php
    include_once('dbconnect.php');
    include_once('views/student/student_session.php');
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

<?php
//catching the markread form values
    if(isset($_POST['markread']))  {

      $destination = $login_session;
      //marking all notifications as read
      if($_POST['markread'] == "all")  {

          $ret = Database::markallnotificationread($destination);
      }
      else  {
          //function for marking a notification as read
          //destination of these type of notifications is the user/student
          $ret = Database::marknotificationread($_POST['markread']);
      }

        if($ret == 1) {
?>
<!-- Snackbar starts -->
          <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>

          <script>
          r(function(){
              var snackbarContainer = document.querySelector('#snackbar');
              var data = { message: 'The notification <?php echo $_POST['markread']; ?> is marked as read.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
<!-- Snackbar ends -->
          <?php
                }
                else  {
                    ?>
<!-- Snackbar starts -->
          <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>

          <script>
          r(function(){
              var snackbarContainer = document.querySelector('#snackbar');
              var data = { message: 'Failed to mark notification <?php echo $_POST['markread']; ?> as read.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
<!-- Snackbar ends -->
          <?php
                }
              }
          ?>
  <body>
    <!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><a href="/student/profile" style="text-decoration: none; color: black">Welcome <?php echo $login_session; ?></a><a class="verified" title="Verified User"><i class="material-icons">verified_user</i></a></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
      <!-- Displaying notification here -->
      <a href="/student/notifications" class="notification"><sup>
      <?php  
              $user =  $login_session;
              $usertype = "student";
           $noti = Database::notificationcount($user,$usertype);  ?></sup>
      <?php if($noti == 0) {?>
            <i class="material-icons md-inactive md-dark">notifications_none</i>
      <?php   }
      else  {
        ?>
            <div class="material-icons mdl-badge mdl-badge--overlap orange" data-badge="<?php echo $noti; ?>">notifications_active</div>
        <?php
        }  ?></a>
        <!-- Displaying notification ends -->
        <a href="/student/profile"><button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect"> Profile </button></a> -
        <a href="/student/logout"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">Logout</button></a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/about">About</a>
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/contact">Contact</a>
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/student/profile">Profile</a>
      <!-- Displaying notification here -->
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/student/notifications" class="notification"><sup>
      <?php  
            Database::notificationcount($user,$usertype);  ?>
      <?php if($noti == 0) {?>
            No Notifications <i class="material-icons md-inactive md-dark">notifications_none</i>
      <?php   }
      else  {
        ?>
            New Notifications <span class="mdl-badge" data-badge="<?php echo $noti; ?>"><i class="material-icons orange">notifications_active</i></span>
        <?php
        }  ?></a>
        <!-- Displaying notification ends -->
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/student/change">Change Password</a>
      <a class="mdl-button mdl-js-ripple-effect stuleft" href="/student/logout">Logout</a>
    </nav>
  </div>
  