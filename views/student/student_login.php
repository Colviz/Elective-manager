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
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
    <div class="mdl-grid">
<?php
      //Admin registration
      include_once('dbconnect.php');
      
      //automatic login if session is set
      session_start();
      
      if(isset($_SESSION['login_user']))  {

          header("location: /student/profile");
      }

        if (!empty($_POST['stulog'])) {
      
        //collecting values
        $rollno = $_POST['rollno'];
        $password = md5($_POST['pass']);
        
       //inserts data in user database       
        $ret = Database::studentlogin($rollno,$password);
        
        //checking the return value from the database
        if ($ret == 1)  {
          
          $_SESSION['login_user'] = $rollno;

              include_once('views/student/student_session.php');
              header("location: /student/profile");
        }
        else  {
        
?>
<!-- Registration unsuccessful -->
<div class="snippet">
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
    <span class="mdl-chip__text">Incorrect <a style="color: blue; text-decoration: none;">Username or Password</a> Login Failed <a href="/admin/login" style="text-decoration: none;">Login here</a>.</span>
</span>
</div>
<?php
    }
  }
?>


<form class="admlog" action="/student/login" method="post">
<h1 class="dept">Student login</h1>
<input placeholder="Roll No" name="rollno" pattern="[A-Za-z0-9]{1,7}" type="text" required>
<input placeholder="Password" name="pass" type="password" required>

<button class="login" type="submit" name="stulog" value="stulog">Login</button><br><br>
<a href="/student/forget" style="text-decoration: none" target="_blank">Forgot Password?</a><br><br>
<a href="/student/register" style="text-decoration: none" target="_blank">Not registered? Register here.</a>
</form>


</div>
</div>