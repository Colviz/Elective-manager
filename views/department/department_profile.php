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
      <?php  Database::userpublishedelectives($login_session);  ?>
  </tbody>
  </center>
</table>
</div>
</div>

  <?php
        if(isset($_POST['update']))  {
            //updating code here
          ?>
          <div class="mdl-cell mdl-cell--6-col"><br>
  <?php
        //fetching the elective details
        $ret = Database::fetchelective($_POST['update']);

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

        //catching the values from the form above
        if(isset($_POST['upelec']))  {
          ?>
          <div class="mdl-cell mdl-cell--6-col"><br>
          <?php
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
<!-- Update successful -->
<span class="mdl-chip mdl-chip--contact">
    <span class="mdl-chip__contact mdl-color--teal mdl-color-text--white">S</span>
    <span class="mdl-chip__text">Elective Updation <a style="color: blue; text-decoration: none;">Successful.</a> <a href="/department/profile">Click here</a></span>
</span>
                    <?php
                }

          ?>
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