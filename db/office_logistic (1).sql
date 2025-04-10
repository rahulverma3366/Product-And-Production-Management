-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 20, 2023 at 01:16 AM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `office_logistic`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

DROP TABLE IF EXISTS `access`;
CREATE TABLE IF NOT EXISTS `access` (
  `acs_id` int NOT NULL AUTO_INCREMENT,
  `r_id` int NOT NULL COMMENT 'Role Id',
  `p_id` int NOT NULL COMMENT 'Page Id',
  `reads` int NOT NULL,
  `writes` int NOT NULL,
  `creates` int NOT NULL,
  `create_at` timestamp NOT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`acs_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`acs_id`, `r_id`, `p_id`, `reads`, `writes`, `creates`, `create_at`, `update_at`) VALUES
(1, 1, 1, 1, 1, 0, '2023-09-03 14:23:04', '2023-09-14 12:07:18'),
(2, 1, 2, 1, 0, 0, '2023-09-03 14:23:04', '2023-09-14 12:07:18'),
(3, 2, 1, 1, 1, 0, '2023-09-03 14:30:16', '2023-09-14 12:09:21'),
(4, 2, 2, 0, 0, 0, '2023-09-03 14:30:16', '2023-09-14 12:09:21'),
(5, 3, 1, 1, 1, 0, '2023-09-03 14:30:29', '2023-09-14 12:12:52'),
(6, 3, 2, 0, 0, 0, '2023-09-03 14:30:29', '2023-09-14 12:12:52'),
(7, 4, 1, 0, 0, 0, '2023-09-10 11:40:09', NULL),
(8, 4, 2, 0, 0, 0, '2023-09-10 11:40:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `r_id` int NOT NULL COMMENT 'Roll id',
  `login_id` varchar(255) NOT NULL,
  `a_type` int NOT NULL COMMENT '1-Super Admin,\r\n2- Admin\r\n3 - Employee Dashboard, \r\n4 - Client Dashboard,\r\n5 - Student Dashboard,\r\n6 - HR Dashboard\r\n',
  `a_type_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '1-Super Admin, 2- Admin 3 - Employee Dashboard, 4 - Client Dashboard, 5 - Student Dashboard, 6 - HR Dashboard	',
  `consumer_id` int NOT NULL,
  `a_code` varchar(100) NOT NULL,
  `a_email` varchar(100) NOT NULL,
  `a_password` varchar(255) NOT NULL,
  `a_vpwd` varchar(100) NOT NULL,
  `a_name` varchar(100) NOT NULL,
  `a_desig` varchar(100) NOT NULL,
  `a_phone` varchar(15) NOT NULL,
  `a_address` tinytext NOT NULL,
  `a_company` tinytext NOT NULL,
  `a_usertype` varchar(10) NOT NULL COMMENT 'For User Privilege 1 for Admin',
  `a_status` varchar(2) NOT NULL COMMENT '1 Approve/ 2 Not Approve',
  `a_pagepermission` varchar(100) NOT NULL,
  `a_sms` varchar(20) NOT NULL,
  `img1` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `active` int NOT NULL,
  `create_at` datetime NOT NULL DEFAULT '1970-01-01 00:00:01',
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `r_id`, `login_id`, `a_type`, `a_type_name`, `consumer_id`, `a_code`, `a_email`, `a_password`, `a_vpwd`, `a_name`, `a_desig`, `a_phone`, `a_address`, `a_company`, `a_usertype`, `a_status`, `a_pagepermission`, `a_sms`, `img1`, `start_date`, `end_date`, `active`, `create_at`) VALUES
(1, 1, 'SA2642', 1, 'Super Admin', 1, '1', 'altabraja4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'Altab Raja', '', '987456321', '', 'Admin', '1', '1', '1', '', '', '2023-03-01', '2023-12-01', 1, '2018-07-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_locations`
--

DROP TABLE IF EXISTS `delivery_locations`;
CREATE TABLE IF NOT EXISTS `delivery_locations` (
  `dl_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `froms` int NOT NULL,
  `tos` int NOT NULL,
  `tov_id` int NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`dl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_locations`
--

INSERT INTO `delivery_locations` (`dl_id`, `consumer_id`, `froms`, `tos`, `tov_id`, `price`, `create_at`, `update_at`) VALUES
(2, 1, 1, 1, 2, '420', '2023-09-20 06:25:19', '2023-09-20 06:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_zone`
--

DROP TABLE IF EXISTS `delivery_zone`;
CREATE TABLE IF NOT EXISTS `delivery_zone` (
  `dz_id` int NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `consumer_id` int NOT NULL,
  `area_pincode` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`dz_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_zone`
--

INSERT INTO `delivery_zone` (`dz_id`, `area_name`, `consumer_id`, `area_pincode`, `create_at`, `update_at`) VALUES
(1, 'Manglabagh,Cuttack', 1, '753001', '2023-09-19 21:28:42', '2023-09-19 21:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `leave_type`
--

DROP TABLE IF EXISTS `leave_type`;
CREATE TABLE IF NOT EXISTS `leave_type` (
  `lt_id` int NOT NULL AUTO_INCREMENT,
  `school_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `type` int NOT NULL COMMENT '1 =  paid , 2 = unpaid',
  `create_date` datetime DEFAULT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`lt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_type`
--

INSERT INTO `leave_type` (`lt_id`, `school_id`, `name`, `type`, `create_date`, `update_date`) VALUES
(2, 2, 'Seek', 1, '2023-05-15 02:23:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

DROP TABLE IF EXISTS `login_history`;
CREATE TABLE IF NOT EXISTS `login_history` (
  `lh_id` int NOT NULL AUTO_INCREMENT,
  `a_id` int NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `session` varchar(255) NOT NULL,
  `login_time` varchar(255) NOT NULL,
  `logout_time` varchar(255) NOT NULL,
  `sts` int NOT NULL,
  `active_time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`lh_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`lh_id`, `a_id`, `browser`, `ip_address`, `session`, `login_time`, `logout_time`, `sts`, `active_time`, `date`) VALUES
(1, 1, 'Chrome', '::1', '3vl9k6t95ugpkgjt6man8rqcek', '17-09-2023 21:12:35', '', 0, '', '17-09-2023 21:12:35'),
(2, 1, 'Chrome', '::1', 'ot34v0uq8q0bjeo4g51gr0e4rl', '19-09-2023 07:21:52', '', 0, '', '19-09-2023 07:21:52'),
(3, 1, 'Chrome', '::1', 'on5k1i2v4ulb25gn6vetedh0al', '19-09-2023 18:35:59', '', 0, '', '19-09-2023 18:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`p_id`, `consumer_id`, `name`, `date`) VALUES
(1, 1, 'Setup', '2023-09-03 10:07:44'),
(2, 1, 'Roles', '2023-09-03 10:11:13');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `roles_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` timestamp NOT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`r_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`r_id`, `consumer_id`, `roles_name`, `create_at`, `update_at`) VALUES
(1, 1, 'Administrator', '2023-09-03 14:23:04', NULL),
(2, 1, 'Telecaller', '2023-09-03 14:30:16', NULL),
(3, 1, 'Core Employee', '2023-09-03 14:30:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `sts` int NOT NULL,
  `shows` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`s_id`, `consumer_id`, `name`, `value`, `sts`, `shows`, `date`) VALUES
(1, 1, 'website_name', 'http://localhost/product/logistic', 1, 1, '2022-12-21 16:15:55'),
(2, 1, 'business_name', 'Tradiozo Logistics', 0, 1, '2022-12-21 16:16:54'),
(3, 1, 'logo', 'http://localhost/product/logistic/uploads/media-95910.png', 0, 1, '2022-12-21 16:17:52'),
(4, 1, 'invoice_pre', '', 0, 2, '2022-12-21 16:18:37'),
(5, 1, 'invoice_template', '', 0, 2, '2022-12-21 16:27:15'),
(6, 1, 'invoice_colour', '', 0, 2, '2022-12-24 21:12:39'),
(7, 1, 'termandcondition', '', 0, 2, '2022-12-24 21:12:39'),
(8, 1, 'bank_details', '', 0, 2, '2022-12-24 22:25:20'),
(9, 1, 'sale_email', '', 0, 3, '2022-12-31 15:02:50'),
(10, 1, 'support_email', '', 0, 3, '2022-12-31 15:02:50'),
(11, 1, 'business_email', '', 0, 3, '2022-12-31 15:02:50'),
(12, 1, 'transaction_email', 'customer@techzex.com', 0, 3, '2023-06-20 07:37:09'),
(13, 1, 'version', 'Version 1.0 (Beta)', 0, 0, '2023-06-20 07:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `staf`
--

DROP TABLE IF EXISTS `staf`;
CREATE TABLE IF NOT EXISTS `staf` (
  `staf_id` int NOT NULL AUTO_INCREMENT,
  `school_id` int NOT NULL,
  `admin_id` int NOT NULL,
  `staf_type` int NOT NULL COMMENT ' 3 - Teacher Dashboard, 6 - admission section dashboard, 7 - account section dashboard, 8 - Examintion Section Dashboard, 9 - Librian dashboard, 10 - HR Dashboard 11 - Comunication Section	',
  `uniq_id` int NOT NULL,
  `staf_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `staf_mobile` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `staf_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `staf_qualification` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `staf_position` varchar(255) NOT NULL,
  `staf_joining_date` date NOT NULL,
  `staf_salary_ctc` double NOT NULL,
  `staf_salary_net` double NOT NULL,
  `current_address` longtext NOT NULL,
  `permanent_address` longtext NOT NULL,
  `status` int NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`staf_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staf`
--

INSERT INTO `staf` (`staf_id`, `school_id`, `admin_id`, `staf_type`, `uniq_id`, `staf_name`, `staf_mobile`, `staf_email`, `staf_qualification`, `staf_position`, `staf_joining_date`, `staf_salary_ctc`, `staf_salary_net`, `current_address`, `permanent_address`, `status`, `create_date`, `update_date`) VALUES
(7, 2, 26, 3, 7682, 'Najma khatun', '99383318786', 'najmakhatun@gmail.com', 'B.ed', 'HOD', '2023-04-19', 1000, 10000, '', '', 1, '2023-04-26 12:27:20', '2023-04-26 12:27:20'),
(6, 2, 18, 7, 3598, 'Raj', '123132121', 'kjdah@gnadsnsda.com', 'sadssad', 'sadasdsa', '2023-03-24', 2132, 21321, '', '', 1, '2023-03-27 08:14:51', '2023-03-27 08:14:51'),
(9, 2, 28, 3, 3714, 'Aliya Parveen', '7077384091', 'alialiya028@gmail.com', 'B tech in computer scince', 'Developer', '2023-05-10', 13000, 13000, '', '', 1, '2023-05-04 11:32:17', '2023-05-04 23:32:17'),
(11, 2, 29, 9, 8870, 'lib', '1234567890', 'lib@gmail.com', '10th', 'Developer', '2023-05-02', 35000, 15000, '', '', 1, '2023-05-10 04:35:14', '2023-05-10 16:35:14'),
(12, 2, 30, 10, 8701, 'Resham', '789494947464', 'resham@gmail.com', 'BTECH', 'TOPPER', '2023-05-18', 10000, 8000, 'Rourkela', 'Rourkela', 1, '2023-05-12 07:03:24', '2023-05-12 07:16:21'),
(13, 2, 32, 8, 1415, 'Afrid Khan', '1234567899', 'afrid@gmail.com', 'Medical', 'Medical', '2023-05-01', 10000, 1000, 'Cuttaack', 'Cuttack', 1, '2023-05-28 05:20:43', '2023-05-28 17:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `staff_bank_details`
--

DROP TABLE IF EXISTS `staff_bank_details`;
CREATE TABLE IF NOT EXISTS `staff_bank_details` (
  `bd_id` int NOT NULL AUTO_INCREMENT,
  `a_id` int NOT NULL COMMENT 'who Add',
  `staf_id` int NOT NULL,
  `school_id` int NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_account_no` varchar(255) NOT NULL,
  `bank_ifsc_code` varchar(255) NOT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `pan_number` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`bd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_bank_details`
--

INSERT INTO `staff_bank_details` (`bd_id`, `a_id`, `staf_id`, `school_id`, `bank_name`, `bank_account_no`, `bank_ifsc_code`, `account_holder_name`, `pan_number`, `branch_name`, `create_date`, `update_date`) VALUES
(4, 30, 0, 2, '', '', '', '', '', '', '2023-05-28 05:15:04', NULL),
(3, 0, 12, 2, 'SBI', '33120814769', 'SBIN0007001', 'ALTAB RAJA', 'DOFPR2142Q', 'Sorda', '2023-05-12 07:03:24', '2023-05-12 07:16:21'),
(5, 30, 13, 2, '', '', '', '', '', '', '2023-05-28 05:20:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_document`
--

DROP TABLE IF EXISTS `staff_document`;
CREATE TABLE IF NOT EXISTS `staff_document` (
  `sd_id` int NOT NULL AUTO_INCREMENT,
  `a_id` int NOT NULL COMMENT 'who update',
  `staf_id` int NOT NULL COMMENT 'staf id',
  `school_id` int NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `offer_letter` varchar(255) DEFAULT NULL,
  `joining_letter` varchar(255) DEFAULT NULL,
  `contract_and_agreement` varchar(255) DEFAULT NULL,
  `id_proof` varchar(255) DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  PRIMARY KEY (`sd_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_document`
--

INSERT INTO `staff_document` (`sd_id`, `a_id`, `staf_id`, `school_id`, `resume`, `offer_letter`, `joining_letter`, `contract_and_agreement`, `id_proof`, `create_date`, `update_date`) VALUES
(6, 30, 13, 2, NULL, NULL, NULL, NULL, NULL, '2023-05-28 05:20:43', NULL),
(5, 30, 0, 2, NULL, NULL, NULL, NULL, NULL, '2023-05-28 05:15:04', NULL),
(4, 2, 12, 2, 'media-12066.pdf', 'media-85492.pdf', NULL, 'media-82531.pdf', 'media-95167.pdf', '2023-05-12 07:03:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_of_vehicle`
--

DROP TABLE IF EXISTS `type_of_vehicle`;
CREATE TABLE IF NOT EXISTS `type_of_vehicle` (
  `tov_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `vehicle_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`tov_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_of_vehicle`
--

INSERT INTO `type_of_vehicle` (`tov_id`, `consumer_id`, `vehicle_type`, `create_at`, `update_at`) VALUES
(2, 1, '4 Wheelers', '2023-09-20 00:24:51', '2023-09-20 00:27:13');

-- --------------------------------------------------------

--
-- Table structure for table `vendar`
--

DROP TABLE IF EXISTS `vendar`;
CREATE TABLE IF NOT EXISTS `vendar` (
  `vd_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `gst_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `img1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'GST Certificate \r\n',
  `img2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Upload Documents',
  `register_address` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`vd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendar`
--

INSERT INTO `vendar` (`vd_id`, `consumer_id`, `name`, `mobile_no`, `email_id`, `gst_no`, `img1`, `img2`, `register_address`, `create_at`, `update_at`) VALUES
(2, 1, 'Raj kishor', '3232432432', 'as@gmail.com', '432432423', '', '', 'Cuttack', '2023-09-18 01:01:10', NULL),
(3, 1, 'Raj', '343243243', 'asdas@gmail.com', '3432432', '', '', 'Cuutack', '2023-09-18 01:04:01', NULL),
(16, 0, 'Altab', '3432', 'sd@gmail.com', '4333', 'media-77567.png', '', 'ssss', '2023-09-18 06:28:38', '0000-00-00 00:00:00'),
(17, 1, 'Altab', '3432432432', 'altabraja4@gmail.com', '3432432423', 'media-13290.png', 'media-36258.png', '', '2023-09-18 06:58:23', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_driver`
--

DROP TABLE IF EXISTS `vendor_driver`;
CREATE TABLE IF NOT EXISTS `vendor_driver` (
  `vnd_id` int NOT NULL AUTO_INCREMENT,
  `vd_id` int NOT NULL,
  `consumer_id` int NOT NULL,
  `vehicle_number` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type_of_vechile` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `driver_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `permit` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `licence_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `insurance` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `img1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`vnd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor_driver`
--

INSERT INTO `vendor_driver` (`vnd_id`, `vd_id`, `consumer_id`, `vehicle_number`, `type_of_vechile`, `driver_name`, `mobile_no`, `permit`, `aadhar_no`, `licence_no`, `insurance`, `img1`, `create_at`, `update_at`) VALUES
(1, 17, 1, 'OD33E7804', '4 Wheelers', 'Jayprakash Mohanty', '3432432432', 'All India', '4532432', '3423423', 'Yes', 'media-62345.png', '2023-09-19 17:11:16', '2023-09-20 00:34:07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
