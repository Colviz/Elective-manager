<?php
    include_once('views/department/department_dashboard.php');
    include_once('dbconnect.php');
?>

  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->
<?php
        if ( !empty($_POST)) {
      
        //collecting values
        $username = $_SESSION['login_user'];
        $newpassdb = md5($_POST['newpass']);
        
        //inserts data in admin login database       
        $pass = Database::departmentchangepassword($username,$newpassdb);
        
        //checking the return value from the database
        if ($pass == 1)  {
          
          //if password updated successfully
          echo "Password updated successfully<br>You're being logged out in 5 seconds<br>";
          header("refresh:5;url=/department/logout");
          
        }
      }
      else  {

?>
<div class="mdl-grid">


<div class="mdl-cell mdl-cell--6-col">
<div class="demo-card-wide1 mdl-card mdl-shadow--4dp">
  <div class="mdl-card__supporting-text">
    <h4>
      <a><?php echo $_SESSION['login_user']; ?></a> Change Password
    </h4>
  </div>
    <form class="admlog" action="/department/change" method="post">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="password" name="newpass" pattern="[A-Za-z0-9]+" id="newpass" required>
            <label class="mdl-textfield__label" for="pass">New Password</label>
            </div>
            <!-- Raised button with ripple -->
            <div>
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">
            Change Password
          </button>
          </div>
        </form>
        <a style="text-decoration: none;" href="/department/forget"><button class="mdl-button mdl-js-button mdl-button--colored mdl-js-ripple-effect">
            Forgot current Password? Recover here!
        </button></a>
</div>
</div>
<?php
      }
?>


		</div>
  </div>
  </main>
</div>

    <script src="../views/design/js/material.min.js"></script>
    <script src="../views/design/js/style.js"></script>
  </body>
</html>