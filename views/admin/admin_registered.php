<?php
    include_once('views/admin/admin_dashboard.php');
?>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

    
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">View Registered students</h2>
  </div>
  <div class="mdl-card__supporting-text">
    Registered students from various departments will appear here
  </div>
  <div class="mdl-card__actions mdl-card--border">
  <?php 
        for ($i=1; $i < 5; $i++) { 
                  
  ?>
    <a class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect">
      Department <?php echo $i; ?>
    </a>
    <?php
        }
    ?>
    <br><br>On clicking the button the registered students of the particular department will be shown.
  </div>



  </div>
  </main>
</div>

    <script src="../../views/design/js/material.min.js"></script>
  </body>
</html>