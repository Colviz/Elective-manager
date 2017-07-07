<?php
    include_once('views/includes/includes_header.php');
    include_once('dbconnect.php');
?>
    <nav class="mdl-navigation">
      <a class="mdl-navigation__link" href="/about">About</a>
      <a class="mdl-navigation__link" href="/contact">Contact</a>
      <a class="mdl-navigation__link" href="/admin">Admin Interface</a>
      <a class="mdl-navigation__link" href="/department">Department Interface</a>
      <a class="mdl-navigation__link" href="/student">Student Interface</a>
    </nav>
  </div>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
   <center>
      <div class="demo-card-wide1 mdl-card mdl-shadow--4dp">
        <div class="mdl-card__title">
          <h2 class="mdl-card__title-text"><b>List of students applied for electives</b></h2>
        </div>
        <div class="mdl-card__actions mdl-card--border"></div>
        Select the subject to view the list of students applied for that subject.
        <div class="mdl-card__actions mdl-card--border"></div>

        <form action="/student/list" method="post">
        <br>
        <select name="code" required>
              <option selected = "true" disabled = "disabled">Select subject code ....</option>
              <?php 
              //fetching subjects of same department from subjects master
              Database::departmentpublishedelectives();
              ?>
        </select><br><br>

        <button class="login" name="eleccode" value="eleccode" type="submit">View list</button>
        </form>        
        <div class="mdl-card__actions mdl-card--border"></div>
  

<?php
      if (!empty($_POST['eleccode'] || $_POST['code'])) {
              
              //catching form values
              $code = $_POST['code'];

              $ret = Database::fetchstudentsappliedcount($code);
              if ($ret == 0) {
                  echo '<br><a style="color:red;">No student has applied for the elective - '.$code.' .</a>';
              }
              else {

              echo "<center><h3><a style='color:yellow;'>$ret</a> - Students have applied for <a style='color:yellow;'>$code</a></h3>";
              echo "The list below is sorted on the basis of <b>Priority</b> and <b>CGPI</b>.</center>";
?>
<script type="text/javascript">
window.onload = function() {

   document.getElementById('displaylist').getElementsByTagName('button')[0].focus();

}
</script>
<div id="displaylist"><button></button></div>
<div class="table-responsive">
  <table class="mdl-data-table mdl-js-data-table">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Roll no.</th>
      <th class="mdl-data-table__cell--non-numeric">Name</th>
      <th class="mdl-data-table__cell--non-numeric">Branch</th>
      <th>Priority</th>
    </tr>
  </thead>
  <tbody>
<?php  $ret = Database::fetchstudentsapplied($code); ?>
  </tbody>
  </table>
</div>
<?php
    }
  }
?>

<div class="mdl-card__actions mdl-card--border"></div>
</center>
  </div>
   