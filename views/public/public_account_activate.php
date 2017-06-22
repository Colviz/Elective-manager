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
     
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
    <!-- Your content goes here -->
    <div class="mdl-grid">

<?php
      
        if (!empty($_POST['actuser'])) {
      
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
          $ret = Database::studentactivation($username,$password,$email,$activation);
        }

        if($ret == NULL || $ret == 0) {       
?>
<!-- Activation unsuccessful -->
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
    <span class="mdl-chip__text">Incorrect <a style="color: blue; text-decoration: none;">Username, Password, email OR Activation code</a> Account activation Failed <a href="/" style="text-decoration: none;">Try Login if already activated</a>.</span>
</span>
<?php
      }
      else  {
        ?>
        <!-- Activation successful -->
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
    <span class="mdl-chip__text">Account activation <a style="color: blue; text-decoration: none;">Successful.</a> Go to <a href="/" style="text-decoration: none;"> Login</a> page.</span>
</span>
        <?php
      }
    }
?>


<form class="admlog" action="/activate" method="post">
<h1 class="dept">Account activation</h1>
<input placeholder="Username" name="uname" pattern="[A-Za-z0-9]{1,15}" type="text" required>
<input placeholder="Password" name="pass" pattern="[A-Za-z0-9]+" type="password" required>
<input placeholder="Email" name="email" type="email" required>
<input placeholder="Activation code" name="actcode" pattern="[A-Za-z0-9]{31,32}" type="text" required>
<center>
<select name="user" required>
      <option>You are a ....?</option>
      <option value="dept">Department User</option>
      <option value="stud">Student</option>
</select></center> <br><br>

<button class="login" name="actuser" value="actuser" type="submit">Activate Account</button><br><br>
<a href="/department/forget" style="text-decoration: none" target="_blank">Department - Forgot Password?</a><br><br>
<a href="/student/forget" style="text-decoration: none" target="_blank">Student - Forgot Password?</a>
</form>




</div>
</div>
<script src="views/design/js/material.min.js"></script>
<script src="views/design/js/style.js"></script>