<?php
		include_once('views/includes/includes_header.php');
  /**
   * DATABASE CONNECTING API FILE IS NOT INCLUDED HERE
   * Hence due to that the captcha on this page won't work
   */
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
      //automatic login if session is set
      session_start();
      echo $_SESSION['login_user'];
      
      if(isset($_SESSION['login_user']))  {

          header("location: /admin/profile");
      }

        if ( !empty($_POST['admreg'] && $_POST['g-recaptcha-response'])) {

            $captcha=$_POST['g-recaptcha-response'];
            $captcha = Database::reCAPTCHAvalidate($captcha);
      
        //checking for the recaptcha value
                if($captcha == 1) {

        //collecting values
        $username = $_POST['uname'];
        $password = md5($_POST['pass']);
        $mobileno = $_POST['no'];
        $email = $_POST['email'];
 		
 		//inserts data in admin registration database       
        Database::adminregister($username,$password,$mobileno,$email);
	
    
?>
          <br><center>
          <!-- success snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Admin added <a style="color: blue; text-decoration: none;">successfully. </span>
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
              var data = { message: 'Admin account added successfully.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
<?php 

    header("refresh:5;url=/admin/login");
  }
  else  {
    //echo "reCAPTCHA validation failed<br>";
    ?>
          <br><center>
          <!-- success snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">reCAPTCHA validation <a style="color: blue; text-decoration: none;">Failed.</span>
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
		else {
?>

	 
  		<div class="mdl-cell mdl-cell--6-col">
			
			  <form class="admreg" action="/admin/register" method="post">
			  <h3>Admin Registration form</h3>
			  		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="text" name="uname" pattern="[A-Za-z0-9]{1,15}" placeholder="Letters & Numerics" id="uname" required>
    				<label class="mdl-textfield__label" for="uname">Username</label>
  					</div>
  					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="password" name="pass" id="pass" required>
    				<label class="mdl-textfield__label" for="pass">Password</label>
  					</div>
  					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="email" name="email" id="email" required>
    				<label class="mdl-textfield__label" for="email">Email</label>
  					</div>
  					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="text" name="no" pattern="[0-9]{10,10}" id="no" required>
    				<label class="mdl-textfield__label" for="no">Mobile no.</label>
  					</div>

            <!-- reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey=<?php echo $reCAPTCHAsiteKey ?> align="center"></div><br>

  					<!-- Raised button with ripple -->
  					<div>
					<button type="submit" name="admreg" value="admreg" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">
  					Register
					</button>
					</div>
				</form>			
			</div>
<?php
		}
?>

  	</div>
  </div>     
