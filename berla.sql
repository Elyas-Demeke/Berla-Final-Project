-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2021 at 07:17 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

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
DROP DATABASE IF EXISTS `berladb`;
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
  `active` binary(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phonenum` (`phone`),
  KEY `roleId` (`roleId`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `phone`, `password`, `roleId`, `active`) VALUES
(1, '1234', '$2y$10$JBvf15ufpt7HFiFknqeO6uY2ZdmlGvy3.Si6rngLRb1.eh6zE/4Hi', 4, 0x31),
(4, '23453452435', '$2y$10$4bzHVHevt6qWs.Wuy75ArOlyZjJXBces5X6k.GE0EhMcu0Ty.fljy', 2, 0x31),
(7, '12345678', '$2y$10$x5ypF3zISQR.E1BGw.DJ9e2yOJX3pXiD9nk4cgL7ijMVEOVckgQ8m', 2, 0x30),
(9, '0956898954', '$2y$10$9UMGjd6wYXFXp30Y1PP7suZWHpr5gdVwqOcgObsKEiqwbSNEhkP6K', 2, 0x31),
(10, '0965849878', '$2y$10$OUpHvQ5VxLOC49dquibGdOuDoW0yfpi1EUml4BGuwyx6Xqu8Hfega', 5, 0x31),
(14, '0984579312', '$2y$10$65RT1T4ifd8hykFLyHbPyuPdKhpgGqChhoVTYOuhWvXduk9jI1bA2', 3, 0x30),
(16, '0912356485', '$2y$10$7foZFDqwldWU2s22d4zPFeEtpRiqf1yWk4pLEZoQknqp/LhPZEljC', 3, 0x31),
(18, '126584524', '$2y$10$g8TyzQYLHADi.ntHCeeqv.6MmAlAVHqKCPA5b9iGy9yuoYYsrBYbC', 4, 0x31),
(19, '0956213568', '$2y$10$YemnOTKJnK3N/LB5VjgbI.ogacGIJ12EWunP/OjUp8CxzFpzY1V2.', 3, 0x31),
(20, '0942512006', '$2y$10$hM88tokbEN9PnTpBKaav2uPk7Kpb0HVok9QxCFrO37Wvfu0sTfA0W', 2, 0x31),
(23, '09658545256', '$2y$10$w9o9Ym3x4z7h2ue68Bg8ge5tFZc4ikj8XTA7YIPrMNtOC./XcqUwC', 3, 0x30),
(24, '0956566556', '$2y$10$WJF/0AOwVPmadJRqdTzOAObqsuI5flT0j6appPDia7zpZsbvQFdnu', 5, 0x31),
(25, '0912568475', '$2y$10$BTnVUIhzyKblTK0t2aRvYe.W90Ad5n2P3/KrL6l1H7BJwzYXVZ99u', 11, 0x30);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appt_date` datetime NOT NULL,
  `status` binary(1) NOT NULL,
  `reason` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `patient_id`, `doctor_id`, `appt_date`, `status`, `reason`) VALUES
(3, 3, 1, '2020-06-05 05:06:00', 0x31, 'Check up'),
(4, 2, 1, '2021-06-25 00:56:00', 0x31, 'Laboratory test'),
(5, 3, 1, '2020-06-25 17:56:00', 0x31, 'Blood pressure test'),
(6, 3, 1, '2021-06-12 12:30:00', 0x31, 'Check up'),
(7, 5, 1, '2021-02-05 02:05:00', 0x30, 'Just to say HI'),
(8, 2, 1, '2020-06-12 00:05:00', 0x31, 'Check up'),
(9, 5, 1, '2021-06-12 00:50:00', 0x31, 'Check up');

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
  `officeno` text,
  `email` varchar(255) DEFAULT NULL,
  `photo` text NOT NULL,
  `accountid` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `accountid` (`accountid`) USING BTREE,
  KEY `ward_id` (`ward_id`),
  KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `fname`, `mname`, `lname`, `dob`, `sex`, `phone`, `officeno`, `email`, `photo`, `accountid`, `ward_id`) VALUES
