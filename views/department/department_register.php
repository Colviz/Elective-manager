<?php
    include_once('views/department/department_dashboard.php');
    include_once('dbconnect.php');
?>

  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->
<?php
        if ( !empty($_POST['reguser'])) {
      
        //collecting values
        $username = $_POST['uname'];
        $pass = $_POST['pass'];
        $password = md5($pass);
        $email = $_POST['email'];
        $mobileno = $_POST['mobileno'];
        $department = Database::departmentcode($login_session);
        //generating the token
        $token = Database::generateRandomString();
        $token = md5($token);
        
        //inserts data in users login database       
        $ret = Database::departmentregister($username,$password,$mobileno,$email,$department,$token);

        echo "<center><br><br>";
        //getting the full name of department
        $department = Database::departmentsname($department);
        
        //checking the return value from the database
        if ($ret == 1)  {
          
          //if user created successfully
          ?>
          <br><div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
              <span class="mdl-chip__text">User account created <a style="color: blue; text-decoration: none;">Successfully</a>.</span>
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
              var data = { message: 'User account created successfully.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
          <?php
          
          //writing the details to variables
          $to = $email;
          $subject = "Departmental account activation - nith.ac.in";
          $message = "Your username - $username\r\n Your password - $pass\r\n Your email - $email\r\n Your mobileno - $mobileno\r\n Your department - $department\r\n Your account activation code is - $token\r\nVisit /activate to activate your account\r\n";
          //mailing the details
          $mailit = Database::mailthedetails($to,$subject,$message);

          if($mailit == 1)	{
          		echo "<center>Activate the account, using the activation link sent to - $email<br>Login credentials are also sent in the mail.</center><br>";
          }
          else 	{
          	?>
            <!-- Snackbar starts -->
            <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
              <div class="mdl-snackbar__text"></div>
              <button class="mdl-snackbar__action" type="button"></button>
            </div>

            <script>
            r(function(){
                var snackbarContainer = document.querySelector('#snackbar');
                var data = { message: 'Account confirmation mail sending failed.',timeout: 4000};
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
            });
            function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
            </script>
            <!-- Snackbar ends -->
            <?php
          }
        }
        else 	{
        	?>
          <!-- Snackbar starts -->
          <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>

          <script>
          r(function(){
              var snackbarContainer = document.querySelector('#snackbar');
              var data = { message: 'User account creation failed, Please try again.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
          <?php
        }
      }
      else  {

?>
<div class="mdl-grid">


<div class="mdl-cell mdl-cell--6-col">

    <form class="admlog" action="/department/profile/register" method="post">
            <h1 class="dept">Create - Department user</h1>
		<input placeholder="Username" name="uname" pattern="[A-Za-z0-9]{1,15}" type="text" required>
		<input placeholder="Password" name="pass" type="password" required>
		<input placeholder="Email" name="email" type="email" required>
		<input placeholder="Mobile no." name="mobileno" pattern="[0-9]{10,10}" type="text" required>

		<button name="reguser" value="reguser" class="login" type="submit">Create User</button>
    </form>
</div>
<?php
      }
?>


		</div>
  </div>
