-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 21, 2015 at 02:58 PM
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
-- Table structure for table `customer_contact`
--

CREATE TABLE IF NOT EXISTS `customer_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `info` text,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `customer_contact`
--

INSERT INTO `customer_contact` (`id`, `customer_id`, `name`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 9, 'Iphone', 'DoanThiCamXin@hotmail.com', '098354729', '094524729', '13 LÃª Thá»‹ RiÃªng P4 Q1', 'Sá»‘ phone khÃ¡c cá»§a chá»‹ Xin', NULL),
(3, 9, 'Skype', 'doanthicamxin', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lead_contact`
--

CREATE TABLE IF NOT EXISTS `lead_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `info` text,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `lead_contact`
--

INSERT INTO `lead_contact` (`id`, `lead_id`, `name`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 1, 'ÄiÃªn thoáº¡i bÃ n', '', '0122875456', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_contact`
--

CREATE TABLE IF NOT EXISTS `vendor_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `info` text,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `vendor_contact`
--

INSERT INTO `vendor_contact` (`id`, `vendor_id`, `name`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 1, 'Nguyá»…n Ngá»c Thá»§y', 'thuyngoc@gmail.com', '093847283', '0394729382', '195 Tráº§n Huy Liá»‡u P7, Q3 ', 'GiÃ¡m Ä‘á»‘c cty', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
