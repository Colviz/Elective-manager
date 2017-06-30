<?php
		//include_once('views/includes/header.php');
    include_once('dbconnect.php');
    include_once('views/department/department_session.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Introducing Lollipop, a sweet new take on Android.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Elective Manager</title>

    <!-- Page styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../../views/design/css/material.css">
    <link rel="stylesheet" href="../../views/design/css/style.css">
    </head>
  <body>
    <!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><a href="/department/profile" style="text-decoration: none; color: black">Welcome <?php echo $login_session; ?></a></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation">
      
        <a href="/department/profile"><button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect"> Profile </button></a> - 
        <a href="/department/profile/publish"><button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect"> Publish Elective </button></a> - 
      
           <?php
            
              //checking if a user is superuser or not
              if($_SESSION['usertype'] == "superuser")  {
      ?>
        <a href="/department/profile/register"><button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect"> Register User </button></a> - 
      <?php
            }
      ?>
        <a href="/department/logout"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect"> Logout </button></a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/about">About</a>
      <a class="mdl-navigation__link" href="/contact">Contact</a>
      <a class="mdl-navigation__link" href="/department">Department Interface</a>
      <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="/department/change">Change Password</a>
      </nav>
  </div>
  </div>