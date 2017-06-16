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
 <h2 class="dept">Department Login</h2>
  <div class="group">
    <input type="text"><span class="highlight" name="uname" pattern="[A-Za-z0-9]{1,15}" placeholder="Letters & Numerics" id="uname" required></span><span class="bar"></span>
   
    <label>User Name</label>
  </div>
  <div class="group">
    <input type="password"><span class="highlight" type="password" name="password"  pattern="[A-Za-z0-9]+" id="pass" required></span><span class="bar"></span>
    <label>Password</label>
  </div>

  <a href="#" target="_blank">Forgot Password</a>

<button type="button" class="button buttonBlue">Login
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button>
</form>
  

