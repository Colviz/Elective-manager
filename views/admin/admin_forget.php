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
      //Admin password recovery
      
        if ( !empty($_POST['admfor'] && $_POST['g-recaptcha-response'])) {

          $captcha=$_POST['g-recaptcha-response'];
          $captcha = Database::reCAPTCHAvalidate($captcha);

          //checking for the recaptcha value
      if($captcha == 1) {
      
                    //collecting values
                    $username = $_POST['uname'];
                    $mobileno = $_POST['no'];
                    $email = $_POST['email'];
                
                    //Values authentication
                    $check = Database::adminrecovery($username,$mobileno,$email);

                    //checking the return value
                    if($check == 1)  {

                      //generating the new password
                      //calling the new password generating function
                      $newpass = Database::generateRandomString(); //send this to user via email
                      $newpassdb = md5($newpass); //insert this encrypted value in database

                      //Replacing the existing password with new password
                      $pass = Database::adminchangepassword($username,$newpassdb);

                      if($pass == 1)  {
                      //send the new password in mail
                      
                      //subject of the email
                      $subject = "Admin - account recovery email, $username";

                      //message content of the email
                      $message = "Hey, $username\r\nYour request to recover your password is received\r\nYour new password is - $newpass.\r\n";

                      //sending the email
                      $mailit = Database::mailthedetails($email,$subject,$message);

                          if($mailit == 1)  {
                          echo "<p>";
                          echo "Account recovery email sent to $email. <br>";
                          echo "Follow the instructions to reset the password. <br>";
                          echo "</p>";
                          } 
                          else  {
                            echo "Account Recovery mail sending failed<br>";
                            }
                      }
                    }
                    else  {
                    
            ?>
<!-- Registration successful -->
<div class="snippet">
<span class="mdl-chip mdl-chip--contact">
  <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
  <span class="mdl-chip__text">Incorrect Input fields <a style="color: blue; text-decoration: none;">Password Recovery Failed.</a></span>
</span>
</div>
            <?php
                }
  }
  else  {
    echo "reCAPTCHA validation failed<br>";
  }
}
      else {
?>
      
        <form action="/admin/forget" method="post">
        <h1>Admin Password recovery</h1>
            <input  type="text" name="uname" pattern="[A-Za-z0-9]{1,15}" placeholder="Letters & Numerics" id="uname" required>
            <input  type="email" name="email" placeholder="Email" id="email" required>
            <input  type="text" name="no" placeholder="Mobile Number" pattern="[0-9]{10,10}" id="no" required>
            
            <!-- reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey="6LeITyYUAAAAAMv47yYgyOkPpBI-tr__XTvc0LlQ" align="center"></div><br>

            <!-- Raised button with ripple -->
            <button type="submit" name="admfor" value="admfor" class="login">
            Submit
          </button>
        </form>
      <?php
          }
      ?>

    </div>
  </div>