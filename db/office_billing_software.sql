-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 03, 2023 at 06:33 AM
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
-- Database: `office_billing_software`
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(8, 4, 2, 0, 0, 0, '2023-09-10 11:40:09', NULL),
(9, 5, 1, 1, 1, 1, '2023-10-02 13:55:33', NULL),
(10, 5, 2, 1, 1, 0, '2023-10-02 13:55:33', NULL),
(11, 5, 3, 1, 1, 0, '2023-10-02 13:55:33', NULL),
(12, 5, 4, 1, 0, 0, '2023-10-02 13:55:33', NULL),
(13, 5, 5, 0, 0, 0, '2023-10-02 13:55:33', NULL),
(14, 5, 6, 0, 0, 0, '2023-10-02 13:55:33', NULL),
(15, 5, 7, 0, 0, 0, '2023-10-02 13:55:33', NULL),
(16, 5, 8, 0, 0, 0, '2023-10-02 13:55:33', NULL),
(17, 5, 9, 0, 0, 0, '2023-10-02 13:55:33', NULL),
(18, 5, 10, 0, 0, 0, '2023-10-02 13:55:33', NULL),
(19, 5, 11, 0, 0, 0, '2023-10-02 13:55:33', NULL),
(20, 5, 12, 0, 0, 0, '2023-10-02 13:55:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `r_id` int NOT NULL COMMENT 'Roll id',
  `login_id` varchar(255) NOT NULL,
  `a_type` int NOT NULL COMMENT '2 - Manufactorer\r\n3 - Distributer\r\n4 - Dealer',
  `a_type_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL COMMENT '2 - Manufactorer 3 - Distributer 4 - Dealer	',
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
(1, 1, 'SA2642', 2, 'Super Admin', 1, '1', 'altabraja4@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456', 'Altab Raja', '', '987456321', '', 'Admin', '1', '1', '1', '', '', '2023-03-01', '2023-12-01', 1, '2018-07-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `custumer`
--

DROP TABLE IF EXISTS `custumer`;
CREATE TABLE IF NOT EXISTS `custumer` (
  `c_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gst_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'GST Certificate \r\n',
  `img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Upload Documents',
  `register_address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `custumer`
--

INSERT INTO `custumer` (`c_id`, `consumer_id`, `user_id`, `name`, `mobile_no`, `email_id`, `gst_no`, `img1`, `img2`, `register_address`, `create_at`, `update_at`) VALUES
(16, 0, 1, 'Altab', '3432', 'sd@gmail.com', '4333', 'media-77567.png', '', 'ssss', '2023-09-18 06:28:38', '0000-00-00 00:00:00'),
(19, 1, 1, 'Reshma Parveem', '7077384091', 'alirehsm@gmail.com', 'XXX', '', '', 'Jharsugda', '2023-09-27 06:56:50', NULL),
(20, 1, 1, 'Gufran', '7873866033', 'gufran@gmail.com', 'ABC', '', '', 'sORDA', '2023-09-27 07:42:13', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`lh_id`, `a_id`, `browser`, `ip_address`, `session`, `login_time`, `logout_time`, `sts`, `active_time`, `date`) VALUES
(1, 1, 'Chrome', '::1', '3vl9k6t95ugpkgjt6man8rqcek', '17-09-2023 21:12:35', '', 0, '', '17-09-2023 21:12:35'),
(2, 1, 'Chrome', '::1', 'ot34v0uq8q0bjeo4g51gr0e4rl', '19-09-2023 07:21:52', '', 0, '', '19-09-2023 07:21:52'),
(3, 1, 'Chrome', '::1', 'on5k1i2v4ulb25gn6vetedh0al', '19-09-2023 18:35:59', '', 0, '', '19-09-2023 18:35:59'),
(4, 1, 'Chrome', '::1', 'o2k4itmi4k4ohaplrt8sh7fbpn', '23-09-2023 07:38:10', '', 0, '', '23-09-2023 07:38:10'),
(5, 1, 'Chrome', '::1', 'hld6q2u6rd5klfrp7kcok2gs98', '23-09-2023 21:39:22', '', 0, '', '23-09-2023 21:39:22'),
(6, 1, 'Chrome', '::1', 'jc8nv8e1eq1u41gkcldtvtc280', '01-10-2023 15:37:34', '', 0, '', '01-10-2023 15:37:34'),
(7, 1, 'Chrome', '::1', 'begrc0u2jbt95rmmbc40f4c8hu', '02-10-2023 17:50:10', '', 0, '', '02-10-2023 17:50:10');

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`p_id`, `consumer_id`, `name`, `date`) VALUES
(1, 1, 'Setup', '2023-09-03 10:07:44'),
(2, 1, 'Roles', '2023-09-03 10:11:13'),
(3, 1, 'User', '2023-10-02 19:21:06'),
(4, 1, 'Suplier', '2023-10-02 19:21:06'),
(5, 1, 'Purchase Goods', '2023-10-02 19:21:06'),
(6, 1, 'Invoices', '2023-10-02 19:21:06'),
(7, 1, 'Products List', '2023-10-02 19:21:06'),
(8, 1, 'Purchase Report', '2023-10-02 19:21:06'),
(9, 1, 'Custumer Manage', '2023-10-02 19:21:06'),
(10, 1, 'Sale Goods', '2023-10-02 19:21:06'),
(11, 1, 'Sale Goods List', '2023-10-02 19:21:06'),
(12, 1, 'Sale Reports', '2023-10-02 19:21:06');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `po_id` int NOT NULL COMMENT 'purchase_order_id',
  `user_id` int NOT NULL,
  `consumer_id` int NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_purchase_price` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_saling_price` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `product_sku` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `unit` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`p_id`, `po_id`, `user_id`, `consumer_id`, `product_name`, `product_purchase_price`, `product_saling_price`, `product_sku`, `qty`, `unit`, `expiry_date`, `create_at`, `update_at`) VALUES
