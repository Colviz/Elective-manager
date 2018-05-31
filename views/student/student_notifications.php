<?php
    include_once('views/student/student_dashboard.php');
?>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

<!-- Wide card with share menu button -->     
<div class="mdl-grid">

<div class="mdl-cell mdl-cell--12-col">
  
<div class="demo-card-wide1 mdl-card mdl-shadow--2dp">
  <div class="mdl-card__title">
    <h2 id="tt1" class="mdl-card__title-text"><b>Notifications for - <?php echo $login_session; ?></b></h2>
    <div class="mdl-tooltip mdl-tooltip--large" data-mdl-for="tt1">
      <b><?php echo $noti; ?> Notifications
    </div>
  </div>


  <div class="mdl-card__actions mdl-card--border"></div>
  <?php
      if($noti != 0)  {
  ?>
  <div class="mdl-card__supporting-text">
    All Notifications - Mark as read 
    <!-- Form for marking notifications as read -->
    <form class="update" action="" method="post">
    <button class="notifibutton mdl-button mdl-button--accent mdl-js-button mdl-js-ripple-effect" type="submit" value="all" name="markread"><i class="material-icons">done_all</i> Mark all as read</button></form>
    <!-- Form for marking notifications as read ends -->
  </div>

  <?php

        }

        //fetching notifications from datbase
        $notificontent = Database::notificationcontent($user,$usertype);

        
          //catching variables for viewing older notifications
          if($_POST['viewread'])  {
            echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
            echo "<b>Older Notifications -</b></div>";
            $oldnotificontent = Database::oldnotificationcontent($user,$usertype); 
          }
          else  {
          ?>
          <!-- Form for viewing all notifications -->
          <form class="update" action="" method="post">
          <button class="mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" value="all" name="viewread"><i class="material-icons">done_all</i> View older Notifications</button></form>
          <!-- Form for viewing all notifications ends -->
          <?php
        }
  ?>
    
  

</div>
</div>
