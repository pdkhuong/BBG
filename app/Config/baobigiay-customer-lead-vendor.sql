-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2015 at 04:17 PM
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
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `info` text,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `code`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 'Phan Há»“ng PhÃºc', 'CKPGFQIHHHHHFNQH', 'phanhongphuc@gmail.com', '01227744772', '0123456789', '201 Hai BÃ  TrÆ°ng , PhÆ°á»ng 5 , quáº­n 3, TpHCM', 'KhÃ¡ch hÃ ng má»›i', '2015-10-09 16:55:34'),
(9, 'ÄoÃ n Thá»‹ Cáº©m Xin', 'FEKAJGYGSRUWLSNI', 'DoanThiCamXin@hotmail.com', '0902212230', '0826482063', '285/C145 CÃ¡ch Máº¡ng ThÃ¡ng 8 - Tp Há»“ ChÃ­ Minh', 'Chá»‹ sinh ngÃ y 2 thÃ¡ng 10 nÄƒm 1971 vÃ  Chá»‹ lÃ  Chá»‹ cáº£ trong gia Ä‘Ã¬nh cá»§a 2 Chá»‹ em. \r\nChá»‹ Ä‘Ã£ tham gia sinh hoáº¡t vÄƒn nghá»‡ tá»« CLB ca sÄ© tráº», Trung tÃ¢m vÄƒn hoÃ¡ quáº­n 10 nÄƒm 1991', NULL),
(10, 'Äáº·ng Thá»‹ Thanh Lanh', 'TLWJCKIPPMMZCRKU', 'ThanhLanh@yahoo.com', '0908960568', '0805688960', '126/8 CÃ¡ch Máº¡ng ThÃ¡ng TÃ¡m, PhÆ°á»ng 7, Quáº­n 3 - Tp Há»“ ChÃ­ Minh', 'Lanh sinh ra táº¡i Huáº¿, trong gia Ä‘Ã¬nh gá»“m 6 anh em vÃ  má»™t ngÆ°á»i chá»‹ nuÃ´i, Lanh lÃ  con thá»© 3 trong gia Ä‘Ã¬nh. ', NULL),
(11, 'Trá»‹nh Thanh Äá»', 'WTLZMFGDGLTLGBAU', 'TrinhThanhe@gmail.com', '09339095507', '08355073909', '319/2A Hai BÃ  TrÆ°ng, PhÆ°á»ng 8, Quáº­n 3 - Tp Há»“ ChÃ­ Minh', 'Äá» sinh ngÃ y 2 thÃ¡ng 4 nÄƒm 1981 táº¡i HÃ  Ná»™i, lÃ  ca sÄ© dÃ²ng nháº¡c nháº¹ cá»§a Viá»‡t Nam', NULL),
(12, 'VÆ°Æ¡ng Háº£i ChÃ­', 'XKEGEBXOUSAJRQOR', 'VuongHaiChi@gmail.com', '0969765226', '0832269765', '194 HoÃ ng VÄƒn Thá»¥, PhÆ°á»ng 9, Quáº­n PhÃº Nhuáº­n - Há»“ ChÃ­ Minh', 'Sinh ra vÃ  lá»›n lÃªn táº¡i HÃ  Ná»™i, nay láº­p nghiá»‡p á»Ÿ SÃ i GÃ²n, vá»›i VÆ°Æ¡ng Háº£i ChÃ­, HÃ  Ná»™i mÃ£i mÃ£i váº«n Ä‘áº¹p, nÃªn thÆ¡ vÃ  cá»• kÃ­nh. ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lead`
--

CREATE TABLE IF NOT EXISTS `lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `info` text,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lead`
--

INSERT INTO `lead` (`id`, `name`, `code`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 'Triá»‡u Trá»ng Sau', 'LDNCTPOOLRMTYBYJ', 'TrieuTrongSau@gmail.com', '0984672618', '0836184672', '16 ÄÆ°á»ng 3 thÃ¡ng 2 , PhÆ°á»ng 1 , ÄÃ  Láº¡t - LÃ¢m Äá»“ng', 'Triá»‡u Trá»ng Sau lÃ  cá»±u thÃ nh viÃªn nhÃ³m MP5, cÅ©ng lÃ  ngÆ°á»i láº­p ra nhÃ³m nháº¡c nÃ y. Sau Ä‘Ã³ cÃ¡c thÃ¡nh viÃªn trong nhÃ³m tÃ¡ch ra solo, Triá»‡u Trá»ng Sau solo tá»« Ä‘áº§u nÄƒm 2009. ', NULL),
(2, 'Láº¡c Thá»‹ XuÃ¢n UyÃªn', 'AGBYSNHNGXUYPGQF', 'LacThiXuanUyen@hotmail.com', '0912010916', '0830916201', '44 Tráº§n PhÃº, P4, Q5 - Há»“ ChÃ­ Minh', 'Láº¡c Thá»‹ XuÃ¢n UyÃªn sinh ngÃ y 1/9/1984, cÃ²n cÃ³ biá»‡t danh lÃ  A MÃ­, lÃ  con thá»© 4 trong má»™t gia Ä‘Ã¬nh cÃ³ 5 chá»‹ em gÃ¡i, táº¡i quáº­n 5, má»™t khu dÃ¢n cÆ° Ä‘Æ°á»£c má»‡nh danh lÃ  "phá»‘ ngÆ°á»i Hoa" cá»§a ThÃ nh phá»‘ Há»“ ChÃ­ Minh. ', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `info` text,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `code`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 'Buffet Ngá»c Thá»§y', 'WDPZUTKCAEDCCBRL', 'ngocthuybuffet@yahoo.com', '0838378543', '0838378543', '214 B Nguyá»…n TrÃ£i, PhÆ°á»ng Nguyá»…n CÆ° Trinh, Quáº­n 1 - Há»“ ChÃ­ Minh', 'Æ¯u Ä‘iá»ƒm : \r\n- Thá»©c Äƒn ngon vÃ  phong phÃº, Ä‘áº·c biá»‡t lÃ  cÃ³ nhiá»u háº£i sáº£n.', NULL),
(2, 'Dá»‹ch vá»¥ Káº¿ toÃ¡n TrÃ­ Viá»‡t', 'EVNVGNTDLKHURRGN', 'trivietacc@gmail.com', '0934534541', '0934534541', '251 Chu VÄƒn An - Há»“ ChÃ­ Minh', 'Cung cáº¥p cÃ¡c dá»‹ch vá»¥ káº¿ toÃ¡n cho doanh nghiá»‡p nhÆ° dá»‹ch vá»¥ káº¿ toÃ¡n thuáº¿ trá»n gÃ³i, dá»‹ch vá»¥ láº­p bÃ¡o cÃ¡o tÃ i chÃ­nh, dá»‹ch vá»¥ káº¿ toÃ¡n trá»n gÃ³i,..', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
