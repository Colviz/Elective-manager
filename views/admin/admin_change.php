<?php
		include_once('views/admin/admin_dashboard.php');
?>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->
<?php
      
        if ( !empty($_POST['admch'] && $_POST['g-recaptcha-response'])) {
      
          $captcha=$_POST['g-recaptcha-response'];
          $captcha = Database::reCAPTCHAvalidate($captcha);

          //checking for the recaptcha value
          if($captcha == 1) {

                //collecting values
                $username = $_SESSION['login_user'];
                $newpassdb = md5($_POST['newpass']); 
                
                //inserts data in admin login database       
                $pass = Database::adminchangepassword($username,$newpassdb);
                
                //checking the return value from the database
                if ($pass == 1)  {
                  
                  //if password updated successfully
                  echo "Password updated successfully<br>You're being logged out in 5 seconds<br>";
                  header("refresh:5;url=/admin/logout");
                }
                else  {
                  echo "Password updating failed<br>.";
                }
            }
            //reCAPTCHA FAILED
            else  {
            echo "reCAPTCHA validation failed<br>";
          }
        }
      else  {

?>
<div class="mdl-grid">


<div class="mdl-cell mdl-cell--6-col">
    <form class="admlog" action="/admin/change" method="post">
    <h1 class="dept"><?php echo $_SESSION['login_user']; ?></a> - Change Password</h1>
            <input placeholder="Password" name="newpass" pattern="[A-Za-z0-9]+" type="password" required>
            
            <!-- reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey="6LeITyYUAAAAAMv47yYgyOkPpBI-tr__XTvc0LlQ" align="center"></div><br>

            <!-- Raised button with ripple -->
            <button class="login" name="admch" value="admch" type="submit">Change Password</button>
            <a href="/admin/forget" style="text-decoration: none" target="_blank">Recover Account?</a>
        </form>
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
