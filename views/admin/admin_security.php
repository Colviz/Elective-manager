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
</div><br>
  <button class="mdl-button mdl-js-button mdl-button--red mdl-button--raised mdl-js-ripple-effect">I am Under attack</button> - Use this when you are under any kind of attack eg. Sql injections, Scripts running on site, etc. This will secure the database and will also creates a clone of database for further use.
  <br><br>

  <button class="mdl-button mdl-js-button mdl-button--green mdl-button--raised mdl-js-ripple-effect">Remote Database backup</button> - Use this to create backup of elective-manager database on remote servers.
  <br><br>

  <button class="mdl-button mdl-js-button mdl-button--blue mdl-button--raised mdl-js-ripple-effect">Synchronize backups</button> - Use this to synchronize remote database backup with live database.  

</div>

</div>
</div>