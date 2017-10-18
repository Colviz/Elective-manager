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
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
    <div class="mdl-grid">

<?php
      //Admin registration
      include_once('dbconnect.php');
      
      //automatic login if session is set
      session_start();
      echo $_SESSION['login_user'];
      
      if(isset($_SESSION['login_user']))  {

          header("location: /admin/profile");
      }

        if (!empty($_POST['admlog'] && $_POST['g-recaptcha-response'])) {
      
            $captcha=$_POST['g-recaptcha-response'];
            $captcha = Database::reCAPTCHAvalidate($captcha);

              //checking for the recaptcha value
                if($captcha == 1) {

                  //collecting values
                          $username = $_POST['uname'];
                          $password = md5($_POST['pass']);
                    
                        //inserts data in admin registration database       
                    $ret = Database::adminlogin($username,$password);
                    
                    //checking the return value from the database
                    if ($ret == 1)  {
                      
                      session_start();
                      $_SESSION['login_user'] = $username;

                      include_once('views/admin/admin_session.php');

                      header("location: /admin/profile");
                    }
                    else  {
        
?>
<br>
<!-- Login unsuccessful -->
<div class="snippet">
<span class="mdl-chip mdl-chip--contact">
  <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
  <span class="mdl-chip__text">Incorrect <a style="color: blue; text-decoration: none;">Username or Password</a> Login Failed <a href="/admin/login" style="text-decoration: none;">Login here</a>.</span>
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
    var data = { message: 'Incorrect Username/Password. Login failed.',timeout: 4000};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
});
function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
</script>
<!-- Snackbar ends -->
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
              var data = { message: 'reCAPTCHA validation failed.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
              <?php
  }
}
?>
      
      
        <form class="admlog" action="/admin/login" method="post">
        <h1 class="dept">Admin login</h1>
            <input placeholder="Username" name="uname" pattern="[A-Za-z0-9]{1,15}" type="text" required>
            <input placeholder="Password" name="pass" type="password" required>
            
            <!-- reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey=<?php echo $reCAPTCHAsiteKey ?> align="center"></div><br>
            <!-- Raised button with ripple -->
            <button class="login" name="admlog" value="admlog" type="submit">Login</button>
            <a href="/admin/forget" style="text-decoration: none" target="_blank">Forgot Password?</a>
        </form>
        

    </div>
