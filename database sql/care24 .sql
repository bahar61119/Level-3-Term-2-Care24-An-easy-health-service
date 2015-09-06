-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2014 at 11:22 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `care24`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` text,
  `role` varchar(100) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `first_name`, `last_name`, `phone`, `email`, `address`, `role`, `image`) VALUES
(1, 'faru', '1234', 'Farhan', 'Sunmun', '01675847362', 'farhan@codevictor.com', 'Rashid Hall ', 'admin', 'farhan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `invoice_no` int(11) DEFAULT NULL,
  `bkash_no` int(11) DEFAULT NULL,
  `card_no` int(11) DEFAULT NULL,
  `cancel` tinyint(1) DEFAULT NULL,
  `payback` tinyint(1) DEFAULT NULL,
  `time` text,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `h_id` (`h_id`),
  KEY `d_id` (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `u_id`, `h_id`, `d_id`, `date`, `description`, `approve`, `invoice_no`, `bkash_no`, `card_no`, `cancel`, `payback`, `time`) VALUES
(17, 16, 6, 3, '2014-03-04', 'diarrhoea\n', 1, 1234, 1112345, NULL, NULL, NULL, '2pm'),
(18, 16, 6, 3, '2014-03-09', 'bone fault', 1, 1234, 16787634, NULL, NULL, NULL, '5 pm'),
(19, 16, 6, 4, '0000-00-00', 'pet betha', 1, 1234, 356, NULL, NULL, NULL, '4 pm');

-- --------------------------------------------------------

--
-- Table structure for table `attendant`
--

CREATE TABLE IF NOT EXISTS `attendant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `post` text NOT NULL,
  `active` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `h_id` (`h_id`),
  KEY `h_id_2` (`h_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `attendant`
--

INSERT INTO `attendant` (`id`, `h_id`, `name`, `username`, `password`, `post`, `active`) VALUES
(1, 4, 'Jahidur Rahman', 'admin', '123456', 'computer operator', 1),
(3, 6, 'Akhter Al Amin', 'amin', 'e10adc3949ba59abbe56e057f20f883e', 'computer operator', 1);

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE IF NOT EXISTS `degree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `d_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `institute` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `d_id` (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`id`, `d_id`, `name`, `institute`) VALUES
(1, 4, 'MBBS', 'DMC'),
(2, 4, 'FCPS', 'BSMMU'),
(3, 4, 'WGS', 'CIU');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(100) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='This table is for department under each hospital ' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `details`) VALUES
(1, 'Anthropology ', 'Anthropologists are here '),
(2, 'Neurology', 'Neuron specialists are here'),
(3, 'Heart Surgery', 'Heart open surgery is now in Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE IF NOT EXISTS `doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `password` varchar(50) NOT NULL,
  `pen_no` int(11) NOT NULL,
  `specialist` text NOT NULL,
  `email` text,
  `phone_no` varchar(30) DEFAULT NULL,
  `address` text,
  `image` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pen_no` (`pen_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='doctor''s info table' AUTO_INCREMENT=5 ;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`id`, `name`, `password`, `pen_no`, `specialist`, `email`, `phone_no`, `address`, `image`) VALUES
