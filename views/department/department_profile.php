<?php
    include_once('views/department/department_dashboard.php');
?>
 
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
    <?php
      //deactivating the elective
        if(isset($_POST['delete']))  {

          $dlt = Database::deactivateelective($_POST['delete']);

          if($dlt == 1) {
            ?>
            <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Elective successfully <a style="color: blue; text-decoration: none;">Deleted</a>.</span>
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
              var data = { message: 'Elective successfully deleted.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
            <?php
          }
          else {
            ?>
            <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Failed to delete Elective.</span>
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
              var data = { message: 'Failed to delete elective.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
            <?php
          }
        }

        //republishing the deleted elective
        if(isset($_POST['republish']))  {

          $rep = Database::republishelective($_POST['republish']);

          if($rep == 1) {
            ?>
            <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Elective successfully <a style="color: blue; text-decoration: none;">Republished</a>.</span>
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
              var data = { message: 'Elective successfully republished.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
            <?php
          }
          else {
            ?>
            <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Failed to Republish elective.</span>
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
              var data = { message: 'Failed to republish elective.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
            <?php
          }
        }

        //updating electives values
        if(isset($_POST['upelec'])) {
          //catching values
                $_POST['seats'];
                $_POST['link'];
                $_POST['info'];
                $_POST['sem'];
                $_POST['upelec'];

      //updating values in database
      $ret = Database::updateelective($_POST['seats'],$_POST['link'],$_POST['info'],$_POST['sem'],$_POST['upelec']);
                if($ret == 1)  {
                  ?>
                  <br><center>
          <!-- success/failure snippet -->
          <div class="snippet">
          <span class="mdl-chip mdl-chip--contact">
              <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
              <span class="mdl-chip__text">Elective successfully <a style="color: blue; text-decoration: none;">Updated</a>.</span>
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
              var data = { message: 'Elective successfully updated.',timeout: 4000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
          <!-- Snackbar ends -->
                  <?php
                }
        }
?>    

<!-- Wide card with share menu button -->

<div class="mdl-grid">


<div class="mdl-cell mdl-cell--12-col">
  <div class="mdl-card__supporting-text">
    <h4>
      Published Electives - <a><?php  $eleccount = Database::publishedelectivescount($login_session,$user_type);  
                                      echo "</a>";
      if($eleccount != 0)  {
      
      ?>
    </h4>
  </div>
    <div class="table-responsive">
    <table class="mdl-data-table mdl-js-data-table">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Subject Code</th>
      <th class="mdl-data-table__cell--non-numeric">Subject Name</th>
      <th class="mdl-data-table__cell--non-numeric">Subject Type</th>
      <th>Semester</th>
      <th class="mdl-data-table__cell--non-numeric">Syllabus Link</th>
      <th class="mdl-data-table__cell--non-numeric">Info</th>
      <th>Total Seats</th>
      <th>Update</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
      <?php  Database::userpublishedelectives($login_session,$user_type);  ?>
  </tbody>
</table>
<br>NOTE - Elective can't be deleted once the students has started to apply for it.
<hr>
<?php
}
else  {
  echo "<center><b>No Elective published.</b></center>";
}
?>
</div>
</div>


<!-- Delete electives -->
<div class="mdl-cell mdl-cell--12-col">
  <div class="mdl-card__supporting-text">
    <h4>
      Deleted Electives - <a><?php  $count = Database::deletedelectivescount($login_session,$user_type);  
                                    echo "</a>";

        if($count != 0)  {
        ?>
    </h4>
  </div>
    <div class="table-responsive">
    <table class="mdl-data-table mdl-js-data-table">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Subject code</th>
      <th class="mdl-data-table__cell--non-numeric">Subject name</th>
      <th class="mdl-data-table__cell--non-numeric">Subject type</th>
      <th>Semester</th>
      <th class="mdl-data-table__cell--non-numeric">Syllabus Link</th>
      <th class="mdl-data-table__cell--non-numeric">Info</th>
      <th>Total seats</th>
      <th>Republish</th>
    </tr>
  </thead>
  <tbody>
      <?php  Database::userdeletedelectives($login_session,$user_type);  ?>
  </tbody>
</table>
<br>NOTE - Elective details can be updated once its republished.
<hr>
<?php
}
?>
</div>
</div>


  <?php        
        //updating the elective
        if(isset($_POST['update']))  {
            //updating code here
          ?>
          <div id="elecupdate" class="mdl-cell mdl-cell--6-col"><br>
  <?php
        //fetching the elective details
        $ret = Database::fetchelective($_POST['update']);
?>
<script type="text/javascript">
window.onload = function() {

   document.getElementById('elecupdate').getElementsByTagName('input')[1].focus();

}
</script>
<?php
        //catching the return variables
        $ret['0']; //seats
        $ret['1']; //link
        $ret['2']; //info
        $ret['3']; //semester
        $ret['4']; //subject code
        $ret['5']; //subject name
         
  ?>
<form class="admlog" action="/department/profile" method="post">
<h1 class="dept">Update <a style="color: yellow;"><?php echo $_POST['update']; ?></a><br><a style="font-size: 0.7em; color: yellow;"><?php echo $ret['5']; ?></a></h1>
<div id="forma">No. of Seats<input value="<?php echo $ret['0']; ?>" name="seats" type="text" required></div>
<div id="forma">Syllabus Link<input value="<?php echo $ret['1']; ?>" name="link" type="text" required></div>
<div id="forma">Additional info<input value="<?php echo $ret['2']; ?>" name="info" type="text" required></div>
<div id="forma">Semester<input value="<?php echo $ret['3']; ?>" name="sem" type="text" required></div>

<button class="login" name="upelec" value="<?php echo $ret['4']; ?>" type="submit">Update <?php echo $ret['4']; ?></button>
</form>

</div>
<?php
    }
?>
</div>
</div>
