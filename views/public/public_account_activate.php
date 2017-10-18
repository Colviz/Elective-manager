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
    <div class="mdl-grid">

<?php
      
        if (!empty($_POST['actuser'] && $_POST['g-recaptcha-response'])) {

          $captcha=$_POST['g-recaptcha-response'];
          $captcha = Database::reCAPTCHAvalidate($captcha);

          //checking for the recaptcha value
          if($captcha == 1) {
      
        //collecting values
        $username = $_POST['uname'];
        $password = md5($_POST['pass']);
        $email = $_POST['email'];
        $activation = $_POST['actcode'];
        $user = $_POST['user'];

        if($user == "dept")  {

          //department account activation
          $ret = Database::departmentactivation($username,$password,$email,$activation);
          
        }
        else {

          //student account activation          
          //student roll no.'s are in lowecase
          $username = strtolower($username);
          $ret = Database::studentactivation($username,$password,$email,$activation);
        }

        if($ret == NULL || $ret == 0) {       
?>
<!-- Activation unsuccessful -->
<div class="snippet">
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
    <span class="mdl-chip__text">Incorrect <a style="color: blue; text-decoration: none;">Username, Password, email OR Activation code</a> Account activation Failed <a href="/" style="text-decoration: none;">Try Login if already activated</a>.</span>
</span>
</div>
<?php
      }
      else  {
        ?>
<!-- Activation successful -->
<div class="snippet">
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
    <span class="mdl-chip__text">Account activation <a style="color: blue; text-decoration: none;">Successful.</a> Go to <a href="/" style="text-decoration: none;"> Login</a> page.</span>
</span>
</div>
        <?php
      }
    }
    //reCAPTCHA VALIDATION
    else  {
    echo "reCAPTCHA validation failed<br>";
  }
}
?>


<form class="admlog" action="/activate" method="post">
<h1 class="dept">Account activation</h1>
<input placeholder="Username/Roll No." name="uname" pattern="[A-Za-z0-9]{1,15}" type="text" required>
<input placeholder="Password" name="pass" type="password" required>
<input placeholder="Email" name="email" type="email" required>
<input placeholder="Activation code" name="actcode" pattern="[A-Za-z0-9]{31,32}" type="text" required>
<center>
<select name="user" required>
      <option selected = "true" disabled = "disabled">You are a ....?</option>
      <option value="dept">Department User</option>
      <option value="stud">Student</option>
</select></center> <br><br>

<!-- reCAPTCHA -->
<div class="g-recaptcha" data-sitekey=<?php echo $reCAPTCHAsiteKey ?> align="center"></div><br>

<button class="login" name="actuser" value="actuser" type="submit">Activate Account</button><br><br>
<a href="/department/forget" style="text-decoration: none" target="_blank">Department - Forgot Password?</a><br><br>
<a href="/student/forget" style="text-decoration: none" target="_blank">Student - Forgot Password?</a><br><br>
<a href="/student/delete" style="text-decoration: none" target="_blank">Student, Having trouble activating account?</a>
</form>




</div>
</div>
