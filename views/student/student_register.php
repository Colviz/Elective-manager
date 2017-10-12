<?php
    include_once('views/includes/includes_header.php');
?>
    <!-- Below scripts added for datepicker -->
    <script src="../../views/design/js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.css" />
    <!-- Datepicker scripts ends -->

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

       if ( !empty($_POST['stureg'] && $_POST['g-recaptcha-response'])) {

        $captcha=$_POST['g-recaptcha-response'];
        $captcha = Database::reCAPTCHAvalidate($captcha);

        //checking for the recaptcha value
        if($captcha == 1) {
      
        //collecting values
        $rollno = $_POST['rollno'];
        $rollno = strtolower($rollno);
        $name = $_POST['sname'];
        $password = md5($_POST['pass']);
        $fname = $_POST['fname'];
        $regno = $_POST['regno'];
        $dob = $_POST['dob'];
        $dept = $_POST['dept'];
        $email = $_POST['email'];
        $mobileno = $_POST['no'];

        $token = Database::generateRandomString();
        $token = md5($token);

        //inserts data in students database       
        $ret = Database::studentregister($rollno,$name,$password,$fname,$regno,$dob,$dept,$mobileno,$email,$token);
  
         if ($ret == 1)  {
          
          //if user created successfully
          ?>
          <!-- Snackbar starts -->
          <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>

          <script>
          r(function(){
              var snackbarContainer = document.querySelector('#snackbar');
              var data = { message: 'Account created successfully.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
          <?php
          $to = $email;
          $subject = "Student account activation - nith.ac.in";
          $message = "Your Roll no. - $username\r\n Your password - $pass\r\n Your email - $email\r\n Your mobileno - $mobileno\r\n Your department - $department\r\n Your account activation code is - $token\r\nVisit /activate to activate your account\r\n";
        
          //mailing the details
          $mailit = Database::mailthedetails($to,$subject,$message);

          if($mailit == 1)  {
          //echo "Activate the account, using the activation link sent to - $email<br>Login credentials are also sent in the mail.<br>";
          ?>
          <!-- Snackbar starts -->
          <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>

          <script>
          r(function(){
              var snackbarContainer = document.querySelector('#snackbar');
              var data = { message: 'Activate the account, using the activation link sent to your provided email id.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
          <?php
          }
          else  {
          //echo "Account confirmation mail sending failed<br>";
            ?>
            <!-- Snackbar starts -->
            <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
              <div class="mdl-snackbar__text"></div>
              <button class="mdl-snackbar__action" type="button"></button>
            </div>

            <script>
            r(function(){
                var snackbarContainer = document.querySelector('#snackbar');
                var data = { message: 'Account confirmation mail sending failed.',timeout: 4000};
                snackbarContainer.MaterialSnackbar.showSnackbar(data);
            });
            function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
            </script>
            <!-- Snackbar ends -->
            <?php
          }
        }
        else  {
          //echo "User creation failed,Please try again<br>";
          ?>
          <!-- Snackbar starts -->
          <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>

          <script>
          r(function(){
              var snackbarContainer = document.querySelector('#snackbar');
              var data = { message: 'User account creation failed, Please try again.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
          <?php
        }
      
?>
<!-- Registration successful -->
<div class="snippet">
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
    <span class="mdl-chip__text"><a style="color: blue; text-decoration: none;"><?php echo "$username -"; ?></a> Registration Successful <a href="/activate" style="text-decoration: none;">Activate your account here</a>.</span>
</span>
</div>
<?php 
    header("refresh:3;url=/activate");
    }
    else  {
    echo "reCAPTCHA validation failed<br>";
  }
  }
    else {
?>

<form id="trial" class="studreg" action="/student/register" method="post">
         <h1 class="studentreg">Student Registration</h1>
         <input class="mdl-textfield_input" placeholder="Roll Number" name="rollno" pattern="[A-Za-z0-9]{1,11}" type="text" required>
         <input  class="mdl-textfield_input" type="text" name="sname"  placeholder ="Your Name" required>
         <input class="mdl-textfield_input" type="password" placeholder ="password" name="pass" id="pass" required>
         <input  class="mdl-textfield_input" type="text" name="fname"  placeholder ="Father's Name" required>
         <div style="text-align: center; color:#18aa8d;">Date Of Birth (yyyy-mm-dd)
         <input  class="mdl-textfield_input" name="dob" placeholder ="Date Of Birth (yyyy-mm-dd)" type="date" required></div>
         <input  class="mdl-textfield_input" type="text" name="regno" placeholder ="Registration No." required>
         <input  class="mdl-textfield_input" type="email" name="email" id="email" placeholder ="Email" required>
         <input  class="mdl-textfield_input" placeholder ="Moblie Number" type="text" name="no" pattern="[0-9]{10,10}" id="no" required>        
         <center>
        <select  name="dept" required>
      <option selected="true" disabled="disabled"> Choose Your Department ....</option>
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
      </select></center> <br>
      <!-- reCAPTCHA -->
      <div class="g-recaptcha" data-sitekey=<?php echo $reCAPTCHAsiteKey ?> align="center"></div><br>
        <button class="login" name="stureg" value="stureg" type="submit">
            Register
          </button>
        </form>           
<?php
    }
?>

    </div>
  </div>     
