<?php
		//include_once('views/includes/header.php');
    include_once('dbconnect.php');
    include_once('views/admin/admin_session.php');

    //getting the URI
    $request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

    switch ($request_uri[0]) {

        case '/admin/profile':
        $i = "profile";
        break;

        case '/admin/profile/registered':
        $i = "registered";
        break;
    }
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
    <!-- Below script is for captcha -->
    <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
  <body>
    <!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><a href="/admin/profile" style="text-decoration: none; color: black">Welcome <?php echo $login_session; ?></a></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation">
      <?php 
              if($i != "profile")  {
      ?>
        <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" href="/admin/profile">Profile</a>
      <?php
            }

            else if($i != "registered") {
      ?>
        <a class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect" href="/admin/profile/registered">Registered Students</a>
      <?php
            }
      ?>
        <a href="/admin/logout"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">Logout</button></a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/about">About</a>
      <a class="mdl-navigation__link" href="/contact">Contact</a>
      <a class="mdl-navigation__link" href="/admin">Admin Interface</a>
      <a class="mdl-button mdl-js-button mdl-button--accent mdl-js-ripple-effect" href="/admin/change">Change Password</a>
      </nav>
  </div>