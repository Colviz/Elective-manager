<?php
    include_once('views/student/student_dashboard.php');
    
        // checks for requested updates 
        if (isset($_POST['up']) || isset($_POST['down'])) {

        //updating the user priority
        if(isset($_POST['up'])) {
          $upd = Database::upstudentpriority($_POST['up'],$_SESSION['login_user']);
          if ($upd == 1) {
          ?>
          <!-- Snackbar starts -->
<div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<script>
r(function(){
    var snackbarContainer = document.querySelector('#snackbar');
    var data = { message: 'Elective priority updated.',timeout: 4000};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
});
function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
</script>
<!-- Snackbar ends -->
          <?php
          }
          else  {
          ?>
          <!-- Snackbar starts -->
<div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<script>
r(function(){
    var snackbarContainer = document.querySelector('#snackbar');
    var data = { message: 'Failed ro update elective priority',timeout: 4000};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
});
function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
</script>
<!-- Snackbar ends -->
          <?php
          }  
        }
        else {
          $dwd = Database::downstudentpriority($_POST['down'],$_SESSION['login_user']);
          if ($dwd == 1) {
          ?>
          <!-- Snackbar starts -->
<div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<script>
r(function(){
    var snackbarContainer = document.querySelector('#snackbar');
    var data = { message: 'Elective priority updated.',timeout: 4000};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
});
function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
</script>
<!-- Snackbar ends -->
          <?php
          }
          else  {
          ?>
          <!-- Snackbar starts -->
<div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<script>
r(function(){
    var snackbarContainer = document.querySelector('#snackbar');
    var data = { message: 'Failed ro update elective priority',timeout: 4000};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
});
function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
</script>
<!-- Snackbar ends -->
          <?php
          }
        }
      } 

      //if elective is deleted
      if (isset($_POST['delete'])) {
        
        //deleting the user priority
        $dlt = Database::deletepriority($_POST['delete'],$_SESSION['login_user']);

        if ($dlt == 1) {
          ?>
          <!-- Snackbar starts -->
<div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
  <div class="mdl-snackbar__text"></div>
  <button class="mdl-snackbar__action" type="button"></button>
</div>

<script>
r(function(){
    var snackbarContainer = document.querySelector('#snackbar');
    var data = { message: 'Elective priority deleted.',timeout: 4000};
    snackbarContainer.MaterialSnackbar.showSnackbar(data);
});
function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
</script>
<!-- Snackbar ends -->
          <?php
        }
      }
?>   
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
    <hr><center>
<form class="update" action="" method="post">
<button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect" name="pubelec" value="pubelec" type="submit"> Published Electives </button> 
</form><a style="padding-left: 10px;"></a>
<form class="update" action="" method="post">
<button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect" name="fillprior" value="fillprior" type="submit"> Apply for Elective </button>
</form>
</center>
<hr>
<div class="mdl-grid">
<?php
      if(isset($_POST['pubelec']))  {
?>
<div class="mdl-cell">
  <div class="mdl-card__supporting-text">
    <h4>
      Published Electives - <a><?php   Database::publishedelectives();  ?></a>
    </h4>
  </div>
  <div class="table-responsive">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Department</th>
      <th>Subject Code</th>
      <th class="mdl-data-table__cell--non-numeric">Subject Name</th>
      <th class="mdl-data-table__cell--non-numeric">Subject Type</th>
      <th class="mdl-data-table__cell--non-numeric">Syllabus Link</th>
      <th class="mdl-data-table__cell--non-numeric">Info</th>
      <th>Semester</th>
      <th>Total Seats</th>
    </tr>
  </thead>
  <tbody>
        <?php  Database::publishedelectivesdetails();   ?>
  </tbody>
</table>
</div>
</div>
<?php
    } ?>
</div>
    <?php

      if(isset($_POST['fillprior']))  {
?>
<form class="admlog" action="/student/profile/apply" method="post">
    <h1 class="dept">Apply for elective</h1>
    <center>
      <select name="type" required>
      <option selected="true" disabled="disabled">Choose the type of Elective</option>
      <option value="open_elective">Open Elective</option>
      <option value="dept_elective">Departmental Elective</option>
      <option value="pg_elective">PG Elective</option>
      </select></center> <br><br>

    <button name="elective" value="elective" class="login" type="submit">Next</button>
</form>
<?php
    }
?>
<div class="mdl-grid">
<div class="mdl-cell">
  <div class="mdl-card__supporting-text">
    <h4>Applied for Electives - <a><?php $count = Database::appliedforelectivescount($_SESSION['login_user']); 
                                                 echo "</a>"; 
        if($count !=0 )  {
    ?>
    </h4>
  </div>
  <div class="table-responsive">
  <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Subject code</th>
      <th class="mdl-data-table__cell--non-numeric">Subject name</th>
      <th>Priority</th>
      <th>CGPI</th>
      <th>Students applied</th>
      <th class="mdl-data-table__cell--non-numeric">Update</th>
      <th class="mdl-data-table__cell--non-numeric">Delete</th>
    </tr>
  </thead>
  <tbody>
        <?php  Database::appliedforelectives($_SESSION['login_user'],$count);   ?>
  </tbody>
</table>
<?php
}
?>
</div>
</div>


</div>
</div>
