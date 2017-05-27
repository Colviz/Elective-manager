<?php
		include_once('views/includes/header.php');
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
	   	//Admin registration
    	include_once('dbconnect.php');

        if ( !empty($_POST)) {
      
        //collecting values
        $username = $_POST['uname'];
        $password = md5($_POST['pass']);
        
 		//inserts data in admin registration database       
        $ret = Database::adminlogin($username,$password);
        
        //checking the return value from the database
        if ($ret == 1)	{
        	
        	$_SESSION['login_user'] = $username;

        	include_once('views/admin/admin_session.php');

        	//header("location: /admin/profile/");
        }
        else 	{
        
?>
    <!-- Registration successful -->
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
    <span class="mdl-chip__text">Incorrect <a style="color: blue; text-decoration: none;">Username or Password</a> Login Failed <a href="/admin/login" style="text-decoration: none;">Login here</a>.</span>
</span>
<?php
		}
	}
?>
  		<div class="mdl-cell mdl-cell--6-col">
			
			  <form class="admreg" action="/admin/login" method="post">
			  <h3>Admin Login</h3>
			  		<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="text" name="uname" pattern="[A-Za-z0-9]{1,15}" placeholder="Letters & Numerics" id="uname" required>
    				<label class="mdl-textfield__label" for="uname">Username</label>
  					</div>
  					<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
    				<input class="mdl-textfield__input" type="password" name="pass" pattern="[A-Za-z0-9]+" id="pass" required>
    				<label class="mdl-textfield__label" for="pass">Password</label>
  					</div>
  					<!-- Raised button with ripple -->
  					<div>
					<button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">
  					Login
					</button>
					</div>
				</form>			
			</div>


  	</div>
  	<?php
  			include_once('views/admin/admin_session.php');
  	?>
  		

		</div>
		
     </div>
  </main>
</div>

    <script src="../views/design/js/material.min.js"></script>
  </body>
</html>