(1, 'Dr.Papul', '1234', 1234, 'Neurology', 'd_papul@gmail.com', '+8801676819666', 'dhaka, Dhanmondi', NULL),
(2, 'Dr.jahangir', '1234', 12345, 'Anthropology ', 'anthro@gmail.com', '+880167866688', 'Mohammadpur,Dhaka', NULL),
(3, 'Jahidur Rahman', 'e10adc3949ba59abbe56e057f20f883e', 123456, 'Neurology', 'fdrads@gmail.com', '+8801676767676767', 'Kalabagan,Dhaka', NULL),
(4, 'Jahidur Rahman', 'e10adc3949ba59abbe56e057f20f883e', 123455, 'Neurology', 'fdrad@gmail.com', '+8801676767676767', 'Kalabagan,Dhaka', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `doc_appointment_time`
--

CREATE TABLE IF NOT EXISTS `doc_appointment_time` (
  `d_id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `day` text CHARACTER SET utf8 NOT NULL,
  `start_time` text CHARACTER SET utf8 NOT NULL,
  `finish_time` text CHARACTER SET utf8 NOT NULL,
  KEY `d_id` (`d_id`),
  KEY `h_id` (`h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doc_appointment_time`
--

INSERT INTO `doc_appointment_time` (`d_id`, `h_id`, `day`, `start_time`, `finish_time`) VALUES
(4, 6, 'Wed', '7am', '10'),
(4, 6, 'Sun', '8pm', '10pm');

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE IF NOT EXISTS `hospital` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_name` text NOT NULL,
  `address` text NOT NULL,
  `longitude` double DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `details` text,
  `phone_no` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `website` text,
  `emergency_no` varchar(30) DEFAULT NULL,
  `ambulance` varchar(50) DEFAULT NULL,
  `fax_no` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`id`, `h_name`, `address`, `longitude`, `latitude`, `details`, `phone_no`, `email`, `website`, `emergency_no`, `ambulance`, `fax_no`, `active`) VALUES
(2, 'Lab Aid', 'Science Lab,Dhaka', 90.3761, 23.7474, 'Nice environment', '+88017187878', 'square@gmail.com', 'www.lab-aid.com', '121', '+99234343434', '89672222', 1),
(3, 'Ibn Sina', 'Dhanmondi 15,Dhaka', 90.3908, 23.7515, 'International residential system ', '+880181882343874', 'sina@gmail.com', 'www.ibn-sina.com', '787', '+8801345632', '1297556', 1),
(4, 'Birdem Medical College and Hospital', 'Shahbag,Dhaka', 90.3943, 23.7382, 'Nice environment.', '2342342', 'farhan_buet_010@yahoo.com', 'www.birdem.com', '7676767676', NULL, '7676767676', 1),
(6, 'DMC', 'Chankharpul,Dhaka', 90.4078, 23.7299, 'Very well and comfortable', '+8801676767676767', 'rayhan_usage@yahoo.com', 'www.dmc.com', '7676767676', NULL, '7676767676', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hospital_doc_dept`
--

CREATE TABLE IF NOT EXISTS `hospital_doc_dept` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `d_id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `dept_id` int(11) NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `d_id` (`d_id`),
  KEY `h_id` (`h_id`),
  KEY `dept_id` (`dept_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `hospital_doc_dept`
--

INSERT INTO `hospital_doc_dept` (`id`, `d_id`, `h_id`, `dept_id`, `approve`) VALUES
(1, 3, 6, 2, 1),
(5, 4, 6, 1, 1),
(6, 1, 6, 3, 1),
(7, 1, 6, 2, 0),
(8, 2, 6, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE IF NOT EXISTS `laboratory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `h_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `h_id` (`h_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='report from which hospital''s laboratory' AUTO_INCREMENT=4 ;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`id`, `h_id`, `name`, `details`) VALUES
(2, 2, 'Anthropology', 'Well and proficient anthropologist  '),
(3, 3, 'Neurologist', 'Good in neurology');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `d_id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `notice` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `d_id` (`d_id`,`h_id`),
  KEY `d_id_2` (`d_id`),
  KEY `h_id` (`h_id`),
  KEY `d_id_3` (`d_id`,`h_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

CREATE TABLE IF NOT EXISTS `prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `d_id` int(11) NOT NULL,
  `h_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `doc_sig` text NOT NULL,
  `disease` varchar(60) DEFAULT NULL,
  `details` text,
  `suggestion` text,
  PRIMARY KEY (`id`),
  KEY `u_id` (`u_id`),
  KEY `d_id` (`d_id`),
  KEY `h_id` (`h_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='doctor user hospital prescription' AUTO_INCREMENT=77 ;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `u_id`, `d_id`, `h_id`, `date`, `doc_sig`, `disease`, `details`, `suggestion`) VALUES
(75, 16, 3, 6, '2014-03-31 00:33:36', 'D.Papul', 'severe', 'severe bone fraction', 'try to take 3 weeks bed rest'),
(76, 16, 3, 6, '2014-03-31 05:35:31', 'Jahidur Rahman', 'Fever', 'dengu', 'ude aspirin');

-- --------------------------------------------------------

--
-- Table structure for table `pres_medication`
--

CREATE TABLE IF NOT EXISTS `pres_medication` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_name` varchar(30) DEFAULT NULL,
  `p_id` int(11) NOT NULL,
  `regulation` varchar(20) NOT NULL,
  `details` text NOT NULL,
  `dose` int(6) DEFAULT NULL,
  PRIMARY KEY (`m_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='In prescription medication''s details will be here' AUTO_INCREMENT=25 ;

--
-- Dumping data for table `pres_medication`
--

INSERT INTO `pres_medication` (`m_id`, `med_name`, `p_id`, `regulation`, `details`, `dose`) VALUES
(23, 'napa', 75, '1--0--1', 'sincerely continue 2 weeks', 3),
(24, 'napa', 76, '1--1--1', 'After Meal', 4);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pdf` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `p_id` (`p_id`),
  KEY `p_id_2` (`p_id`),
  KEY `p_id_3` (`p_id`),
  KEY `p_id_4` (`p_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `p_id`, `date`, `pdf`) VALUES
(1, 75, '2014-03-30 18:18:23', 'report.pdf'),
(2, 57, '2014-03-30 18:24:50', 'report1.pdf'),
(3, 56, '2014-03-30 18:24:50', 'report2.pdf'),
(4, 76, '2014-03-31 05:37:13', 'app1.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `phone` varchar(50) NOT NULL,
  `address` text,
  `email` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `salt` varchar(100) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `sex` varchar(50) NOT NULL,
  `weight` int(11) DEFAULT NULL,
  `image_url` text NOT NULL,
  `gcm_regid` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `password` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `phone`, `address`, `email`, `username`, `password`, `salt`, `age`, `sex`, `weight`, `image_url`, `gcm_regid`) VALUES
(16, 'Bahar', '01553418874', 'BUET', 'bahar61119@gmail.com', 'bahar61119', 'yUY0/UQGjYMzlRo4liUTcYHNd7A4ZDFjM2I0MTQ5', '8d1c3b4149', 24, 'Male', 66, '', 'APA91bHqSNwNsvjUml0bvYCnZiC3q25-H-seKmyUwWbCMzcS0VsVQ60oJ4YUNkPorRU247iUd7P1iW8iqwVFsNXm3HUZNGL1PomM1XrYrj8wdkWC_LJYN1Yq0IA1DJtPmh-AwS3C1sS3d92VQ13kJqrEs63BtEO1yg'),
(17, 'akhter', '016768676', 'dhanmondi', 'farbuet@gmail.com', 'akhter', 'MT0TPivY6UEvl76O7eGpK5jP5loxYzRmNmFkZTVk', '1c4f6ade5d', 23, 'Male', 56, '', 'APA91bFuL76OGy2mfR_EmfjjkIr9sYk5RM2GAOzQqGrEP3xQN3F9Gh3XrUb2oHsIX_2badGJoSfLFfy0NwtZliefokS6ef0OipCCDTPkXKFoDhV2JZx5qSniqY-YiGZrhv2Vk9iN_GZbkw-q5EbDQXRbD2flf_kE6A');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `doctor_appointment` FOREIGN KEY (`d_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hospital_appointment` FOREIGN KEY (`h_id`) REFERENCES `hospital` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendant`
--
ALTER TABLE `attendant`
  ADD CONSTRAINT `attendant_ibfk_1` FOREIGN KEY (`h_id`) REFERENCES `hospital` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `degree`
--
ALTER TABLE `degree`
  ADD CONSTRAINT `doctor_degree` FOREIGN KEY (`d_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hospital_doc_dept`
--
ALTER TABLE `hospital_doc_dept`
  ADD CONSTRAINT `hospital_doc_dept_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hospital_doc_dept_ibfk_2` FOREIGN KEY (`h_id`) REFERENCES `hospital` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hospital_doc_dept_ibfk_3` FOREIGN KEY (`dept_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laboratory`
--
ALTER TABLE `laboratory`
  ADD CONSTRAINT `laboratory_ibfk_1` FOREIGN KEY (`h_id`) REFERENCES `hospital` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prescription`
--
ALTER TABLE `prescription`
  ADD CONSTRAINT `prescription_ibfk_2` FOREIGN KEY (`d_id`) REFERENCES `doctor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_3` FOREIGN KEY (`h_id`) REFERENCES `hospital` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prescription_ibfk_4` FOREIGN KEY (`u_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `pres_medication`
--
ALTER TABLE `pres_medication`
  ADD CONSTRAINT `pres_medication_ibfk_2` FOREIGN KEY (`p_id`) REFERENCES `prescription` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
