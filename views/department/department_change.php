<?php
		//include_once('views/includes/header.php');
    include_once('dbconnect.php');
    include_once('views/department/department_session.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Introducing Lollipop, a sweet new take on Android.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Elective Manager</title>

    <!-- Page styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="../views/design/css/material.css">
    <link rel="stylesheet" href="../views/design/css/style.css">
    </head>
  <body>
    <!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title"><a href="/department/profile" style="text-decoration: none; color: black">Welcome <?php echo $login_session; ?></a></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation -->
      <nav class="mdl-navigation">
        <a href="/department/logout"><button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">Logout</button></a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/about">About</a>
      <a class="mdl-navigation__link" href="/contact">Contact</a>
      <a class="mdl-navigation__link" href="/department">Department Interface</a>
      </nav>
  </div>
     
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->
<?php
      include_once('dbconnect.php');

        if ( !empty($_POST)) {
      
        //collecting values
        $username = $_SESSION['login_user'];
        $newpassdb = md5($_POST['newpass']);
        
        //inserts data in admin login database       
        $pass = Database::departmentchangepassword($username,$newpassdb);
        
        //checking the return value from the database
        if ($pass == 1)  {
          
          //if password updated successfully
          echo "Password updated successfully<br>You're being logged out in 5 seconds<br>";
          header("refresh:5;url=/department/logout");
          
        }
      }
      else  {

?>
<div class="mdl-grid">


<div class="mdl-cell mdl-cell--6-col">
<div class="demo-card-wide1 mdl-card mdl-shadow--4dp">
  <div class="mdl-card__supporting-text">
    <h4>
      <a><?php echo $_SESSION['login_user']; ?></a> Change Password
    </h4>
  </div>
    <form class="admlog" action="/department/change" method="post">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="password" name="newpass" pattern="[A-Za-z0-9]+" id="newpass" required>
            <label class="mdl-textfield__label" for="pass">New Password</label>
            </div>
            <!-- Raised button with ripple -->
            <div>
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">
            Change Password
          </button>
          </div>
        </form>
        <a style="text-decoration: none;" href="/department/forget"><button class="mdl-button mdl-js-button mdl-button--colored mdl-js-ripple-effect">
            Forgot current Password? Recover here!
        </button></a>
</div>
</div>
<?php
      }
?>


		</div>
  </div>
  </main>
</div>

    <script src="../views/design/js/material.min.js"></script>
    <script src="../views/design/js/style.js"></script>
  </body>
</html>