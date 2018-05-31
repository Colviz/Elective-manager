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
        if (isset($_POST['sturec'])) {

      
        //collecting values
        $username = $_POST['uname'];
        $mobileno = $_POST['no'];
        $email = $_POST['email'];
    
        //Values authentication
        $check = Database::studentrecovery($username,$mobileno,$email);
      
        //checking the return value
        if($check == 1)  {

          //generating the new password
          //calling the new password generating function
          $newpass = Database::generateRandomString(); //send this to user via email
          $newpassdb = md5($newpass); //insert this encrypted value in database

          //Replacing the existing password with new password
          $pass = Database::studentchangepassword($username,$newpassdb);

          if($pass == 1)  {
          //send the new password in mail
          
          //subject of the email
          $subject = "Student - account recovery email, $username";

          //message content of the email
          $message = "Hey, $username<br>Your request to recover your password is received<br>Your new password is <b>$newpass</b> .<br>";

          //sending the email
          $mailit = Database::mailthedetails($email,$subject,$message);

                if($mailit == 1)  {
                  //echo "Account recovery email sent to $email. <br>";
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
                      var data = { message: 'Account recovery email sent to <?php echo $email; ?>.',timeout: 4000};
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
                      var data = { message: 'Follow the instruction in email to reset the password.',timeout: 4000};
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
                      var data = { message: 'Account recovery email sending failed.',timeout: 4000};
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
                      var data = { message: 'Incorrect input fields, password recovery failed.',timeout: 4000};
                      snackbarContainer.MaterialSnackbar.showSnackbar(data);
                  });
                  function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
                  </script>
                  <!-- Snackbar ends -->
                  </div>
<?php
    }
  }
      else {
?>
      <div class="mdl-cell mdl-cell--6-col">
      
        <form class="admlog" action="/student/forget" method="post">
        <h1 class="dept">Student Password recovery</h1>
        <input placeholder="Roll No" name="uname" pattern="[A-Za-z0-9]{1,11}" type="text" required>
        <input placeholder="Email" type="email" name="email" id="email" required>
        <input placeholder="Mobile no." type="text" name="no" pattern="[0-9]{10,10}" id="no" required>

        <button class="login" type="submit" name="sturec" value="sturec">Recover Account</button><br><br>
        </form>
      </div>
      <?php
          }
      ?>


    </div>
  </div>
