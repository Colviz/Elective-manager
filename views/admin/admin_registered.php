<?php
    include_once('views/admin/admin_dashboard.php');
?>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

    <div class="mdl-grid">
    <div class="mdl-cell mdl-cell--12-col">

    
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Registered students</h2>
  </div>
  <div class="table-responsive">
  <table id="result" class="mdl-data-table mdl-js-data-table">  
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Roll no.</th>
      <th class="mdl-data-table__cell--non-numeric">Name of Student</th>
      <th class="mdl-data-table__cell--non-numeric">Department of Student</th>
      </tr>
  </thead>
  <tbody>
        <?php  $result = Database::RegisteredStudents();   ?>
                
                
  </tbody>  
  </table>
</div>
</div>
</div>