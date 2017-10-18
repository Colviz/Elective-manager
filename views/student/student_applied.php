<?php
    include_once('views/student/student_dashboard.php');
?>
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<div class="mdl-cell mdl-cell--12-col">
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
                  //echo "<br><b>Priorities added to database.</b><br>";
                ?>
                <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Priorities successfully added to <a style="color: blue; text-decoration: none;">Database</a>.</span>
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
              var data = { message: 'Priorities successfully added to database.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
          <a class="mdl-button mdl-js-ripple-effect stuleft mdl-button--accent" href="/student/profile">Go to your Profile</a>
                <?php
                }
                else {
                  //echo "<br><b>Priorities added to database.</b><br>";
                ?>
                <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">F</span>
              <span class="mdl-chip__text">Failed to add Priorities to <a style="color: blue; text-decoration: none;">Database</a>. Duplicate entry found.</span>
          </span>
          </div>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
          <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">D</span>
              <span class="mdl-chip__text">Delete existing priorities and <a style="color: blue; text-decoration: none;">Try again</a>.</span>
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
              var data = { message: 'Failed to add priorities to database. Duplicate entry found. Delete existing priorities and try again.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
          <a class="mdl-button mdl-js-ripple-effect stuleft mdl-button--accent" href="/student/profile">Go to your Profile</a>
                <?php
                }
      ?>
    </center>
    </div>
      <?php
      }
?>


    </div>
