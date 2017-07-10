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
                          ?>
                  <div class="mdl-cell mdl-cell--12-col">
                  <br><center>
                  <!-- success/failure snippet -->
                  <div class="snippet">
                  <span class="mdl-chip mdl-chip--contact">
                      <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
                      <span class="mdl-chip__text">Account recovery email sent to <a style="text-decoration: none;"><?php echo $email; ?></a>.</span>
                  </span>
                  </div>
                  <!-- success/failure snippet -->
                  <div class="snippet">
                  <span class="mdl-chip mdl-chip--contact">
                      <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
                      <span class="mdl-chip__text">Follow the instruction in email to reset the <a style="color: blue; text-decoration: none;">Password</a>.</span>
                  </span>
                  </div></center>
                  <!-- Snackbar starts -->
                  <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
                    <div class="mdl-snackbar__text"></div>
                    <button class="mdl-snackbar__action" type="button"></button>
                  </div>

                  <script>
                  r(function(){
                      var snackbarContainer = document.querySelector('#snackbar');
                      var data = { message: 'Account recovery email sent to <?php echo $email; ?>.'};
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                  });
                  function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
                  </script>
                  <!-- Snackbar ends -->
                  <!-- Snackbar starts -->
                  <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
                    <div class="mdl-snackbar__text"></div>
                    <button class="mdl-snackbar__action" type="button"></button>
                  </div>

                  <script>
                  r(function(){
                      var snackbarContainer = document.querySelector('#snackbar');
                      var data = { message: 'Follow the instruction in email to reset the password.'};
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                  });
                  function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
                  </script>
                  <!-- Snackbar ends -->
                  </div>
                  <?php
                          } 
                          else  {
                            //echo "Account Recovery mail sending failed<br>";
                            ?>
                  <div class="mdl-cell mdl-cell--12-col">
                  <br><center>
                  <!-- success/failure snippet -->
                  <div class="snippet">
                  <span class="mdl-chip mdl-chip--contact">
                      <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
                      <span class="mdl-chip__text">Account recovery email sending <a style="text-decoration: none;">failed</a>.</span>
                  </span>
                  </div></center>
                  <!-- Snackbar starts -->
                  <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
                    <div class="mdl-snackbar__text"></div>
                    <button class="mdl-snackbar__action" type="button"></button>
                  </div>

                  <script>
                  r(function(){
                      var snackbarContainer = document.querySelector('#snackbar');
                      var data = { message: 'Account recovery email sending failed.'};
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                  });
                  function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
                  </script>
                  <!-- Snackbar ends -->
                  </div>
                  <?php
                            }
                      }
                    }
                    else  {
                    
            ?>
                  <div class="mdl-cell mdl-cell--12-col">
                  <br><center>
                  <!-- success/failure snippet -->
                  <div class="snippet">
                  <span class="mdl-chip mdl-chip--contact">
                    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
                    <span class="mdl-chip__text">Incorrect Input fields <a style="color: blue; text-decoration: none;">Password Recovery Failed.</a></span>
                  </span>
                  </div></center>
                  <!-- Snackbar starts -->
                  <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
                    <div class="mdl-snackbar__text"></div>
                    <button class="mdl-snackbar__action" type="button"></button>
                  </div>

                  <script>
                  r(function(){
                      var snackbarContainer = document.querySelector('#snackbar');
                      var data = { message: 'Incorrect input fields, password recovery failed.'};
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                  });
                  function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
                  </script>
                  <!-- Snackbar ends -->
                  </div>
            <?php
                }
  }
  else  {
    //echo "reCAPTCHA validation failed<br>";
    ?>
              <br><center>
          <!-- success snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">reCAPTCHA validation <a style="color: blue; text-decoration: none;">failed.</span>
          </span>
          </div></center>
          <!-- Snackbar starts -->
          <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>

          <script>
          r(function(){
              var snackbarContainer = document.querySelector('#snackbar');
              var data = { message: 'reCAPTCHA validation failed.'};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
              <?php
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