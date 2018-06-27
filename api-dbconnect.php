<?php   
/**
 * This file is a mirror file of dbconnect.php
 * This file is not being used anywhere, but dbconnect.php is being used for database connectivity and 
 * contains all kinds of functions being used
 */

/**
 * Google reCAPTCHAvalidate data-sitekey
 */
$reCAPTCHAsiteKey = "YOUR_SITE_KEY_HERE";

/**
 * Class Database
 */
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

        //connecting to database
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
         
        //disconnecting from database
        public static function disconnect()    {
            
            self::$cont = null;
        }

        //Admin, Department, Student, Other functions for fetching values from database are as follows

        //Admin Register, Login, Sessions, Password recovery , Change password

        //admin register
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

        //admin login
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

        //setting admin session
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

        //admin account recovery
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

        //admin password change
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

        //counting no. of admin's
        public static function admincount() {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(username) AS total FROM users where usertype = 'admin' AND active = 1";
            $q = $pdo->prepare($sql);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['total'];
            Database::disconnect();
            
            return $count;
        }


        //Department Register, Login, Sessions, Password recovery , Change password

        //department login
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

        //setting department sessions
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

        //department password change
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

        //department account recovery
        public static function departmentrecovery($username,$mobileno,$email)    {

            //Recovering department user password
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

        //fetching the published subjects codes
        public static function departmentpublishedelectives()   {

            //fetching the subjects published
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT subj_code,subject_name FROM subjects_published WHERE active = 1";
            $q = $pdo->prepare($sql);
            $q->execute();
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

        //updating the published elective details
        public static function updateelective($seats,$link,$info,$sem,$code) {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE subjects_published SET total_seats = ?,link = ?,info = ?,semester = ? WHERE subj_code = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($seats,$link,$info,$sem,$code));
            Database::disconnect();

            return 1;
        }

        //counting no. of departments registered
        public static function departmentcount() {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(username) AS total FROM users where usertype = 'superuser' AND active = 1";
            $q = $pdo->prepare($sql);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['total'];
            Database::disconnect();
            
            return $count;
        }

        //counting no. of department users
        public static function departmentuserscount() {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(username) AS total FROM users where usertype != 'admin' AND active = 1";
            $q = $pdo->prepare($sql);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['total'];
            Database::disconnect();
            
            return $count;
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
        public static function studentregister($rollno,$name,$password,$fname,$regno,$dob,$dept,$mobileno,$email,$token)    {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO students (rollno,name,password,fathers_name,dob,reg_no,email,mobile_no,branch,activate) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($rollno,$name,$password,$fname,$dob,$regno,$email,$mobileno,$dept,$token));
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

        //student session setting
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

        // Student password recovery
        public static function studentrecovery($username,$mobileno,$email) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT rollno,email,mobile_no FROM students WHERE rollno = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();

            //check whether the provided values are correct
            if($data['email'] == $email && $data['mobile_no'] == $mobileno)    {
                return 1;
            }  
        }

        // Student Change Password
        public static function studentchangepassword($username,$newpassdb)    {

            //changing admin password
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE students SET password = ? WHERE rollno = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($newpassdb,$username));
            Database::disconnect();

            return 1;
        }

        //student department fetching from username
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

        //fetching students name from rollno
        public static function studentsname($rollno)    {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT name FROM students WHERE rollno = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($rollno));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $name = $data['name'];
            Database::disconnect();

            return $name;
        }

        //fetching students branch from rollno
        public static function studentsbranch($rollno)  {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT branch FROM students WHERE rollno = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($rollno));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $branch = $data['branch'];
            Database::disconnect();

            return $branch;
        }

        //counting no. of registered students
        public static function studentscount() {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(rollno) AS total FROM students where activate = 1";
            $q = $pdo->prepare($sql);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['total'];
            Database::disconnect();
            
            return $count;
        }

        //counting no. of students filling priorities
        public static function studentsprioritycount() {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(rollno) AS total FROM priorities";
            $q = $pdo->prepare($sql);
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['total'];
            Database::disconnect();
            
            return $count;
        }

        //checking if student account is activated
        public static function studentisactivated($rollno) {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT rollno FROM students WHERE rollno = ? AND activate = 1";
            $q = $pdo->prepare($sql);
            $q->execute(array($rollno));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            
            if ($data > 0) {
                return 1;
            }
            else {
                return 0;
            }
            Database::disconnect();
        }

        //deleting student account
        public static function studentaccountdelete($rollno)   {

            //checking if student account is activated
            $activated = Database::studentisactivated($rollno);

            if ($activated > 0)   {
            
                $snd = 2;   
            }
            else    {

                //deleting the useraccount if its unactivated
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DELETE FROM students WHERE rollno = ? AND activate != 1";
                $q = $pdo->prepare($sql);
                $q->execute(array($rollno));
                Database::disconnect();
                
                $snd = 1;   
            }

            return $snd;    
        }

        //checking if student account exists
        public static function studentaccountcheck($roll)   {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(rollno) AS total FROM students where rollno = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($roll));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['total'];
            Database::disconnect();
            
            return $count; 
        }

        //Functions for fetching data from database

        //fetching the no. of notifications for users (admin,superuser,dept users,student)
        public static function notificationcount($user,$usertype)  {
            
            //for admin
            if($usertype == 0 && $user == "admin")  {
                //for admin
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT count(destination) AS total FROM notifications where destination = ? AND marked = 0";
                $q = $pdo->prepare($sql);
                $q->execute(array($user));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $count = $data['total'];
            }
            else if ($usertype == "student")  {
                //for student
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT count(destination) AS total FROM notifications where destination = ? AND marked = 0 OR destination = ? AND marked = 0";
                $q = $pdo->prepare($sql);
                $q->execute(array($user,$usertype));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $count = $data['total'];
            }
            
            //notifications count for departmental users (superuser and normaluser)
            else if($usertype == "superuser")    {
                    //getting the department of superuser
                    $department = Database::departmentcode($user);

                    //getting notifications count for superuser
                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $query = "SELECT count(destination) AS total FROM notifications where origin = ? AND marked = 0 AND destination NOT LIKE '1%'";
                    
                    $q = $pdo->prepare($query);
                    $q->execute(array($department));
                    $data = $q->fetch(PDO::FETCH_ASSOC);
                    $count = $data['total'];
                }
            else    {
                    //getting notifications count for deptuser
                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "SELECT count(destination) AS total FROM notifications where destination = ? AND marked != 1";
                    $q = $pdo->prepare($sql);
                    $q->execute(array($user));
                    $data = $q->fetch(PDO::FETCH_ASSOC);
                    $count = $data['total'];
                }

            Database::disconnect();
            
            return $count;   
        }

        //fetching the notifications content for users (Admin, department and students)
        public static function notificationcontent($user,$usertype)   {

            //for admin
            if($user == "admin" && $usertype == "admin")  {
                
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT id,origin,username,type,content,created FROM notifications where destination = ? AND marked = 0 order by created DESC";
                $q = $pdo->prepare($sql);
                $q->execute(array($user));
                //fetching data
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    
                    if($data['type'] == "login" || $data['type'] == "pass_change")  {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $data['origin']; 
                        echo $data['username']; 
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['created']." , "; 
                        echo "</a>from - <a>".$data['content'];
                        //form for marking as read
                        echo '</a><form class="update" action="" method="post">';
                        echo '<button class="notifibutton mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                        echo $data['id'];
                        echo '" name="markread"><i class="material-icons">done</i> Mark as read</button></form></div>';
                        //form ends
                    }
                    else if($data['type'] == "elec_published" || $data['type'] == "elec_delete")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['content'];
                        echo "</a>, by ";
                        Database::departmentsname($data['origin']);
                        echo " user - <a>"; 
                        echo $data['username']; 
                        echo "</a>, on - ".$data['created']; 
                        //form for marking as read
                        echo '<form class="update" action="" method="post">';
                        echo '<button class="notifibutton mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                        echo $data['id'];
                        echo '" name="markread"><i class="material-icons">done</i> Mark as read</button></form></div>';
                        //form ends
                    }
                    else if($data['type'] == "acc_delete")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a> ".$data['username']; 
                        echo "</a>, from <a>".$data['content'];
                        echo "</a>, on - ".$data['created']; 
                        //form for marking as read
                        echo '<form class="update" action="" method="post">';
                        echo '<button class="notifibutton mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                        echo $data['username'];
                        echo '" name="accdelete"> Delete <a><i class="material-icons">account_circle</i>'.$data['username'].'</a> Account</button></form></div>';
                        //form ends
                    }
                }
            }

            //for student
            else if($usertype == "student")   {
                //for student
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT id,origin,username,type,content,created FROM notifications where destination = ? AND marked = 0 OR destination = ? AND marked = 0 order by created DESC";
                $q = $pdo->prepare($sql);
                $q->execute(array($user,$usertype));
                //fetching data
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    
                    if($data['type'] == "allotment")  {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo "You're allotted ";
                        echo "<a>".$data['content'];
                        echo "</a> of <a>";
                        Database::departmentsname($data['origin']);
                        echo " Department</a>, on - <a> ".$data['created']; 
                        //form for marking as read
                        echo '</a><form class="update" action="" method="post">';
                        echo '<button class="notifibutton mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                        echo $data['id'];
                        echo '" name="markread"><i class="material-icons">done</i> Mark as read</button></form></div>';
                        //form ends
                    }
                    else if($data['type'] == "fill_priorities")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo Database::filtertype($data['type']);
                        echo "<a> ".$data['content'];
                        echo "</a>, Notification sent on - <a>";
                        echo $data['created'];
                        //form for filling priorities
                        echo '</a><form class="update" action="/student/profile" method="post">';
                        echo '<button class="notifibutton mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" name="fillprior" value="fillprior"><i class="material-icons">done</i> Fill Priorities</button></form></div>';
                        //form ends
                    }
                }
            }

            //for department normaluser
            else if($usertype == "normaluser")   {
                //for department normaluser
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT id,origin,username,type,content,created FROM notifications where destination = ? AND marked != 1 order by created DESC";
                $q = $pdo->prepare($sql);
                $q->execute(array($user));
                //fetching data
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    
                    if($data['type'] == "login" || $data['type'] == "pass_change")  {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $data['origin']; 
                        echo $data['username']; 
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['created']." , "; 
                        echo "</a>from - <a>".$data['content'];
                        //form for marking as read
                        echo '</a><form class="update" action="" method="post">';
                        echo '<button class="notifibutton mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                        echo $data['id'];
                        echo '" name="markread"><i class="material-icons">done</i> Mark as read</button></form></div>';
                        //form ends
                    }
                    else if($data['type'] == "elec_published" || $data['type'] == "elec_delete")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['content'];
                        echo "</a>, by ";
                        //Database::departmentsname($data['origin']);
                        echo " user - <a>"; 
                        echo $data['username']; 
                        echo "</a>, on - ".$data['created']; 
                        //form for marking as read
                        echo '<form class="update" action="" method="post">';
                        echo '<button class="notifibutton mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                        echo $data['id'];
                        echo '" name="markread"><i class="material-icons">done</i> Mark as read</button></form></div>';
                        //form ends
                    }
                }
            }

            //for department superuser
            else if($usertype == "superuser")   {
                //for department normaluser

                //getting the department code of user
                $user = Database::departmentcode($user);

                //database interaction
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //"SELECT count(destination) AS total FROM notifications where origin = ? AND marked = 0 AND NOT (destination = 'admin' || destination LIKE '1234%')";
                $sql = "SELECT id,origin,username,type,content,created FROM notifications where origin = ? AND marked = 0 AND NOT ( destination LIKE '1234%') order by created DESC";
                $q = $pdo->prepare($sql);
                $q->execute(array($user));
                //fetching data
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    
                    if($data['type'] == "login" || $data['type'] == "pass_change")  {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $data['origin']; 
                        echo $data['username']; 
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['created']." , "; 
                        echo "</a>from - <a>".$data['content'];
                        //form for marking as read
                        echo '</a><form class="update" action="" method="post">';
                        echo '<button class="notifibutton mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                        echo $data['id'];
                        echo '" name="markread"><i class="material-icons">done</i> Mark as read</button></form></div>';
                        //form ends
                    }
                    else if($data['type'] == "elec_published" || $data['type'] == "elec_delete")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['content'];
                        echo "</a>, by ";
                        //Database::departmentsname($data['origin']);
                        echo " user - <a>"; 
                        echo $data['username']; 
                        echo "</a>, on - ".$data['created']; 
                        //form for marking as read
                        echo '<form class="update" action="" method="post">';
                        echo '<button class="notifibutton mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                        echo $data['id'];
                        echo '" name="markread"><i class="material-icons">done</i> Mark as read</button></form></div>';
                        //form ends
                    }
                }
            }

            Database::disconnect();
        }

        //fetching the old notifications for users
        public static function oldnotificationcontent($user,$usertype)   {

            //for admin
            if($user == "admin" && $usertype == "admin")  {
                //for admin and students
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT origin,username,type,content,created FROM notifications where destination = ? AND marked = 1 order by created DESC";
                $q = $pdo->prepare($sql);
                $q->execute(array($user));
                //fetching data
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    
                    if($data['type'] == "login" || $data['type'] == "pass_change")  {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $data['origin']; 
                        echo $data['username']; 
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['created']." , "; 
                        echo "</a>from - <a>".$data['content'];
                        echo "</a></div>";
                    }
                    else if($data['type'] == "elec_published" || $data['type'] == "elec_delete")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['content'];
                        echo "</a>, by ";
                        Database::departmentsname($data['origin']);
                        echo " user - <a>"; 
                        echo $data['username']; 
                        echo "</a>, on - ".$data['created']; 
                        echo "</div>";
                    }
                    else if($data['type'] == "acc_delete")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a> ".$data['username']; 
                        echo "</a>, from <a>".$data['content'];
                        echo "</a>, on - ".$data['created']; 
                        echo "</div>";                    
                    }
                }
            }
            //for student
            else if($usertype == "student")   {
                //for student
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT origin,username,type,content,created FROM notifications where destination = ? AND marked = 1 OR destination = ? AND marked = 1 order by created DESC";
                $q = $pdo->prepare($sql);
                $q->execute(array($user,$usertype));
                //fetching data
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    
                    if($data['type'] == "allotment")  {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo "You're allotted ";
                        echo "<a>".$data['content'];
                        echo "</a> of <a>";
                        Database::departmentsname($data['origin']);
                        echo " Department</a>, on - <a> ".$data['created']; 
                        echo "</div>";
                    }
                    else if($data['type'] == "fill_priorities")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo Database::filtertype($data['type']);
                        echo "<a> ".$data['content'];
                        echo "</a>, Notification sent on - <a>";
                        echo $data['created'];
                        echo "</div>";
                    }
                }
            }

            //for department normaluser
            else if($usertype == "normaluser")   {
                //for department normaluser
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT origin,username,type,content,created FROM notifications where destination = ? AND marked = 1 order by created DESC";
                $q = $pdo->prepare($sql);
                $q->execute(array($user));
                //fetching data
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    
                    if($data['type'] == "login" || $data['type'] == "pass_change")  {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $data['origin']; 
                        echo $data['username']; 
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['created']." , "; 
                        echo "</a>from - <a>".$data['content'];
                        echo '</div>';
                    }
                    else if($data['type'] == "elec_published" || $data['type'] == "elec_delete")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['content'];
                        echo "</a>, by ";
                        //Database::departmentsname($data['origin']);
                        echo " user - <a>"; 
                        echo $data['username']; 
                        echo "</a>, on - ".$data['created']; 
                        echo '</div>';
                    }
                }
            }

            //for department superuser
            else if($usertype == "superuser")   {
                //for department normaluser

                //getting the department code of user
                $user = Database::departmentcode($user);

                //database interaction
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT origin,username,type,content,created FROM notifications where origin = ? AND marked != 0 order by created DESC";
                $q = $pdo->prepare($sql);
                $q->execute(array($user));
                //fetching data
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    
                    if($data['type'] == "login" || $data['type'] == "pass_change")  {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $data['origin']; 
                        echo $data['username']; 
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['created']." , "; 
                        echo "</a>from - <a>".$data['content'];
                        echo '</div>';
                    }
                    else if($data['type'] == "elec_published" || $data['type'] == "elec_delete")   {
                        //displaying the content
                        echo '<div class="mdl-card__actions mdl-card--border"></div><div class="mdl-card__supporting-text">';
                        echo $type = Database::filtertype($data['type']); 
                        echo " - <a>".$data['content'];
                        echo "</a>, by ";
                        //Database::departmentsname($data['origin']);
                        echo " user - <a>"; 
                        echo $data['username']; 
                        echo "</a>, on - ".$data['created']; 
                        echo '</div>';
                    }
                }
            }

            Database::disconnect();
        }

        //marking notification as read
        public static function marknotificationread($id)    {

            //check if the notification response is via superuser
            $check = substr($id,-3);

            if ($check == "abc") {
                $id = substr($id, 0, -3);
                
                //the response is via superuser
                //database interaction
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE `notifications` SET `marked` = '0.5' WHERE `id` = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                Database::disconnect();

                return 1;
            }

            else    {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE `notifications` SET `marked` = '1' WHERE `id` = ?";
                $q = $pdo->prepare($sql);
                $q->execute(array($id));
                Database::disconnect();

                return 1;
            }            
        }

        //marking all notifications as read
        public static function markallnotificationread($destination)    {

            //Marking all notifications as read will not work for superuser.
            //This feature has been intentionally disabled.
            if($destination != "student" || $destination != "department")    {
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE `notifications` SET `marked` = '1' WHERE `destination` = ? AND type != 'acc_delete' ";
                $q = $pdo->prepare($sql);
                $q->execute(array($destination));
                Database::disconnect();

                return 1;
            }
            else    {
                return 0;
            }            
        }

        //delete the requested user account
        public static function accountdeleteadmin($username)  {

            //deleting the user account
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM `students` WHERE rollno = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username));
            Database::disconnect();

            //marking the delete account notification as read
            $notifiread = Database::markaccdeletenotificationread($username);

            if($notifiread == 1)    {
                return 1;    
            }
            else    {
                return 0;
            }
            
        }

        //mark account delete notification as read
        public static function markaccdeletenotificationread($username) {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE `notifications` SET `marked` = '1' WHERE `type` = 'acc_delete' AND `username` = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($username));
            Database::disconnect();

            return 1;            
        }

        //filtering the notification type
        public static function filtertype($type)    {

            switch ($type) {

                case 'login':
                    $type = "Last login on";
                    break;

                case 'elec_published':
                    $type = "Elective Published";
                    break;

                case 'elec_delete':
                    $type = "Elective Deleted";
                    break;

                case 'acc_delete':
                    $type = "Account Deletion Requested by";
                    break;

                case 'pass_change':
                    $type = "Password Changed on";
                    break;

                case 'allotment':
                    $type = "Elective allotted on";
                    break;

                case 'priorities':
                    $type = "Priorities Filled on";
                    break;

                case 'fill_priorities':
                    $type = "Fill elective priorities before";
                    break;
            }

            return $type;
        }

        //counting no. of registered departments (normalusers)
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

        //counting no. of electives for departmental users (superuser and normaluser)
        public static function publishedelectivescount($login_session,$user_type)  {

            if ($user_type == 'superuser') {
                
                //fetching the department code
                $code = Database::departmentcode($login_session);

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = 'SELECT count(username) AS total FROM subjects_published where deptcode = ? AND active = 1';
                $q = $pdo->prepare($sql);
                $q->execute(array($code));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $count = $data['total'];
                echo $count;
            }
            else    {

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = 'SELECT count(username) AS total FROM subjects_published where username = ? AND active = 1';
                $q = $pdo->prepare($sql);
                $q->execute(array($login_session));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $count = $data['total'];
                echo $count;
            }
            return $count;

            Database::disconnect();
        }

        //fetching registered departments details (usernames,date created)
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
        public static function userpublishedelectives($login_session,$user_type)   {

            if ($user_type == 'superuser') {
                
                //fetching the department code
                $code = Database::departmentcode($login_session);

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT subj_code,subject_name,total_seats,subj_type,link,info,semester FROM `subjects_published` where deptcode = ? AND active = 1 ORDER by subj_type";
                $q = $pdo->prepare($sql);
                $q->execute(array($code));
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr><td class="mdl-data-table__cell--non-numeric">';
                    $code = $data['subj_code'];
                    echo $data['subj_code'];
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['subject_name'];            
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['subj_type'];            
                    echo '</td><td>';
                    echo $data['semester'];
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['link'];
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['info'];
                    echo '</td><td>';
                    echo $data['total_seats'];
                    echo '</td><td>';
                    //updating the elective
                    echo '<form class="update" action="" method="post">';
                    echo '<button class="mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                    echo $code;
                    echo '" name="update">Update</button></form>';
                    echo '</td><td>';
                    //deactivating the elective
                    echo '<form class="update" action="" method="post">';
                    echo '<button class="mdl-button mdl-button--red mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                    echo $code;
                    echo '" name="delete">Delete</button></form>';
                    echo "</td></tr>";
                }
            }
            else    {

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT subj_code,subject_name,total_seats,link,subj_type,info,semester FROM `subjects_published` where username = ? AND active = 1 ORDER by subj_type";
                $q = $pdo->prepare($sql);
                $q->execute(array($login_session));
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr><td class="mdl-data-table__cell--non-numeric">';
                    $code = $data['subj_code'];
                    echo $data['subj_code'];
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['subject_name'];            
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['subj_type'];            
                    echo '</td><td>';
                    echo $data['semester'];
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['link'];
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['info'];
                    echo '</td><td>';
                    echo $data['total_seats'];
                    echo '</td><td>';
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
            }
           Database::disconnect();
        }

        //user deleted electives
        public static function userdeletedelectives($login_session,$user_type)  {

            if ($user_type == 'superuser') {
                
                //fetching the department code
                $code = Database::departmentcode($login_session);

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT subj_code,subject_name,total_seats,link,subj_type,info,semester FROM `subjects_published` where deptcode = ? AND active = 0 ORDER by subj_type";
                $q = $pdo->prepare($sql);
                $q->execute(array($code));
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr><td class="mdl-data-table__cell--non-numeric">';
                    $code = $data['subj_code'];
                    echo $data['subj_code'];
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['subject_name'];            
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['subj_type'];            
                    echo '</td><td>';
                    echo $data['semester'];
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['link'];
                    echo '</td><td class="mdl-data-table__cell--non-numeric">';
                    echo $data['info'];
                    echo '</td><td>';
                    echo $data['total_seats'];
                    echo '</td><td>';
                    //republish the elective
                    echo '<form class="update" action="" method="post">';
                    echo '<button class="mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                    echo $code;
                    echo '" name="republish">Republish</button></form>';
                    echo "</td></tr>";
                }
            }
            else    {

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT subj_code,subject_name,total_seats,link,info,subj_type,semester FROM `subjects_published` where username = ? AND active = 0 ORDER by subj_type";
                $q = $pdo->prepare($sql);
                $q->execute(array($login_session));
                while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr><td class="mdl-data-table__cell--non-numeric">';
                $code = $data['subj_code'];
                echo $data['subj_code'];
                echo '</td><td class="mdl-data-table__cell--non-numeric">';
                echo $data['subject_name'];            
                echo '</td><td class="mdl-data-table__cell--non-numeric">';
                echo $data['subj_type'];            
                echo '</td><td>';
                echo $data['semester'];
                echo '</td><td class="mdl-data-table__cell--non-numeric">';
                echo $data['link'];
                echo '</td><td class="mdl-data-table__cell--non-numeric">';
                echo $data['info'];
                echo '</td><td>';
                echo $data['total_seats'];
                echo '</td><td>';
                //republish the elective
                echo '<form class="update" action="" method="post">';
                echo '<button class="mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                echo $code;
                echo '" name="republish">Republish</button></form>';
                echo "</td></tr>";
                }
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

        //counting the users applied for an elective
        public static function fetchstudentsappliedcount($code)  {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT count(*) AS total FROM priorities where subj_code = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($code));
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['total'];
            Database::disconnect();

            return $count;
        }

        //fetching the users applied for an elective
        public static function fetchstudentsapplied($code)  {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT rollno,priority FROM `priorities` where subj_code = ? order by priority ASC";
            $q = $pdo->prepare($sql);
            $q->execute(array($code));
            while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr><td class="mdl-data-table__cell--non-numeric">';
                echo $data['rollno'];
                echo '</td><td class="mdl-data-table__cell--non-numeric">';

                //getting students name
                $name = Database::studentsname($data['rollno']);
                echo $name;
                echo '</td><td class="mdl-data-table__cell--non-numeric">';

                //getting students branch
                $branch = Database::studentsbranch($data['rollno']);
                $branch = Database::departmentsname($branch);
                echo '</td><td>';
                echo $data['priority'];            
                echo "</td></tr>";
            }
            Database::disconnect();
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
            }   
         Database::disconnect();
        }

        //insert elective priorities
    public static function insertelectivepriorities($user,$cgpi,$priority,$subjcode) {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $new = "SELECT subj_code,priority FROM priorities WHERE rollno = ? AND subj_code = ?"; 
        $n = $pdo->prepare($new);
        $n->execute(array($user,$subjcode));
        $data = $n->fetch(PDO::FETCH_ASSOC);
        $count = $data['subj_code'];
        $pre = $data['priority'];
        
        if($data > 0)
        {
            
            Database::disconnect();

            return 0;
        }
        else {
            
            $sql = "INSERT INTO priorities (rollno,cgpi,subj_code,priority) VALUES (?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($user,$cgpi,$subjcode,$priority));
            Database::disconnect();

            return 1;
        }
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
        public static function deletedelectivescount($login_session,$user_type)    {

            if ($user_type == 'superuser') {
                
                //fetching the department code
                $code = Database::departmentcode($login_session);

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT count(*) AS total FROM subjects_published WHERE deptcode = ? AND active = 0";
                $q = $pdo->prepare($sql);
                $q->execute(array($code));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $count = $data['total'];
                echo $data['total'];

            }
            else    {

                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT count(*) AS total FROM subjects_published WHERE username = ? AND active = 0";
                $q = $pdo->prepare($sql);
                $q->execute(array($login_session));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $count = $data['total'];
                echo $data['total'];

                
            }
            return $count;

            Database::disconnect();
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
    public static function appliedforelectives($user,$count)    {

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT subj_code,cgpi,priority FROM `priorities` where rollno = ? order by priority ASC";
        $q = $pdo->prepare($sql);
        $q->execute(array($user));
        while($data = $q->fetch(PDO::FETCH_ASSOC)) {
            echo '<tr><td class="mdl-data-table__cell--non-numeric">';
            $code = $data['subj_code'];
            echo $data['subj_code'];
            $pri = $data['priority'];
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
            echo '<form class="update" action="/student/list" method="post">';
            echo '<button class="mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" value="';
            echo $code;
            echo '" name="code">View list</button></form>';
            echo "</td><td>";

            // updating the elective
            if($count == ($pri + 1)){
                echo '<form class="update" action="" method="post">';
            echo '<button title = "Move priority Up" class="new-button mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" value="';
            echo $pri;
            echo '" name="up">&#x25B2;</button>';
            echo '<button title = "Move priority Down" class="new-button mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" disabled value="';
            echo $pri;
            echo '" name="down">&#x25BC;</button></form>';
            echo "</td><td>";
            }
            
            else if ($pri == 0){
                echo '<form class="update" action="" method="post">';
            echo '<button title = "Move priority Up" class="new-button mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" disabled value="';
            echo $pri;
            echo '" name="up">&#x25B2;</button>';
            echo '<button title = "Move priority Down" class="new-button mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit"  value="';
            echo $pri;
            echo '" name="down">&#x25BC;</button></form>';
            echo "</td><td>";
            } 
            
            else if ($count == 1){
                echo '<form class="update" action="" method="post">';
            echo '<button title = "Move priority Up" class="new-button mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" disabled value="';
            echo $pri;
            echo '" name="up">&#x25B2;</button>';
            echo '<button title = "Move priority Down" class="new-button mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" disabled value="';
            echo $pri;
            echo '" name="down">&#x25BC;</button></form>';
            echo "</td><td>";
            }

            else{
                echo '<form class="update" action="" method="post">';
                echo '<button title = "Move priority Up" class="new-button mdl-button mdl-button--green mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                echo $pri;
                echo '" name="up">&#x25B2;</button>';
                echo '<button title = "Move priority Down" class="new-button mdl-button mdl-button--blue mdl-js-button mdl-js-ripple-effect" type="submit" value="';
                echo $pri;
                echo '" name="down">&#x25BC;</button></form>';
                echo "</td><td>";
            }
            //deactivating the elective
            echo '<form class="update" action="" method="post">';
            echo '<button class="mdl-button mdl-button--red mdl-js-button mdl-js-ripple-effect" type="submit" value="';
            echo $code;
            echo '" name="delete">Delete</button></form>';
            echo "</td></td>";
        }    
        Database::disconnect();
    }

    //upgrade student priority
    public static function upstudentpriority($pri,$user){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pre = $pri - 1;
        
            
        //fetching subject code of selected priority
        $roll1 =  "SELECT subj_code FROM priorities WHERE priority = ? AND rollno = ?";
        $query1 = $pdo->prepare($roll1);
        $query1->execute(array($pri,$user));
        $data1 = $query1->fetch(PDO::FETCH_ASSOC);   
        $sub1 = $data1['subj_code'];
        
        // fetching subj.code of lower priority than selected priority
        $roll2 =  "SELECT subj_code FROM priorities WHERE priority = ? AND rollno = ?";
        $query2 = $pdo->prepare($roll2);
        $query2->execute(array($pre,$user));
        $data2 = $query2->fetch(PDO::FETCH_ASSOC);   
        $sub2 = $data2['subj_code'];

        // initializing a third variable to swap the values of priorities
        $temp = $pri;
        
        // updating priorities
        $sql1 = "UPDATE priorities SET priority = ? WHERE rollno = ? AND subj_code = ?";
        $q1 = $pdo->prepare($sql1);
        $q1->execute(array($pre,$user,$sub1));
        $sql2 = "UPDATE priorities SET priority = ? WHERE rollno = ? AND subj_code = ?";
        $q2 = $pdo->prepare($sql2);
        $q2->execute(array($temp,$user,$sub2));

        Database::disconnect();
        return 1;
    }

    //downgrade student priority
    public static function downstudentpriority($pri,$user) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $next = $pri + 1;

            
        // fetching subject code of selected priority
        $roll1 =  "SELECT subj_code FROM priorities WHERE priority = ? AND rollno = ?";
        $query1 = $pdo->prepare($roll1);
        $query1->execute(array($pri,$user));
        $data1 = $query1->fetch(PDO::FETCH_ASSOC);   
        $sub1 = $data1['subj_code'];
        
        
        // fetching subj.code of lower priority than selected priority
        $roll2 =  "SELECT subj_code FROM priorities WHERE priority = ? AND rollno = ?";
        $query2 = $pdo->prepare($roll2);
        $query2->execute(array($next,$user));
        $data2 = $query2->fetch(PDO::FETCH_ASSOC);   
        $sub2 = $data2['subj_code'];
        

        // initializing a third variable to swap the values of priorities
        $temp = $pri;
        
        // updating priorities
        $sql1 = "UPDATE priorities SET priority = ? WHERE rollno = ? AND subj_code = ?";
        $q1 = $pdo->prepare($sql1);
        $q1->execute(array($next,$user,$sub1));
        $sql2 = "UPDATE priorities SET priority = ? WHERE rollno = ? AND subj_code = ?";
        $q2 = $pdo->prepare($sql2);
        $q2->execute(array($temp,$user,$sub2));

        Database::disconnect();

        return 1;
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
            $sql = "SELECT deptcode,subj_code,subject_name,subj_type,link,info,total_seats,semester  FROM `subjects_published` WHERE active = 1 order by subj_code ASC";
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
                echo '</td><td class="mdl-data-table__cell--non-numeric">';
                echo $data['link'];
                echo '</td><td class="mdl-data-table__cell--non-numeric">';
                echo $data['info'];
                echo '</td><td>';
                echo $data['semester'];
                echo "</td><td>";
                echo $data['total_seats'];
                echo "</td></tr>";
            }
            Database::disconnect();
        }

        //getting department name from department code
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
            //return $name;
        }


        //other functions

        //priorities backup
        public static function createbackup()   {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CALL replicate_priorities_table";
            $q = $pdo->prepare($sql); 
            $q->execute();
            Database::disconnect();

            return 1;
        }

        //allotting electives
        public static function startallotment() {
            
            echo "Allotment in Progress, Please don't refresh/close page.<br>This might take few minutes.<br>";
            //selects the total no. of students in the table
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CALL total_students_count";
            $q = $pdo->prepare($sql); 
            $q->execute();
            $data = $q->fetch(PDO::FETCH_ASSOC);
            $count = $data['countno'];

            for ($i=0; $i < $count; $i++) { 
                    
                //max_cgpi - gives max cgpi of student
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "CALL max_cgpi";
                $q = $pdo->prepare($sql); 
                $q->execute();
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $rollno = $data['rollno'];
                
                //select the subject with minimum priority of student
                $sql = "CALL select_priority(?)";
                $q = $pdo->prepare($sql); 
                $q->execute(array($rollno));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $subject = $data['subj_code'];

                //get total no. of seats in subject
                $sql = "CALL total_seats_subject(?)";
                $q = $pdo->prepare($sql); 
                $q->execute(array($subject));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $total_seats = $data['total_seats'];

                //get the no. of alloted seats
                $sql = "CALL seats_in_subject_allotted(?)";
                $q = $pdo->prepare($sql); 
                $q->execute(array($subject));
                $data = $q->fetch(PDO::FETCH_ASSOC);
                $alloted_seats = $data['total_seats'];
                Database::disconnect();

                //no. of available seats
                $seats_available = $total_seats - $alloted_seats;   

                //if seat available then allot priority
                if ($seats_available != 0) {
                    //allot priority
                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "CALL allot_priority(?)";
                    $q = $pdo->prepare($sql); 
                    $q->execute(array($rollno));
                    $data = $q->fetch(PDO::FETCH_ASSOC);
                    $subject = $data['subj_code'];

                    //final allotment of subject 
                    $sql = "CALL allot_final(?,?)";
                    $q = $pdo->prepare($sql); 
                    $q->execute(array($rollno,$subject));

                    //set allotment value = 1 in students.allotment
                    $sql = "CALL student_alloted(?)";
                    $q = $pdo->prepare($sql); 
                    $q->execute(array($rollno));
                    Database::disconnect();

                    //delete all the other priorities
                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "CALL delete_user_priorities(?)";
                    $q = $pdo->prepare($sql); 
                    $q->execute(array($rollno));
                    Database::disconnect();

                }   else    {//else delete priority
                    $pdo = Database::connect();
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "CALL delete_specific_priority(?)";
                    $q = $pdo->prepare($sql); 
                    $q->execute(array($rollno));
                    Database::disconnect();
                }
            }

            return 1;
        }

        //electives allotment result
        public static function Allotmentresult()    {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT rollno,subj_code FROM students_allotted WHERE 1";
            $q = $pdo->prepare($sql);
            $q->execute();

            while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr><td>';
                echo $data['rollno'];
                echo '</td><td>';
                echo $data['subj_code'];
                echo "</td></tr>";
            }
            Database::disconnect();

            if ($data['rollno'] != NULL) {
                return 1;
            }
            else return 0;
        }

        //undo allotment
        public static function UndoAllotment()  {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "CALL undo_allotment()";
            $q = $pdo->prepare($sql); 
            $q->execute();
            $sql = "CALL clear_priorities()";
            $q = $pdo->prepare($sql); 
            $q->execute();
            $sql = "CALL clear_students_allotted()";
            $q = $pdo->prepare($sql); 
            $q->execute();
            $sql = "CALL resave_priorities()";
            $q = $pdo->prepare($sql); 
            $q->execute();
            Database::disconnect();

            return 1;
        }

        public static function RegisteredStudents() {

            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT rollno, name, branch FROM students WHERE 1";
            $q = $pdo->prepare($sql);
            $q->execute();

            while($data = $q->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr><td>';
                echo $data['rollno'];
                echo '</td><td class="mdl-data-table__cell--non-numeric">';
                echo $data['name'];
                echo '</td><td class="mdl-data-table__cell--non-numeric">';
                echo Database::departmentsname($data['branch']);
                echo "</td></tr>";
            }
            Database::disconnect();
        }

        //generating the tokens (random strings)
        public static function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

    //mailing the required stuff for the app
    public static function mailthedetails($to,$subject,$message) {
        
        //sending the mail through 3rd party API - mailgun.com
        exec("curl -s --user 'api:key-[YOUR-API-KEY-HERE]' \    https://api.mailgun.net/v3/sandboxb6377426d4624727b78a197408029a96.mailgun.org/messages \  -F headers='MIME-Version: 1.0\r\n' -F headers='Content-Type: text/html; charset=ISO-8859-1\r\n'  -F from='nith.ac.in <postmaster@sandboxb6377426d4624727b78a197408029a96.mailgun.org>' \    -F to='$to' \    -F subject='$subject' \    -F text='$message'");

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

/**
 * SQL Procedure's "name" - "working"
 *
 * allot_final - Inserts the rollno. of student along with the subject code to final students_allotted database ie. final elective allotment
 *
 * allot_priority - Selects rollno. and subject code from priorities table where priority is minimum [rollno. is taken as input]
 *
 * allotments - Selects name and cgpi from students where rollno. is taken as input
 *
 * delete_specific_priority - Once a priority has been checked and is unavailable then it'll take rollno. and priority as input and will delete the specific priority and will again call allot_priority
 * 
 * delete_user_priorities - Deletes all priorities of user rollno. is given as input, this will be called once elective has been allotted to a student.
 *
 * max_cgpi - Selects the rollno. from student where student has max(cgpi) ie. the highest cgpi student
 *
 * max_cgpi_priorities - Selects the rollno. from priorities with max(cgpi), is similar to the above procedure
 * 
 * replicate_priorities_table - creates a table with name priorities_backup and moves all the content of priorities table to this table.
 *
 * seats_in_subject_allotted - Selects the no. of seats allotted to students in a particular subject.
 *
 * select_priority - Selects the subject code with minimum priority from priorities
 * 
 * total_seats_subject - Selects the no. of seats in a subject, subject code is taken as input
 */

?>
