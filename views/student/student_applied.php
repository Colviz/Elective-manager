<?php
    include_once('views/student/student_dashboard.php');
?>
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<div class="mdl-cell mdl-cell--6-col">
<center>
<div class="table-responsive">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <b>Your priorities for electives are as follows</b>
  <thead>
    <tr>
    <th>Priority</th>
    <th>Subject code</th>
    </tr>
  </thead>
<?php

          if(!empty($_POST['subpri']))  {

              $count = $_SESSION['tempcount'];
              //fetching the student cgpi
              $cgpi = Database::studentcgpi($_SESSION['login_user']);
              
              echo "<tbody>";
              //printing the cached values
              for($i = 0; $i < $count; $i++) {
                
                echo '<tr><td>';
                echo "Priority ".$i."";
                echo '</td><td>';
                echo $_POST[$i];
                echo '</td></tr">';

                //insert these values in database
                $ret = Database::insertelectivepriorities($_SESSION['login_user'],$cgpi,$i,$_POST[$i]);
              }
              echo "</tbody></table></div>";

              if($ret ==1) {
                  echo "<br><b>Priorities added to database.</b><br>";
                }
      ?>
    </center>
    </div>
      <?php
      }
?>


    </div>