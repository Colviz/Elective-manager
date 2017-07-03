<?php
    include_once('views/student/student_dashboard.php');
?>
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<div class="mdl-cell mdl-cell--6-col">
<b>Your priorities for electives are as follows -</b><br>
<?php

          if(!empty($_POST['subpri']))  {

              $count = $_SESSION['tempcount'];
              //fetching the student cgpi
              $cgpi = Database::studentcgpi($_SESSION['login_user']);
              //printing the cached values
              for($i = 0; $i < $count; $i++) {
                
                echo "Priority ".$i." - ";
                echo $_POST[$i];
                echo "<br>";

                //insert these values in database
                $ret = Database::insertelectivepriorities($_SESSION['login_user'],$cgpi,$i,$_POST[$i]);
              }
              if($ret ==1) {
                  echo "<br>Priorities added to database.<br>";
                }
      ?>
    </div>
      <?php
      }
?>


    </div>