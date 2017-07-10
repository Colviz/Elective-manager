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
        if ( !empty($_POST)) {
      
        //collecting values
        $username = $_POST['uname'];
        $mobileno = $_POST['no'];
        $email = $_POST['email'];
    
        //Values authentication
        $check = Database::departmentrecovery($username,$mobileno,$email);

        //checking the return value
        if($check == 1)  {

          //generating the new password
          //calling the new password generating function
          $newpass = Database::generateRandomString(); //send this to user via email
          $newpassdb = md5($newpass); //insert this encrypted value in database

          //Replacing the existing password with new password
          $pass = Database::departmentchangepassword($username,$newpassdb);

          if($pass == 1)  {
          //send the new password in mail
          
          //subject of the email
          $subject = "Department - account recovery email, $username";

          //message content of the email
          $message = "Hey, $username<br>Your request to recover your password is received<br>Your new password is <b>$newpass</b> .<br>";

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
      else {
?>
      <div class="mdl-cell mdl-cell--6-col">
      
        <form class="admlog" action="/department/forget" method="post">
        <h3>Department Password recovery</h3>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" name="uname" pattern="[A-Za-z0-9]{1,15}" placeholder="Letters & Numerics" id="uname" required>
            <label class="mdl-textfield__label" for="uname">Username</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="email" name="email" id="email" required>
            <label class="mdl-textfield__label" for="email">Email</label>
            </div>
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" name="no" pattern="[0-9]{10,10}" id="no" required>
            <label class="mdl-textfield__label" for="no">Mobile no.</label>
            </div>
            <!-- Raised button with ripple -->
            <div>
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">
            Submit
          </button>
          </div>
        </form>
      </div>
      <?php
          }
      ?>


    </div>
  </div>