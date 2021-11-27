-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2018 at 06:40 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `electivemanager`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `allotments` (IN `roll` VARCHAR(11))  SELECT name, cgpi from students WHERE rollno = roll$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `allot_final` (IN `roll` VARCHAR(11), IN `subject` VARCHAR(11))  MODIFIES SQL DATA
INSERT INTO students_allotted(rollno, subj_code) VALUES(roll, subject)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `allot_priority` (IN `roll` VARCHAR(11))  READS SQL DATA
SELECT subj_code FROM priorities WHERE rollno = roll order by priority ASC limit 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `clear_priorities` ()  MODIFIES SQL DATA
TRUNCATE TABLE `priorities`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `clear_students_allotted` ()  NO SQL
TRUNCATE TABLE `students_allotted`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_specific_priority` (IN `roll` VARCHAR(11))  DELETE FROM priorities WHERE rollno = roll ORDER BY priority ASC LIMIT 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_user_priorities` (IN `roll` VARCHAR(11))  MODIFIES SQL DATA
DELETE FROM priorities WHERE rollno = roll$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `max_cgpi` ()  READS SQL DATA
SELECT rollno from students WHERE cgpi = (
    select max(cgpi)
    from students WHERE allotment = 0 LIMIT 1
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `max_cgpi_priorities` ()  READS SQL DATA
SELECT rollno from priorities WHERE cgpi = (
    select max(cgpi)
    from priorities
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `replicate_priorities_table` ()  INSERT INTO priorities_backup
SELECT * FROM priorities$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `resave_priorities` ()  MODIFIES SQL DATA
INSERT INTO `electivemanager`.`priorities`(`rollno`, `cgpi`, `subj_code`, `priority`) SELECT `rollno`, `cgpi`, `subj_code`, `priority` FROM `electivemanager`.`priorities_backup`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `seats_in_subject_allotted` (IN `subjcode` VARCHAR(11))  READS SQL DATA
SELECT COUNT(subj_code) AS total_seats FROM students_allotted WHERE subj_code = subjcode$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_priority` (IN `roll` VARCHAR(11))  READS SQL DATA
SELECT subj_code from priorities WHERE rollno = roll AND priority = (
    select min(priority)
    from priorities WHERE rollno = roll
)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `student_alloted` (IN `roll` INT(11))  NO SQL
UPDATE students SET allotment = 1 WHERE rollno = roll$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_seats_subject` (IN `subjcode` VARCHAR(11))  READS SQL DATA
SELECT total_seats FROM subjects_published WHERE subj_code = subjcode AND active = 1$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_students_count` ()  READS SQL DATA
SELECT COUNT(rollno) AS countno FROM `priorities`$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `total_students_rollno` ()  READS SQL DATA
SELECT rollno FROM `priorities` GROUP BY rollno$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `undo_allotment` ()  MODIFIES SQL DATA
UPDATE `students` SET `allotment` = '0' WHERE 1$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(10) NOT NULL,
  `origin` varchar(15) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `destination` varchar(15) NOT NULL,
  `type` varchar(15) NOT NULL,
  `content` varchar(15) NOT NULL,
  `marked` decimal(2,1) NOT NULL DEFAULT '0.0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `origin`, `username`, `destination`, `type`, `content`, `marked`, `created`) VALUES
(1, NULL, NULL, 'admin', 'login', '172.16.21.69', '1.0', '2017-07-27 07:08:51'),
(2, NULL, NULL, 'admin', 'login', '172.16.21.55', '1.0', '2017-07-27 07:08:51'),
(3, 'csed', 'deptsuper', 'deptuser', 'elec_delete', 'CS-700', '1.0', '2017-07-27 06:36:23'),
(4, 'csed', NULL, '14508', 'allotment', 'CS-700', '1.0', '2017-07-27 06:36:23'),
(5, NULL, '14555', 'admin', 'acc_delete', '172.16.21.69', '1.0', '2017-07-27 06:36:23'),
(6, 'csed', 'deptsuper', 'admin', 'elec_published', 'CS702', '0.5', '2017-07-27 07:08:51'),
(7, NULL, NULL, 'admin', 'pass_change', '172.16.21.69', '1.0', '2017-07-27 07:08:51'),
(8, NULL, NULL, 'admin', 'pass_change', '172.16.21.55', '1.0', '2017-07-27 07:08:51'),
(9, NULL, NULL, 'admin', 'pass_change', '172.16.21.69', '1.0', '2017-07-27 07:08:51'),
(10, NULL, NULL, 'admin', 'login', '172.16.21.69', '1.0', '2017-07-27 07:27:48'),
(11, NULL, NULL, 'student', 'fill_priorities', '07:00 PM 31/07', '0.0', '2017-07-30 07:24:48'),
(12, NULL, NULL, 'department', 'pub_elective', '05:00PM 01/08', '0.0', '2017-08-01 07:09:06'),
(13, 'csed', 'deptsuper', 'admin', 'elec_delete', 'cs-703', '0.5', '2017-08-01 07:31:53'),
(14, 'csed', 'deptsuper', 'deptuser', 'elec_delete', 'CS-702', '1.0', '2017-09-26 18:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `rollno` varchar(11) NOT NULL,
  `cgpi` decimal(10,2) NOT NULL,
  `subj_code` varchar(11) NOT NULL,
  `priority` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`rollno`, `cgpi`, `subj_code`, `priority`) VALUES
('14508', '10.00', 'CSE-414(c)', 0),
('14508', '10.00', 'CSE-425(c)', 1),
('14510', '9.00', 'CSE-414(c)', 0),
('14510', '9.00', 'CSE-425(c)', 1),
('14511', '8.00', 'CSE-414(c)', 0),
('14511', '8.00', 'CSE-425(c)', 1),
('iiitu14101', '7.00', 'CSE-414(c)', 0),
('iiitu14101', '7.00', 'CSE-425(c)', 1);

-- --------------------------------------------------------

--
-- Table structure for table `priorities_backup`
--

CREATE TABLE `priorities_backup` (
  `rollno` varchar(11) NOT NULL,
  `cgpi` decimal(10,2) NOT NULL,
  `subj_code` varchar(11) NOT NULL,
  `priority` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `rollno` varchar(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `branch` varchar(4) NOT NULL,
  `fathers_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `reg_no` varchar(7) NOT NULL,
  `email` varchar(35) NOT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `activate` varchar(32) NOT NULL,
  `cgpi` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `allotment` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`rollno`, `name`, `password`, `branch`, `fathers_name`, `dob`, `reg_no`, `email`, `mobile_no`, `activate`, `cgpi`, `created`, `allotment`) VALUES
('14508', 'john woods', '5f4dcc3b5aa765d61d8327deb882cf99', 'csed', 'H.S.Chaudhary', '1996-02-04', 'CSED221', 'rishabh0402@gmail.com', '9805126955', '1', '10.00', '2018-06-27 06:38:57', 0),
('14510', 'Pasha Kumar', '5f4dcc3b5aa765d61d8327deb882cf99', 'csed', 'bihari lal', '1998-10-15', 'asdf', 'dsfsd@sadf.com', '7845125896', '1', '9.00', '2018-06-27 06:38:57', 0),
('14511', 'Kartikay', '5f4dcc3b5aa765d61d8327deb882cf99', 'csed', 'kartik', '1996-05-02', 'asdfas', 'kartkiay@gmail.com', '8745965123', '1', '8.00', '2018-06-27 06:38:57', 0),
('iiitu14101', 'anyone here', '5f4dcc3b5aa765d61d8327deb882cf99', 'csed', 'fasdtqadf', '1996-12-02', 'asdfasd', 'asdfl@lsajfl.com', '9034257814', '1', '7.00', '2018-06-27 06:38:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_allotted`
--

CREATE TABLE `students_allotted` (
  `rollno` varchar(11) NOT NULL,
  `subj_code` varchar(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects_published`
--

CREATE TABLE `subjects_published` (
  `username` varchar(15) NOT NULL,
  `deptcode` varchar(4) NOT NULL,
  `subj_code` varchar(11) NOT NULL,
  `subject_name` varchar(60) NOT NULL,
  `total_seats` int(3) NOT NULL,
  `link` varchar(100) NOT NULL,
  `info` varchar(100) NOT NULL,
  `subj_type` varchar(13) NOT NULL,
  `semester` int(2) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects_published`
--

INSERT INTO `subjects_published` (`username`, `deptcode`, `subj_code`, `subject_name`, `total_seats`, `link`, `info`, `subj_type`, `semester`, `active`) VALUES
('deptsuper', 'csed', 'CS-700', 'Artificial Intelligence', 50, 'asdf', 'AI', 'pg_elective', 7, 0),
('deptsuper', 'csed', 'CS-701', 'Formal Languages and Automata Theory', 56, 'dfa', 'formal lang and automata', 'pg_elective', 5, 1),
('deptsuper', 'csed', 'CS-703', 'Topics in Cloud Computing', 85, 'adf', 'asfdasdf', 'pg_elective', 8, 0),
('deptuser', 'csed', 'CS-705', 'CAD of Digital Systems', 45, 'gfjhgjhgj', 'lkasjfklsadjfssfd', 'pg_elective', 8, 1),
('deptuser', 'csed', 'CS-708', 'Software Testing', 99, 'sdfg', 'asdfgsdfgsdfg', 'pg_elective', 5, 1),
('deptsuper', 'csed', 'CS-710', 'Real Time System Design', 52, 'jhjklhjklh', 'ksadjflkjdf lkasjdflkjasdf', 'pg_elective', 9, 1),
('deptsuper', 'csed', 'CS-712', 'Information Theory and Coding', 75, 'asdfjlkj', 'aslkdfjlkjsfd', 'pg_elective', 8, 1),
('deptsuper', 'csed', 'CS-716', 'Soft Computing', 85, 'kjkljklj', 'skldjfsdf', 'pg_elective', 1, 1),
('deptsuper', 'csed', 'CS-717', 'Cluster and Grid Computing', 45, 'asdklkjhgfdc', 'jhghjghjghj jhghjghjg', 'pg_elective', 9, 1),
('deptsuper', 'csed', 'CS-731', 'Multimedia Computing', 85, 'asdhfkjsdhf.pdf', 'kjdflkj adlkf lkjlkadsf jl sajdflkj lasjfkljsafd.', 'pg_elective', 8, 0),
('deptsuper', 'csed', 'CSE-413(c)', 'CAD of Digital Systems', 75, 'sadkfj', 'aslkdfjklasdjf', 'dept_elective', 8, 0),
('deptsuper', 'csed', 'CSE-414(c)', 'Parallel Algorithms', 2, '55', '554', 'dept_elective', 2, 1),
('deptsuper', 'csed', 'CSE-424(a)', 'Distributed Systems', 75, 'aslkdfj', 'KJDFkadjf', 'dept_elective', 7, 0),
('deptsuper', 'csed', 'CSE-424(c)', 'Reconfigurable Computing', 12, '5sdfghjkl', '4545', 'dept_elective', 6, 0),
('deptsuper', 'csed', 'CSE-425(c)', 'Programming Language Security', 2, 'dkfkjsd.pdf', 'asdklfjlk sldkjflkasjdfl;', 'dept_elective', 5, 1),
('deptsuper', 'csed', 'CSE-425(d)', 'Wireless Sensor Networks', 45, 'sdfjlkasjdflksjdfl', 'kdjfkdjfk kjkl', 'dept_elective', 3, 0),
('deptsuper', 'csed', 'CSO-316', 'Data Structure', 70, 'nith.ac.in/try.pdf', 'Hope it works.', 'open_elective', 5, 1),
('deptsuper', 'csed', 'CSO-324', 'Computer Graphics', 52, 'asfjljasdlf.pdf', 'asldkfjkl;asjfl;kjasl;fkjasl;kfjl;aksjfkl;jasf', 'open_elective', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subject_master`
--

CREATE TABLE `subject_master` (
  `deptcode` varchar(4) NOT NULL,
  `subj_code` varchar(11) NOT NULL,
  `dept_elective` int(1) DEFAULT '0',
  `open_elective` int(1) DEFAULT '0',
  `pg_elective` int(1) DEFAULT '0',
  `subject_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject_master`
--

INSERT INTO `subject_master` (`deptcode`, `subj_code`, `dept_elective`, `open_elective`, `pg_elective`, `subject_name`) VALUES
('csed', 'CS-700', 0, 0, 1, 'Artificial Intelligence'),
('csed', 'CS-701', 0, 0, 1, 'Formal Languages and Automata Theory'),
('csed', 'CS-702', 0, 0, 1, 'Computer Vision and Image Processing'),
('csed', 'CS-703', 0, 0, 1, 'Topics in Cloud Computing'),
('csed', 'CS-704', 0, 0, 1, 'Cryptography and Computer Security'),
('csed', 'CS-705', 0, 0, 1, 'CAD of Digital Systems'),
('csed', 'CS-706', 0, 0, 1, 'Combinatorial Optimization'),
('csed', 'CS-707', 0, 0, 1, 'Software Project & Quality Management'),
('csed', 'CS-708', 0, 0, 1, 'Software Testing'),
('csed', 'CS-709', 0, 0, 1, 'Graph Theory and Network Algorithms'),
('csed', 'CS-710', 0, 0, 1, 'Real Time System Design'),
('csed', 'CS-711', 0, 0, 1, 'Intrusion Detection System'),
('csed', 'CS-712', 0, 0, 1, 'Information Theory and Coding'),
('csed', 'CS-713', 0, 0, 1, 'Game Theory'),
('csed', 'CS-714', 0, 0, 1, 'Bioinformatics'),
('csed', 'CS-715', 0, 0, 1, 'Biometric Security'),
('csed', 'CS-716', 0, 0, 1, 'Soft Computing'),
('csed', 'CS-717', 0, 0, 1, 'Cluster and Grid Computing'),
('csed', 'CS-718', 0, 0, 1, 'Embedded Systems'),
('csed', 'CS-719', 0, 0, 1, 'Fault Tolerant Computing'),
('csed', 'CS-720', 0, 0, 1, 'Parallel Algorithms'),
('csed', 'CS-721', 0, 0, 1, 'Performance Evaluation of Computer System'),
('csed', 'CS-722', 0, 0, 1, 'Speech and NLP'),
('csed', 'CS-723', 0, 0, 1, 'Advances in Compiler Construction'),
('csed', 'CS-724', 0, 0, 1, 'Formal Methods in Secure Computing'),
('csed', 'CS-730', 0, 0, 1, 'Mobile Databases'),
('csed', 'CS-731', 0, 0, 1, 'Multimedia Computing'),
('csed', 'CS-732', 0, 0, 1, 'Data Mining'),
('csed', 'CS-733', 0, 0, 1, 'Security in Wireless & Mobile System'),
('csed', 'CS-734', 0, 0, 1, 'Distributed and Mobile Architecture'),
('csed', 'CS-735', 0, 0, 1, 'Programming Mobile Devices'),
('csed', 'CS-750', 0, 1, 0, 'Modeling & Simulation'),
('csed', 'CS-751', 0, 1, 0, 'Computer Graphics'),
('csed', 'CSE-413(a)', 1, 0, 0, 'Web Technologies'),
('csed', 'CSE-413(b)', 1, 0, 0, 'Information Retrieval'),
('csed', 'CSE-413(c)', 1, 0, 0, 'CAD of Digital Systems'),
('csed', 'CSE-413(d)', 1, 0, 0, 'Artificial Intelligence'),
('csed', 'CSE-414(a)', 1, 0, 0, 'Management Information System'),
('csed', 'CSE-414(b)', 1, 0, 0, 'Advanced Microprocessors'),
('csed', 'CSE-414(c)', 1, 0, 0, 'Parallel Algorithms'),
('csed', 'CSE-414(d)', 1, 0, 0, 'Soft Computing'),
('csed', 'CSE-424(a)', 1, 0, 0, 'Distributed Systems'),
('csed', 'CSE-424(b)', 1, 0, 0, 'Agent Based Systems'),
('csed', 'CSE-424(c)', 1, 0, 0, 'Reconfigurable Computing'),
('csed', 'CSE-424(d)', 1, 0, 0, 'Mobile Databases'),
('csed', 'CSE-425(a)', 1, 0, 0, 'Advance Computer Networks'),
('csed', 'CSE-425(b)', 1, 0, 0, 'Embedded Systems'),
('csed', 'CSE-425(c)', 1, 0, 0, 'Programming Language Security'),
('csed', 'CSE-425(d)', 1, 0, 0, 'Wireless Sensor Networks'),
('csed', 'CSO-316', 0, 1, 0, 'Data Structure'),
('csed', 'CSO-324', 0, 1, 0, 'Computer Graphics');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(35) NOT NULL,
  `mobileno` varchar(10) NOT NULL,
  `usertype` varchar(10) NOT NULL,
  `active` varchar(32) DEFAULT NULL,
  `deptcode` varchar(4) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `email`, `mobileno`, `usertype`, `active`, `deptcode`, `created`) VALUES
('archsuper', '5f4dcc3b5aa765d61d8327deb882cf99', 'archi@gmail.com', '9834728473', 'superuser', '1', 'arch', '2017-06-19 10:47:12'),
('chedsuper', '5f4dcc3b5aa765d61d8327deb882cf99', 'csesuper@gmail.com', '9805125833', 'superuser', '1', 'ched', '2017-06-19 09:00:11'),
('cheduser', '5f4dcc3b5aa765d61d8327deb882cf99', 'cseuser@gmail.com', '9805128544', 'normaluser', '1', 'ched', '2017-06-19 09:00:16'),
('civisuper', '5f4dcc3b5aa765d61d8327deb882cf99', 'civil@gmail.com', '9805123454', 'superuser', '1', 'civi', '2017-06-19 10:43:10'),
('deptsuper', '5f4dcc3b5aa765d61d8327deb882cf99', 'deptsuper@gmail.com', '9882955524', 'superuser', '1', 'csed', '2017-06-27 07:34:02'),
('deptuser', '5f4dcc3b5aa765d61d8327deb882cf99', 'deptuser@gmail.com', '980512695', 'normaluser', '1', 'csed', '2017-06-17 11:54:40'),
('ecedsuper', '5f4dcc3b5aa765d61d8327deb882cf99', 'eced@gmail.com', '9876543456', 'superuser', '1', 'eced', '2017-06-19 10:45:36'),
('eeedsuper', '5f4dcc3b5aa765d61d8327deb882cf99', 'eeed@gmail.com', '9823475837', 'superuser', '1', 'eeed', '2017-06-19 10:45:39'),
('medsuper', '5f4dcc3b5aa765d61d8327deb882cf99', 'medsuper@gmail.com', '9805126944', 'superuser', '1', 'med', '2017-06-19 08:59:34'),
('meduser', '5f4dcc3b5aa765d61d8327deb882cf99', 'meduser@gmail.com', '9805126433', 'normaluser', '1', 'med', '2017-06-19 08:59:39'),
('msedsuper', '5f4dcc3b5aa765d61d8327deb882cf99', 'msed@gmail.com', '9834237584', 'superuser', '1', 'msed', '2017-06-19 10:47:17'),
('Rishabh0402', '5f4dcc3b5aa765d61d8327deb882cf99', 'rishabh0402@gmail.com', '9805126955', 'admin', '1', 'adm', '2017-07-01 09:20:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`rollno`,`priority`),
  ADD KEY `subj code` (`subj_code`);

--
-- Indexes for table `priorities_backup`
--
ALTER TABLE `priorities_backup`
  ADD PRIMARY KEY (`rollno`,`priority`),
  ADD KEY `subj code` (`subj_code`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`rollno`),
  ADD UNIQUE KEY `reg no` (`reg_no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `students_allotted`
--
ALTER TABLE `students_allotted`
  ADD KEY `rollno` (`rollno`),
  ADD KEY `subj code` (`subj_code`);

--
-- Indexes for table `subjects_published`
--
ALTER TABLE `subjects_published`
  ADD PRIMARY KEY (`subj_code`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `subject_master`
--
ALTER TABLE `subject_master`
  ADD PRIMARY KEY (`subj_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobileno` (`mobileno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `priorities`
--
ALTER TABLE `priorities`
  ADD CONSTRAINT `priorities_ibfk_2` FOREIGN KEY (`rollno`) REFERENCES `students` (`rollno`) ON DELETE CASCADE;

--
-- Constraints for table `students_allotted`
--
ALTER TABLE `students_allotted`
  ADD CONSTRAINT `students_allotted_ibfk_1` FOREIGN KEY (`rollno`) REFERENCES `students` (`rollno`),
  ADD CONSTRAINT `students_allotted_ibfk_2` FOREIGN KEY (`subj_code`) REFERENCES `subjects_published` (`subj_code`);

--
-- Constraints for table `subjects_published`
--
ALTER TABLE `subjects_published`
  ADD CONSTRAINT `subjects_published_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
