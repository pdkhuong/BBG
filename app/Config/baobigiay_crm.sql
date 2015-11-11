-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 11, 2015 at 03:11 PM
-- Server version: 5.5.46
-- PHP Version: 5.5.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `baobigiay_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `deleted_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `name`, `user_id`, `description`, `from_date`, `to_date`, `deleted_time`) VALUES
(1, 'Hop hÃ ng tuáº§n', 5, 'bÃ¡o cÃ¡o thu chi trong thÃ¡ng', '2015-11-02 08:00:00', '2015-11-02 10:00:00', '0000-00-00 00:00:00'),
(2, 'Team building nhÃ  hÃ ng Hoa Rá»«ng', 5, 'Äá»‹a chá»‰: 43 ThÃ nh ThÃ¡i, P6, Q10', '2015-10-31 17:30:00', '2015-10-31 19:30:00', '0000-00-00 00:00:00'),
(3, 'LiÃªn hoan cuá»‘i thÃ¡ng', 5, 'Ä‘á»‹a chá»‰: buffee HÃ¹ng VÆ°Æ¡ng, 341 HÃ¹ng VÆ°Æ¡ng, P6, Q5', '2015-11-01 09:00:00', '2015-11-01 12:00:00', '0000-00-00 00:00:00'),
(4, 'Há»p dá»± Ã¡n Thuáº­n Minh', 4, '', '2015-11-03 09:15:00', '2015-10-31 11:45:00', '0000-00-00 00:00:00'),
(5, 'GAP KHACH HANG DART', 10, 'ÃDFSDFSDFSDF', '2015-11-20 11:37:00', '2015-11-20 11:37:00', '2015-11-02 11:35:10'),
(6, 'LÃ PHONG', 10, 'GIAO PROOF', '2015-11-02 15:30:00', '2015-11-02 17:00:00', '2015-11-02 16:16:44'),
(7, 'MÃ‚Y VÃ€NG + D;ART', 10, 'Há»¢P Äá»’NG + PROOF + TIá»€N Cá»ŒC + MáºªU D''ART\r\n', '2015-11-03 14:30:00', '2015-11-03 17:00:00', '2015-11-02 16:16:39'),
(8, 'MÃ‚Y VÃ€NG + D;ART', 10, 'GIAO HÄ + MáºªU', '2015-11-04 14:30:00', '2015-11-04 17:00:00', '2015-11-04 14:08:11'),
(9, 'NGHá»ˆ', 10, 'CV CÃ NHÃ‚N', '2015-11-24 11:56:00', '2015-11-26 11:56:00', '0000-00-00 00:00:00'),
(10, 'LÃ PHONG + LAI PHÃš', 10, 'GIAO PROOF', '2015-11-03 08:30:00', '2015-11-03 11:00:00', '0000-00-00 00:00:00'),
(11, 'LÃ€M VIá»†C Vá»šI CTY CHANTELE VN', 2, 'Há»ŽI MáºªU KHÃCH HÃ€NG', '2015-11-04 20:34:00', '2015-11-04 20:34:00', '0000-00-00 00:00:00'),
(12, 'MÃ‚Y VÃ€NG + D''ART', 10, 'Há»¢P Äá»’NG + MáºªU', '2015-11-05 09:00:00', '2015-11-05 11:30:00', '0000-00-00 00:00:00'),
(13, 'TÃ€I TÃ€I THÃ€NH', 10, '', '2015-11-04 10:00:00', '2015-11-05 11:00:00', '0000-00-00 00:00:00'),
(14, 'SAIKO', 10, 'THU 20TR', '2015-11-05 15:00:00', '2015-11-05 16:30:00', '0000-00-00 00:00:00'),
(15, 'NGÃ€Y 10 PHáº¢I GIAO Háº¾T Há»˜P 3V', 41, 'Pháº£i giao háº¿t trÆ°á»›c 4h30', '2015-11-10 07:40:00', '2015-11-10 16:27:00', '0000-00-00 00:00:00'),
(16, 'SUOL CHOCOLATE', 37, 'GIAO MáºªU CHO KHÃCH HÃ€NG', '2015-11-07 08:30:00', '2015-11-07 16:30:00', '0000-00-00 00:00:00'),
(17, 'NGÃ€Y 7 GIAO MáºªU CHO KHÃCH HÃ€NG', 41, 'GIAO MáºªU CHO KHÃCH', '2015-11-07 10:58:00', '2015-11-07 16:30:00', '0000-00-00 00:00:00'),
(18, 'KANA', 10, '', '2015-11-05 11:35:00', '2015-11-05 13:14:00', '0000-00-00 00:00:00'),
(19, 'X28 + LÃ PHONG', 10, 'Láº¤Y MáºªU', '2015-11-07 08:00:00', '2015-11-07 10:30:00', '0000-00-00 00:00:00'),
(20, 'SAIKO', 10, '', '2015-11-07 15:30:00', '2015-11-07 17:00:00', '0000-00-00 00:00:00'),
(21, 'FONTERRA + D''ART + MÃ‚Y VÃ€NG', 10, '', '2015-11-10 14:00:00', '2015-11-10 18:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `costing`
--

CREATE TABLE IF NOT EXISTS `costing` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `spec_length` float DEFAULT NULL,
  `spec_width` float DEFAULT NULL,
  `paper_length` float DEFAULT NULL,
  `paper_width` float DEFAULT NULL,
  `paper_substance` float DEFAULT NULL,
  `paper_cutting` float DEFAULT NULL,
  `paper_price_ton` float DEFAULT NULL,
  `paper_price_ram` float DEFAULT NULL,
  `printing_color` int(11) DEFAULT NULL,
  `printing_coverage` int(11) DEFAULT NULL,
  `printing_cost` float DEFAULT NULL,
  `printing_films` float DEFAULT NULL,
  `vanish_oil` float DEFAULT NULL,
  `vanish_uv` float DEFAULT NULL,
  `vanish_opp` float DEFAULT NULL,
  `ply` float DEFAULT NULL,
  `limination` float DEFAULT NULL,
  `die_cut` float DEFAULT NULL,
  `gluing_1` float DEFAULT NULL,
  `gluing_2` float DEFAULT NULL,
  `gluing_3` float DEFAULT NULL,
  `packaging` float DEFAULT NULL,
  `transportation` float DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `mk` float DEFAULT NULL,
  `exchange` float DEFAULT NULL,
  `inner_surf_substance` float DEFAULT NULL,
  `inner_surf_price` float DEFAULT NULL,
  `b_flute_substance` float DEFAULT NULL,
  `b_flute_price` float DEFAULT NULL,
  `e_flute_substance` float DEFAULT NULL,
  `e_flute_price` float DEFAULT NULL,
  `selling_price` float DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `costing`
--

INSERT INTO `costing` (`id`, `product_id`, `user_id`, `spec_length`, `spec_width`, `paper_length`, `paper_width`, `paper_substance`, `paper_cutting`, `paper_price_ton`, `paper_price_ram`, `printing_color`, `printing_coverage`, `printing_cost`, `printing_films`, `vanish_oil`, `vanish_uv`, `vanish_opp`, `ply`, `limination`, `die_cut`, `gluing_1`, `gluing_2`, `gluing_3`, `packaging`, `transportation`, `quantity`, `mk`, `exchange`, `inner_surf_substance`, `inner_surf_price`, `b_flute_substance`, `b_flute_price`, `e_flute_substance`, `e_flute_price`, `selling_price`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 9, 1, 55, 59, 56, 60.5, 400, 2, 150000, 0, 8, 80, 0, 0, 0, 0, 1, 1, 10, 0.75, 2, 0, 0, 15, 10, 20000, 3, 21000, 150, 550, 150, 508, 0, 400, 3135, '2015-11-11 15:00:31', '2015-11-11 15:00:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `customer_user_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `foundation` date NOT NULL COMMENT 'ngày thành lập',
  `investment` varchar(255) DEFAULT NULL COMMENT 'số vốn',
  `career` varchar(255) DEFAULT NULL COMMENT 'ngành nghề',
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `user_id`, `customer_user_id`, `name`, `code`, `email`, `phone`, `fax`, `address`, `website`, `foundation`, `investment`, `career`, `deleted_time`) VALUES
(1, 1, 3, 'Customer 1', 'C001', 'customer1@gmail.com', '0987710227', '0987710227', 'TÃ¢n lÃ¢m', 'http://dramalist.net', '2015-10-20', '2000', 'CÃ´ng Nghá»‡ ThÃ´ng Tin', NULL),
(2, 2, 4, 'Phan VÄƒn Minh', 'staff002', 'phanhongphuc@gmail.com', '0123456789', '0123456789', '841 LÃª Lai, P4, Q1', 'http://www.vanminh.com', '2013-07-17', '4,3 tá»‰ Ä‘á»“ng', 'thiáº¿t káº¿ thá»i trang', NULL),
(3, 2, 6, 'Tá»”NG CÃ”NG TY Cá»” PHáº¦N Y Táº¾ DANAMECO', 'DANAMECO', 'hanhnt2@danameco.com', '05103753857', '05103753548', '105 HÃ¹ng VÆ°Æ¡ng, Q. Háº£i ChÃ¢u, Tp. ÄÃ  Náºµng', 'http://www.danameco.com', '2005-06-07', '5000000000', '100', '2015-11-04 22:53:08'),
(4, 2, 7, 'REMINGTON Sroufe Intl'' Company', 'rsil', 'purchasing-rsil@remsroufe-intl.com', '06503559908', '06503577469', 'Lo C-8C-CN, KCN My Phuoc 3, Báº¿n CÃ¡t, BÃŒnh DÆ°Æ¡ng', 'http://www.remsroufe-intl.com', '2008-01-01', '3000000000', '200', '2015-11-04 22:53:03'),
(5, 19, 8, 'CÃ”NG TY CP DÆ¯á»¢C - TRANG THIáº¾T Bá»Š Y Táº¾ BÃŒNH Äá»ŠNH', 'BIDIPHAR', 'hoa@bidiphar.com', '0563846500', '0563846501', '498 Nguyá»…n ThÃ¡i Há»c, P. Quang Trung, BÃŒnh Äá»‹nh', 'http://www.bidiphar.com', '2010-09-01', '10000000000', '400', NULL),
(6, 2, 9, 'CÃ”NG TY CP TM VÃ€ DV THIáº¾T Bá»Š GIÃM SÃT Báº¢O TOÃ€N', 'BAOTOAN', 'baotoan@baotoan.com.vn', '0838371234', '0838371333', '300D.08 LÃ´ D Khu 300 Ä‘Æ°á»ng Báº¿n ChÆ°Æ¡ng DÆ°Æ¡ng, P.Cáº§u Kho, Quáº­n 1, Tp.HCM', 'http://www.baotoan.com.vn', '2012-12-10', '3000000', '100', NULL),
(7, 10, 13, 'CÃ´ng ty TNHH  Dart Chocolate', 'D''ART', 'thu.mua@dartchocolate.com', '0907039059', '', '166A Tráº§n HÆ°ng Äáº¡o, Quáº­n 1, TP.HCM', 'http://dartchocolate.com/', '2015-06-09', '', '', NULL),
(8, 10, 14, 'CÃ”NG TY TNHH Náº¾N ZHONG SHENG', 'ZHONG SHENG', 'missmoon2004@163.com', '01646177012', '0837355764', '105D,Ngo Quyen St,Ward 11,5 Dist,Ho Chi Minh City Factory:14,206St,Hoa Phu Ward,Cu Chi Dist,Ho Chi Minh City', 'http://www.zhongshengcandle.com', '2015-10-27', '', '', NULL),
(9, 10, 15, 'XÃ¬-trum shop', 'XÃ¬-trum', 'ntqtuan2003@yahoo.com', '01299333333', '', '262/6 LÃª VÄƒn Sá»¹, PhÆ°á»ng 14, Quáº­n 3, Tp. Há»“ ChÃ­ Minh', '', '2015-11-10', '', '', NULL),
(10, 10, 16, 'CÃ´ng ty TNHH XNK LOHAS VINA', 'LOHASVINA', 'lohasvina@gmail.com', '0935092534', '', 'R2-01 Khu phá»‘ HÆ°ng Gia II, ÄÆ°á»ng BÃ¹i Báº±ng ÄoÃ n, PhÆ°á»ng TÃ¢n Phong, Quáº­n 7, ThÃ nh phá»‘ HCM.', '', '2015-11-03', '', '', NULL),
(11, 10, 17, 'CÃ”NG TY TNHH Má»˜T THÃ€NH VIÃŠN Tá»”NG CÃ”NG TY 28', 'X28', 'thaoltt@agtex.com.vn', '0908151908', '', 'Sá»‘ 03 Nguyá»…n Oanh - F.10 - GÃ² Váº¥p - TP.HCM', 'http://www.belluni.com/', '2015-10-20', '', '', NULL),
(12, 10, 18, 'CÃ”NG TY TNHH TM DV- SX TÃN LIÃŠN', 'TÃN LIÃŠN', 'hoptac@tinlien.com', '0822142972', '', '1018 Nguyá»…n TrÃ£i, P.14, Quáº­n 5, Tp.Há»“ ChÃ­ Minh', 'http://www.tinlien.com/', '2015-10-12', '', '', NULL),
(13, 19, NULL, 'CTY TNHH FARMER COFFEE ', 'FAMMERCO', 'bichnguyen2014@gmail.com', '05783276495', '', '', '', '2015-10-07', '', '', NULL),
(14, 10, 20, 'CÃ´ng ty TNHH  SX - TM TIáº¾N NGA', 'TIáº¾N NGA', 'thanhthuy869@yahoo.com', '0837203122', '', '22/4 ÄÆ°á»ng 32, Khu phá»‘ 7, PhÆ°á»ng Linh ÄÃ´ng , Quáº­n Thá»§ Äá»©c, TP. HCM ', 'http://tiennga.com/index.php?', '2015-10-05', '', '', NULL),
(15, 10, 21, ' CÃ”NG TY TNHH SX TM BÃŒNH THIÃŠN PHÃšC', 'THIá»†N MINH', 'maiyen@sanxuathopgo.com', '0903695877', '', '755 Nguyá»…n Duy Trinh, PhÆ°á»ng PhÃº Há»¯u, Quáº­n 9, TPHCM', '', '2015-11-01', '', '', NULL),
(16, 10, 22, 'CÃ”NG TY TNHH SAIKO       ', 'SAIKO', 'lequangtruong0208@gmail.com', '01229923388', '', '907/9 Tráº§n HÆ°ng Äáº¡o, PhÆ°á»ng 01, Quáº­n 05, TP. Há»“ ChÃ­ Minh', '', '2015-11-01', '', '', NULL),
(17, 10, 23, 'CÃ´ng ty TNHH RI TA VÃ• ', 'RITA VO', 'trang.nguyen@ritavo.com', '0984326569', '', '327 xa lá»™ HÃ  Ná»™i, khu phá»‘ 4, phÆ°á»ng An PhÃº, Quáº­n 2, HCM', '', '2015-11-01', '', '', NULL),
(18, 10, 24, 'DNTN NGUYÃŠN THÃI TRANG', 'NTT', 'lamhoangquynhi93@gmail.com', '0906020493', '', 'Sá»‘ 1 Phan ÄÃ¬nh PhÃ¹ng - PhÆ°á»ng 1 - TP. ÄÃ  Láº¡t - LÃ¢m Äá»“ng', 'http://nguyenthaitrang.com.vn/', '2015-11-01', '', '', NULL),
(19, 10, 25, 'CA CAO NAM TRÆ¯á»œNG SÆ N', 'NTS', 'info@cacaonamtruongson.com.vn', '05003638879', '', '107 Tan Tien - Ea Na Commune - Krong Ana District - Dak Lak Province', 'http://cacaonamtruongson.com.vn/', '2015-11-01', '', '', NULL),
(20, 10, 26, ' CÃ”NG TY TRÃCH NHIá»†M Há»®U Háº N MEDIUSA', 'MEDIUSA', 'thaiphuong@mediusa.vn', '0907344587', '', '154 KhÃ¡nh Há»™i, phÆ°á»ng 06, quáº­n 4', 'http://www.mediusa.vn/', '2015-11-01', '', '', NULL),
(21, 10, 27, 'CÃ”NG TY TNHH MTV MÃ‚Y VÃ€NG', 'Gloden - Cloud', 'ngocpnb@golden-cloud.com', '0909427389', '', 'Láº§u 05, Norch Building, 170-170Bis-172E BÃ¹i Thá»‹ XuÃ¢n, P. Pháº¡m NgÅ© LÃ£o, Q.1, TP.HCM', 'http://www.mayvang.vn/ve-may-vang/335', '2015-11-01', '', '', NULL),
(22, 10, 28, 'CÃ”NG TY Cá»” PHáº¦N LAI PHÃš', 'LAI PHÃš', 'chan.tran438@gmail.com', '0932756671', '', '95 BÃ€U CÃT 3, P.12, Q.TÃ‚N BÃŒNH, TP.HCM', 'http://www.laiphufood.com/', '2015-11-01', '', '', NULL),
(23, 10, 29, 'CÃ”NG TY TNHH TM DV KHANG NAM ', 'KANA', 'cdchieu@kana.vn', '0918606652', '', '30 LÃ´ C, TrÆ°á»ng SÆ¡n, PhÆ°á»ng 15, Quáº­n 10, Tp. Há»“ ChÃ­ Minh', 'http://www.kana.vn/index.php?route=common/home', '2015-11-01', '', '', NULL),
(24, 10, 30, 'CÃ”NG TY TNHH XÆ¯á»žNG CÃ€ PHÃŠ RANG XAY Há»˜I AN', 'Há»˜I AN', 'tam36k15.2@gmail.com', '', '', '135 Tráº§n PhÃº â€“ Há»™i An â€“ Quáº£ng Nam', '', '2015-11-01', '', '', NULL),
(25, 10, 31, 'FONTERRA', 'FONTERRA', 'uyen.phan@fonterra.com', '0906682808', '', 'Láº¦U 9 TÃ’A NHÃ€ BITEXCO', 'http://www.fonterra.com/global/en/About', '2015-11-01', '', '', NULL),
(26, 10, 32, 'CÃ”NG TY TNHH FIVETECH', 'FIVETECH', 'tuanpham.ac@gmail.com', '0933700607', '', '266/24 TÃ´ Hiáº¿n ThÃ nh, PhÆ°á»ng 15, Quáº­n 10, TP. Há»“ ChÃ­ Minh', '', '2015-11-01', '', '', NULL),
(27, 10, 33, 'CÃ´ng ty TNHH ThÆ°Æ¡ng Máº¡i LÃ¡ Phong', 'CHOCOLATE GRAPHICS', 'kenla@chocolategraphics.com.vn', '0933168160', '', '232/6 CÃ´Ì£ng HoÌ€a,PhÆ°á»ng 12,Quáº­n TÃ¢n BÃ¬nh,Tp HCM', 'http://www.chocolategraphics.com.vn/', '2009-07-01', '', '', NULL),
(28, 19, 34, 'CÃ”NG TY TNHH TM & DV Má»¸ TÃN THÃ€NH', 'MYTINTHA', 'hoa740826@gmail.com', '', '', '', '', '2014-10-22', '', '', NULL),
(29, 10, 35, 'CÃ”NG TY TNHH SX-TM-XNK AUVIET COFFEE       ', 'AUVIET', 'vantinphat@gmail.com', '0903356292', '', '459/24 CÃ¡ch Máº¡ng ThÃ¡ng 8, PhÆ°á»ng 8, TP. ÄÃ  Láº¡t', '', '2015-11-01', '', '', NULL),
(30, 10, 36, 'CÃ”NG TY Cá»” PHáº¦N Äáº¦U TÆ¯ ANNI', 'ANNI', 'thao.annicoffee@gmail.com', '0976686796', '', '192/71, Nguyen Oanh st, Ward 17, Go Vap Dist, HCMC', 'http://www.annicoffee.vn/', '2015-11-01', '', '', NULL),
(31, 37, NULL, 'REMINGTON Sroufe Intl'' Company', 'rsil', 'purchasing-rsil@remsroufe-intl.com', '06503559908', '06503577469', 'Lo C-8C-CN, KCN My Phuoc 3, Báº¿n CÃ¡t, BÃŒnh DÆ°Æ¡ng', 'http://www.remsroufe-intl.com', '2011-09-28', '', '', NULL),
(32, 37, 43, 'CÃ”NG TY TNHH SOUL CHOCOLATE', 'SOULCHOC', 'namhoangrmit@gmail.com', '', '', '', '', '2015-10-07', '', '', NULL),
(33, 37, 44, ' CÃ”NG TY TNHH UN-AVAILABLE', 'UNAVAIL', 'chuong.le@un-available.net', '0838832493', '0838832494', '', '', '2015-11-14', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact`
--

CREATE TABLE IF NOT EXISTS `customer_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL COMMENT 'chức vụ',
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `customer_contact`
--

INSERT INTO `customer_contact` (`id`, `customer_id`, `name`, `email`, `phone`, `address`, `birthday`, `position`, `deleted_time`) VALUES
(1, 1, 'Contact 1', 'c1@gmail.com', '0987710227', 'HÃ  ná»™i', '2015-10-13', 'Lead', NULL),
(2, 1, 'Contact 2', 'c2@gmail.com', '0987710227', 'Thanh HoÃ¡ ', '2015-10-14', 'Senior', NULL),
(3, 1, 'Contact 3', 'sales@fammercoffee.com', '0123456789', '', NULL, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facsimile_massage`
--

CREATE TABLE IF NOT EXISTS `facsimile_massage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `facsimile_massage`
--

INSERT INTO `facsimile_massage` (`id`, `name`, `customer_id`, `user_id`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 'Báº£ng BÃ¡o GiÃ¡ 1', 1, 1, '2015-10-31 11:50:31', '2015-10-31 11:51:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `facsimile_massage_product`
--

CREATE TABLE IF NOT EXISTS `facsimile_massage_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `facsimile_massage_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `num_item` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `facsimile_massage_product`
--

INSERT INTO `facsimile_massage_product` (`id`, `facsimile_massage_id`, `product_id`, `num_item`, `price`, `created_time`, `updated_time`, `deleted_time`) VALUES
(5, 1, 2, 4000, 0, '2015-10-31 11:51:19', '2015-10-31 11:51:19', NULL),
(6, 1, 1, 10000, 2559, '2015-10-31 11:51:19', '2015-10-31 11:51:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `original_filename` varchar(255) NOT NULL DEFAULT '',
  `file_path` varchar(255) NOT NULL DEFAULT '',
  `model` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`id`, `name`, `description`, `original_filename`, `file_path`, `model`, `user_id`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 'ÄIá»€U CHá»ˆNH CRM - 3', NULL, 'ÄIá»€U CHá»ˆNH CRM - 3.pdf', 'files/uploads/563f309cd4790_1446981788.pdf', 'Product', 2, '2015-10-31 11:43:10', '2015-11-08 18:23:08', NULL),
(2, 'BCD01-01', NULL, 'BCD01-01.png', 'files/uploads/563960065c1ba_1446600710.png', 'Product', 10, '2015-11-04 08:31:50', '2015-11-04 08:31:50', NULL),
(3, 'BC1M01-01', NULL, 'BC1M01-01.png', 'files/uploads/5639605c2532d_1446600796.png', 'Product', 10, '2015-11-04 08:33:16', '2015-11-04 08:33:16', NULL),
(4, 'file in decal Phuong Dong-01', NULL, 'file in decal Phuong Dong-01.png', 'files/uploads/56397e061e77b_1446608390.png', 'Product', 10, '2015-11-04 10:39:50', '2015-11-04 10:39:50', NULL),
(5, 'DO1G01-01', NULL, 'DO1G01-01.png', 'files/uploads/563af6f65bc1b_1446704886.png', 'Product', 10, '2015-11-04 10:40:42', '2015-11-05 13:28:06', NULL),
(6, 'INCOMFISH-C22101', 'LAYOUT NHáº¢Y CON IN', 'INCOMFISH_-_C22101.jpg', 'files/uploads/563aa4799d783_1446683769.jpg', 'File', 41, '2015-11-05 07:36:09', '2015-11-05 15:39:36', NULL),
(7, 'SOULCHOC - AND291', 'LAYOUT KHUÃ”N', 'AND291.jpg', 'files/uploads/563c65beb30da_1446798782.jpg', 'File', 41, '2015-11-05 10:31:22', '2015-11-06 15:33:02', NULL),
(8, 'SOULCHOC - CND291', 'LAYOUT KHUÃ”N', 'CND291.jpg', 'files/uploads/563c65cf6b926_1446798799.jpg', 'File', 41, '2015-11-05 10:32:24', '2015-11-06 15:33:19', NULL),
(9, 'SOULCHOC - AND901', 'LAYOUT KHUÃ”N', 'AND901.jpg', 'files/uploads/563c65e274a9f_1446798818.jpg', 'File', 41, '2015-11-05 10:34:04', '2015-11-06 15:33:38', NULL),
(10, 'SOULCHOC - CND901', 'LAYOUT KHUÃ”N', 'CND901.jpg', 'files/uploads/563c65f336b4c_1446798835.jpg', 'File', 41, '2015-11-05 10:34:45', '2015-11-06 15:33:55', NULL),
(13, 'SOULCHOC - AND171', 'LAYOUT KHUÃ”N', 'AND171.jpg', 'files/uploads/563c660b4a10e_1446798859.jpg', 'File', 41, '2015-11-05 10:35:48', '2015-11-06 15:34:19', NULL),
(14, 'SOULCHOC - CND171', 'LAYOUT KHUÃ”N', 'CND171.jpg', 'files/uploads/563c661ef40c6_1446798878.jpg', 'File', 41, '2015-11-05 10:36:35', '2015-11-06 15:34:39', NULL),
(15, 'BCD01-01', NULL, 'BCD01-01.png', 'files/uploads/563b01bf0c41a_1446707647.png', 'Product', 10, '2015-11-05 14:13:23', '2015-11-05 14:14:07', NULL),
(17, 'UNAVAIL - CBUVB1', 'LAYOUT KHUÃ”N 1 CON', 'CBUNB1.jpg', 'files/uploads/563b17a9c6984_1446713257.jpg', 'File', 41, '2015-11-05 15:47:37', '2015-11-05 15:47:37', NULL),
(18, 'UNAVAIL - ABUVB1', 'LAYOUT KHUÃ”N 1 CON', 'ABUNB1.jpg', 'files/uploads/563c127f85bc3_1446777471.jpg', 'File', 41, '2015-11-05 15:48:33', '2015-11-06 09:37:52', NULL),
(19, 'ÄIá»€U CHá»ˆNH CRM - 4', NULL, 'ÄIá»€U CHá»ˆNH CRM - 4.pdf', 'files/uploads/563f30cda5437_1446981837.pdf', 'Product', 2, '2015-11-08 18:23:57', '2015-11-08 18:23:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lead`
--

CREATE TABLE IF NOT EXISTS `lead` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
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

INSERT INTO `lead` (`id`, `user_id`, `name`, `code`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 1, 'Lead 001', 'L - 001', 'lead1@gmail.com', '0987710227', '0987710227', '', '', NULL),
(2, 1, 'Tráº§n VÄƒn KhÃ¡nh', 'lead002', 'khanhvan@gmail.com', '1234567890', '1234567890', '44 Tráº§n PhÃº, P4, Q5 - Há»“ ChÃ­ Minh', '', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lead_contact`
--

INSERT INTO `lead_contact` (`id`, `lead_id`, `name`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 1, 'Contact for lead', 'cl@gmail.com', '', '', '', '', NULL),
(2, 2, 'Mobile', '', '5736282033', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_no` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `length` float DEFAULT NULL,
  `width` float DEFAULT NULL,
  `paper_name` tinyint(4) DEFAULT NULL,
  `substance` int(11) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `structure` text,
  `description` varchar(255) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `item_no`, `name`, `length`, `width`, `paper_name`, `substance`, `specification`, `structure`, `description`, `product_unit_id`, `quantity`, `price`, `file_id`, `user_id`, `customer_id`, `created_time`, `updated_time`, `deleted_time`) VALUES
(9, 'P-001', 'product 001', 55, 59, 2, 400, '10x20x30cm', '', NULL, 1, 20000, 3135, NULL, 2, 1, '2015-11-11 14:54:42', '2015-11-11 15:00:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE IF NOT EXISTS `product_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `auto_code` varchar(200) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `delivery_location` varchar(255) DEFAULT NULL,
  `difference_percent` int(11) DEFAULT NULL,
  `special_note` text,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`id`, `auto_code`, `customer_id`, `product_id`, `delivery_date`, `delivery_location`, `difference_percent`, `special_note`, `user_id`, `status`, `created_time`, `updated_time`, `deleted_time`) VALUES
(2, 'WS1511001', 1, 9, '2015-11-04 00:00:00', 'HCM', 3, 'Hang duoc dong goi can than', 2, NULL, '2015-11-11 15:10:32', '2015-11-11 15:10:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_order_progress`
--

CREATE TABLE IF NOT EXISTS `product_order_progress` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_order_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `product_order_progress`
--

INSERT INTO `product_order_progress` (`id`, `product_order_id`, `name`, `vendor_id`, `description`, `order`, `created_time`, `updated_time`, `deleted_time`) VALUES
(4, 2, 'Cáº¯t Giáº¥y Táº¥m', 1, 'test', 1, '2015-11-11 15:10:32', '2015-11-11 15:10:32', NULL),
(5, 2, 'In 8 MÃ u', 2, '', 2, '2015-11-11 15:10:32', '2015-11-11 15:10:32', NULL),
(6, 2, 'CÃ¡n MÃ ng BÃ³ng', NULL, '', 3, '2015-11-11 15:10:32', '2015-11-11 15:10:32', NULL),
(7, 2, 'Báº¿', NULL, '', 4, '2015-11-11 15:10:32', '2015-11-11 15:10:32', NULL),
(8, 2, 'DÃ¡n', NULL, '', 5, '2015-11-11 15:10:32', '2015-11-11 15:10:32', NULL),
(9, 2, 'Bá»“i', NULL, '', 6, '2015-11-11 15:10:32', '2015-11-11 15:10:32', NULL),
(10, 2, 'ÄÃ³ng GÃ³i', NULL, '', 7, '2015-11-11 15:10:32', '2015-11-11 15:10:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_unit`
--

CREATE TABLE IF NOT EXISTS `product_unit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_unit`
--

INSERT INTO `product_unit` (`id`, `name`) VALUES
(1, 'Each'),
(2, 'Piece');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  `buyer_name` varchar(200) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `ship_via` varchar(100) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `customer_id`, `user_id`, `order_no`, `order_date`, `received_date`, `buyer_name`, `term`, `ship_via`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 1, 1, 'C00-KH001-1511001', '2015-11-10 00:00:00', '2015-11-19 00:00:00', 'KHuong', 'term', '2', '2015-11-11 15:09:45', '2015-11-11 15:09:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_product`
--

CREATE TABLE IF NOT EXISTS `purchase_order_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `num_item` int(11) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `purchase_order_product`
--

INSERT INTO `purchase_order_product` (`id`, `product_id`, `purchase_order_id`, `num_item`, `created_time`, `updated_time`, `deleted_time`) VALUES
(5, 9, 1, 20000, '2015-11-11 15:09:45', '2015-11-11 15:09:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_vendor`
--

CREATE TABLE IF NOT EXISTS `purchase_order_vendor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `received_date` datetime DEFAULT NULL,
  `seller_name` varchar(200) DEFAULT NULL,
  `term` varchar(255) DEFAULT NULL,
  `ship_via` varchar(100) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_vendor_product`
--

CREATE TABLE IF NOT EXISTS `purchase_order_vendor_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `purchase_order_vendor_id` int(11) NOT NULL,
  `num_item` int(11) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `mark_up` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `customer_id`, `user_id`, `amount`, `date`, `mark_up`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 10, 2, 100000000, '2015-11-04 00:00:00', 10, '2015-11-02 14:50:34', '2015-11-02 14:50:34', NULL),
(2, 10, 2, 100000000, '2015-10-07 00:00:00', 10, '2015-11-02 14:51:42', '2015-11-02 14:51:42', NULL),
(3, 13, 19, 100000000, '2015-09-09 00:00:00', 10, '2015-11-02 21:14:43', '2015-11-02 21:14:43', NULL),
(4, 16, 10, 100000000, '2015-11-05 00:00:00', 10, '2015-11-05 08:26:45', '2015-11-05 08:27:57', '2015-11-05 08:27:57'),
(5, 27, 10, 4000000, '2015-11-09 00:00:00', 10, '2015-11-05 08:27:37', '2015-11-05 08:27:37', NULL),
(6, 16, 10, 100000000, '2015-11-05 00:00:00', 10, '2015-11-05 08:28:27', '2015-11-05 08:31:29', '2015-11-05 08:31:29'),
(7, 7, 10, 40000000, '2015-11-09 00:00:00', 10, '2015-11-05 08:29:03', '2015-11-05 08:29:03', NULL),
(8, 7, 10, 400000000, '2015-11-05 00:00:00', 10, '2015-11-05 08:29:25', '2015-11-05 08:29:34', '2015-11-05 08:29:34'),
(9, 7, 10, 17000000, '2015-11-05 00:00:00', 10, '2015-11-05 08:29:51', '2015-11-05 08:31:04', '2015-11-05 08:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) DEFAULT NULL,
  `val` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `val`, `name`) VALUES
(1, 'printing_ink_price', '175', 'Printing - Ink Price'),
(2, 'ink_loss_prn_color', '200', ' Ink loss/Prn / Color'),
(3, 'trial_prn', '30', 'Trial Prn'),
(4, 'printing_cost', '150', 'Printing Cost'),
(5, 'time_cost', '3500', 'Time Cost'),
(6, 'time_waste', '45', 'Time Waste'),
(7, 'prn_plate', '180000', 'Prn Plate'),
(8, 'film_cost', '800000', 'Film Cost'),
(9, 'prn_wastg', '1', 'Prn Wastg'),
(10, 'vanish_oil', '600', 'Vanish - Oil'),
(11, 'vanish_uv', '950', 'Vanish - UV'),
(12, 'vanish_opp', '1800', 'Vanish - OPP'),
(13, 'limination', '500', 'Limination'),
(14, 'limination _wastage', '1', 'Limination - Wastage'),
(15, 'die_cut', '1500000', 'Die-Cut'),
(16, 'die_cut_labour', '150', 'Die-Cut - Labour'),
(17, 'die_cut_wastage', '1', 'Die-Cut - Wastage'),
(18, 'gluing_1', '40', 'Gluing 1'),
(19, 'gluing_2', '60', 'Gluing 2'),
(20, 'gluing_3', '80', 'Gluing 3'),
(21, 'sales_tax', '0', 'Sales Tax'),
(22, 'exchange', '21000', 'Exchange'),
(23, 'salary_doanhso_1', '100000000', 'Salary - Doanh Sá»‘ 1'),
(24, 'salary_doanhso_2', '200000000', 'Salary - Doanh Sá»‘ 2'),
(25, 'salary_doanhso_3', '300000000', 'Salary - Doanh Sá»‘ 3'),
(26, 'salary_hoahong_1', '0.03', 'Salary - Hoa Há»“ng 1'),
(27, 'salary_hoahong_2', '0.025', 'Salary - Hoa Há»“ng 2'),
(28, 'salary_hoahong_3', '0.02', 'Salary - Hoa Há»“ng 3'),
(29, 'salary_hoahong_4', '0.015', 'Salary - Hoa Há»“ng 4'),
(30, 'salary_siengnang_1', '500000', 'Salary - Má»©c Äá»™ SiÃªng NÄƒng 1'),
(31, 'salary_siengnang_2', '2000000', 'Salary - Má»©c Äá»™ SiÃªng NÄƒng 2'),
(32, 'salary_siengnang_3', '4000000', 'Salary - Má»©c Äá»™ SiÃªng NÄƒng 3'),
(33, 'entilement_doanhso_1', '10000000', 'Entilement - Doanh Sá»‘ 1'),
(34, 'entilement_doanhso_2', '20000000', 'Entilement - Doanh Sá»‘ 2'),
(35, 'entilement_hoahong_1', '0.05', 'Entilement - Hoa Há»“ng 1'),
(36, 'entilement_hoahong_2', '0.045', 'Entilement - Hoa Há»“ng 2'),
(37, 'entilement_hoahong_3', '0.03', 'Entilement - Hoa Há»“ng 3'),
(38, 'entilement_siengnang_1', '100000', 'Entilement - SiÃªng NÄƒng 1'),
(39, 'entilement_siengnang_2', '600000', 'Entilement - SiÃªng NÄƒng 2');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE IF NOT EXISTS `user_admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(40) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user_admin`
--

INSERT INTO `user_admin` (`id`, `name`, `email`, `username`, `password`, `status`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 'Admin', 'admin', NULL, '7c4a8d09ca3762af61e59520943dc26494f8941b', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `name`, `description`, `created_time`, `deleted_time`, `updated_time`) VALUES
(2, 'Administrator', 'Administrator', NULL, NULL, NULL),
(4, 'Customer', 'Customer', '2015-10-30 06:44:17', NULL, '2015-10-30 07:41:27'),
(5, 'Marketing', 'Marketing', NULL, NULL, '2015-10-30 07:42:46'),
(6, 'Accounting', 'Marketing', '2015-10-30 07:46:22', NULL, '2015-10-30 07:46:22'),
(7, 'Design', 'Design', '2015-10-30 07:46:35', NULL, '2015-10-30 07:46:35');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_access`
--

CREATE TABLE IF NOT EXISTS `user_role_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `user_role_access`
--

INSERT INTO `user_role_access` (`id`, `role_id`, `user_id`, `created_time`, `deleted_time`, `updated_time`) VALUES
(1, 5, 1, '2015-10-31 05:29:32', NULL, '2015-10-31 05:29:32'),
(2, 2, 2, '2015-10-31 11:32:59', NULL, '2015-10-31 11:32:59'),
(3, 4, 3, '2015-10-31 11:37:36', NULL, '2015-10-31 11:37:36'),
(4, 4, 4, '2015-10-31 12:07:14', NULL, '2015-10-31 12:07:14'),
(5, 6, 5, '2015-10-31 12:23:59', NULL, '2015-10-31 12:23:59'),
(6, 4, 6, '2015-11-01 15:02:07', NULL, '2015-11-01 15:02:07'),
(7, 4, 7, '2015-11-01 15:05:41', NULL, '2015-11-01 15:05:41'),
(8, 4, 8, '2015-11-01 15:11:37', NULL, '2015-11-01 15:11:37'),
(9, 4, 9, '2015-11-01 15:17:43', NULL, '2015-11-01 15:17:43'),
(10, 5, 10, '2015-11-02 11:03:40', NULL, '2015-11-02 11:03:40'),
(11, 7, 11, '2015-11-02 11:11:29', NULL, '2015-11-02 11:11:29'),
(12, 2, 12, '2015-11-02 12:50:40', '2015-11-04 22:55:00', '2015-11-02 12:50:40'),
(13, 4, 13, '2015-11-02 13:51:53', NULL, '2015-11-02 13:51:53'),
(14, 4, 14, '2015-11-02 14:03:06', NULL, '2015-11-02 14:03:06'),
(15, 4, 15, '2015-11-02 14:05:23', NULL, '2015-11-02 14:05:23'),
(16, 4, 16, '2015-11-02 14:10:22', NULL, '2015-11-02 14:10:22'),
(17, 4, 17, '2015-11-02 16:27:00', NULL, '2015-11-02 16:27:00'),
(18, 4, 18, '2015-11-02 16:30:03', NULL, '2015-11-02 16:30:03'),
(19, 5, 19, '2015-11-02 20:30:01', '2015-11-04 23:06:21', '2015-11-02 20:30:01'),
(20, 4, 20, '2015-11-03 14:05:10', NULL, '2015-11-03 14:05:10'),
(21, 4, 21, '2015-11-03 14:13:04', NULL, '2015-11-03 14:13:04'),
(22, 4, 22, '2015-11-03 14:15:13', NULL, '2015-11-03 14:15:13'),
(23, 4, 23, '2015-11-03 14:18:24', NULL, '2015-11-03 14:18:24'),
(24, 4, 24, '2015-11-03 14:20:36', NULL, '2015-11-03 14:20:36'),
(25, 4, 25, '2015-11-03 14:23:26', NULL, '2015-11-03 14:23:26'),
(26, 4, 26, '2015-11-03 14:25:16', NULL, '2015-11-03 14:25:16'),
(27, 4, 27, '2015-11-03 14:28:59', NULL, '2015-11-03 14:28:59'),
(28, 4, 28, '2015-11-03 14:31:50', NULL, '2015-11-03 14:31:50'),
(29, 4, 29, '2015-11-03 14:44:44', NULL, '2015-11-03 14:44:44'),
(30, 4, 30, '2015-11-03 14:49:39', NULL, '2015-11-03 14:49:39'),
(31, 4, 31, '2015-11-03 14:51:30', NULL, '2015-11-03 14:51:30'),
(32, 4, 32, '2015-11-03 14:53:38', NULL, '2015-11-03 14:53:38'),
(33, 4, 33, '2015-11-03 14:57:08', NULL, '2015-11-03 14:57:08'),
(34, 4, 34, '2015-11-03 20:57:58', NULL, '2015-11-03 20:57:58'),
(35, 4, 35, '2015-11-04 16:28:47', NULL, '2015-11-04 16:28:47'),
(36, 4, 36, '2015-11-04 16:31:51', NULL, '2015-11-04 16:31:51'),
(37, 6, 12, '2015-11-04 22:55:00', NULL, '2015-11-04 22:55:00'),
(38, 5, 37, '2015-11-04 22:57:31', NULL, '2015-11-04 22:57:31'),
(39, 6, 38, '2015-11-04 23:00:42', NULL, '2015-11-04 23:00:42'),
(40, 7, 39, '2015-11-04 23:01:33', NULL, '2015-11-04 23:01:33'),
(41, 6, 19, '2015-11-04 23:06:21', NULL, '2015-11-04 23:06:21'),
(42, 5, 40, '2015-11-04 23:08:02', NULL, '2015-11-04 23:08:02'),
(43, 7, 41, '2015-11-04 23:13:35', NULL, '2015-11-04 23:13:35'),
(44, 5, 42, '2015-11-04 23:14:28', NULL, '2015-11-04 23:14:28'),
(45, 4, 43, '2015-11-05 07:50:44', NULL, '2015-11-05 07:50:44'),
(46, 4, 44, '2015-11-05 14:37:17', NULL, '2015-11-05 14:37:17');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_right`
--

CREATE TABLE IF NOT EXISTS `user_role_right` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL,
  `plugin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_owner` tinyint(4) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=155 ;

--
-- Dumping data for table `user_role_right`
--

INSERT INTO `user_role_right` (`id`, `role_id`, `plugin`, `controller`, `action`, `is_owner`, `description`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 2, 'User', NULL, NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(2, 2, NULL, 'CalendarController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(3, 2, NULL, 'CostingController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(4, 2, NULL, 'CustomerController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(5, 2, NULL, 'DashboardController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(6, 2, NULL, 'FacsimileMassageController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(7, 2, NULL, 'FileController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(8, 2, NULL, 'LeadController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(9, 2, NULL, 'ProductController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-11-08 17:30:46', '2015-11-08 17:30:46'),
(10, 2, NULL, 'PurchaseOrderController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(11, 2, NULL, 'PurchaseRequestController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(12, 2, NULL, 'SalaryController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(13, 2, NULL, 'SettingsController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(14, 2, NULL, 'VendorController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(15, 2, NULL, 'WorksSheetController', NULL, NULL, NULL, '2015-10-31 05:21:54', '2015-10-31 05:21:54', NULL),
(16, 5, NULL, 'CalendarController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(17, 5, NULL, 'CalendarController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(18, 5, NULL, 'CalendarController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(19, 5, NULL, 'CalendarController', 'feed', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(20, 5, NULL, 'CostingController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(21, 5, NULL, 'CostingController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(22, 5, NULL, 'CostingController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(23, 5, NULL, 'CustomerController', 'view', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(24, 5, NULL, 'CustomerController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(25, 5, NULL, 'CustomerController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(26, 5, NULL, 'CustomerController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(27, 5, NULL, 'DashboardController', NULL, NULL, NULL, '2015-10-31 05:24:14', '2015-10-31 05:24:14', NULL),
(28, 5, NULL, 'FacsimileMassageController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(29, 5, NULL, 'FacsimileMassageController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(30, 5, NULL, 'FacsimileMassageController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(31, 5, NULL, 'FacsimileMassageController', 'report', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(32, 5, NULL, 'FileController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(33, 5, NULL, 'FileController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(34, 5, NULL, 'FileController', 'index', 0, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(35, 5, NULL, 'LeadController', 'view', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(36, 5, NULL, 'LeadController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(37, 5, NULL, 'LeadController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(38, 5, NULL, 'LeadController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(39, 5, NULL, 'ProductController', 'view', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(40, 5, NULL, 'ProductController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(41, 5, NULL, 'ProductController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(42, 5, NULL, 'ProductController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(43, 5, NULL, 'PurchaseOrderController', 'view', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(44, 5, NULL, 'PurchaseOrderController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(45, 5, NULL, 'PurchaseOrderController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(46, 5, NULL, 'PurchaseOrderController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(47, 5, NULL, 'PurchaseRequestController', 'view', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(48, 5, NULL, 'PurchaseRequestController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(49, 5, NULL, 'PurchaseRequestController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(50, 5, NULL, 'PurchaseRequestController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(51, 5, NULL, 'SalaryController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(52, 5, NULL, 'SalaryController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(53, 5, NULL, 'SalaryController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:19', NULL),
(54, 5, NULL, 'VendorController', 'view', 0, NULL, '2015-10-31 05:24:14', '2015-11-02 11:08:04', '2015-11-02 11:08:04'),
(55, 5, NULL, 'VendorController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-02 11:06:40', '2015-11-02 11:06:40'),
(56, 5, NULL, 'VendorController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-02 11:06:40', '2015-11-02 11:06:40'),
(57, 5, NULL, 'VendorController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-02 11:06:40', '2015-11-02 11:06:40'),
(58, 5, NULL, 'WorksSheetController', 'edit', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:20', NULL),
(59, 5, NULL, 'WorksSheetController', 'delete', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:20', NULL),
(60, 5, NULL, 'WorksSheetController', 'index', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:20', NULL),
(61, 5, NULL, 'WorksSheetController', 'report', 1, NULL, '2015-10-31 05:24:14', '2015-11-11 14:56:20', NULL),
(62, 6, NULL, 'CalendarController', 'edit', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(63, 6, NULL, 'CalendarController', 'delete', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(64, 6, NULL, 'CalendarController', 'index', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(65, 6, NULL, 'CalendarController', 'feed', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(66, 6, NULL, 'CostingController', 'edit', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(67, 6, NULL, 'CostingController', 'delete', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(68, 6, NULL, 'CostingController', 'index', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(69, 6, NULL, 'CustomerController', 'view', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(70, 6, NULL, 'CustomerController', 'edit', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(71, 6, NULL, 'CustomerController', 'delete', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(72, 6, NULL, 'CustomerController', 'index', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(73, 6, NULL, 'DashboardController', NULL, NULL, NULL, '2015-10-31 05:26:29', '2015-10-31 05:26:29', NULL),
(74, 6, NULL, 'FacsimileMassageController', 'edit', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(75, 6, NULL, 'FacsimileMassageController', 'delete', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(76, 6, NULL, 'FacsimileMassageController', 'index', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(77, 6, NULL, 'FacsimileMassageController', 'report', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(78, 6, NULL, 'FileController', 'edit', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(79, 6, NULL, 'FileController', 'delete', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(80, 6, NULL, 'FileController', 'index', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(81, 6, NULL, 'ProductController', 'view', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(82, 6, NULL, 'ProductController', 'edit', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(83, 6, NULL, 'ProductController', 'delete', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(84, 6, NULL, 'ProductController', 'index', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(85, 6, NULL, 'PurchaseRequestController', 'view', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(86, 6, NULL, 'PurchaseRequestController', 'edit', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(87, 6, NULL, 'PurchaseRequestController', 'delete', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(88, 6, NULL, 'PurchaseRequestController', 'index', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(89, 6, NULL, 'VendorController', 'view', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(90, 6, NULL, 'VendorController', 'edit', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(91, 6, NULL, 'VendorController', 'delete', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(92, 6, NULL, 'VendorController', 'index', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(93, 6, NULL, 'WorksSheetController', 'edit', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(94, 6, NULL, 'WorksSheetController', 'delete', 1, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(95, 6, NULL, 'WorksSheetController', 'index', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(96, 6, NULL, 'WorksSheetController', 'report', 0, NULL, '2015-10-31 05:26:29', '2015-11-11 14:57:50', NULL),
(97, 7, NULL, 'CalendarController', 'edit', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(98, 7, NULL, 'CalendarController', 'delete', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(99, 7, NULL, 'CalendarController', 'index', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(100, 7, NULL, 'CalendarController', 'feed', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(101, 7, NULL, 'DashboardController', NULL, NULL, NULL, '2015-10-31 05:27:44', '2015-10-31 05:27:44', NULL),
(102, 7, NULL, 'FileController', 'edit', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(103, 7, NULL, 'FileController', 'delete', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(104, 7, NULL, 'FileController', 'index', 0, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(105, 7, NULL, 'ProductController', 'view', 0, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(106, 7, NULL, 'ProductController', 'edit', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(107, 7, NULL, 'ProductController', 'delete', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(108, 7, NULL, 'ProductController', 'index', 0, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(109, 7, NULL, 'SalaryController', 'edit', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(110, 7, NULL, 'SalaryController', 'delete', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(111, 7, NULL, 'SalaryController', 'index', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(112, 7, NULL, 'WorksSheetController', 'edit', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(113, 7, NULL, 'WorksSheetController', 'delete', 1, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(114, 7, NULL, 'WorksSheetController', 'index', 0, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(115, 7, NULL, 'WorksSheetController', 'report', 0, NULL, '2015-10-31 05:27:44', '2015-11-11 14:58:07', NULL),
(116, 4, NULL, 'CalendarController', 'edit', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(117, 4, NULL, 'CalendarController', 'delete', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(118, 4, NULL, 'CalendarController', 'index', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(119, 4, NULL, 'CalendarController', 'feed', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(120, 4, NULL, 'CustomerController', 'view', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(121, 4, NULL, 'CustomerController', 'edit', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(123, 4, NULL, 'CustomerController', 'index', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(124, 4, NULL, 'DashboardController', NULL, NULL, NULL, '2015-10-31 05:28:48', '2015-10-31 05:28:48', NULL),
(125, 4, NULL, 'FileController', 'edit', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(126, 4, NULL, 'FileController', 'delete', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(127, 4, NULL, 'FileController', 'index', 0, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(128, 4, NULL, 'ProductController', 'view', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(131, 4, NULL, 'ProductController', 'index', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(132, 4, NULL, 'PurchaseOrderController', 'view', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(133, 4, NULL, 'PurchaseOrderController', 'index', 1, NULL, '2015-10-31 05:28:48', '2015-11-11 14:56:28', NULL),
(134, 5, NULL, 'CostingController', 'export', 1, NULL, '2015-10-31 11:48:18', '2015-11-11 14:56:19', NULL),
(135, 5, NULL, 'CostingController', 'view', 1, NULL, '2015-11-04 22:48:03', '2015-11-11 14:56:19', NULL),
(136, 6, NULL, 'CostingController', 'export', 0, NULL, '2015-11-04 22:48:19', '2015-11-11 14:57:50', NULL),
(137, 6, NULL, 'CostingController', 'view', 0, NULL, '2015-11-04 22:48:19', '2015-11-11 14:57:50', NULL),
(138, 2, NULL, 'ProductController', 'index', 1, NULL, '2015-11-08 17:30:46', '2015-11-08 17:31:14', '2015-11-08 17:31:14'),
(139, 2, NULL, 'ProductController', NULL, NULL, NULL, '2015-11-08 17:31:14', '2015-11-08 17:31:14', NULL),
(140, 5, NULL, 'VendorController', 'edit', 1, NULL, '2015-11-11 14:56:19', '2015-11-11 14:56:19', NULL),
(141, 5, NULL, 'VendorController', 'delete', 1, NULL, '2015-11-11 14:56:19', '2015-11-11 14:56:19', NULL),
(142, 5, NULL, 'VendorController', 'index', 1, NULL, '2015-11-11 14:56:19', '2015-11-11 14:56:19', NULL),
(143, 5, NULL, 'VendorController', 'view', 1, NULL, '2015-11-11 14:56:20', '2015-11-11 14:56:20', NULL),
(144, 6, NULL, 'LeadController', 'edit', 1, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(145, 6, NULL, 'LeadController', 'delete', 1, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(146, 6, NULL, 'LeadController', 'index', 1, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(147, 6, NULL, 'LeadController', 'view', 1, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(148, 6, NULL, 'PurchaseOrderController', 'edit', 1, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(149, 6, NULL, 'PurchaseOrderController', 'delete', 1, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(150, 6, NULL, 'PurchaseOrderController', 'index', 0, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(151, 6, NULL, 'PurchaseOrderController', 'view', 0, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(152, 6, NULL, 'SalaryController', 'edit', 1, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(153, 6, NULL, 'SalaryController', 'delete', 1, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL),
(154, 6, NULL, 'SalaryController', 'index', 1, NULL, '2015-11-11 14:57:50', '2015-11-11 14:57:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
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

INSERT INTO `vendor` (`id`, `user_id`, `name`, `code`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 1, 'Vendor 001', 'V-001', 'vendor1@gmail.com', '0987710227', '0987710227', 'Äá»‹nh QuÃ¡n, Äá»“ng Nai', '', NULL),
(2, 2, 'LÃª Thá»‹ Hoa', 'vendor005', 'hoantan@gmail.com', '0934534541', '0934534541', '90 Phan ÄÃ¬nh PhÃ¹ng , P2, Q3', '', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vendor_contact`
--

INSERT INTO `vendor_contact` (`id`, `vendor_id`, `name`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`) VALUES
(1, 1, 'Contact 1', '', '', '', '', '', NULL),
(2, 2, 'ThÆ° KÃ½', '', '00389472934', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wp_users`
--

CREATE TABLE IF NOT EXISTS `wp_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `display_name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`user_login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `wp_users`
--

INSERT INTO `wp_users` (`id`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `firstname`, `lastname`, `display_name`, `created_time`, `updated_time`, `deleted_time`) VALUES
(1, 'marketing', '$P$Boj4ZRANYjdBO1G0D9cG2FU35YQ3u7/', '', 'marketing@baobigiay.vn', '', '0000-00-00 00:00:00', '', 0, 'Test', '1', 'Test 1', '2015-10-31 05:29:32', '2015-10-31 05:29:32', NULL),
(2, 'ADMIN', '$P$BQBpUvGaRQkUVZ0hNzFkTUgMMbfYcf.', '', 'sonadmin@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'LÃŠ Há»’NG', 'SÆ N ADMIN', 'LÃŠ Há»’NG SÆ N ADMIN', '2015-10-31 11:32:59', '2015-11-04 23:03:27', NULL),
(3, 'Customer 1', '$P$BSVFhKmzvjrPGY7egbH7xUjadgms7j.', '', 'customer1@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'Customer 1', 'Customer 1', 'Customer 1', '2015-10-31 11:37:36', '2015-10-31 11:37:36', NULL),
(4, 'Phan VÄƒn Minh', '$P$BDXLkASiw6hOjIlW3S3cgLRPNRQ3t70', '', 'phanhongphuc@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'Phan VÄƒn Minh', 'Phan VÄƒn Minh', 'Phan VÄƒn Minh', '2015-10-31 12:07:14', '2015-10-31 12:07:14', NULL),
(5, '1234567890', '$P$BXuifCQFWBE5rIiGjXYmQla7/cBhn.1', '', 'phanhongphuc12345@yahoo.com', '', '0000-00-00 00:00:00', '', 0, 'Pháº¡m', 'Trung', 'Pháº¡m Trung', '2015-10-31 12:23:59', '2015-10-31 12:30:49', NULL),
(6, 'Tá»”NG CÃ”NG TY Cá»” PHáº¦N Y Táº¾ DANAMECO', '$P$B2rss7IEqXhFv0aduU3t425PwR1N70.', '', 'hanhnt2@danameco.com', '', '0000-00-00 00:00:00', '', 0, 'Tá»”NG CÃ”NG TY Cá»” PHáº¦N Y Táº¾ DANAMECO', 'Tá»”NG CÃ”NG TY Cá»” PHáº¦N Y Táº¾ DANAMECO', 'Tá»”NG CÃ”NG TY Cá»” PHáº¦N Y Táº¾ DANAMECO', '2015-11-01 15:02:07', '2015-11-01 15:02:07', NULL),
(7, 'REMINGTON Sroufe Intl'' Company', '$P$BJGa8Dc4IN8WEr2x7S96vrUaEqMFn71', '', 'purchasing-rsil@remsroufe-intl.com', '', '0000-00-00 00:00:00', '', 0, 'REMINGTON Sroufe Intl'' Company', 'REMINGTON Sroufe Intl'' Company', 'REMINGTON Sroufe Intl'' Company', '2015-11-01 15:05:41', '2015-11-01 15:05:41', NULL),
(8, 'CÃ”NG TY CP DÆ¯á»¢C - TRANG THIáº¾T Bá»Š Y Táº¾ BÃŒNH Äá»ŠN', '$P$BMtht3Wr1UShYeG3daAgK7aGXC3kUg.', '', 'hoa@bidiphar.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY CP DÆ¯á»¢C - TRANG THIáº¾T Bá»Š Y Táº¾ BÃŒNH Äá»ŠNH', 'CÃ”NG TY CP DÆ¯á»¢C - TRANG THIáº¾T Bá»Š Y Táº¾ BÃŒNH Äá»ŠNH', 'CÃ”NG TY CP DÆ¯á»¢C - TRANG THIáº¾T Bá»Š Y Táº¾ BÃŒNH Äá»ŠNH', '2015-11-01 15:11:37', '2015-11-01 15:11:37', NULL),
(9, 'CÃ”NG TY CP TM VÃ€ DV THIáº¾T Bá»Š GIÃM SÃT Báº¢O TOÃ€N', '$P$BQd6wYYSAi8iSEOciV6kQK/zcrU6nx0', '', 'baotoan@baotoan.com.vn', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY CP TM VÃ€ DV THIáº¾T Bá»Š GIÃM SÃT Báº¢O TOÃ€N', 'CÃ”NG TY CP TM VÃ€ DV THIáº¾T Bá»Š GIÃM SÃT Báº¢O TOÃ€N', 'CÃ”NG TY CP TM VÃ€ DV THIáº¾T Bá»Š GIÃM SÃT Báº¢O TOÃ€N', '2015-11-01 15:17:43', '2015-11-01 15:17:43', NULL),
(10, 'duyennguyen', '$P$BkIOTmiflfWFBzMqNJ0ji52311xeyC1', '', 'duyennguyen@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'NGUYá»„N THá»Š Má»¸', 'DUYÃŠN', 'NGUYá»„N THá»Š DUYÃŠN', '2015-11-02 11:03:40', '2015-11-02 11:03:40', NULL),
(11, 'khoa', '$P$BX9Mwk/0EaQzjCYtt0Ef.9Ww1vhHr..', '', 'khoa@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'Pháº¡m Anh', 'Khoa', 'Pháº¡m Anh Khoa', '2015-11-02 11:11:29', '2015-11-02 11:11:29', NULL),
(12, 'TRIEM', '$P$BI0CCYEDCR5EBMrWwx6A74AjhPvlsm.', '', 'account@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'NGUYá»„N THá»Š', 'TRIá»€M', 'NGUYá»„N THá»Š TRIá»€M', '2015-11-02 12:50:40', '2015-11-04 22:55:00', NULL),
(13, 'CÃ´ng ty TNHH  Dart Chocolate', '$P$B2tWB3F/IdjGaQrWuJs9iDJvBJgT8Y.', '', 'thu.mua@dartchocolate.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ´ng ty TNHH  Dart Chocolate', 'CÃ´ng ty TNHH  Dart Chocolate', 'CÃ´ng ty TNHH  Dart Chocolate', '2015-11-02 13:51:53', '2015-11-02 13:51:53', NULL),
(14, 'CÃ”NG TY TNHH Náº¾N ZHONG SHENG', '$P$BAUN5n3VEk3P1kVI2tSz2pEc7WwYHV/', '', 'missmoon2004@163.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH Náº¾N ZHONG SHENG', 'CÃ”NG TY TNHH Náº¾N ZHONG SHENG', 'CÃ”NG TY TNHH Náº¾N ZHONG SHENG', '2015-11-02 14:03:06', '2015-11-02 14:03:06', NULL),
(15, 'XÃ¬-trum shop', '$P$BnzImur0oqLJJSknftZweucMiRSsig/', '', 'ntqtuan2003@yahoo.com', '', '0000-00-00 00:00:00', '', 0, 'XÃ¬-trum shop', 'XÃ¬-trum shop', 'XÃ¬-trum shop', '2015-11-02 14:05:23', '2015-11-02 14:05:23', NULL),
(16, 'CÃ´ng ty TNHH XNK LOHAS VINA', '$P$B5.Czkz.YV/pftxfKQQb5KSbXS2J11/', '', 'lohasvina@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ´ng ty TNHH XNK LOHAS VINA', 'CÃ´ng ty TNHH XNK LOHAS VINA', 'CÃ´ng ty TNHH XNK LOHAS VINA', '2015-11-02 14:10:22', '2015-11-02 14:10:22', NULL),
(17, 'CÃ”NG TY TNHH Má»˜T THÃ€NH VIÃŠN Tá»”NG CÃ”NG TY 28', '$P$B7qpeTfSHb2lHeyagsVOCNU9RXenaN/', '', 'thaoltt@agtex.com.vn', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH Má»˜T THÃ€NH VIÃŠN Tá»”NG CÃ”NG TY 28', 'CÃ”NG TY TNHH Má»˜T THÃ€NH VIÃŠN Tá»”NG CÃ”NG TY 28', 'CÃ”NG TY TNHH Má»˜T THÃ€NH VIÃŠN Tá»”NG CÃ”NG TY 28', '2015-11-02 16:27:00', '2015-11-02 16:27:00', NULL),
(18, 'CÃ”NG TY TNHH TM DV- SX TÃN LIÃŠN', '$P$BLShHGMxLac.why.rYHL0yCB5r.snr1', '', 'hoptac@tinlien.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH TM DV- SX TÃN LIÃŠN', 'CÃ”NG TY TNHH TM DV- SX TÃN LIÃŠN', 'CÃ”NG TY TNHH TM DV- SX TÃN LIÃŠN', '2015-11-02 16:30:03', '2015-11-02 16:30:03', NULL),
(19, 'Account', '$P$BNZsA7b8f9P3wAZmI7NVE7I7wy.Uds0', '', 'bichaccount@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'NGUYá»„N THá»Š', 'BÃCH ACCOUNT', 'NGUYá»„N THá»Š BÃCH ACCOUNT', '2015-11-02 20:30:01', '2015-11-04 23:06:21', NULL),
(20, 'CÃ´ng ty TNHH  SX - TM TIáº¾N NGA', '$P$Bq0ZhtwbDPWKAuW3CfmM0hSaW.XPim/', '', 'thanhthuy869@yahoo.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ´ng ty TNHH  SX - TM TIáº¾N NGA', 'CÃ´ng ty TNHH  SX - TM TIáº¾N NGA', 'CÃ´ng ty TNHH  SX - TM TIáº¾N NGA', '2015-11-03 14:05:10', '2015-11-03 14:05:10', NULL),
(21, ' CÃ”NG TY TNHH SX TM BÃŒNH THIÃŠN PHÃšC', '$P$BjwbEqB.krF8tiSE4fG6EtOolWc5hH/', '', 'maiyen@sanxuathopgo.com', '', '0000-00-00 00:00:00', '', 0, ' CÃ”NG TY TNHH SX TM BÃŒNH THIÃŠN PHÃšC', ' CÃ”NG TY TNHH SX TM BÃŒNH THIÃŠN PHÃšC', ' CÃ”NG TY TNHH SX TM BÃŒNH THIÃŠN PHÃšC', '2015-11-03 14:13:03', '2015-11-03 14:13:03', NULL),
(22, 'CÃ”NG TY TNHH SAIKO       ', '$P$Bfhdm/Kdk5ToZViRxgWqPmJS8EPwfB0', '', 'lequangtruong0208@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH SAIKO       ', 'CÃ”NG TY TNHH SAIKO       ', 'CÃ”NG TY TNHH SAIKO       ', '2015-11-03 14:15:13', '2015-11-03 14:15:13', NULL),
(23, 'CÃ´ng ty TNHH RI TA VÃ• ', '$P$BR7qgz0I2nE0.pVSGu/m.6qY8HCyvE/', '', 'trang.nguyen@ritavo.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ´ng ty TNHH RI TA VÃ• ', 'CÃ´ng ty TNHH RI TA VÃ• ', 'CÃ´ng ty TNHH RI TA VÃ• ', '2015-11-03 14:18:24', '2015-11-03 14:18:24', NULL),
(24, 'DNTN NGUYÃŠN THÃI TRANG', '$P$BUU0etWbnGH1.2oAxJSUYl8KZ3iACd0', '', 'lamhoangquynhi93@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'DNTN NGUYÃŠN THÃI TRANG', 'DNTN NGUYÃŠN THÃI TRANG', 'DNTN NGUYÃŠN THÃI TRANG', '2015-11-03 14:20:36', '2015-11-03 14:20:36', NULL),
(25, 'CA CAO NAM TRÆ¯á»œNG SÆ N', '$P$BXj63GVEQyIMIf/1A3b8x5b351WmyW/', '', 'info@cacaonamtruongson.com.vn', '', '0000-00-00 00:00:00', '', 0, 'CA CAO NAM TRÆ¯á»œNG SÆ N', 'CA CAO NAM TRÆ¯á»œNG SÆ N', 'CA CAO NAM TRÆ¯á»œNG SÆ N', '2015-11-03 14:23:26', '2015-11-03 14:23:26', NULL),
(26, ' CÃ”NG TY TRÃCH NHIá»†M Há»®U Háº N MEDIUSA', '$P$BF.sjmwdZlB6GgeX3xZE54C3bEEhRa.', '', 'thaiphuong@mediusa.vn', '', '0000-00-00 00:00:00', '', 0, ' CÃ”NG TY TRÃCH NHIá»†M Há»®U Háº N MEDIUSA', ' CÃ”NG TY TRÃCH NHIá»†M Há»®U Háº N MEDIUSA', ' CÃ”NG TY TRÃCH NHIá»†M Há»®U Háº N MEDIUSA', '2015-11-03 14:25:16', '2015-11-03 14:25:16', NULL),
(27, 'CÃ”NG TY TNHH MTV MÃ‚Y VÃ€NG', '$P$BR6/DZw4UcysEXNgGbM7vNRppTC1rH/', '', 'ngocpnb@golden-cloud.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH MTV MÃ‚Y VÃ€NG', 'CÃ”NG TY TNHH MTV MÃ‚Y VÃ€NG', 'CÃ”NG TY TNHH MTV MÃ‚Y VÃ€NG', '2015-11-03 14:28:59', '2015-11-03 14:28:59', NULL),
(28, 'CÃ”NG TY Cá»” PHáº¦N LAI PHÃš', '$P$BiTn1KBSRq0261BrT.1IP4q26KAeBi/', '', 'chan.tran438@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY Cá»” PHáº¦N LAI PHÃš', 'CÃ”NG TY Cá»” PHáº¦N LAI PHÃš', 'CÃ”NG TY Cá»” PHáº¦N LAI PHÃš', '2015-11-03 14:31:50', '2015-11-03 14:31:50', NULL),
(29, 'CÃ”NG TY TNHH TM DV KHANG NAM ', '$P$BewRWjH0j63wz/ClgjJHvN/QADIBRI0', '', 'cdchieu@kana.vn', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH TM DV KHANG NAM ', 'CÃ”NG TY TNHH TM DV KHANG NAM ', 'CÃ”NG TY TNHH TM DV KHANG NAM ', '2015-11-03 14:44:43', '2015-11-03 14:44:43', NULL),
(30, 'CÃ”NG TY TNHH XÆ¯á»žNG CÃ€ PHÃŠ RANG XAY Há»˜I AN', '$P$BZxmnsPGoKJOjmoGvdN8WCQmXpzQed.', '', 'tam36k15.2@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH XÆ¯á»žNG CÃ€ PHÃŠ RANG XAY Há»˜I AN', 'CÃ”NG TY TNHH XÆ¯á»žNG CÃ€ PHÃŠ RANG XAY Há»˜I AN', 'CÃ”NG TY TNHH XÆ¯á»žNG CÃ€ PHÃŠ RANG XAY Há»˜I AN', '2015-11-03 14:49:39', '2015-11-03 14:49:39', NULL),
(31, 'FONTERRA', '$P$BaLrvNvT3d0OfLEw5bbzFU5gebS7is.', '', 'uyen.phan@fonterra.com', '', '0000-00-00 00:00:00', '', 0, 'FONTERRA', 'FONTERRA', 'FONTERRA', '2015-11-03 14:51:30', '2015-11-03 14:51:30', NULL),
(32, 'CÃ”NG TY TNHH FIVETECH', '$P$BXz7kc7Mj1js/PdnjI4P4ucXCQogF01', '', 'tuanpham.ac@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH FIVETECH', 'CÃ”NG TY TNHH FIVETECH', 'CÃ”NG TY TNHH FIVETECH', '2015-11-03 14:53:38', '2015-11-03 14:53:38', NULL),
(33, 'CÃ´ng ty TNHH ThÆ°Æ¡ng Máº¡i LÃ¡ Phong', '$P$BAGnBQaWB0ukf9BiZG11cwLqrGgioO.', '', 'kenla@chocolategraphics.com.vn', '', '0000-00-00 00:00:00', '', 0, 'CÃ´ng ty TNHH ThÆ°Æ¡ng Máº¡i LÃ¡ Phong', 'CÃ´ng ty TNHH ThÆ°Æ¡ng Máº¡i LÃ¡ Phong', 'CÃ´ng ty TNHH ThÆ°Æ¡ng Máº¡i LÃ¡ Phong', '2015-11-03 14:57:08', '2015-11-03 14:57:08', NULL),
(34, 'CÃ”NG TY TNHH TM & DV Má»¸ TÃN THÃ€NH', '$P$B/8VM.Jnwhn/ZDO3BZ/2FcsaRoT0lU/', '', 'hoa740826@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH TM & DV Má»¸ TÃN THÃ€NH', 'CÃ”NG TY TNHH TM & DV Má»¸ TÃN THÃ€NH', 'CÃ”NG TY TNHH TM & DV Má»¸ TÃN THÃ€NH', '2015-11-03 20:57:58', '2015-11-03 20:57:58', NULL),
(35, 'CÃ”NG TY TNHH SX-TM-XNK AUVIET COFFEE       ', '$P$BfYIqi8plTQpRNf9B5J.vLZHcelc0F/', '', 'vantinphat@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH SX-TM-XNK AUVIET COFFEE       ', 'CÃ”NG TY TNHH SX-TM-XNK AUVIET COFFEE       ', 'CÃ”NG TY TNHH SX-TM-XNK AUVIET COFFEE       ', '2015-11-04 16:28:47', '2015-11-04 16:28:47', NULL),
(36, 'CÃ”NG TY Cá»” PHáº¦N Äáº¦U TÆ¯ ANNI', '$P$BpCzqjhAgPjo/.6I19F5PEx2A9u6V50', '', 'thao.annicoffee@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY Cá»” PHáº¦N Äáº¦U TÆ¯ ANNI', 'CÃ”NG TY Cá»” PHáº¦N Äáº¦U TÆ¯ ANNI', 'CÃ”NG TY Cá»” PHáº¦N Äáº¦U TÆ¯ ANNI', '2015-11-04 16:31:51', '2015-11-04 16:31:51', NULL),
(37, 'Pháº§n nÃ y khÃ´ng cáº§n nÃªn bá» Ä‘i', '$P$B8rlgv2kUgHg1vuQAI6yImyW477P0s1', '', 'sonmarketing@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'LÃŠ Há»’NG ', 'SÆ N MARKETING', 'LÃŠ Há»’NG  SÆ N MARKETING', '2015-11-04 22:57:31', '2015-11-04 23:11:47', NULL),
(38, 'Pháº§n nÃ y dÆ°', '$P$BCgigwxUDp21ErFJZUZZHXxvF33W5g1', '', 'sonaccount@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'LÃŠ Há»’NG', 'SÆ N ACCOUNT', 'LÃŠ Há»’NG SÆ N ACCOUNT', '2015-11-04 23:00:42', '2015-11-04 23:00:42', NULL),
(39, 'dÆ° bá»', '$P$B.HZX2WBiv14k2gH7tWamto1s2cBpO/', '', 'sondesign@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'LÃŠ Há»’NG', 'SÆ N DESIGN', 'LÃŠ Há»’NG SÆ N DESIGN', '2015-11-04 23:01:33', '2015-11-04 23:01:33', NULL),
(40, 'BICHmarketing', '$P$B0lXiilKhzkwRHVNrKErCepYxaU.N/1', '', 'bichmarketing@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'NGUYá»„N THá»Š', 'BÃCH MARKETING', 'NGUYá»„N THá»Š BÃCH MARKETING', '2015-11-04 23:08:02', '2015-11-04 23:08:02', NULL),
(41, 'XuyÃªn Design', '$P$BZhbTNj1.rRKkHLLWplFb3A1zmB5bU0', '', 'xuyendesign@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'ÄOÃ€N THá»Š Cáº¨M ', 'XUYÃŠN DESIGN', 'ÄOÃ€N THá»Š Cáº¨M  XUYÃŠN DESIGN', '2015-11-04 23:13:35', '2015-11-04 23:13:35', NULL),
(42, 'xuyen marketing', '$P$BHS8ggxLr56hbDac.nReU3140Fltkh0', '', 'xuyenmarketing@hopcaocap.vn', '', '0000-00-00 00:00:00', '', 0, 'ÄOÃ€N THá»Š Cáº¨M', 'XUYÃŠN MARKETING', 'ÄOÃ€N THá»Š Cáº¨M XUYÃŠN MARKETING', '2015-11-04 23:14:28', '2015-11-05 07:16:14', '2015-11-05 07:16:14'),
(43, 'CÃ”NG TY TNHH SOUL CHOCOLATE', '$P$BXodByjpifLXuqgPK3lrYhT9Eg7Iav.', '', 'namhoangrmit@gmail.com', '', '0000-00-00 00:00:00', '', 0, 'CÃ”NG TY TNHH SOUL CHOCOLATE', 'CÃ”NG TY TNHH SOUL CHOCOLATE', 'CÃ”NG TY TNHH SOUL CHOCOLATE', '2015-11-05 07:50:44', '2015-11-05 07:50:44', NULL),
(44, ' CÃ”NG TY TNHH UN-AVAILABLE', '$P$BNTnjwvS506X/u5iu5a0M4XOTSjPw51', '', 'chuong.le@un-available.net', '', '0000-00-00 00:00:00', '', 0, ' CÃ”NG TY TNHH UN-AVAILABLE', ' CÃ”NG TY TNHH UN-AVAILABLE', ' CÃ”NG TY TNHH UN-AVAILABLE', '2015-11-05 14:37:17', '2015-11-05 14:37:17', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_role_access`
--
ALTER TABLE `user_role_access`
  ADD CONSTRAINT `user_role_access_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`);

--
-- Constraints for table `user_role_right`
--
ALTER TABLE `user_role_right`
  ADD CONSTRAINT `user_role_right_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
