<?php
    include_once('views/includes/includes_header.php');
    include_once('dbconnect.php');
?>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/about">About</a>
      <a class="mdl-navigation__link" href="/contact">Contact</a>
      <a class="mdl-navigation__link" href="/admin">Admin Interface</a>
      <a class="mdl-navigation__link" href="/department">Department Interface</a>
      <a class="mdl-navigation__link" href="/student">Student Interface</a>
    </nav>
  </div>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
        
        <center>
        <div class="demo-card-wide1 mdl-card mdl-shadow--4dp">
        
        <div class="mdl-card__title">
        <h4><b>Student, check if your account exists?</b></h4>
        </div>
<?php
      if (isset($_POST['stuchk'])) {
          $roll = $_POST['rollno'];

          $check = Database::studentaccountcheck($roll);

          if($check == 1)  {
            echo "<b>Your account exists. <a>Have you activated it, before trying to login.</a></b>";
          }
          else  {
            echo "<b><a>Your account doesn't exist.</a><br>Register <a href ='/student/register'>here</a></b>";
          }
      }
?>
        <form class="admlog" action="/student/delete" method="post">
        <h1 class="dept">Account checking</h1>
        <input placeholder="Roll No" name="rollno" pattern="[A-Za-z0-9]{1,7}" type="text" required>

        <button class="login" type="submit" name="stuchk" value="stuchk">Check</button><br><br>
        </form>

        <div class="mdl-card__actions mdl-card--border"></div>
        <div class="mdl-card__title">
        <h4><b>Student, Having trouble activating account?</b></h4>
        </div>
        <div class="mdl-card__actions mdl-card--border"></div>
        <span style="text-align: left;">
        Are you are facing trouble activating your account? Due to providing of wrong credentials(email,etc.)<br>
        
        <ul><b>Steps to solve the problem -</b>
          <li>Don't try to re-register, as it's not possible to register with the same roll no. more than once.</li>
          <li>Delete your unactivated account using the form below.</li>
          <li>After successfully deleting your unactivated account, create another account with your roll no. and provide valid credentials as they'll be used in case of account recovery(in case you forgot your password).</li>
        </ul>
        </span>
        <div class="mdl-card__actions mdl-card--border"></div>
<?php
      if (isset($_POST['studel'])) {
          $_POST['rollno'];
          $del = Database::studentaccountdelete($_POST['rollno']);
          if($del == 1)  {
              echo "<br>Account successfully deleted<br>Check your account status using the above form.<br>";
          }
      }
?>
        <form class="admlog" action="/student/delete" method="post">
        <h1 class="dept">Student account deletion</h1>
        <input placeholder="Roll No" name="rollno" pattern="[A-Za-z0-9]{1,7}" type="text" required>

        <button class="login" type="submit" name="studel" value="studel">Delete account</button><br><br>
        <a href="/student/forget" style="text-decoration: none" target="_blank">Forgot Password?</a><br><br>
        <a href="/student/register" style="text-decoration: none" target="_blank">Not registered? Register here.</a><br><br>
        <a href="/student/delete" style="text-decoration: none" target="_blank">Having trouble activating account?</a>
        </form>
        Note - If your account is not deleted, then try to recover it from <a href="/student/forget">here.</a>

        </div>
        </center>
        </div>
        
