<?php 	
//This file is a mirror file of dbconnect.php
//This file is not being used anywhere, but dbconnect.php is being used for database connectivity and contains all kinds of functions being used
class Database
{
    private static $dbName = 'database name here' ;
    private static $dbHost = 'database host here' ;
    private static $dbUsername = 'database username here';
    private static $dbUserPassword = 'database password here';
     
    private static $cont  = null;
     
    public function __construct() {
        
        die('Init function is not allowed');
    }
     
    //Connecting & Disconnecting from database

    public static function connect()    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()    {
        
        self::$cont = null;
    }

    //Admin Register, Login, Sessions, Password recovery , Change password

    public static function adminregister($username,$password,$mobileno,$email)    {
        
        //some predefined values
        $usertype = "admin";
        $active = 1;
        $deptcode = "adm";
        //inserts data in admin registration database
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (username,password,email,mobileno,usertype,active,deptcode) values(?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($username,$password,$email,$mobileno,$usertype,$active,$deptcode));
        Database::disconnect();
    }

    public static function adminlogin($username,$password)  {

        //data validation
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT password,usertype FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the password matches
        if($data['password']==$password && $data['usertype']=='admin')  {
            return 1;
        }
    }

    public static function adminsession($user_check)    {

        //data validation
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,usertype FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_check));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether username exists
        if($data['username'] == $user_check && $data['usertype']=='admin')  {
            return 1;
        }
    }

    public static function adminrecovery($username,$mobileno,$email)    {

        //Recovering admin password
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,usertype,email,mobileno FROM admin WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the provided values are correct
        if($data['username'] == $username && $data['email'] == $email && $data['mobileno'] == $mobileno && $data['usertype'] == "admin")    {
            return 1;
        }
    }

    public static function adminchangepassword($username,$newpassdb)    {

        //changing admin password
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET password = ? WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($newpassdb,$username));
        Database::disconnect();

        return 1;
    }


    //Department Register, Login, Sessions, Password recovery , Change password

    public static function departmentlogin($username,$password,$user)  {

        //data validation
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT password,usertype,active FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the password matches
        if($data['password'] == $password && $data['usertype'] == $user && $data['active'] == 1)  {
            return 1;
        }
    }

    //department normal user registration, unactivated account
    public static function departmentregister($username,$password,$mobileno,$email,$department,$token)    {
        
        //some predefined values
        $usertype = "normaluser";
        //inserts data in department registration database
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO users (username,password,email,mobileno,usertype,active,deptcode) values(?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($username,$password,$email,$mobileno,$usertype,$token,$department));
        Database::disconnect();

        return 1;
    }

    public static function departmentsession($user_check,$user_type)    {

        //data validation
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,usertype,active FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_check));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether username exists
        if($data['username'] == $user_check && $data['usertype'] == $user_type && $data['active'] == 1)  {
            return 1;
        }
    }

    public static function departmentchangepassword($username,$newpassdb)    {

        //changing admin password
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE users SET password = ? WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($newpassdb,$username));
        Database::disconnect();

        return 1;
    }

    public static function departmentrecovery($username,$mobileno,$email)    {

        //Recovering admin password
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,usertype,email,mobileno FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the provided values are correct
        if($data['email'] == $email && $data['mobileno'] == $mobileno && $data['usertype'] != "admin")    {
            return 1;
        }
    }

    //department account activation 
    public static function departmentactivation($username,$password,$email,$activation)    {

        //Activating department normaluser account
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,password,email,active FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the provided values are correct
        if($data['email'] == $email && $data['password'] == $password && $data['active'] == $activation)    {
            
            //activating the account
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE users SET `active`= 1 WHERE username = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username));
            Database::disconnect();

            return 1;
        }
    }

    //fetching the department code of user provided
    public static function departmentcode($user)    {
        //fetching department code
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT deptcode FROM users WHERE username = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $code = $data['deptcode'];
        Database::disconnect();

        return $code;
    }

    //fetching elective subject name from elective code
    public static function departmentsubjectname($subjcode) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT subject_name FROM subject_master WHERE subj_code = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($subjcode));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $sname = $data['subject_name'];
        Database::disconnect();

        return $sname;
    }

    //fetching the subjects details
    public static function departmentelectivesubjects($user,$electype)   {
        
        //fetching department code
        $code = Database::departmentcode($user);

        //fetching the subjects published
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT subj_code,subject_name FROM subject_master WHERE deptcode = ? AND $electype = 1";
        $q = $pdo->prepare($sql);
        $q->execute(array($code));
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            //<option value="csed">Computer Science & Engineering</option>
            echo "<option value=".$data['subj_code'].">".$data['subj_code']." - ".$data['subject_name']."</option>"; 
        }
        Database::disconnect();

    }

    //publishing the electives
    public static function publishelective($loginuser,$electivetype,$subject,$seats,$link,$semester,$info)   {

        //getting the department code
        $code = Database::departmentcode($loginuser);
        //getting the subject name
        $subname = Database::departmentsubjectname($subject);
        //now publishing the elective
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO subjects_published (username,deptcode,subj_code,subject_name,total_seats,link,info,subj_type, semester) values(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($loginuser,$code,$subject,$subname,$seats,$link,$info,$electivetype,$semester));
        Database::disconnect();

        return 1;
    }

    //updating the elective
    public static function updateelective($seats,$link,$info,$sem,$code) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE subjects_published SET total_seats = ?,link = ?,info = ?,semester = ? WHERE subj_code = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($seats,$link,$info,$sem,$code));
        Database::disconnect();

        return 1;
    }

    //Student Register, Login, Sessions, Password recovery , Change password
    
    //Student account activation 
    public static function studentactivation($username,$password,$email,$activation)    {

        //Activating department normaluser account
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT rollno,password,email,activate FROM students WHERE rollno = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($username));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the provided values are correct
        if($data['email'] == $email && $data['password'] == $password && $data['activate'] == $activation)    {
            
            //activating the account
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE students SET `activate`= 1 WHERE rollno = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username));
            Database::disconnect();

            return 1;
        }
    }

    //student register
    public static function studentregister($rollno,$password,$fname,$regno,$dob,$dept,$mobileno,$email,$token)    {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO students (rollno,password,fathers_name,dob,reg_no,email,mobile_no,branch,activate) values (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($rollno,$password,$fname,$dob,$regno,$email,$mobileno,$dept,$token));
        Database::disconnect();

        return 1;
    }

    //student login
    public static function studentlogin($rollno,$password)  {

        //data validation
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT password,activate FROM students WHERE rollno = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($rollno));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether the password matches
        if($data['password']==$password && $data['activate'] == 1)  {
            return 1;
        }
    }

    //student session
    public static function studentsession($user_check)    {

        //data validation
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT rollno,activate FROM students WHERE rollno = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user_check));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        //check whether rollno exists
        if($data['rollno'] == $user_check && $data['activate'] == 1)  {
            return 1;
        }
    }

    //student department fetching
    public static function studentdepartment($user) {

        //data validation
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT branch FROM students WHERE rollno = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $branch = $data['branch'];
        Database::disconnect();

        return $branch;
    }

    //fetching student cgpi
    public static function studentcgpi($user) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT cgpi FROM students WHERE rollno = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $cgpi = $data['cgpi'];
        Database::disconnect();

        return $cgpi;
    }

    //Functions for fetching data from database

    public static function registereddepartments()  {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT count(username) AS total FROM users where usertype = "normaluser"';
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        echo $data['total'];
        Database::disconnect();
    }

    //counting no. of electives
    public static function publishedelectivescount($login_session)  {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = 'SELECT count(username) AS total FROM subjects_published where username = ? AND active = 1';
        $q = $pdo->prepare($sql);
        $q->execute(array($login_session));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $count = $data['total'];
        echo $count;
        Database::disconnect();

        return $count;
    }

    public static function registereddepartmentsdetails()  {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT username,deptcode,created FROM `users` WHERE `usertype` = 'normaluser' order by created ASC";
        $q = $pdo->prepare($sql);
        $q->execute();
        //$data = $q->fetch(PDO::FETCH_ASSOC);
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td class="mdl-data-table__cell--non-numeric">';
            Database::departmentsname($data['deptcode']);
            echo "</td><td>";
            echo $data['username'];            
            echo "</td><td>";
            echo $data['created'];
            echo "</td></tr>";
        }
        Database::disconnect();
    }

    //fetching details of user published electives
    public static function userpublishedelectives($login_session)   {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT subj_code,subject_name,total_seats,link,info,semester FROM `subjects_published` where username = ? AND active = 1";
        $q = $pdo->prepare($sql);
        $q->execute(array($login_session));
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td class="mdl-data-table__cell--non-numeric">';
            $code = $data['subj_code'];
            echo $data['subj_code'];
            echo "</td><td>";
            echo $data['subject_name'];            
            echo "</td><td>";
            echo $data['semester'];
            echo "</td><td>";
            echo $data['link'];
            echo "</td><td>";
            echo $data['info'];
            echo "</td><td>";
            echo $data['total_seats'];
            echo "</td><td>";
            //updating the elective
            echo '<form class="update" action="" method="post">';
            echo '<button class="mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" value="';
            echo $code;
            echo '" name="update">Update</button></form>';
            echo "</td><td>";
            //deactivating the elective
            echo '<form class="update" action="" method="post">';
            echo '<button class="mdl-button mdl-button--red mdl-js-button mdl-js-ripple-effect" type="submit" value="';
            echo $code;
            echo '" name="delete">Delete</button></form>';
            echo "</td></tr>";
        }
        Database::disconnect();
    }

    //user deleted electives
    public static function userdeletedelectives($user)  {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT subj_code,subject_name,total_seats,link,info,semester FROM `subjects_published` where username = ? AND active = 0";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td class="mdl-data-table__cell--non-numeric">';
            $code = $data['subj_code'];
            echo $data['subj_code'];
            echo "</td><td>";
            echo $data['subject_name'];            
            echo "</td><td>";
            echo $data['semester'];
            echo "</td><td>";
            echo $data['link'];
            echo "</td><td>";
            echo $data['info'];
            echo "</td><td>";
            echo $data['total_seats'];
            echo "</td><td>";
            //republish the elective
            echo '<form class="update" action="" method="post">';
            echo '<button class="mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" value="';
            echo $code;
            echo '" name="republish">Republish</button></form>';
            echo "</td></tr>";
        }
    Database::disconnect();
    }

    //fetching the elective details
    public static function fetchelective($code)  {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT subject_name,total_seats,link,info,semester FROM subjects_published WHERE subj_code = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($code));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $name = $data['subject_name'];
        $seats = $data['total_seats'];
        $link = $data['link'];
        $info = $data['info'];
        $semester = $data['semester'];
        Database::disconnect();

        return array($seats,$link,$info,$semester,$code,$name);
    }

    //counting the no. of electives to be displayed
    public static function studentelectivescount($type,$department)  {

        if($type == 'open_elective')    {
            
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(*) AS total FROM subjects_published where subj_type = ? AND deptcode != ? AND active = 1";
            $q = $pdo->prepare($sql);
            $q->execute(array($type,$department));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['total'];
            Database::disconnect();        
        }
        else    {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(*) AS total FROM subjects_published where subj_type = ? AND deptcode = ? AND active = 1";
            $q = $pdo->prepare($sql);
            $q->execute(array($type,$department));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['total'];
            Database::disconnect();
        }

        return $count;
    }

    //fetching the published electives for prioritizing
    public static function publishedelectivespriority($type,$department) {

        //checking if its open_elective or other
        if($type == 'open_elective')    {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT subj_code,subject_name,total_seats FROM subjects_published where subj_type = ? AND deptcode != ? AND active = 1";
        $q = $pdo->prepare($sql);
        $q->execute(array($type,$department));
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value=".$data['subj_code'].">".$data['subj_code']." - ".$data['subject_name']." - ".$data['total_seats']."</option>"; 
        }
        Database::disconnect();
        }
        else    {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT subj_code,subject_name,total_seats FROM subjects_published where subj_type = ? AND deptcode = ? AND active = 1";
        $q = $pdo->prepare($sql);
        $q->execute(array($type,$department));
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value=".$data['subj_code'].">".$data['subj_code']." - ".$data['subject_name']." - ".$data['total_seats']."</option>"; 
        }
        Database::disconnect();
        }
        
    }

    //insert elective priorities
    public static function insertelectivepriorities($user,$cgpi,$priority,$subjcode) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO priorities (rollno,cgpi,subj_code,priority) VALUES (?, ?, ?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($user,$cgpi,$subjcode,$priority));
        Database::disconnect();

        return 1;
    }

    //deactivating the elective
    public static function deactivateelective($code) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE `subjects_published` SET `active` = '0' WHERE `subj_code` = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($code));
        Database::disconnect();

        return 1;
    }

    //republishing elective
    public static function republishelective($code)  {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE `subjects_published` SET `active` = '1' WHERE `subj_code` = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($code));
        Database::disconnect();

        return 1;
    }

    //count of deactivated electives
    public static function deletedelectivescount($user)    {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT count(*) AS total FROM subjects_published WHERE username = ? AND active = 0";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $count = $data['total'];
        echo $data['total'];
        Database::disconnect();

        return $count;
    }

    //student applied for elective count
    public static function appliedforelectivescount($user)    {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT count(*) AS total FROM priorities WHERE rollno = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $count = $data['total'];
        echo $data['total'];
        Database::disconnect();

        return $count;
    }

    //applied for electives
    public static function appliedforelectives($user)    {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT subj_code,cgpi,priority FROM `priorities` where rollno = ? order by priority ASC";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td class="mdl-data-table__cell--non-numeric">';
            $code = $data['subj_code'];
            echo $data['subj_code'];
            $subname = Database::departmentsubjectname($data['subj_code']);
            echo '</td><td class="mdl-data-table__cell--non-numeric">';
            echo $subname;
            echo "</td><td>";
            echo $data['priority'];            
            echo "</td><td>";
            echo $data['cgpi'];            
            echo "</td><td>";
            $applied = Database::studentsappliesforelective($data['subj_code']);
            echo $applied;
            echo "</td><td>";
            //deactivating the elective
            echo '<form class="update" action="" method="post">';
            echo '<button class="mdl-button mdl-button--red mdl-js-button mdl-js-ripple-effect" type="submit" value="';
            echo $code;
            echo '" name="delete">Delete</button></form>';
            echo "</td></tr>";
        }
        Database::disconnect();
    }

    //delete user priority
    public static function deletepriority($code,$user) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM `priorities` WHERE subj_code = ? AND rollno = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($code,$user));
        Database::disconnect();

        return 1;
    }
    
    //no. of seats filled in elective
    public static function studentsappliesforelective($code)  {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT count(*) AS total FROM priorities WHERE subj_code = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($code));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $count = $data['total'];
        Database::disconnect();

        return $count;
    }

    //counting no. of published electives for admin and students
    public static function publishedelectives() {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT count(*) AS total FROM subjects_published WHERE active = 1";
        $q = $pdo->prepare($sql);
        $q->execute();
        $data = $q->fetch(PDO::FETCH_ASSOC);
        echo $data['total'];
        Database::disconnect();
    }

    //fetching details of published electives for admin
    public static function publishedelectivesdetails() {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT deptcode,subj_code,subject_name,subj_type,total_seats,semester  FROM `subjects_published` WHERE active = 1 order by subj_code ASC";
        $q = $pdo->prepare($sql);
        $q->execute();
        //$data = $q->fetch(PDO::FETCH_ASSOC);
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td class="mdl-data-table__cell--non-numeric">';
            Database::departmentsname($data['deptcode']);
            echo '</td><td class="mdl-data-table__cell--non-numeric">';
            echo $data['subj_code'];
            echo '</td><td class="mdl-data-table__cell--non-numeric">';
            echo $data['subject_name'];            
            echo "</td><td>";
            echo $data['subj_type'];
            echo "</td><td>";
            echo $data['semester'];
            echo "</td><td>";
            echo $data['total_seats'];
            echo "</td></tr>";
        }
        Database::disconnect();
    }

    public static function departmentsname($name)    {
        switch ($name) {

            //CSE
            case 'csed':
            $name = "Computer Science & Engineering";
            break;

            //Chemical
            case 'ched':
            $name = "Chemical Engineering";
            break;

            //Civil
            case 'civi':
            $name = "Civil Engineering";
            break;

            //ECE
            case 'eced':
            $name = "Electronics and Communication Engineering";
            break;

            //EEE
            case 'eeed':
            $name = "Electrical Engineering";
            break;

            //Mechanical
            case 'med':
            $name = "Mechanical Engineering";
            break;

            //Materials Science and Engineering
            case 'msed':
            $name = "Materials Science and Engineering";
            break;

            //Architecture
            case 'arch':
            $name = "Architecture";
            break;

            //Physics
            case 'phys':
            $name = "Physics";
            break;

            //Chemistry
            case 'chem':
            $name = "Chemistry";
            break;

            //Maths
            case 'math':
            $name = "Maths";
            break;

            //Management & Humanities
            case 'huma':
            $name = "Management and Humanities";
            break;

            //default case
            default:
            $name = "Unknown Department";
            break;
        }
        echo $name;
        return $name;
    }

    //other functions
    //generating the tokens
    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function mailthedetails($to,$subject,$message) {
        
        //sending the mail through 3rd party API - mailgun.com
        exec("curl -s --user 'api:key-[YOUR-API-KEY-HERE]' \    https://api.mailgun.net/v3/sandboxb6377426d4624727b78a197408029a96.mailgun.org/messages \  -F headers='MIME-Version: 1.0\r\n' -F headers='Content-Type: text/html; charset=ISO-8859-1\r\n'  -F from='nith.ac.in <do-not-reply@nith.ac.in>' \    -F to='$to' \    -F subject='$subject' \    -F text='$message'");

        return 1;
    }

    //validating reCAPTCHA
    public static function reCAPTCHAvalidate($captcha)  {

        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=[YOUR-SECRET-KEY-HERE]&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        $obj = json_decode($response);
        if($obj->success == true)   {
                return 1;
            }
    }

    
}
?>