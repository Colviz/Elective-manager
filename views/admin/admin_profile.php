<?php
    include_once('views/admin/admin_dashboard.php');
?>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->


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

  <div class="table-responsive">
<?php 
  //create backup
  if (isset($_POST['backup'])) {
      $backup = Database::createbackup();

      if ($backup == 1) {
        echo "<b>Backup created successfully.</b>";
      } else  {
        echo "<b>Backup creation failed. Check if the backup table already exist.</b>";
      }
  }

  //catching the allotment form result
  //  $allot = 0;
  if (isset($_POST['allot'])) {
      $allot = Database::startallotment();

      if ($allot == 1) {
        echo "<b>Allotment successful.</b>";
      } else  {
        echo "<b>Allotment failed.</b>";
      }
  }
?>
<br><br>
  <button class="mdl-button mdl-js-button mdl-button--green mdl-button--raised mdl-js-ripple-effect">Ready for Allotment?</button>
  <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" href="/admin/alloted">View Allotment Result</a>
  <!-- The hidden div -->
  <div id="Hideit" style="display: none;">
    <br><p>Once you are ready for allotment (All departments have registered and all students have filled their priorities), just start the allotment by clicking on the button below.</p>
    When allotment is started, Please don't refresh/close page.<br>This might take few minutes.<br>
    <br><p><b>Note - Allotment once started can be undone.</b><br>Also It is recommended to create a backup of the priorities filled by students. Using the button below.</p><br>
    <form class="update" action="" method="post">
      <button name="backup" type="submit" value="true" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--colored">Create priorities backup</button>
    </form>

    <form class="update" action="" method="post">
      <button name="allot" type="submit" value="true" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent">Start Allotment</button>
    </form>
  </div>
    
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
