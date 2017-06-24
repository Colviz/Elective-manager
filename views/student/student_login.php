<?php
      include_once('views/includes/includes_header.php');
?>
<nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/about">About</a>
      <a class="mdl-navigation__link" href="/contact">Contact</a>
      <a class="mdl-navigation__link" href="/admin">Admin Interface</a>
      <a class="mdl-navigation__link" href="/department">Department Interface</a>
      <a class="mdl-navigation__link" href="/student">Student Interface</a>
    </nav>
  </div>
     
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
    <!-- Your content goes here -->
    <div class="mdl-grid">



<form class="admlog" action="/student/login" method="post">
<h1 class="dept">Student login</h1>
<input placeholder="Roll No" pattern="[A-Za-z0-9]{1,7}" type="text" required="">
<input placeholder="Password" type="password" required="">

<button class="login">Login</button>
<a href="/student/forget" style="text-decoration: none" target="_blank">Forgot Password?</a><br><br>
<a href="/student/register"><button style="width: 300px; float:left;" class="login">Not registered? Register here</button></a>
</form>