(1, 'Elyas', 'Demeke', 'Tedla', '1998-06-26', 1, '1234', '0921465868', 'nebiyou.elyas11@gmail.com', 'uploads/danny.jpg', 1, 1),
(3, 'Amsalech', 'Worku', 'Tadesse', '1889-12-31', 2, '23453452435', '14352345', 'AT@gmail.com', 'uploads/communication-activities.jpg', 4, 2),
(7, 'Tariku', 'Mesay', 'Lema', '1989-06-26', 1, '0956898954', '1568954825', 'Tariku.Mesay@gmail.com', 'uploads/doctor-thumb-01.jpg', 9, 2),
(8, 'Semret', 'Solomon', 'Kebede', '1990-06-05', 2, '0965849878', '5846841831384', 'Semret.solomon@gmail.com', 'uploads/doctor-thumb-02.jpg', 10, 2),
(12, 'Frank', 'Manny', 'Pacquiao', '1990-06-05', 1, '126584524', '58468418313', 'frank.manny@gmail.com', 'uploads/Dr__Arkebe.jpeg', 18, 1),
(13, 'Bethelhem', 'Demeke', 'Lema', '1993-12-25', 2, '0942512006', '095684965468', 'Bethelhem.Demeke@gmail.com', 'uploads/doctor-thumb-021.jpg', 20, 1),
(15, 'yordanos', 'Mitiku', 'Bedada', '2021-02-25', 2, '0956566556', '1568954825', 'yorda.mit@gmail.com', 'uploads/doctor-031.jpg', 24, 1),
(16, 'yordanos', 'heung', 'Lema', '1985-06-12', 1, '0912568475', '1568954825', 'lasd@gmail.com', 'uploads/doctor-032.jpg', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `labratoryresult`
--

DROP TABLE IF EXISTS `labratoryresult`;
CREATE TABLE IF NOT EXISTS `labratoryresult` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lab_test_id` int(11) NOT NULL,
  `result` text NOT NULL,
  `completion_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lab_test_id` (`lab_test_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `labratoryresult`
--

INSERT INTO `labratoryresult` (`id`, `lab_test_id`, `result`, `completion_date`) VALUES
(1, 2, '13 % tumor markers found.', '2020-12-09'),
(6, 1, '100g blood sugar\r\n50g K', '2020-12-12'),
(7, 4, 'jhfjhfg', '2020-12-13'),
(8, 5, '100ml of', '2020-12-13'),
(9, 3, '100 g of sugar', '2020-12-13');

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
  `pat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `pat_id` (`pat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `labratorytest`
--

INSERT INTO `labratorytest` (`id`, `test_name`, `test_order_time`, `doctor_id`, `pat_id`) VALUES
(1, 'Blood tests', '2020-12-12 13:59:00', 1, 2),
(2, 'Tumor markers', '2020-12-12 14:09:00', 1, 5),
(3, 'Blood tests', '2020-12-13 09:20:00', 1, 2),
(4, 'Urine test', '2020-12-13 10:51:00', 1, 2),
(5, 'Urine test', '2020-12-13 12:41:00', 1, 5),
(6, 'Blood tests', '2021-01-05 13:35:00', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `oralhistory`
--

DROP TABLE IF EXISTS `oralhistory`;
CREATE TABLE IF NOT EXISTS `oralhistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `diagnosis` text NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oralhistory`
--

INSERT INTO `oralhistory` (`id`, `patient_id`, `doctor_id`, `diagnosis`, `date`) VALUES
(1, 5, 1, 'This patient had a severe headache and vomiting. This could be a sign of a food poisinoning', '2020-12-10'),
(2, 5, 1, 'This patient has some undiagnosed disease', '2020-12-09'),
(3, 5, 1, 'severe cough, headache', '2020-12-13'),
(4, 5, 1, 'severe cough, headache', '2020-12-13'),
(5, 5, 1, 'severe cough, headache', '2020-12-13');

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
  `home` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `in_patient` binary(1) NOT NULL,
  `accountid` int(11) NOT NULL,
  `ward_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`),
  KEY `accountid` (`accountid`),
  KEY `wardid` (`ward_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `fname`, `mname`, `lname`, `dob`, `sex`, `phone`, `home`, `email`, `in_patient`, `accountid`, `ward_id`) VALUES
(2, 'Dustin', 'hunk', 'moti', '1998-06-12', 1, '0984579312', 0, 'Dustin.hunk@gmail.com', 0x30, 14, 1),
(3, 'Simon', 'Biles', 'Morales', '1998-05-12', 2, '0912356485', 0, 'Simon.biles@gmail.com', 0x30, 16, 2),
(4, 'Samuel', 'Messele', 'Habtamu', '1998-06-25', 1, '0956213568', 113725187, 'samuel.messele@gmail.com', 0x30, 19, 1),
(5, 'Abebe', 'Kebede', 'Lema', '1998-06-25', 1, '09658545256', 0, 'test@gmail.com', 0x30, 23, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `permission`) VALUES
(2, 'Doctor', 'a:23:{i:0;s:11:\"viewPatient\";i:1;s:17:\"createAppointment\";i:2;s:17:\"updateAppointment\";i:3;s:15:\"viewAppointment\";i:4;s:13:\"createLabTest\";i:5;s:11:\"viewLabTest\";i:6;s:15:\"createLabResult\";i:7;s:15:\"updateLabResult\";i:8;s:13:\"viewLabResult\";i:9;s:15:\"deleteLabResult\";i:10;s:8:\"viewWard\";i:11;s:17:\"createOralHistory\";i:12;s:17:\"updateOralHistory\";i:13;s:15:\"viewOralHistory\";i:14;s:17:\"deleteOralHistory\";i:15;s:16:\"createVitalSigns\";i:16;s:16:\"updateVitalSigns\";i:17;s:14:\"viewVitalSigns\";i:18;s:16:\"deleteVitalSigns\";i:19;s:13:\"createProfile\";i:20;s:13:\"updateProfile\";i:21;s:11:\"viewProfile\";i:22;s:13:\"deleteProfile\";}'),
(3, 'Patient', 'a:3:{i:0;s:13:\"createPatient\";i:1;s:11:\"viewPatient\";i:2;s:13:\"deletePatient\";}'),
(4, 'Department Manager', 'a:48:{i:0;s:13:\"createPatient\";i:1;s:13:\"updatePatient\";i:2;s:11:\"viewPatient\";i:3;s:13:\"deletePatient\";i:4;s:17:\"createAppointment\";i:5;s:17:\"updateAppointment\";i:6;s:15:\"viewAppointment\";i:7;s:17:\"deleteAppointment\";i:8;s:14:\"createEmployee\";i:9;s:14:\"updateEmployee\";i:10;s:12:\"viewEmployee\";i:11;s:14:\"deleteEmployee\";i:12;s:10:\"createRole\";i:13;s:10:\"updateRole\";i:14;s:8:\"viewRole\";i:15;s:10:\"deleteRole\";i:16;s:13:\"createLabTest\";i:17;s:13:\"updateLabTest\";i:18;s:11:\"viewLabTest\";i:19;s:13:\"deleteLabTest\";i:20;s:15:\"createLabResult\";i:21;s:15:\"updateLabResult\";i:22;s:13:\"viewLabResult\";i:23;s:15:\"deleteLabResult\";i:24;s:8:\"creatBed\";i:25;s:9:\"updateBed\";i:26;s:7:\"viewBed\";i:27;s:9:\"deleteBed\";i:28;s:15:\"createSickLeave\";i:29;s:15:\"updateSickLeave\";i:30;s:13:\"viewSickLeave\";i:31;s:15:\"deleteSickLeave\";i:32;s:10:\"createWard\";i:33;s:10:\"updateWard\";i:34;s:8:\"viewWard\";i:35;s:10:\"deleteWard\";i:36;s:17:\"createOralHistory\";i:37;s:17:\"updateOralHistory\";i:38;s:15:\"viewOralHistory\";i:39;s:17:\"deleteOralHistory\";i:40;s:16:\"createVitalSigns\";i:41;s:16:\"updateVitalSigns\";i:42;s:14:\"viewVitalSigns\";i:43;s:16:\"deleteVitalSigns\";i:44;s:13:\"createProfile\";i:45;s:13:\"updateProfile\";i:46;s:11:\"viewProfile\";i:47;s:13:\"deleteProfile\";}'),
(5, 'Nurse', 'a:7:{i:0;s:11:\"viewPatient\";i:1;s:17:\"updateAppointment\";i:2;s:14:\"updateEmployee\";i:3;s:8:\"viewRole\";i:4;s:11:\"viewLabTest\";i:5;s:15:\"updateLabResult\";i:6;s:13:\"viewLabResult\";}'),
(8, 'Receptionist', 'N;'),
(9, 'Human Resources', 'N;'),
(10, 'Laboratorist', 'N;'),
(11, 'Office manager', 'a:3:{i:0;s:14:\"createEmployee\";i:1;s:14:\"updateEmployee\";i:2;s:12:\"viewEmployee\";}');

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
-- Table structure for table `vital_sign`
--

DROP TABLE IF EXISTS `vital_sign`;
CREATE TABLE IF NOT EXISTS `vital_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pat_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `temp` int(11) NOT NULL,
  `bp` varchar(15) NOT NULL,
  `pulse` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `emp_id` (`emp_id`),
  KEY `pat_id` (`pat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vital_sign`
--

INSERT INTO `vital_sign` (`id`, `pat_id`, `emp_id`, `date`, `temp`, `bp`, `pulse`) VALUES
(1, 2, 1, '2020-12-09', 36, '120/80', 85),
(2, 2, 1, '2020-12-13', 35, '45', 78),
(3, 5, 1, '2020-12-13', 56, '34', 35);

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
  ADD CONSTRAINT `labratorytest_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `labratorytest_ibfk_2` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`id`);

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
  ADD CONSTRAINT `patients_ibfk_2` FOREIGN KEY (`ward_id`) REFERENCES `ward` (`id`);

--
-- Constraints for table `sick_leave`
--
ALTER TABLE `sick_leave`
  ADD CONSTRAINT `sick_leave_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `sick_leave_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`);

--
-- Constraints for table `vital_sign`
--
ALTER TABLE `vital_sign`
  ADD CONSTRAINT `vital_sign_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `vital_sign_ibfk_2` FOREIGN KEY (`pat_id`) REFERENCES `patients` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
