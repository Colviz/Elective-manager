<?php
	include_once('baseurl.php');
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
    <link rel="stylesheet" href="../../design/css/material.css">
    <link rel="stylesheet" href="../../design/css/style.css">
    </head>
  <body>
    <!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title">Elective Manager</span>

  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Elective Manager</span>
    <div class="side-separator"></div>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/admin">Admin</a>
      <a class="mdl-navigation__link" href="/department">Department Section</a>
      <a class="mdl-navigation__link" href="/student">Student Section</a>
    </nav>
  </div>
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
    <!-- Your content goes here -->
    <!-- Wide card with share menu button -->
<style>
.demo-card-wide.mdl-card {
  width: 512px;
}
.demo-card-wide > .mdl-card__title {
  color: #fff;
  height: 176px;
  background: url('../../images/books.jpg') center / cover;
}
.demo-card-wide > .mdl-card__menu {
  color: #fff;
}
</style>

<div class="demo-card-wide mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Welcome</h2>
  </div>
  <div class="mdl-card__supporting-text">
    Student Interface
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a href="/student" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      Get Started 
    </a>
  </div>
</div>


    </div>
  </main>
</div>

<!-- Footer here -->
<footer class="mdl-mini-footer footer">
  <div class="mdl-mini-footer__left-section">
    <div class="mdl-logo">&copy; : National Institute of Technology, Hamirpur (H.P.)</div>
  <div class="mdl-mini-footer__right-section">
  <div class="mdl-logo">Made with &hearts; By Team .EXE</div>
  </div>
  </div>
</footer>
    <script src="../../design/js/material.min.js"></script>
  </body>
</html>
