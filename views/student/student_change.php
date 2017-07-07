<?php
    include_once('views/student/student_dashboard.php');
    include_once('dbconnect.php');
?>

  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->
<?php
        if ( !empty($_POST['stuch'])) {
      
        //collecting values
        $username = $_SESSION['login_user'];
        $newpassdb = md5($_POST['newpass']);
        
        //inserts data in admin login database       
        $pass = Database::studentchangepassword($username,$newpassdb);
        
        //checking the return value from the database
        if ($pass == 1)  {
          
          //if password updated successfully
          echo "<br><b><center>Password updated successfully<br>You're being logged out in 5 seconds<br></b></center>";
          header("refresh:5;url=/student/logout");          
        }
      }
      else  {

?>
<div class="mdl-grid">


<div class="mdl-cell mdl-cell--6-col">
    <form class="admlog" action="/student/change" method="post">
    <h1 class="dept"><?php echo $_SESSION['login_user']; ?></a> - Change Password</h1>
       <input placeholder="Password" name="newpass" type="password" required>
          
       <!-- Raised button with ripple -->
       <button class="login" name="stuch" value="stuch" type="submit">Change Password</button>
       <a href="/department/forget" style="text-decoration: none" target="_blank">Recover Account?</a>
    </form>
</div>
</div>
<?php
      }
?>
		
  </div>