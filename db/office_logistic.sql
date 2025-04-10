-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 17, 2023 at 02:26 PM
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
-- Database: `office_software_new`
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
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`lh_id`, `a_id`, `browser`, `ip_address`, `session`, `login_time`, `logout_time`, `sts`, `active_time`, `date`) VALUES
(1, 1, 'Chrome', '::1', '42aq28rh503shmddm9hla9qu3d', '20-12-2022 22:01:12', '24-12-2022 21:06:56', 0, '', '20-12-2022 22:01:12'),
(2, 1, 'Chrome', '::1', '7ugltga2hbgg8ntj85toqidq7f', '20-12-2022 22:50:05', '24-12-2022 21:06:56', 0, '', '20-12-2022 22:50:05'),
(3, 1, 'Chrome', '::1', '6apiav6bipi1401ssnc4u81f9h', '21-12-2022 15:10:54', '24-12-2022 21:06:56', 0, '', '21-12-2022 15:10:54'),
(4, 1, 'Chrome', '::1', '08devah1t4hjjj2r6d7eblc8sk', '21-12-2022 16:24:31', '24-12-2022 21:06:56', 0, '', '21-12-2022 16:24:31'),
(5, 1, 'Chrome', '::1', '5vm819hgpbg01slg3lr18nj00e', '22-12-2022 00:16:04', '24-12-2022 21:06:56', 0, '', '22-12-2022 00:16:04'),
(6, 1, 'Chrome', '::1', 'p9okkdu9i8len3ch6nclsj13t2', '23-12-2022 17:44:15', '24-12-2022 21:06:56', 0, '', '23-12-2022 17:44:15'),
(7, 1, 'Chrome', '::1', 'iprqd9fhraetkahc6gr1iqrkrh', '24-12-2022 16:43:17', '24-12-2022 21:06:56', 0, '', '24-12-2022 16:43:17'),
(8, 1, 'Chrome', '::1', '86rff74nmlul74arnoiksh4m02', '24-12-2022 21:06:39', '24-12-2022 21:06:56', 0, '', '24-12-2022 21:06:39'),
(9, 1, 'Chrome', '::1', '9ui6geu1osr3rp2mr6c805f1i1', '24-12-2022 21:07:01', '25-12-2022 17:18:37', 0, '', '24-12-2022 21:07:01'),
(10, 1, 'Chrome', '::1', 'og4j2ul5ufickrjm8injsv77c2', '25-12-2022 17:18:42', '11-03-2023 08:29:46', 0, '', '25-12-2022 17:18:42'),
(11, 1, 'Chrome', '::1', 'ihr7nv2l2jio907ejkaakqvvri', '31-12-2022 15:05:00', '11-03-2023 08:29:46', 0, '', '31-12-2022 15:05:00'),
(12, 1, 'Chrome', '::1', 'idhbtj2t294di2gca2fufs35ds', '04-01-2023 00:20:07', '11-03-2023 08:29:46', 0, '', '04-01-2023 00:20:07'),
(13, 1, 'Chrome', '::1', 'mbt7cqpjf2s95khl9c3tp5r6ji', '06-01-2023 08:58:06', '11-03-2023 08:29:46', 0, '', '06-01-2023 08:58:06'),
(14, 1, 'Chrome', '::1', 'bn6rmqcmfjnkfcblljsheftsqj', '15-01-2023 00:34:43', '11-03-2023 08:29:46', 0, '', '15-01-2023 00:34:43'),
(15, 1, 'Chrome', '::1', 'nkk8bjvadeinve5rn37ocpsr72', '15-01-2023 23:25:26', '11-03-2023 08:29:46', 0, '', '15-01-2023 23:25:26'),
(16, 1, 'Chrome', '::1', '03280lqpk12r74jj54monau39v', '20-01-2023 00:19:13', '11-03-2023 08:29:46', 0, '', '20-01-2023 00:19:13'),
(17, 1, 'Chrome', '::1', '44u1k40g35eubpf8ds0fpcop3u', '07-02-2023 06:16:18', '11-03-2023 08:29:46', 0, '', '07-02-2023 06:16:18'),
(18, 1, 'Chrome', '::1', 'r8v60fr760hkjqcri2hhu3fvn3', '09-02-2023 19:09:48', '11-03-2023 08:29:46', 0, '', '09-02-2023 19:09:48'),
(19, 1, 'Chrome', '::1', 'rn18o168dchj1fjf0kdb8mlq32', '10-03-2023 18:31:44', '11-03-2023 08:29:46', 0, '', '10-03-2023 18:31:44'),
(20, 1, 'Chrome', '::1', 'rtkt43vgjltkvbb0u0fmfr5nb8', '10-03-2023 19:16:06', '11-03-2023 08:29:46', 0, '', '10-03-2023 19:16:06'),
(21, 1, 'Chrome', '::1', 'n811rcmd53udnsl144fhpb2n2f', '11-03-2023 06:24:55', '11-03-2023 08:29:46', 0, '', '11-03-2023 06:24:55'),
(22, 1, 'Chrome', '::1', 'h500vnjb7vvch7t8nm5ubat9dq', '11-03-2023 06:30:47', '11-03-2023 08:29:46', 0, '', '11-03-2023 06:30:47'),
(23, 10, 'Chrome', '::1', '6cbr2fd9nage83ce74a7c9n29u', '11-03-2023 08:30:00', '', 0, '', '11-03-2023 08:30:00'),
(24, 1, 'Chrome', '::1', 'omnfb0j5b6md7be5aik2s06s6l', '11-03-2023 13:17:28', '11-03-2023 13:17:36', 0, '', '11-03-2023 13:17:28'),
(25, 10, 'Chrome', '::1', 'sumjlm0a894o2ag2m10k3ns3f4', '11-03-2023 13:17:47', '', 0, '', '11-03-2023 13:17:47'),
(26, 1, 'Chrome', '::1', 'vgadppjqu27fvp8lvo21vq942b', '15-03-2023 13:38:39', '17-03-2023 23:00:29', 0, '', '15-03-2023 13:38:39'),
(27, 1, 'Chrome', '::1', 'llcfabudc0hjbg4a7egngfopb8', '17-03-2023 22:56:37', '17-03-2023 23:00:29', 0, '', '17-03-2023 22:56:37'),
(28, 2, 'Chrome', '::1', 'bgpgb509ebqdek992mlqa7uk2j', '17-03-2023 23:01:10', '26-03-2023 20:12:37', 0, '', '17-03-2023 23:01:10'),
(29, 2, 'Chrome', '::1', 'vf4d1naos9ct2dce3v00657c2u', '20-03-2023 17:52:58', '26-03-2023 20:12:37', 0, '', '20-03-2023 17:52:58'),
(30, 2, 'Chrome', '::1', 'th9sulcgmhtk9msa1tvo1gj77f', '21-03-2023 14:04:35', '26-03-2023 20:12:37', 0, '', '21-03-2023 14:04:35'),
(31, 2, 'Chrome', '::1', 'l13h7t98emah2m7vdlfqm4nk87', '24-03-2023 16:04:28', '26-03-2023 20:12:37', 0, '', '24-03-2023 16:04:28'),
(32, 2, 'Chrome', '::1', '6e3j2d1a0njklqh6hsf2q757o7', '25-03-2023 16:38:03', '26-03-2023 20:12:37', 0, '', '25-03-2023 16:38:03'),
(33, 2, 'Chrome', '::1', '27ftuge1884knk2aroj8tgc4fm', '27-03-2023 07:46:21', '27-03-2023 08:10:58', 0, '', '27-03-2023 07:46:21'),
(34, 2, 'Chrome', '::1', 'uspcmfbq97b4bb9kolj00fi8pq', '27-03-2023 08:13:22', '27-03-2023 08:20:31', 0, '', '27-03-2023 08:13:22'),
(35, 18, 'Chrome', '::1', 'b76r8ngehbgkj81sl66vorj0qi', '27-03-2023 08:21:16', '28-03-2023 16:29:06', 0, '', '27-03-2023 08:21:16'),
(36, 18, 'Chrome', '::1', 'fmpm65tvmjh3l5s9j3kmifg52s', '28-03-2023 16:29:27', '28-03-2023 17:00:12', 0, '', '28-03-2023 16:29:27'),
(37, 18, 'Chrome', '::1', 'fgsfdqu69a8qo8gq895saujksp', '28-03-2023 17:00:45', '03-05-2023 11:30:02', 0, '', '28-03-2023 17:00:45'),
(38, 18, 'Chrome', '::1', '0smbn05u5gcivp92vktqn88pjk', '30-03-2023 12:52:17', '03-05-2023 11:30:02', 0, '', '30-03-2023 12:52:17'),
(39, 18, 'Chrome', '::1', 'ons22bqf8smgach2hjc019k12c', '02-04-2023 15:10:03', '03-05-2023 11:30:02', 0, '', '02-04-2023 15:10:03'),
(40, 18, 'Chrome', '::1', 'huk7uf95ihas0u19prvlr3tlp5', '03-04-2023 08:22:24', '03-05-2023 11:30:02', 0, '', '03-04-2023 08:22:24'),
(41, 18, 'Chrome', '::1', 'v1gv8s47pj2harfgp69v9l2v5h', '04-04-2023 01:51:17', '03-05-2023 11:30:02', 0, '', '04-04-2023 01:51:17'),
(42, 18, 'Chrome', '::1', 'bukg36pj24jehvq09vdn5nhi5b', '04-04-2023 10:00:55', '03-05-2023 11:30:02', 0, '', '04-04-2023 10:00:55'),
(43, 2, 'Chrome', '::1', '65po1icl2plbcptgfqd0j7d537', '04-04-2023 13:28:39', '04-05-2023 15:11:42', 0, '', '04-04-2023 13:28:39'),
(44, 18, 'Chrome', '::1', 'aof0cer73en92jc2aacou3cub2', '07-04-2023 09:39:01', '03-05-2023 11:30:02', 0, '', '07-04-2023 09:39:01'),
(45, 18, 'Chrome', '::1', 'ugptipvb3aso13o4tfk0oiv3f2', '16-04-2023 07:44:16', '03-05-2023 11:30:02', 0, '', '16-04-2023 07:44:16'),
(46, 2, 'Chrome', '::1', 'mmego3pf911jvtv4jdu881qqkn', '18-04-2023 12:10:01', '04-05-2023 15:11:42', 0, '', '18-04-2023 12:10:01'),
(47, 2, 'Chrome', '::1', '68d33e5pnhprd2t5n92osbnlus', '25-04-2023 23:24:49', '04-05-2023 15:11:42', 0, '', '25-04-2023 23:24:49'),
(48, 18, 'Chrome', '::1', 'rj9h774jo6q8chkuibqrgq6jdi', '25-04-2023 23:27:09', '03-05-2023 11:30:02', 0, '', '25-04-2023 23:27:09'),
(49, 16, 'Chrome', '::1', '95o1darld04n40g1dbbckfvm6g', '26-04-2023 00:06:40', '26-04-2023 12:22:33', 0, '', '26-04-2023 00:06:40'),
(50, 26, 'Chrome', '::1', 'g8i2qp1bsg6rjeshc9ghmqq8ef', '26-04-2023 12:30:16', '29-04-2023 18:20:30', 0, '', '26-04-2023 12:30:16'),
(51, 26, 'Chrome', '::1', 'a87u65l9egvc0ommdlea9qfi2f', '27-04-2023 15:07:35', '29-04-2023 18:20:30', 0, '', '27-04-2023 15:07:35'),
(52, 2, 'Chrome', '::1', '9r13a5nk1fsuega6od12e311ef', '27-04-2023 15:24:42', '04-05-2023 15:11:42', 0, '', '27-04-2023 15:24:42'),
(53, 16, 'Chrome', '::1', 'mcbng83ccf6jrcb4a9goj1gk9n', '27-04-2023 17:24:23', '03-05-2023 11:31:53', 0, '', '27-04-2023 17:24:23'),
(54, 26, 'Chrome', '::1', '7u3qeiu843j0imc49h3fh0f36o', '29-04-2023 09:59:53', '29-04-2023 18:20:30', 0, '', '29-04-2023 09:59:53'),
(55, 2, 'Chrome', '::1', 'ec7tacum6fhk0btmpfq0g3esid', '29-04-2023 18:20:54', '04-05-2023 15:11:42', 0, '', '29-04-2023 18:20:54'),
(56, 2, 'Chrome', '::1', 'md610q3o3n95mn9c31fnhpfbth', '03-05-2023 10:19:28', '04-05-2023 15:11:42', 0, '', '03-05-2023 10:19:28'),
(57, 15, 'Chrome', '::1', 'vscsv49sggnbk91oqrr5o16967', '03-05-2023 10:19:52', '25-05-2023 15:29:52', 0, '', '03-05-2023 10:19:52'),
(58, 2, 'Chrome', '::1', '14fcph42b0onmh4il08sgmre3p', '03-05-2023 11:17:46', '04-05-2023 15:11:42', 0, '', '03-05-2023 11:17:46'),
(59, 18, 'Chrome', '::1', 'recc5hqmqj2n1akse9tofsa31i', '03-05-2023 11:26:50', '03-05-2023 11:30:02', 0, '', '03-05-2023 11:26:50'),
(60, 26, 'Chrome', '::1', 'p7vql2gkt1udgdp16p93nomk7j', '03-05-2023 11:30:17', '03-05-2023 11:31:36', 0, '', '03-05-2023 11:30:17'),
(61, 16, 'Chrome', '::1', 'ktq28n3i5rnrgigoj83dv1tffd', '03-05-2023 11:31:42', '03-05-2023 11:31:53', 0, '', '03-05-2023 11:31:42'),
(62, 15, 'Chrome', '::1', '0jscrnrpijleqv84a7a94srg4e', '03-05-2023 11:32:05', '25-05-2023 15:29:52', 0, '', '03-05-2023 11:32:05'),
(63, 2, 'Chrome', '::1', '801bbvjr159i2duheac99cbk21', '04-05-2023 12:27:55', '04-05-2023 15:11:42', 0, '', '04-05-2023 12:27:55'),
(64, 27, 'Chrome', '::1', '3ijga0rcnul357nplpnuofbe8t', '04-05-2023 13:36:06', '11-05-2023 22:18:56', 0, '', '04-05-2023 13:36:06'),
(65, 27, 'Chrome', '::1', 'bjng3heijokk65ig16vqgfd9vf', '04-05-2023 15:11:53', '11-05-2023 22:18:56', 0, '', '04-05-2023 15:11:53'),
(66, 27, 'Chrome', '::1', '99i5l1hdgjke3636ts9mb6s15q', '07-05-2023 10:02:37', '11-05-2023 22:18:56', 0, '', '07-05-2023 10:02:37'),
(67, 2, 'Chrome', '::1', 'o8p04ftv9fpudd72uepg0t1qgh', '10-05-2023 16:24:14', '10-05-2023 17:03:51', 0, '', '10-05-2023 16:24:14'),
(68, 29, 'Chrome', '::1', 'flhem2a7qiqf5git9g9bl3clu9', '10-05-2023 17:04:00', '05-06-2023 07:23:11', 0, '', '10-05-2023 17:04:00'),
(69, 27, 'Chrome', '::1', 'rvbehbnshb5k919vpjfgijv0he', '11-05-2023 21:51:12', '11-05-2023 22:18:56', 0, '', '11-05-2023 21:51:12'),
(70, 2, 'Chrome', '::1', 'h8uhe0hga0hvcci7b95g4gf642', '11-05-2023 22:19:12', '12-05-2023 16:12:07', 0, '', '11-05-2023 22:19:12'),
(71, 30, 'Chrome', '::1', '4rfdnqhneum8ik4vro1k6knm0t', '12-05-2023 16:12:29', '17-05-2023 06:18:54', 0, '', '12-05-2023 16:12:29'),
(72, 30, 'Chrome', '::1', 'kdfaguvhhr19f72lml3vu12gtf', '14-05-2023 18:13:35', '17-05-2023 06:18:54', 0, '', '14-05-2023 18:13:35'),
(73, 30, 'Chrome', '::1', '5u4m0qtjo669us1ls3f1q1kgnn', '15-05-2023 10:02:12', '17-05-2023 06:18:54', 0, '', '15-05-2023 10:02:12'),
(74, 30, 'Chrome', '::1', 'kve188kp6o4nk3o5vda4qfsuai', '15-05-2023 18:35:13', '17-05-2023 06:18:54', 0, '', '15-05-2023 18:35:13'),
(75, 30, 'Chrome', '::1', 'ef8lvnce5ab4dsq4f90lju3765', '16-05-2023 11:54:32', '17-05-2023 06:18:54', 0, '', '16-05-2023 11:54:32'),
(76, 30, 'Chrome', '::1', '7c79dhvlgnedegmsc8o98dkvnk', '16-05-2023 16:07:58', '17-05-2023 06:18:54', 0, '', '16-05-2023 16:07:58'),
(77, 1, 'Chrome', '::1', 'gm63gepnm9sractura4l38252r', '17-05-2023 06:49:43', '01-06-2023 16:06:22', 0, '', '17-05-2023 06:49:43'),
(78, 29, 'Chrome', '::1', 'gshbn6df1gohdcmedvcphenffg', '18-05-2023 12:40:12', '05-06-2023 07:23:11', 0, '', '18-05-2023 12:40:12'),
(79, 29, 'Chrome', '::1', '4e78g8ph3gpern9unaseij7mni', '21-05-2023 13:27:09', '05-06-2023 07:23:11', 0, '', '21-05-2023 13:27:09'),
(80, 29, 'Chrome', '::1', '4ttm5svpcql8lju5371k0teqgt', '23-05-2023 15:30:17', '05-06-2023 07:23:11', 0, '', '23-05-2023 15:30:17'),
(81, 15, 'Chrome', '::1', '2bs97dj0evb2754kihrlm5r799', '25-05-2023 15:05:34', '25-05-2023 15:29:52', 0, '', '25-05-2023 15:05:34'),
(82, 2, 'Chrome', '::1', 'elun5tuio7oidq4p30qhrkrp3m', '25-05-2023 15:30:09', '30-05-2023 15:19:49', 0, '', '25-05-2023 15:30:09'),
(83, 2, 'Chrome', '::1', '8agoock51crk5nnnjei0vm1mm3', '26-05-2023 15:34:18', '30-05-2023 15:19:49', 0, '', '26-05-2023 15:34:18'),
(84, 30, 'Chrome', '::1', '6f5f9klli98a9ps8jc5t66edt3', '28-05-2023 17:13:11', '28-05-2023 17:21:43', 0, '', '28-05-2023 17:13:11'),
(85, 32, 'Chrome', '::1', 'bqopgdce131l8ejilhg8s7aoj7', '28-05-2023 17:21:58', '30-05-2023 15:00:36', 0, '', '28-05-2023 17:21:58'),
(86, 32, 'Chrome', '::1', '59ge9prl3fc1l32dg8m1bbf3jp', '29-05-2023 12:24:10', '30-05-2023 15:00:36', 0, '', '29-05-2023 12:24:10'),
(87, 32, 'Chrome', '::1', '0p9k1ojc0k0impae2pcq0std09', '30-05-2023 07:21:38', '30-05-2023 15:00:36', 0, '', '30-05-2023 07:21:38'),
(88, 32, 'Chrome', '::1', 'ipcjnl7jhotvroffvfgbs0edrn', '30-05-2023 13:39:00', '30-05-2023 15:00:36', 0, '', '30-05-2023 13:39:00'),
(89, 2, 'Chrome', '::1', 'sj792uq2lr9m6r8noro0e6c38b', '30-05-2023 15:01:02', '30-05-2023 15:19:49', 0, '', '30-05-2023 15:01:02'),
(90, 2, 'Chrome', '::1', '70uimpsdhbfans2b3bgmudl0v1', '30-05-2023 15:20:01', '30-05-2023 15:20:52', 0, '', '30-05-2023 15:20:01'),
(91, 2, 'Chrome', '::1', 'ovqc9fvvksbv8dpdjch65pao72', '30-05-2023 15:21:12', '30-05-2023 16:00:25', 0, '', '30-05-2023 15:21:12'),
(92, 2, 'Chrome', '::1', 'akllmvrvdsen8qtus40a0opho5', '30-05-2023 16:00:49', '01-06-2023 12:44:46', 0, '', '30-05-2023 16:00:49'),
(93, 32, 'Chrome', '::1', '655bq9jrjne7js19n0ergposb6', '31-05-2023 13:19:56', '01-06-2023 15:40:54', 0, '', '31-05-2023 13:19:56'),
(94, 2, 'Chrome', '::1', '9a20aq0s1uj8ilv850ohik2buu', '31-05-2023 16:34:35', '01-06-2023 12:44:46', 0, '', '31-05-2023 16:34:35'),
(95, 32, 'Chrome', '::1', 'sag2aqv9c2nhqn7f39l7to7fqg', '01-06-2023 12:45:05', '01-06-2023 15:40:54', 0, '', '01-06-2023 12:45:05'),
(96, 1, 'Chrome', '::1', 'urfd6m8qiha1eu0fote1j79u4s', '01-06-2023 15:41:12', '01-06-2023 16:06:22', 0, '', '01-06-2023 15:41:12'),
(97, 32, 'Chrome', '::1', '1qv4d94smikvek0116haj6s70u', '01-06-2023 16:06:40', '02-06-2023 15:42:28', 0, '', '01-06-2023 16:06:40'),
(98, 32, 'Chrome', '::1', 'v688jdihbfd5a52pb12e66ads7', '02-06-2023 12:31:17', '02-06-2023 15:42:28', 0, '', '02-06-2023 12:31:17'),
(99, 29, 'Chrome', '::1', 'hicmm885kku9gr7ek192dlre7g', '02-06-2023 15:43:55', '05-06-2023 07:23:11', 0, '', '02-06-2023 15:43:55'),
(100, 29, 'Chrome', '::1', '78fciha8v3cuvs74p4obi5vf6t', '04-06-2023 07:28:09', '05-06-2023 07:23:11', 0, '', '04-06-2023 07:28:09'),
(101, 26, 'Chrome', '::1', '4p3ta9qv5vl1ejltn8aadfcpnl', '05-06-2023 07:23:46', '06-06-2023 13:00:22', 0, '', '05-06-2023 07:23:46'),
(102, 30, 'Chrome', '::1', 'k0ap24bra9dmlub8ti2s3vl4g5', '05-06-2023 10:46:44', '05-06-2023 12:21:06', 0, '', '05-06-2023 10:46:44'),
(103, 2, 'Chrome', '::1', 'lb60u7iss8cb9kp5rmp9emja09', '05-06-2023 12:22:19', '05-06-2023 12:36:28', 0, '', '05-06-2023 12:22:19'),
(104, 18, 'Chrome', '::1', 'i3b738ieapvau3sp6j9mptuj7u', '05-06-2023 12:36:52', '05-06-2023 16:51:37', 0, '', '05-06-2023 12:36:52'),
(105, 26, 'Chrome', '::1', '9gdln9om8c3ms56vlerlpock43', '06-06-2023 12:56:09', '06-06-2023 13:00:22', 0, '', '06-06-2023 12:56:09'),
(106, 2, 'Chrome', '::1', 'le5sagp9bforh62hr1td5von79', '06-06-2023 13:00:54', '07-06-2023 05:55:14', 0, '', '06-06-2023 13:00:54'),
(107, 28, 'Chrome', '::1', 'heebmf7od8pasqc1mnri1hcshp', '07-06-2023 05:56:42', '11-07-2023 14:07:59', 0, '', '07-06-2023 05:56:42'),
(108, 2, 'Chrome', '::1', 'fa775hu1e3jdp9prp7cht5tp28', '07-06-2023 12:37:51', '07-06-2023 16:46:22', 0, '', '07-06-2023 12:37:51'),
(109, 32, 'Chrome', '::1', 'jh5mst9c9pfaice76t6sgopfih', '07-06-2023 16:49:51', '13-06-2023 14:15:24', 0, '', '07-06-2023 16:49:51'),
(110, 2, 'Chrome', '::1', 'dh34ko6va95dme5777njbnismh', '10-06-2023 07:36:59', '10-06-2023 07:38:17', 0, '', '10-06-2023 07:36:59'),
(111, 32, 'Chrome', '::1', 'r05nlngbaq5erdhnovq3fjka3p', '10-06-2023 07:38:40', '13-06-2023 14:15:24', 0, '', '10-06-2023 07:38:40'),
(112, 32, 'Chrome', '::1', '3rgchni4eae3hi70ccps0kgufc', '12-06-2023 16:19:32', '13-06-2023 14:15:24', 0, '', '12-06-2023 16:19:32'),
(113, 18, 'Chrome', '::1', 'r1coe46skkjumd8b5cc81auc4p', '13-06-2023 14:16:14', '20-06-2023 00:07:14', 0, '', '13-06-2023 14:16:14'),
(114, 18, 'Chrome', '::1', '1c9m4q5tck0p0q9dh7f343k8ha', '14-06-2023 10:52:03', '20-06-2023 00:07:14', 0, '', '14-06-2023 10:52:03'),
(115, 18, 'Chrome', '::1', '4q1j83ih8v6cd9uu4idgem78c2', '15-06-2023 12:29:28', '20-06-2023 00:07:14', 0, '', '15-06-2023 12:29:28'),
(116, 18, 'Chrome', '::1', 's7n8g9r9acgj09p3lob3eekvov', '16-06-2023 12:16:12', '20-06-2023 00:07:14', 0, '', '16-06-2023 12:16:12'),
(117, 32, 'Chrome', '::1', 'a6b7gl107smcr8fct6h7ru62ou', '16-06-2023 15:54:50', '16-06-2023 15:57:12', 0, '', '16-06-2023 15:54:50'),
(118, 18, 'Chrome', '::1', 'uvfkgrlv95519nqj2lk9aj11hl', '16-06-2023 15:57:29', '20-06-2023 00:07:14', 0, '', '16-06-2023 15:57:29'),
(119, 18, 'Chrome', '::1', 'qlrc98aoehm6rpedpdsdaesiav', '18-06-2023 16:24:32', '20-06-2023 00:07:14', 0, '', '18-06-2023 16:24:32'),
(120, 18, 'Chrome', '::1', 'l45uq8fk8bn5mm65cj9s09126b', '19-06-2023 16:21:42', '20-06-2023 00:07:14', 0, '', '19-06-2023 16:21:42'),
(121, 1, 'Chrome', '::1', 'qe7mogrli15puj24ekheus6jr8', '20-06-2023 00:09:50', '20-06-2023 08:53:17', 0, '', '20-06-2023 00:09:50'),
(122, 50, 'Chrome', '::1', 'cc43rm03dgnkc9j3fh00s0g84t', '20-06-2023 08:53:30', '', 0, '', '20-06-2023 08:53:30'),
(123, 28, 'Chrome', '::1', 'ilqevoserp5tcbn9ieroun6e3u', '11-07-2023 12:12:32', '11-07-2023 14:07:59', 0, '', '11-07-2023 12:12:32'),
(124, 32, 'Chrome', '::1', 'ubbo5u37s23l9d0ncdapqab8ej', '11-07-2023 14:08:33', '19-07-2023 15:15:33', 0, '', '11-07-2023 14:08:33'),
(125, 26, 'Chrome', '::1', 'oe0bs9p45hjas27m6ag625nd5j', '11-07-2023 15:27:18', '18-07-2023 15:13:38', 0, '', '11-07-2023 15:27:18'),
(126, 18, 'Chrome', '::1', '1lhan8hgue7q9l9hb42lsjqfnf', '13-07-2023 22:37:51', '13-07-2023 22:38:05', 0, '', '13-07-2023 22:37:51'),
(127, 32, 'Chrome', '::1', 'ils9mvkrn0ihtci3s1cp9pmr58', '13-07-2023 22:38:31', '19-07-2023 15:15:33', 0, '', '13-07-2023 22:38:31'),
(128, 32, 'Chrome', '::1', 'cov6prfbnqjkve3ll7d21meduc', '14-07-2023 15:28:48', '19-07-2023 15:15:33', 0, '', '14-07-2023 15:28:48'),
(129, 2, 'Chrome', '::1', '9k6pv91mjt1nktqatot9oleecj', '15-07-2023 11:50:36', '', 0, '', '15-07-2023 11:50:36'),
(130, 15, 'Chrome', '::1', 'b58n8aq8akds7uubavqq3g1rcb', '18-07-2023 14:08:56', '', 0, '', '18-07-2023 14:08:56'),
(131, 26, 'Chrome', '::1', '2tsrv31c9f19g49mjqaliufgqv', '18-07-2023 14:29:10', '18-07-2023 15:13:38', 0, '', '18-07-2023 14:29:10'),
(132, 2, 'Chrome', '::1', 'rqhgkecdsplf4one8vjjv4tpoj', '18-07-2023 15:14:03', '', 0, '', '18-07-2023 15:14:03'),
(133, 15, 'Chrome', '::1', 'gafjk4gj1uucveefufrv96t5m4', '19-07-2023 13:13:53', '', 0, '', '19-07-2023 13:13:53'),
(134, 26, 'Chrome', '::1', 'lkg8s031jtdvb6rm5s6hqo3ebg', '19-07-2023 14:24:53', '19-07-2023 14:40:26', 0, '', '19-07-2023 14:24:53'),
(135, 32, 'Chrome', '::1', 'gr1i836987hdrcn88s8rngm1d1', '19-07-2023 14:41:54', '19-07-2023 15:15:33', 0, '', '19-07-2023 14:41:54'),
(136, 29, 'Chrome', '::1', 'qelm67lonim2v370354ckvgmad', '19-07-2023 15:16:23', '', 0, '', '19-07-2023 15:16:23'),
(137, 1, 'Chrome', '::1', 'aickp3l42ha0npfffudc3faatg', '03-09-2023 08:03:22', '03-09-2023 09:08:00', 0, '', '03-09-2023 08:03:22'),
(138, 1, 'Chrome', '::1', '8jj89egguht00cmcu333m3pl1e', '03-09-2023 09:09:36', '03-09-2023 09:09:45', 0, '', '03-09-2023 09:09:36'),
(139, 1, 'Chrome', '::1', '0cu33hpqkk0n0rvgkojg05mam5', '03-09-2023 09:10:05', '03-09-2023 09:10:38', 0, '', '03-09-2023 09:10:05'),
(140, 1, 'Chrome', '::1', 'futjn1flgfmva5o531mcbuhnu9', '03-09-2023 09:13:44', '11-09-2023 16:15:16', 0, '', '03-09-2023 09:13:44'),
(141, 1, 'Chrome', '::1', 'k8buqq6jcnkpil7a285hotecna', '03-09-2023 17:56:55', '11-09-2023 16:15:16', 0, '', '03-09-2023 17:56:55'),
(142, 1, 'Chrome', '::1', '7pm0k57rfdqdfj4mo0lt4v22ld', '10-09-2023 16:58:09', '11-09-2023 16:15:16', 0, '', '10-09-2023 16:58:09'),
(143, 1, 'Chrome', '::1', 'roqhrjl1k3m0104i87taoggt88', '11-09-2023 16:13:28', '11-09-2023 16:15:16', 0, '', '11-09-2023 16:13:28'),
(144, 1, 'Chrome', '::1', 'br4ftrkuhiovkhn7fao52iuie4', '14-09-2023 12:00:30', '15-09-2023 17:33:12', 0, '', '14-09-2023 12:00:30'),
(145, 1, 'Chrome', '::1', '5m0paiv8qhvi7pjb120h579brs', '15-09-2023 17:32:58', '15-09-2023 17:33:12', 0, '', '15-09-2023 17:32:58'),
(146, 1, 'Chrome', '::1', 't08up7qs17utteqpgmputua8ao', '15-09-2023 17:33:32', '15-09-2023 17:33:36', 0, '', '15-09-2023 17:33:32'),
(147, 1, 'Chrome', '::1', 'ru8evupkdulcrsu7nv43a9sc9s', '15-09-2023 17:36:10', '15-09-2023 17:36:15', 0, '', '15-09-2023 17:36:10'),
(148, 1, 'Chrome', '::1', 'vktli976jklbh6sak46uu1me1s', '15-09-2023 17:37:54', '15-09-2023 17:37:58', 0, '', '15-09-2023 17:37:54'),
(149, 1, 'Chrome', '::1', '5he23istbd9j72gchg3bkmjldu', '15-09-2023 17:39:24', '', 0, '', '15-09-2023 17:39:24');

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
  `roles_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
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
(1, 1, 'website_name', 'http://localhost/product/office', 1, 1, '2022-12-21 16:15:55'),
(2, 1, 'business_name', 'My Office 360', 0, 1, '2022-12-21 16:16:54'),
(3, 1, 'logo', 'http://localhost/product/office/uploads/media-43152.webp', 0, 1, '2022-12-21 16:17:52'),
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
