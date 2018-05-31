<?php
    include_once('views/admin/admin_dashboard.php');
?>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->     
<div class="mdl-grid">

<div class="mdl-cell mdl-cell--12-col">
  
<div class="demo-card-wide1 mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title">
    <h2 id="tt1" class="mdl-card__title-text"><b>Security & Backup Settings</b></h2>
    <div class="mdl-tooltip mdl-tooltip--large" data-mdl-for="tt1">
      Use these when under attack
    </div>
  </div>


  <div class="mdl-card__actions mdl-card--border"></div>

<?php
      if (isset($_POST['attack'])) {
          
          function underattack()  {
            rename("dbconnect.php", "backup_dbconnect.php");
          }

          echo "<a style='color: red'>You are now safe from any kind of attack.</a> ";
          echo "When the attack has stopped, contact your database administrator to rename file 'backup_dbconnect.php' to 'dbconnect.php' in the project directory.";
?>
<!-- Snackbar starts -->
          <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
            <div class="mdl-snackbar__text"></div>
            <button class="mdl-snackbar__action" type="button"></button>
          </div>

          <script>
          r(function(){
              var snackbarContainer = document.querySelector('#snackbar');
              var data = { message: 'You are now safe from any kind of attack. Contact your database administrator now.',timeout: 6000};
              snackbarContainer.MaterialSnackbar.showSnackbar(data);
          });
          function r(f){ /in/.test(document.readyState)?setTimeout('r('+f+')',9):f()}
          </script>
<!-- Snackbar ends -->
<?php
            underattack();
          }
?>

<div class="mdl-grid">
   
      <div class="mdl-cell mdl-cell--12-col">
      
          <h4>Use this when you are under any kind of attack eg. Sql injections, Scripts running on site, etc. This will prevent database connectivity of any kind.
            When the attack has stopped, contact your database administrator to rename file "<code>backup_dbconnect.php</code>" to "<code>dbconnect.php</code>" in the project directory.</h4> 
        <form class="update" action="" method="post">
          <button name="attack" class="mdl-button mdl-js-button mdl-button--red mdl-button--raised mdl-js-ripple-effect">I am Under attack</button></form>
        
      
      </div>

      <div class="mdl-card__actions mdl-card--border"></div>

      <div class="mdl-cell mdl-cell--12-col">
      
          <h2 class="mdl-card__title-text">Use this to create backup of elective-manager database on remote servers.</h2>
        
          <button class="mdl-button mdl-js-button mdl-button--green mdl-button--raised mdl-js-ripple-effect">Remote Database backup</button>
        
      
      </div>

      <div class="mdl-card__actions mdl-card--border"></div>

      <div class="mdl-cell mdl-cell--12-col">
      
          <h2 class="mdl-card__title-text">Use this to synchronize remote database backup with live database.</h2>
        
          <button class="mdl-button mdl-js-button mdl-button--blue mdl-button--raised mdl-js-ripple-effect">Synchronize backups</button>
        
      
      </div>

      <div class="mdl-card__actions mdl-card--border"></div>

</div>
</div>

</div>

</div>
</div>
