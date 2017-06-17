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
     
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
    <!-- Your content goes here -->
    <div class="mdl-grid">
<?php
      //Admin password recovery
      include_once('dbconnect.php');

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
          function generateRandomString($length = 10) {
          $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $charactersLength = strlen($characters);
          $randomString = '';
          for ($i = 0; $i < $length; $i++) {
              $randomString .= $characters[rand(0, $charactersLength - 1)];
          }
          return $randomString;
          }

          //calling the new password generating function
          $newpass = generateRandomString(); //send this to user via email
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
          //mail($email, $subject, $message);
          echo "<p>";
          echo "Account recovery email sent to $email. <br>";
          echo "Follow the instructions to reset the password. <br>";
          echo "</p>";

          //temporarily displaying the contents of the email
          echo "<p>";
          echo "<b>Below are the contents of the email</b> - Displaying here temporarily<br>";
          echo "<b>Subject</b> - $subject<br>";
          echo "<b>Message</b> - $message<br>";
          echo "</p>";
          }
        }
        else  {
        
?>
    <!-- Registration successful -->
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
    <span class="mdl-chip__text">Incorrect Input fields <a style="color: blue; text-decoration: none;">Password Recovery Failed.</a></span>
</span>
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