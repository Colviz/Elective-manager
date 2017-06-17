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



<form>
<h1 class="dept">Admin login</h1>
<input placeholder="Username" pattern="[A-Za-z0-9]{1,15}" type="text" required="">
<input placeholder="Password" pattern="[A-Za-z0-9]+" type="password" required="">

<button class="login">Login</button>
<a href="#" target="_blank">Forgot Password</a>
</form>