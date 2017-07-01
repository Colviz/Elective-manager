<?php
    include_once('views/student/student_dashboard.php');
?>
    <script src="../../views/design/js/material.min.js"></script>
    
    <script src="../../views/design/js/jquery.min.js"></script>

  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<div class="mdl-cell mdl-cell--6-col">
<b>Your priorities for electives are as follows -</b><br>
<?php

          if(!empty($_POST['subpri']))  {

              $count = $_SESSION['tempcount'];
              //printing the cached values
              for($i = 0; $i < $count; $i++) {
                
                echo "Priority ".$i." - ";
                echo $_POST[$i];
                echo "<br>";

                //insert these values in database
                $ret = database::insertelectivepriorities($_SESSION['login_user'],$i,$_POST[$i]);
              }
              if($ret ==1) {
                  echo "<br>Priorities added to database.<br>";
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

<script src="../../views/design/js/style.js"></script>

  </body>
</html>