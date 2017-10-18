<?php
    include_once('views/admin/admin_dashboard.php');
?>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<?php 
  //catching the allotment form result
  $allot = 0;
  if (isset($_POST['allot']) && $_POST['allot'] == true) {
      $allot = 1;
  }
?>
<!-- Wide card with share menu button -->

<div class="mdl-grid">

<div class="mdl-cell mdl-cell--6-col">
  <div class="mdl-card__supporting-text">
    <h4>
      Registered Departments - <a><?php   $redept = Database::registereddepartments();  ?></a>
    </h4>
  </div>
  <div class="table-responsive">
  <table class="mdl-data-table mdl-js-data-table">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Department</th>
      <th>Username</th>
      <th>Registered on</th>
    </tr>
  </thead>
  <tbody>
      <?php        Database::registereddepartmentsdetails();  ?>
  </tbody>
</table>
</div>
</div>

<div class="mdl-cell mdl-cell--6-col">
  <div class="mdl-card__supporting-text">
    <h4>
      Start Allotment 
    </h4>
  </div>
  <?php
    if ($allot == 0)  {
  ?>
  <div class="table-responsive">
  <button class="mdl-button mdl-js-button mdl-button--green mdl-button--raised mdl-js-ripple-effect">Ready for Allotment?</button>

  <!-- The hidden div -->
  <div id="Hideit" style="display: none;">
    <br><p>Once you are ready for allotment (All departments have registered and all students have filled their priorities), just start the allotment by clicking on the button below.</p>
    <br><p><b>Note - Allotment once started can't be undone.</b></p><br>
    <form class="update" action="" method="post">
      <button name="allot" type="submit" value="true" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Start Allotment</button>
    </form>
  </div>
  <?php 
    } else  {
  ?>
  <div class="table-responsive">
    <p><b>Allotting electives......</b></p>

    <!-- Snackbar starts -->
          <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>

          <script>
          r(function(){
              var snackbarContainer = document.querySelector('#snackbar');
              var data = { message: 'Elective Allotment Complete.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
<!-- Snackbar ends -->

  

  <?php 
    }
  ?>
</div>
</div>


<div class="mdl-cell mdl-cell--12-col">
  <div class="mdl-card__supporting-text">
    <h4>
      Published Electives - <a><?php   Database::publishedelectives();  ?></a>
    </h4>
  </div>
  <div class="table-responsive">
  <table class="mdl-data-table mdl-js-data-table">
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

</div>
</div>
