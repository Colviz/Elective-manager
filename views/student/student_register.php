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
      //Admin registration
      include_once('dbconnect.php');

       if ( !empty($_POST)) {
      
        //collecting values
        $rollno= $_POST['rollno'];
        $password = md5($_POST['pass']);
        $fName=$_POST['fname'];
        $regno=$_POST['regno'];
        $dob=$_POST['dob'];
        $dept=$_POST['dept'];
        $email = $_POST['email'];
        $mobileno = $_POST['no'];
        $token = Database::generateRandomString();
        $token = md5($token);
    
    //inserts data in students database       
        Database::studentregister($rollno,$password,$fName,$dob,$regno,$email,$mobileno,$dept,$token);
  
    
?>
    <!-- Registration successful -->
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
    <span class="mdl-chip__text"><a style="color: blue; text-decoration: none;"><?php echo "$username -"; ?></a> Registration Successful <a href="/student/login" style="text-decoration: none;">Login here</a>.</span>
</span>
<?php 

    header("refresh:5;url=/student/login");
    }
    else {
?>
<form class="studreg" action="/student/register" method="post">
         
              <h1 class="studentreg">Student Registration</h1>
            
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield_input" placeholder="Roll Number" name="rollno" pattern="[A-Za-z0-9]{1,7}" type="text" required>
        </div>

        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield_input" type="password" placeholder ="password" name="pass" pattern="[A-Za-z0-9]+" id="pass" required>
        </div>
       
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input  class="mdl-textfield_input" type="text" name="fname"  placeholder ="Father's Name" required>
        </div>


      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input  class="mdl-textfield_input" type="date" name="dob" placeholder ="DOB(DD-MM-YYYY)" required>
        </div>


           
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input  class="mdl-textfield_input" type="text" name="regno" placeholder ="Registration No." required>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input  class="mdl-textfield_input" type="email" name="email" id="email" placeholder ="Email" required>
        </div>
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input  class="mdl-textfield_input" placeholder ="Moblie Number" type="text" name="no" pattern="[0-9]{10,10}" id="no" required>
          </div>
         <center>
        <!-- This drop down feature here allows the superuser of one department to create normaluser of another, this feature can be vulnerable. This feature can be easily substituted with a secure one. -->
    <select name="dept" required>
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
</select></center> <br><br>

        
          <button class="regbutton" type="submit">
            Register
          </button>
        </div>
       
            
        
          
          
        </form>     
      
<?php
    }
?>

    </div>
  </div>     
