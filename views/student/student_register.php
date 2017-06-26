<?php
    include_once('views/includes/includes_header.php');
?>
    <!-- Below scripts added for datepicker -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
     
  <main class="mdl-layout__content mdl-color--grey-100">
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
        $rollno= $_POST['rollno'];
        $password = md5($_POST['pass']);
        $fname=$_POST['fname'];
        $regno=$_POST['regno'];
        $dob=$_POST['dob'];
        $dept=$_POST['dept'];
        $email = $_POST['email'];
        $mobileno = $_POST['no'];
        

        //inserts data in students database       
        Database::studentregister($rollno,$password,$fname,$regno,$dob,$dept,$mobileno,$email,$token);
  
    
?>
    <!-- Registration successful -->
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
    <span class="mdl-chip__text"><a style="color: blue; text-decoration: none;"><?php echo "$username -"; ?></a> Registration Successful <a href="/activate" style="text-decoration: none;">Activate your account here</a>.</span>
</span>
<?php 
    header("refresh:3;url=/activate");
    }
    else  {
    echo "reCAPTCHA validation failed<br>";
  }
  }
    else {
?>

<form class="studreg" action="/student/register" method="post">
         <h1 class="studentreg">Student Registration</h1>
         <input class="mdl-textfield_input" placeholder="Roll Number" name="rollno" pattern="[A-Za-z0-9]{1,7}" type="text" required>
         <input class="mdl-textfield_input" type="password" placeholder ="password" name="pass" id="pass" required>
         <input  class="mdl-textfield_input" type="text" name="fname"  placeholder ="Father's Name" required>
         <div style="text-align: center; color:#18aa8d;">Date Of Birth (dd/mm/yyyy)
         <input  class="mdl-textfield_input" name="dob" placeholder ="Date Of Birth (dd/mm/yyyy)" type="date" class="date start" required></div>
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
      <div class="g-recaptcha" data-sitekey="6LeITyYUAAAAAMv47yYgyOkPpBI-tr__XTvc0LlQ" align="center"></div><br>
        <button class="login" name="stureg" value="stureg" type="submit">
            Register
          </button>
        </form>     
        <script>
                $('#jqueryExample .date').datepicker({
                    'format': 'd/m/yyyy',
                    'autoclose': true
                });
        </script>
      
<?php
    }
?>

    </div>
  </div>     