(1, 1, 1, 1, 'ABCD2', '5000', '', 'ABC', 30, '', NULL, '2023-09-26 13:23:49', NULL),
(2, 1, 1, 1, 'acvbj', '100', '', 'ACF', 49, '', NULL, '2023-09-26 13:23:49', NULL),
(3, 0, 1, 1, 'button', '500', '3000', 'VCK', 1, '', '0000-00-00', '2023-09-26 13:23:49', '2023-10-02 19:36:30'),
(4, 2, 1, 0, 'items', '500', '', 'vvc', 5, '', NULL, '2023-09-27 19:25:30', NULL),
(5, 3, 1, 0, 'Item 1', '500', '', 'SKU12', 4, '', NULL, '2023-10-02 19:31:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchae_order`
--

DROP TABLE IF EXISTS `purchae_order`;
CREATE TABLE IF NOT EXISTS `purchae_order` (
  `po_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `consumer_id` int NOT NULL,
  `supplier_id` int NOT NULL,
  `order_date` date NOT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `subtotal` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tax_amount` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `total` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `paid_amount` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `due_amount` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sts` int NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`po_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchae_order`
--

INSERT INTO `purchae_order` (`po_id`, `user_id`, `consumer_id`, `supplier_id`, `order_date`, `invoice_no`, `subtotal`, `tax`, `tax_amount`, `total`, `paid_amount`, `due_amount`, `payment_method`, `sts`, `create_at`, `update_at`) VALUES
(1, 1, 1, 2, '2023-09-26', '1', '15500', '18', '2790', '18290', '10000', '7690', 'Cash', 0, '2023-09-26 13:23:49', NULL),
(2, 1, 1, 2, '2023-09-27', '2', '2500', '10', '250', '2750', '50', '2700', 'Cash', 0, '2023-09-27 19:25:30', NULL),
(3, 1, 1, 2, '2023-10-02', '3', '2500', '18', '450', '2950', '2000', '950', 'Cash', 0, '2023-10-02 19:31:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_data`
--

DROP TABLE IF EXISTS `purchase_data`;
CREATE TABLE IF NOT EXISTS `purchase_data` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `po_id` int NOT NULL COMMENT 'purchase_order_id',
  `consumer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_purchase_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_saling_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `sts` int NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_data`
--

INSERT INTO `purchase_data` (`p_id`, `po_id`, `consumer_id`, `product_id`, `product_name`, `product_purchase_price`, `product_saling_price`, `product_sku`, `qty`, `unit`, `expiry_date`, `sts`, `create_at`, `update_at`) VALUES
(1, 1, 1, 1, 'ABCD2', '5000', '', 'ABC', 2, '', NULL, 0, '2023-09-26 13:23:49', NULL),
(2, 1, 1, 2, 'acvbj', '100', '', 'ACF', 5, '', NULL, 0, '2023-09-26 13:23:49', NULL),
(3, 3, 1, 3, 'button', '500', '1000', 'VCK', 10, '', '0000-00-00', 0, '2023-09-26 13:23:49', '2023-09-26 17:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_due_amount_collect`
--

DROP TABLE IF EXISTS `purchase_due_amount_collect`;
CREATE TABLE IF NOT EXISTS `purchase_due_amount_collect` (
  `pdac_id` int NOT NULL AUTO_INCREMENT,
  `po_id` int NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `payment_date` date NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pdac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_due_amount_collect`
--

INSERT INTO `purchase_due_amount_collect` (`pdac_id`, `po_id`, `amount`, `payment_method`, `payment_date`, `create_at`, `update_at`) VALUES
(6, 1, '600', 'Cash', '2023-10-02', '2023-10-02 19:33:31', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`r_id`, `consumer_id`, `roles_name`, `create_at`, `update_at`) VALUES
(1, 1, 'Administrator', '2023-09-03 14:23:04', NULL),
(2, 1, 'Telecaller', '2023-09-03 14:30:16', NULL),
(3, 1, 'Core Employee', '2023-09-03 14:30:29', NULL),
(5, 1, '', '2023-10-02 13:55:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_data`
--

DROP TABLE IF EXISTS `sale_data`;
CREATE TABLE IF NOT EXISTS `sale_data` (
  `s_id` int NOT NULL AUTO_INCREMENT,
  `so_id` int NOT NULL COMMENT 'sale_order_id',
  `user_id` int NOT NULL,
  `consumer_id` int NOT NULL,
  `custumer_id` int NOT NULL,
  `product_id` int NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_purchase_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_saling_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `expiry_date` date DEFAULT NULL,
  `sts` int NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`s_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_data`
--

INSERT INTO `sale_data` (`s_id`, `so_id`, `user_id`, `consumer_id`, `custumer_id`, `product_id`, `product_name`, `product_purchase_price`, `product_saling_price`, `product_sku`, `qty`, `unit`, `expiry_date`, `sts`, `create_at`, `update_at`) VALUES
(4, 0, 1, 1, 20, 3, 'button', '500', '1000', 'VCK', 5, '', NULL, 1, '2023-09-27 14:29:25', NULL),
(5, 0, 1, 1, 20, 3, 'button', '500', '1000', 'VCK', 1, '', NULL, 1, '2023-09-27 17:51:57', NULL),
(6, 0, 1, 1, 20, 2, 'acvbj', '100', '500', 'ACF', 1, '', NULL, 1, '2023-09-27 17:55:30', NULL),
(7, 0, 1, 1, 20, 3, 'button', '500', '1000', 'VCK', 90, '', NULL, 1, '2023-09-27 18:20:04', NULL),
(8, 4, 1, 1, 20, 3, 'button', '500', '1000', 'VCK', 1, '', NULL, 1, '2023-09-27 19:22:52', NULL),
(9, 5, 1, 1, 20, 3, 'button', '500', '1000', 'VCK', 2, '', NULL, 1, '2023-10-02 19:35:30', NULL),
(10, 5, 1, 1, 20, 5, 'Item 1', '500', '600', 'SKU12', 1, '', NULL, 1, '2023-10-02 19:36:01', NULL),
(11, 0, 1, 1, 20, 1, 'ABCD2', '5000', '500', 'ABC', 6, '', NULL, 0, '2023-10-02 20:31:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_due_amount_collect`
--

DROP TABLE IF EXISTS `sale_due_amount_collect`;
CREATE TABLE IF NOT EXISTS `sale_due_amount_collect` (
  `pdac_id` int NOT NULL AUTO_INCREMENT,
  `so_id` int NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_date` date NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pdac_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_due_amount_collect`
--

INSERT INTO `sale_due_amount_collect` (`pdac_id`, `so_id`, `amount`, `payment_method`, `payment_date`, `create_at`, `update_at`) VALUES
(1, 3, '100', 'Cash', '2023-09-27', '2023-09-27 19:08:31', NULL),
(2, 4, '50', 'Cash', '2023-09-27', '2023-09-27 19:27:35', NULL),
(3, 4, '50', 'Cash', '2023-09-27', '2023-09-27 19:27:44', NULL),
(4, 5, '20', 'Cash', '2023-10-02', '2023-10-02 19:37:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_order`
--

DROP TABLE IF EXISTS `sale_order`;
CREATE TABLE IF NOT EXISTS `sale_order` (
  `so_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `consumer_id` int NOT NULL,
  `custumer_id` int NOT NULL,
  `order_date` date NOT NULL,
  `invoice_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `subtotal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tax` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tax_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `paid_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `due_amount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sts` int NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`so_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_order`
--

INSERT INTO `sale_order` (`so_id`, `user_id`, `consumer_id`, `custumer_id`, `order_date`, `invoice_no`, `subtotal`, `tax`, `tax_amount`, `total`, `paid_amount`, `due_amount`, `payment_method`, `sts`, `create_at`, `update_at`) VALUES
(3, 1, 1, 20, '2023-09-27', '1', '96500', '18', '17370', '113870', '110000', '3770', 'Cash', 1, '2023-09-27 18:50:04', NULL),
(4, 1, 1, 20, '2023-09-27', '2', '1000', '10', '100', '1100', '1000', '0', 'Cash', 0, '2023-09-27 19:23:06', NULL),
(5, 1, 1, 20, '2023-10-02', '3', '2600', '18', '468', '3068', '3000', '48', 'Cash', 0, '2023-10-02 19:37:15', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`s_id`, `consumer_id`, `name`, `value`, `sts`, `shows`, `date`) VALUES
(1, 1, 'website_name', 'http://localhost/product/billing_software', 1, 1, '2022-12-21 16:15:55'),
(2, 1, 'business_name', 'Billing Software', 0, 1, '2022-12-21 16:16:54'),
(3, 1, 'logo', 'http://localhost/product/billing_software/uploads/media-47148.webp', 0, 1, '2022-12-21 16:17:52'),
(4, 1, 'invoice_pre', 'ABC', 0, 4, '2022-12-21 16:18:37'),
(5, 1, 'invoice_template', '', 0, 2, '2022-12-21 16:27:15'),
(6, 1, 'invoice_colour', '', 0, 2, '2022-12-24 21:12:39'),
(7, 1, 'termandcondition', '', 0, 2, '2022-12-24 21:12:39'),
(8, 1, 'bank_details', '', 0, 2, '2022-12-24 22:25:20'),
(9, 1, 'sale_email', '', 0, 3, '2022-12-31 15:02:50'),
(10, 1, 'support_email', '', 0, 3, '2022-12-31 15:02:50'),
(11, 1, 'business_email', '', 0, 3, '2022-12-31 15:02:50'),
(12, 1, 'transaction_email', '', 0, 3, '2023-06-20 07:37:09'),
(13, 1, 'version', '', 0, 0, '2023-06-20 07:52:29'),
(14, 1, 'shop_address', 'Manglabagh,\r\nCuttack, Masjid  - 753001', 0, 4, '2023-09-24 06:15:45'),
(15, 1, 'shop_mobile_no', '7894947464', 0, 4, '2023-09-24 06:16:59'),
(16, 1, 'shop_email_id', 'altabraja4@gmail.com', 0, 4, '2023-09-24 06:16:59'),
(17, 1, 'shop_gst_no', '21DOFR2142Q', 0, 4, '2023-09-24 06:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `store_setting`
--

DROP TABLE IF EXISTS `store_setting`;
CREATE TABLE IF NOT EXISTS `store_setting` (
  `ss_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'a_id',
  `store_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `store_mobile_no` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `store_email_id` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `store_address` varchar(600) COLLATE utf8mb4_general_ci NOT NULL,
  `store_gst` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `store_logo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`ss_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store_setting`
--

INSERT INTO `store_setting` (`ss_id`, `consumer_id`, `user_id`, `store_name`, `store_mobile_no`, `store_email_id`, `store_address`, `store_gst`, `store_logo`, `create_at`, `update_at`) VALUES
(1, 1, 1, 'Techzex       ', '9938318786       ', 'altabrajaa4@gmail.com        ', 'Address is here', 'DOF2142QIZP        ', 'media-62767.webp', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `vd_id` int NOT NULL AUTO_INCREMENT,
  `consumer_id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gst_no` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `img1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'GST Certificate \r\n',
  `img2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Upload Documents',
  `register_address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`vd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vd_id`, `consumer_id`, `user_id`, `name`, `mobile_no`, `email_id`, `gst_no`, `img1`, `img2`, `register_address`, `create_at`, `update_at`) VALUES
(2, 1, 1, 'Raj kishor', '3232432432', 'as@gmail.com', '432432423', '', '', 'Cuttack', '2023-09-18 01:01:10', NULL),
(16, 0, 1, 'Altab', '3432', 'sd@gmail.com', '4333', 'media-77567.png', '', 'ssss', '2023-09-18 06:28:38', '0000-00-00 00:00:00'),
(18, 1, 1, 'Techzex', '9777760079', 'techzex@gmail.com', '3432432432', 'media-95899.pdf', 'media-34973.pdf', 'Chandan Nagar, Nashik Maharastra', '2023-09-23 21:42:40', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
