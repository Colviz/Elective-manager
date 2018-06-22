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
    <h2 id="tt1" class="mdl-card__title-text"><b>Allotment Result</b></h2>
  </div>


  <div class="mdl-card__actions mdl-card--border"></div>

<div class="table-responsive">
  <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent mdl-js-ripple-effect">Print Allotment Result</button><br><br>
  <table id="result" class="mdl-data-table mdl-js-data-table">  
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Roll no.</th>
      <th class="mdl-data-table__cell--non-numeric">Alloted Elective</th>
      </tr>
  </thead>
  <tbody>
        <?php  Database::Allotmentresult();   ?>
  </tbody>  
  </table>
</div>
<script>
    function printData() {
        var divToPrint = document.getElementById('result');
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
   }
</script>

</div>
</div>
