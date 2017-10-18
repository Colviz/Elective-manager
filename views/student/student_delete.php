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
        
        <center>
        <div class="demo-card-wide1 mdl-card mdl-shadow--4dp">
        
<?php
      if (isset($_POST['stuchk'])) {
          $roll = $_POST['rollno'];

          $check = Database::studentaccountcheck($roll);

          if($check == 1)  {
            //echo "<b>Your account exists. <a>Have you activated it, before trying to login.</a></b>";
            ?>
            <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text"><a style="color: blue; text-decoration: none;"><?php echo $roll; ?></a> - Your account <a style="text-decoration: none;">Exists</a>.</span>
          </span>
          </div>
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Have you activated it? <a href="/activate" style="color: blue; text-decoration: none;">Before trying to login</a>.</span>
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
              var data = { message: '<?php echo $roll; ?> - Your account exists.',timeout: 4000};
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
              var data = { message: 'Have you activated it? Before trying to login.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
            <?php
          }
          else  {
            //echo "<b><a>Your account doesn't exist.</a><br>Register <a href ='/student/register'>here</a></b>";
            ?>
            <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text"><?php echo $roll; ?> - Your account doesn't <a style="color: blue; text-decoration: none;">exist</a>.</span>
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
              var data = { message: '<?php echo $roll; ?> - your account does not exist.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
            <?php
          }
      }
?>
        <form class="admlog" action="/student/delete" method="post">
        <h1 class="dept">Student Check if your account exists</h1>
        <input placeholder="Roll No" name="rollno" pattern="[A-Za-z0-9]{1,11}" type="text" required>

        <button class="login" type="submit" name="stuchk" value="stuchk">Check</button><br><br>
        </form>

        <div class="mdl-card__actions mdl-card--border"></div>
        <div class="mdl-card__title">
        <h4><b>Student, Having trouble activating account?</b></h4>
        </div>
        <span style="text-align: left;">
        Are you are facing trouble activating your account? Due to providing of wrong credentials(email,etc.)<br>
        
        <ul><b>Steps to solve the problem -</b>
          <li>Don't try to re-register, as it's not possible to register with the same roll no. more than once.</li>
          <li>Delete your unactivated account using the form below.</li>
          <li>After successfully deleting your unactivated account, create another account with your roll no. and provide valid credentials as they'll be used in case of account recovery(in case you forgot your password).</li>
        </ul>
        </span>
        <div class="mdl-card__actions mdl-card--border"></div>
<?php
      if (isset($_POST['studel'])) {
          $_POST['rollno'];
          $del = Database::studentaccountdelete($_POST['rollno']);
          if($del == 1)  {
              //echo "<br><a>Account successfully deleted<br>Check your account status using the above form.</a><br>";
            ?>
            <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Account successfully <a style="color: blue; text-decoration: none;">Deleted</a>.</span>
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
              var data = { message: 'Account successfully deleted.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
            <?php
          }
          else if($del == 2)  {
              //echo "<br><a>Account deletion failed<br>Your account is activated, proceed to login.</a><br>"; 
            ?>
            <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
              <span class="mdl-chip__text">Account deletion<a style="text-decoration: none;">Failed</a>.</span>
          </span>
          </div>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Your account is <a style="text-decoration: none;">Activated</a>. Proceed to login.</span>
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
              var data = { message: 'Account deletion failed. Your account is activated proceed to login.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
            <?php
          }
      }
?>
        <form class="admlog" action="/student/delete" method="post">
        <h1 class="dept">Student account deletion</h1>
        <input placeholder="Roll No" name="rollno" pattern="[A-Za-z0-9]{1,11}" type="text" required>

        <button class="login" type="submit" name="studel" value="studel">Delete account</button><br><br>
        <a href="/student/forget" style="text-decoration: none" target="_blank">Forgot Password?</a><br><br>
        <a href="/student/register" style="text-decoration: none" target="_blank">Not registered? Register here.</a><br><br>
        <a href="/student/delete" style="text-decoration: none" target="_blank">Having trouble activating account?</a>
        </form>
        Note - If your account is not deleted, then try to recover it from <a href="/student/forget">here.</a>

        </div>
        </center>
        </div>
