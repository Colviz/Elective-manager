<?php
    include_once('views/department/department_dashboard.php');
?>

  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->
<?php
        
        if (!empty($_POST['pubelec'])) {
              
              //catching form values
              $seats = $_POST['seats'];
              $link = $_POST['link'];
              $semester = $_POST['sem'];
              $subject = $_POST['subj'];
              $info = $_POST['info'];

            $publish = Database::publishelective($_SESSION['login_user'],$type,$subject,$seats,$link,$semester,$info);

            if($publish == 1)  {
              echo "Elective successfully published.<br>";
            }
            else  {
              echo "Elective publishing failed.<br>";
            }
          }

        if ( !empty($_POST['elective'])) {

          $_SESSION['temptype'] = $_POST['type'];
          $elective = $_POST['type'];
          
          switch ($elective) {
            case 'open_elective':
              $elective = "Open Elective";
              break;

            case 'dept_elective':
            $elective = "Departmental Elective";
            break;

            case 'pg_elective':
            $elective = "PG Elective";
            break;            
          }

      ?>
    <div class="mdl-cell mdl-cell--6-col">
    <form class="admlog" action="/department/profile/publish" method="post">
    <h1 class="dept">Publish <?php echo $elective; ?></h1>
    
    <center>
    <select name="subj" required>
      <option selected="true" disabled="disabled">Select  the course....</option>
      <?php 
              //fetching subjects of same department from subjects master
              Database::departmentelectivesubjects($_SESSION['login_user'],$_POST['type']);
      ?>
    </select></center> <br><br>
    <input placeholder="Total Seats" name="seats" type="number" required>
    <input placeholder="Syllabus link" name="link" type="link" required>
    <input placeholder="Semester" name="sem" type="number" required>
    <center>
    <textarea placeholder="Additional info : eg. Professors name who is taking the course, Prerequisites, etc." name="info" cols="40" rows="5" pattern="{1,1000}" required></textarea>
    <br>
    <code style="color: red;">Elective once published can't be unpublished.</code><code style="color: blue;"> Although can be updated.</code></center><br>
    <button name="pubelec" value="pubelec" class="login" type="submit">Publish Elective</button>
        </form>
</div>

      <?php
      }
      else  {

?>

<div class="mdl-grid">

<div class="mdl-cell mdl-cell--6-col">

<form class="admlog" action="/department/profile/publish" method="post">
    <h1 class="dept">Publish Elective</h1>
    <center><!-- This drop down feature here allows the superuser of one department to create normaluser of another, this feature can be vulnerable. This feature can be easily substituted with a secure one. -->
      <select name="type" required>
      <option selected="true" disabled="disabled">Choose the type of Elective</option>
      <option value="open_elective">Open Elective</option>
      <option value="dept_elective">Departmental Elective</option>
      <option value="pg_elective">PG Elective</option>
      </select></center> <br><br>

    <button name="elective" value="elective" class="login" type="submit">Next</button>
</form>
</div>



<?php
      }
?>


    </div>
  </div>