-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 25, 2020 at 04:46 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `berladb`
--
CREATE DATABASE IF NOT EXISTS `berladb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `berladb`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phone` varchar(15) NOT NULL,
  `password` varchar(64) NOT NULL,
  `roleId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phonenum` (`phone`),
  KEY `roleId` (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `phone`, `password`, `roleId`) VALUES
(1, '1234', '$2y$10$JBvf15ufpt7HFiFknqeO6uY2ZdmlGvy3.Si6rngLRb1.eh6zE/4Hi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appt_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bed`
--

DROP TABLE IF EXISTS `bed`;
CREATE TABLE IF NOT EXISTS `bed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_no` int(11) NOT NULL,
  `occupied` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bed_patient`
--

DROP TABLE IF EXISTS `bed_patient`;
CREATE TABLE IF NOT EXISTS `bed_patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `bed_id` int(11) NOT NULL,
  `allocation_date` datetime NOT NULL,
  `allocator_id` int(11) NOT NULL,
  `release_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `allocator_id` (`allocator_id`),
  KEY `bed_id` (`bed_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(15) NOT NULL,
  `mname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `sex` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `officeno` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `photo` blob NOT NULL,
  `accountid` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountid` (`accountid`) USING BTREE,
  KEY `ward_id` (`ward_id`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `mname`, `lname`, `dob`, `sex`, `phone`, `officeno`, `email`, `photo`, `accountid`, `ward_id`) VALUES
(1, 'Elyas', 'Demeke', 'Tedla', '1998-06-26', 1, '1234', '0921465868', 'nebiyou.elyas11@gmail.com', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `labratoryresult`
--

DROP TABLE IF EXISTS `labratoryresult`;
CREATE TABLE IF NOT EXISTS `labratoryresult` (
  `id` int(11) NOT NULL,
  `lab_test_id` int(11) NOT NULL,
  `result` text NOT NULL,
  `completion_date` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lab_test_id` (`lab_test_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `labratorytest`
--

DROP TABLE IF EXISTS `labratorytest`;
CREATE TABLE IF NOT EXISTS `labratorytest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(15) NOT NULL,
  `test_order_time` datetime NOT NULL,
  `doctor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `oralhistory`
--

DROP TABLE IF EXISTS `oralhistory`;
CREATE TABLE IF NOT EXISTS `oralhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date_time_diagnosis` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

DROP TABLE IF EXISTS `patients`;
CREATE TABLE IF NOT EXISTS `patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(15) NOT NULL,
  `mname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `dob` date NOT NULL,
  `sex` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `accountid` int(11) NOT NULL,
  `in_patient` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountid` (`accountid`) USING BTREE,
  KEY `phone` (`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `amount` text NOT NULL,
  `prescription_date` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Role Name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `permission`) VALUES
(1, 'Admin', 'a:4:{i:0;s:4:\"view\";i:1;s:6:\"update\";i:2;s:6:\"delete\";i:3;s:6:\"create\";}');

-- --------------------------------------------------------

--
-- Table structure for table `sick_leave`
--

DROP TABLE IF EXISTS `sick_leave`;
CREATE TABLE IF NOT EXISTS `sick_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `leaving_date_start` date NOT NULL,
  `leaving_date_end` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ward`
--

DROP TABLE IF EXISTS `ward`;
CREATE TABLE IF NOT EXISTS `ward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  `phone_num` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ward`
--

INSERT INTO `ward` (`id`, `name`, `phone_num`) VALUES
(1, 'Gynecology', '+251 942589006'),
(2, 'Pediatrics', '+251 910234231');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `accounts_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`);

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Constraints for table `bed_patient`
--
ALTER TABLE `bed_patient`
  ADD CONSTRAINT `bed_patient_ibfk_1` FOREIGN KEY (`allocator_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `bed_patient_ibfk_2` FOREIGN KEY (`bed_id`) REFERENCES `bed` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`ward_id`) REFERENCES `ward` (`id`),
  ADD CONSTRAINT `employees_ibfk_3` FOREIGN KEY (`accountid`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `employees_ibfk_4` FOREIGN KEY (`phone`) REFERENCES `accounts` (`phone`);

--
-- Constraints for table `labratoryresult`
--
ALTER TABLE `labratoryresult`
  ADD CONSTRAINT `labratoryresult_ibfk_1` FOREIGN KEY (`lab_test_id`) REFERENCES `labratorytest` (`id`);

--
-- Constraints for table `labratorytest`
--
ALTER TABLE `labratorytest`
  ADD CONSTRAINT `labratorytest_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `employees` (`id`);

--
-- Constraints for table `oralhistory`
--
ALTER TABLE `oralhistory`
  ADD CONSTRAINT `oralhistory_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `oralhistory_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`accountid`) REFERENCES `accounts` (`id`),
  ADD CONSTRAINT `patients_ibfk_2` FOREIGN KEY (`phone`) REFERENCES `accounts` (`phone`);

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Constraints for table `sick_leave`
--
ALTER TABLE `sick_leave`
  ADD CONSTRAINT `sick_leave_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `sick_leave_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
