<?php
    include_once('views/department/department_dashboard.php');
?>
     
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->

<div class="mdl-grid">


<div class="mdl-cell mdl-cell--12-col">
<div class="demo-card-wide1 mdl-card mdl-shadow--4dp">
  <div class="mdl-card__supporting-text">
    <h4>
      Published Electives - <a><?php  Database::publishedelectivescount($login_session);  ?></a>
    </h4>
  </div>
  <center>
    <table class="mdl-data-table mdl-js-data-table">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Subject code</th>
      <th>Subject name</th>
      <th>Semester</th>
      <th>Link</th>
      <th>Info</th>
      <th>Total seats</th>
    </tr>
  </thead>
  <tbody>
      <?php        Database::userpublishedelectives($login_session);  ?>
  </tbody>
  </center>
</table>
</div>
</div>

  <?php
        if(isset($_POST['update']))  {
            //updating code here
          ?>
          <div class="mdl-cell mdl-cell--6-col">
<div class="demo-card-wide1 mdl-card mdl-shadow--4dp">
  <div class="mdl-card__supporting-text">
    <h4>
      Update <a><?php echo $_POST['update']; ?></a>
    </h4>
  </div>
  
</div>
</div>
          <?php
        }

  ?>


  		

	</div>
  </div>
  </main>
  </div>
  </body>
  </html>