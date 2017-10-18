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
      <a class="mdl-navigation__link" href="/activate">Activate account</a>
      <a class="mdl-navigation__link" href="/faq">FAQ's</a>
    </nav>
  </div>
     
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->

	 <div class="mdl-grid">
	 
  		<div class="mdl-cell mdl-cell--3-col">
			<div class="demo-card-wide mdl-card mdl-shadow--2dp">
			  <div class="mdl-card__title">
			    <h2 class="mdl-card__title-text">Admin Interface</h2>
			  </div>
			  <div class="mdl-card__actions mdl-card--border">
			    <a href="/admin" class="mdl-button mdl-button--red mdl-js-button mdl-js-ripple-effect">
			      Admin Login
			    </a>
			  </div>
			</div>
  		</div>
  		<div class="mdl-cell mdl-cell--3-col">
  						<div class="demo-card-wide mdl-card mdl-shadow--2dp">
			  <div class="mdl-card__title">
			    <h2 class="mdl-card__title-text">Department Interface</h2>
			  </div>
			  <div class="mdl-card__actions mdl-card--border">
			    <a href="/department" class="mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect">
			      Department Login
			    </a>
			  </div>
			</div>
  		</div>
  		<div class="mdl-cell mdl-cell--3-col">
  						<div class="demo-card-wide mdl-card mdl-shadow--2dp">
			  <div class="mdl-card__title">
			    <h2 class="mdl-card__title-text">Student Interface</h2>
			  </div>
			  <div class="mdl-card__actions mdl-card--border">
			    <a href="/student" class="mdl-button mdl-js-button mdl-js-ripple-effect">
			      Student Login
			    </a>
			  </div>
			</div>
  		</div>
  		<div class="mdl-cell mdl-cell--3-col">
  			<div class="demo-card-wide mdl-card mdl-shadow--2dp">
			  <div class="mdl-card__title">
			    <h2 class="mdl-card__title-text">Account activation</h2>
			  </div>
			  <div class="mdl-card__actions mdl-card--border">
			    <a href="/activate" class="mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect">
			      Activate account
			    </a>
			  </div>
			</div>
  		</div>
  <div class="mdl-cell mdl-cell--6-col">
	<div class="table-responsive">
    <table class="mdl-data-table mdl-js-data-table">
  		<thead>
		    <tr>
		      <th class="mdl-data-table__cell--non-numeric">Entity</th>
		      <th>Count</th>
		      <th></th>
		      <th class="mdl-data-table__cell--non-numeric">Entity</th>
		      <th>Count</th>
		    </tr>
		</thead>
		<tbody>
		    <tr>
		    	<td class="mdl-data-table__cell--non-numeric">Registered Admins</td>
		    	<td><a><b><?php $admcount = Database::admincount();	echo $admcount; ?></b></a></td>
		    	<th>|</th>
		    	<td class="mdl-data-table__cell--non-numeric">Registered Departments</td>
		    	<td><a><b><?php $deptcount = Database::departmentcount();	echo $deptcount; ?></b></a></td>
		    </tr>
		    <tr>
		    	<td class="mdl-data-table__cell--non-numeric">Registered Department users</td>
		    	<td><a target="_blank"><b><?php $deptusercount = Database::departmentuserscount();	echo $deptusercount; ?></b></a></td>
		    	<th>|</th>
		    	<td class="mdl-data-table__cell--non-numeric">Registered Students</td>
		    	<td><a target="_blank"><b><?php $studentscount = Database::studentscount();	echo $studentscount; ?></b></a></td>
		    </tr>
		    <tr>
		    	<td class="mdl-data-table__cell--non-numeric">Published Electives</td>
		    	<td><a><b><?php $elecount = Database::publishedelectives();	echo $elecount; ?></b></a></td>
		    	<th>|</th>
		    	<td class="mdl-data-table__cell--non-numeric">Priorities Filled</td>
		    	<td><a><b><?php $studentspricount = Database::studentsprioritycount();	echo $studentspricount; ?></b></a></td>
		    </tr>
		</tbody>
	</table>
	</div>
  </div>


	</div>
    </div>
    