<?php
    include_once('views/student/student_dashboard.php');
?>
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->
<?php

        if ( !empty($_POST['elective'])) {

          $elec = $_POST['type'];
          $elective = $_POST['type'];
          
          switch ($elective) {
            case 'open_elective':
            $elective = "Open Elective";
             break;

            case 'dept_elective':
            $elective = "Departmental Elective";
            break;

            case 'pg_elective':
            $elective = "PG Elective";
            break;            
          }

            //fetching students department
            $department = Database::studentdepartment($_SESSION['login_user']);

            //count the no. of electives
            $count = Database::studentelectivescount($elec,$department);
            $_SESSION['tempcount'] = $count;
            if ($count == 0 || $count == '') {
              echo "<center><b>No $elective published at this time<br>Try after sometime.<b></center>";
            }
            else  {
      ?>
    <div class="mdl-cell mdl-cell--6-col">
    <form action="/student/profile/applied" method="post">
    <h1 class="dept">Prioritize <?php echo $elective; ?></h1>
<div class="table-responsive">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
    <th style="text-align: left; font-size: 1.1em;">Priority | Subject code - Subject name - Seats</th>
    </tr>
  </thead>
      <?php 
              echo "<tbody>";
              echo '<tr><td>';
              for ($i=0; $i < $count; $i++) { 
              
              echo "<b>Priority <a>$i</a> </b>- ";
              
              echo '<select name="'.$i.'" class="go" required>';
              echo '<option selected="true" disabled="disabled">Select the course....</option>';
              //fetching published electives
              Database::publishedelectivespriority($elec,$department);
              echo '</select><br><br>';
              
              }
              echo '</td></tr">';
              echo "</tbody>";
      ?>
</table>
</div>
    <br><br><button name="subpri" value="subpri" class="login" type="submit">Submit priorities</button>
        </form>
</div>

      <?php
      }
    }
?>

</div>