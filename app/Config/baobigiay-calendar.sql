-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2015 at 03:53 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baobigiay`
--
CREATE DATABASE IF NOT EXISTS `baobigiay` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `baobigiay`;

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `deleted_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `name`, `description`, `from_date`, `to_date`, `deleted_time`) VALUES
(1, 'Triá»ƒn khai dá»± Ã¡n Vinavit', 'CÃ´ng bá»‘ lá»‹ch lÃ m viá»‡c cá»¥ thá»', '2015-10-22 14:30:00', '2015-10-22 16:45:00', '2015-10-19 17:27:35'),
(2, 'Há»p hÃ ng tuáº§n', 'BÃ¡o cÃ¡o tÃ¬nh hÃ¬nh lÃ m viá»‡c trong tuáº§n', '2015-10-22 09:00:00', '2015-10-22 10:00:00', '2015-10-19 17:11:09'),
(3, 'Há»p hÃ ng thÃ¡ng', 'BÃ¡o cÃ¡o tÃ¬nh hÃ¬nh lÃ m viá»‡c hÃ ng thÃ¡ng', '2015-10-22 10:00:00', '2015-10-22 11:00:00', '2015-10-19 17:16:04'),
(4, 'Há»p há»™i Ä‘á»“ng quáº£n tri', 'Báº¯t Ä‘áº§u trá»ƒ hÆ¡n bÃ¬nh thÆ°á»ng vÃ¬ giÃ¡m Ä‘á»‘c cÃ³ viá»‡c báº§n', '2015-10-23 09:30:00', '2015-10-23 12:00:00', '0000-00-00 00:00:00'),
(5, 'a', 'v', '2015-09-28 00:31:00', '2015-10-07 00:31:00', '2015-10-19 17:31:54'),
(6, 'Ä‚n sÃ¡ng nhÃ  hÃ ng Háº£i Yáº¿n', 'Äá»‹a chá»‰ 264 LÃª VÄƒn Sá»¹ PhÆ°á»ng 3, Quáº­n 10', '2015-10-21 09:00:00', '2015-10-21 12:00:00', '0000-00-00 00:00:00'),
(7, 'Há»p dá»± Ã¡n Thuáº­n Minh', 'tháº£o luáº­n chi tiáº¿t vá»›i PhÃ³ giÃ¡m Ä‘á»‘c Lanh', '2015-10-22 10:10:00', '2015-10-20 12:00:00', '0000-00-00 00:00:00'),
(8, 'Ä‚n trÆ°a vá»›i anh Sau', 'anh Sau giÃ¡m Ä‘á»‘c cty Hiá»n PhÆ°Æ¡ng', '2015-10-20 11:45:00', '2015-10-20 14:00:00', '0000-00-00 00:00:00'),
(9, 'Há»p hÃ ng quÃ½', 'há»p hÃ ng quÃ½ toÃ n thá» nhÃ¢n viÃªn', '2015-10-21 15:00:00', '2015-10-21 17:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_customer`
--

CREATE TABLE IF NOT EXISTS `calendar_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `deleted_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `calendar_customer`
--

INSERT INTO `calendar_customer` (`id`, `calendar_id`, `customer_id`, `order`, `created_time`, `updated_time`, `deleted_time`) VALUES
(42, 4, 11, 0, '2015-10-19 17:17:31', '2015-10-19 17:17:31', '0000-00-00 00:00:00'),
(43, 4, 10, 0, '2015-10-19 17:17:31', '2015-10-19 17:17:31', '0000-00-00 00:00:00'),
(44, 4, 12, 0, '2015-10-19 17:17:31', '2015-10-19 17:17:31', '0000-00-00 00:00:00'),
(45, 6, 9, 0, '2015-10-20 02:58:39', '2015-10-20 02:58:39', '0000-00-00 00:00:00'),
(46, 6, 10, 0, '2015-10-20 03:10:10', '2015-10-20 03:10:10', '0000-00-00 00:00:00'),
(47, 7, 10, 0, '2015-10-20 03:45:10', '2015-10-20 03:45:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_lead`
--

CREATE TABLE IF NOT EXISTS `calendar_lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `deleted_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `calendar_lead`
--

INSERT INTO `calendar_lead` (`id`, `calendar_id`, `lead_id`, `order`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 4, 1, 0, '2015-10-20 02:54:25', '2015-10-20 02:54:25', '0000-00-00 00:00:00'),
(2, 4, 1, 0, '2015-10-20 02:55:52', '2015-10-20 02:55:52', '0000-00-00 00:00:00'),
(4, 6, 2, 0, '2015-10-20 03:10:10', '2015-10-20 03:10:10', '0000-00-00 00:00:00'),
(5, 6, 1, 0, '2015-10-20 03:10:10', '2015-10-20 03:10:10', '0000-00-00 00:00:00'),
(6, 8, 1, 0, '2015-10-20 03:46:51', '2015-10-20 03:46:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_user`
--

CREATE TABLE IF NOT EXISTS `calendar_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `deleted_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `calendar_user`
--

INSERT INTO `calendar_user` (`id`, `calendar_id`, `user_id`, `order`, `created_time`, `updated_time`, `deleted_time`) VALUES
(2, 6, 3, 0, '2015-10-20 03:41:55', '2015-10-20 03:41:55', '0000-00-00 00:00:00'),
(3, 7, 3, 0, '2015-10-20 03:45:10', '2015-10-20 03:45:10', '0000-00-00 00:00:00'),
(4, 8, 3, 0, '2015-10-20 03:46:51', '2015-10-20 03:46:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_vendor`
--

CREATE TABLE IF NOT EXISTS `calendar_vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` datetime NOT NULL,
  `deleted_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `calendar_vendor`
--

INSERT INTO `calendar_vendor` (`id`, `calendar_id`, `vendor_id`, `order`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 4, 2, 0, '2015-10-20 02:55:52', '2015-10-20 02:55:52', '0000-00-00 00:00:00'),
(2, 6, 2, 0, '2015-10-20 03:10:11', '2015-10-20 03:10:11', '0000-00-00 00:00:00'),
(3, 6, 1, 0, '2015-10-20 03:10:11', '2015-10-20 03:10:11', '0000-00-00 00:00:00'),
(4, 9, 2, 0, '2015-10-20 03:47:54', '2015-10-20 03:47:54', '0000-00-00 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
