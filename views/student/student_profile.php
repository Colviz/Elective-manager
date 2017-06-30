<?php
    include_once('views/student/student_dashboard.php');
?>
     
  <main class="mdl-layout__content mdl-color--grey-100">
    <div class="page-content">
    <!-- Your content goes here -->
<form class="update" action="" method="post">
<button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect" name="pubelec" value="pubelec" type="submit"> Published Electives </button> -
</form>
<form class="update" action="" method="post">
<button class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect" name="fillprior" value="fillprior" type="submit"> Apply for Elective </button>
</form>

<div class="mdl-grid">

<?php
      if(isset($_POST['pubelec']))  {
?>
<div class="mdl-cell mdl-cell--12-col">
  <div class="mdl-card__supporting-text">
    <h4>
      Published Electives - <a><?php   Database::publishedelectives();  ?></a>
    </h4>
  </div>
  <table class="mdl-data-table mdl-js-data-table">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Department</th>
      <th>Subject code</th>
      <th>Subject name</th>
      <th>Semester</th>
      <th>Total seats</th>
    </tr>
  </thead>
  <tbody>
        <?php  Database::publishedelectivesdetails();   ?>
  </tbody>
</table>
</div>
<?php
    }

      if(isset($_POST['fillprior']))  {
?>
<form class="admlog" action="/student/profile/apply" method="post">
    <h1 class="dept">Apply for elective</h1>
    <center><!-- This drop down feature here allows the superuser of one department to create normaluser of another, this feature can be vulnerable. This feature can be easily substituted with a secure one. -->
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



</div>
</div>
</main>
</div>
</body>
</html>