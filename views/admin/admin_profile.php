<?php
    include_once('views/admin/admin_dashboard.php');
?>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->

<div class="mdl-grid">

<div class="mdl-cell mdl-cell--12-col">
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