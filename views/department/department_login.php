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

          header("location: /department/profile");
      }

        if (!empty($_POST['deptsu'])) {
      
        //collecting values
        $username = $_POST['uname'];
        $password = md5($_POST['pass']);
        $user = $_POST['user'];
        
       //inserts data in user database       
        $ret = Database::departmentlogin($username,$password,$user);
        
        //checking the return value from the database
        if ($ret == 1)  {
          
          session_start();
          $_SESSION['login_user'] = $username;
          $_SESSION['usertype'] = $user;

              include_once('views/department/department_session.php');
              header("location: /department/profile");
        }
        else  {
        
?>
<br>
<!-- Login unsuccessful -->
<div class="snippet">
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
    <span class="mdl-chip__text">Incorrect <a style="color: blue; text-decoration: none;">Username or Password</a>.</span>
</span>
</div>
<!-- Snackbar starts -->
<div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<script>
r(function(){
    var snackbarContainer = document.querySelector('#snackbar');
    var data = { message: 'Incorrect Username/Password.',timeout: 4000};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
});
function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
</script>
<!-- Snackbar ends -->
<?php
    }
  }
?>

<form class="admlog" action="/department/login" method="post">
<h1 class="dept">Department login</h1>
<input placeholder="Username" name="uname" pattern="[A-Za-z0-9]{1,15}" type="text" required>
<input placeholder="Password" name="pass" type="password" required>
<center>
<select name="user" required>
      <option selected="true" disabled="disabled">You are a ....?</option>
      <option value="superuser">Departmental admin</option>
      <option value="normaluser">Departmental user</option>
</select></center> <br><br>

<button class="login" name="deptsu" value="deptsu" type="submit">Login</button>
<a href="/department/forget" style="text-decoration: none" target="_blank">Forgot Password?</a>
</form>




</div>
</div>
