<?php
    include_once('views/department/department_dashboard.php');
    include_once('dbconnect.php');
?>

  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->
<?php
        if ( !empty($_POST['reguser'])) {
      
        //collecting values
        $username = $_POST['uname'];
        $pass = $_POST['pass'];
        $password = md5($pass);
        $email = $_POST['email'];
        $mobileno = $_POST['mobileno'];
        $department = $_POST['department'];
        //generating the token
        $token = Database::generateRandomString();
        $token = md5($token);
        
        //inserts data in users login database       
        $ret = Database::departmentregister($username,$password,$mobileno,$email,$department,$token);

        //getting the full name of department
        $department = Database::departmentsname($department);
        
        //checking the return value from the database
        if ($ret == 1)  {
          
          //if user created successfully
          echo " - Department user created successfully<br>";
          
          //writing the details to variables
          $to = $email;
          $subject = "Departmental account activation - nith.ac.in";
          $message = "Your username - $username\r\n Your password - $pass\r\n Your email - $email\r\n Your mobileno - $mobileno\r\n Your department - $department\r\n Your account activation code is - $token\r\nVisit /activate to activate your account\r\n";
          //mailing the details
          $mailit = Database::mailthedetails($to,$subject,$message);

          if($mailit == 1)	{
          		echo "Activate the account, using the activation link sent to - $email<br>Login credentials are also sent in the mail.<br>";
          }
          else 	{
          	echo "Account confirmation mail sending failed<br>";
          }
        }
        else 	{
        	echo "Department user creation failed<br>";
        }
      }
      else  {

?>
<div class="mdl-grid">


<div class="mdl-cell mdl-cell--6-col">

    <form class="admlog" action="/department/profile/register" method="post">
            <h1 class="dept">Create - Department user</h1>
		<input placeholder="Username" name="uname" pattern="[A-Za-z0-9]{1,15}" type="text" required>
		<input placeholder="Password" name="pass" pattern="[A-Za-z0-9]+" type="password" required>
		<input placeholder="Email" name="email" type="email" required>
		<input placeholder="Mobile no." name="mobileno" pattern="[0-9]{10,10}" type="text" required>
		<center><!-- This drop down feature here allows the superuser of one department to create normaluser of another, this feature can be vulnerable. This feature can be easily substituted with a secure one. -->
		<select name="department" required>
		  <option>Choose Your Department ....</option>
		  <option value="csed">Computer Science & Engineering</option>
		  <option value="ched">Chemical Engineering</option>
		  <option value="civi">Civil Engineering</option>
		  <option value="eced">Electronics and Communication Engineering</option>
		  <option value="eeed">Electrical Engineering</option>
		  <option value="med">Mechanical Engineering</option>
		  <option value="msed">Materials Science and Engineering</option>
		  <option value="arch">Architecture</option>
		  <option value="phys">Physics</option>
		  <option value="chem">Chemistry</option>
		  <option value="math">Maths</option>
		  <option value="huma">Management and Humanities</option>		  
		</select></center> <br><br>

		<button name="reguser" value="reguser" class="login" type="submit">Create User</button>
        </form>
</div>
<?php
      }
?>


		</div>
  </div>
  </main>
</div>

    <script src="../../views/design/js/material.min.js"></script>
    <script src="../../views/design/js/style.js"></script>
  </body>
</html>