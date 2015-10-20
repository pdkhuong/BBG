# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.20)
# Database: baobigiay
# Generation Time: 2015-10-18 08:09:16 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table costing
# ------------------------------------------------------------

DROP TABLE IF EXISTS `costing`;

CREATE TABLE `costing` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `costing_date` datetime DEFAULT NULL,
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
  `printing_firms` float DEFAULT NULL,
  `vanish_oil` float DEFAULT NULL,
  `vanish_uv` float DEFAULT NULL,
  `vanish_opp` float DEFAULT NULL,
  `ply` float DEFAULT NULL,
  `limination` float DEFAULT NULL,
  `die_cut` float DEFAULT NULL,
  `gluing_40` float DEFAULT NULL,
  `gluing_60` float DEFAULT NULL,
  `gluing_80` float DEFAULT NULL,
  `packaging` float DEFAULT NULL,
  `transportation` float DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `mk` float DEFAULT NULL,
  `inner_surf_substance` float DEFAULT NULL,
  `inner_surf_price` float DEFAULT NULL,
  `b_flute_substance` float DEFAULT NULL,
  `b_flute_price` float DEFAULT NULL,
  `e_flute_substance` float DEFAULT NULL,
  `e_flute_price` float DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;

INSERT INTO `customer` (`id`, `name`, `code`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`)
VALUES
	(1,'Phan Há»“ng PhÃºc','CKPGFQIHHHHHFNQH','phanhongphuc@gmail.com','01227744772','0123456789','201 Hai BÃ  TrÆ°ng , PhÆ°á»ng 5 , quáº­n 3, TpHCM','KhÃ¡ch hÃ ng má»›i','2015-10-09 16:55:34'),
	(9,'ÄoÃ n Thá»‹ Cáº©m Xin','FEKAJGYGSRUWLSNI','DoanThiCamXin@hotmail.com','0902212230','0826482063','285/C145 CÃ¡ch Máº¡ng ThÃ¡ng 8 - Tp Há»“ ChÃ­ Minh','Chá»‹ sinh ngÃ y 2 thÃ¡ng 10 nÄƒm 1971 vÃ  Chá»‹ lÃ  Chá»‹ cáº£ trong gia Ä‘Ã¬nh cá»§a 2 Chá»‹ em. \r\nChá»‹ Ä‘Ã£ tham gia sinh hoáº¡t vÄƒn nghá»‡ tá»« CLB ca sÄ© tráº», Trung tÃ¢m vÄƒn hoÃ¡ quáº­n 10 nÄƒm 1991',NULL),
	(10,'Äáº·ng Thá»‹ Thanh Lanh','TLWJCKIPPMMZCRKU','ThanhLanh@yahoo.com','0908960568','0805688960','126/8 CÃ¡ch Máº¡ng ThÃ¡ng TÃ¡m, PhÆ°á»ng 7, Quáº­n 3 - Tp Há»“ ChÃ­ Minh','Lanh sinh ra táº¡i Huáº¿, trong gia Ä‘Ã¬nh gá»“m 6 anh em vÃ  má»™t ngÆ°á»i chá»‹ nuÃ´i, Lanh lÃ  con thá»© 3 trong gia Ä‘Ã¬nh. ',NULL),
	(11,'Trá»‹nh Thanh Äá»','WTLZMFGDGLTLGBAU','TrinhThanhe@gmail.com','09339095507','08355073909','319/2A Hai BÃ  TrÆ°ng, PhÆ°á»ng 8, Quáº­n 3 - Tp Há»“ ChÃ­ Minh','Äá» sinh ngÃ y 2 thÃ¡ng 4 nÄƒm 1981 táº¡i HÃ  Ná»™i, lÃ  ca sÄ© dÃ²ng nháº¡c nháº¹ cá»§a Viá»‡t Nam',NULL),
	(12,'VÆ°Æ¡ng Háº£i ChÃ­','XKEGEBXOUSAJRQOR','VuongHaiChi@gmail.com','0969765226','0832269765','194 HoÃ ng VÄƒn Thá»¥, PhÆ°á»ng 9, Quáº­n PhÃº Nhuáº­n - Há»“ ChÃ­ Minh','Sinh ra vÃ  lá»›n lÃªn táº¡i HÃ  Ná»™i, nay láº­p nghiá»‡p á»Ÿ SÃ i GÃ²n, vá»›i VÆ°Æ¡ng Háº£i ChÃ­, HÃ  Ná»™i mÃ£i mÃ£i váº«n Ä‘áº¹p, nÃªn thÆ¡ vÃ  cá»• kÃ­nh. ',NULL);

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table file
# ------------------------------------------------------------

DROP TABLE IF EXISTS `file`;

CREATE TABLE `file` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `original_filename` varchar(255) NOT NULL DEFAULT '',
  `file_path` varchar(255) NOT NULL DEFAULT '',
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;

INSERT INTO `file` (`id`, `name`, `description`, `original_filename`, `file_path`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(1,'test name 222222','test des 2222','AppBody-Sample-English.docx','files/uploads/562345dcdfb0a_1445152220.docx',NULL,'2015-10-18 09:10:20',NULL),
	(2,'AppBody-Sample-English',NULL,'AppBody-Sample-English.docx','files/uploads/5623416c3650f_1445151084.docx',NULL,NULL,NULL),
	(3,'test name','test des','AppBody-Sample-English.docx','files/uploads/562345b2c9aee_1445152178.docx','2015-10-18 09:09:38','2015-10-18 09:10:09','2015-10-18 09:10:09');

/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lead
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lead`;

CREATE TABLE `lead` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `lead` WRITE;
/*!40000 ALTER TABLE `lead` DISABLE KEYS */;

INSERT INTO `lead` (`id`, `name`, `code`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`)
VALUES
	(1,'Triá»‡u Trá»ng Sau','LDNCTPOOLRMTYBYJ','TrieuTrongSau@gmail.com','0984672618','0836184672','16 ÄÆ°á»ng 3 thÃ¡ng 2 , PhÆ°á»ng 1 , ÄÃ  Láº¡t - LÃ¢m Äá»“ng','Triá»‡u Trá»ng Sau lÃ  cá»±u thÃ nh viÃªn nhÃ³m MP5, cÅ©ng lÃ  ngÆ°á»i láº­p ra nhÃ³m nháº¡c nÃ y. Sau Ä‘Ã³ cÃ¡c thÃ¡nh viÃªn trong nhÃ³m tÃ¡ch ra solo, Triá»‡u Trá»ng Sau solo tá»« Ä‘áº§u nÄƒm 2009. ',NULL),
	(2,'Láº¡c Thá»‹ XuÃ¢n UyÃªn','AGBYSNHNGXUYPGQF','LacThiXuanUyen@hotmail.com','0912010916','0830916201','44 Tráº§n PhÃº, P4, Q5 - Há»“ ChÃ­ Minh','Láº¡c Thá»‹ XuÃ¢n UyÃªn sinh ngÃ y 1/9/1984, cÃ²n cÃ³ biá»‡t danh lÃ  A MÃ­, lÃ  con thá»© 4 trong má»™t gia Ä‘Ã¬nh cÃ³ 5 chá»‹ em gÃ¡i, táº¡i quáº­n 5, má»™t khu dÃ¢n cÆ° Ä‘Æ°á»£c má»‡nh danh lÃ  \"phá»‘ ngÆ°á»i Hoa\" cá»§a ThÃ nh phá»‘ Há»“ ChÃ­ Minh. ',NULL);

/*!40000 ALTER TABLE `lead` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `item_no` varchar(100) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `product_unit_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`id`, `item_no`, `name`, `specification`, `description`, `product_unit_id`, `price`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(1,'Item001','test item name',NULL,'des',1,1212.12,'2015-10-13 10:12:05','2015-10-18 10:05:35','2015-10-18 10:05:35'),
	(2,'Item002','product 2',NULL,'',2,232,'2015-10-13 10:42:19','2015-10-13 10:44:37',NULL),
	(3,'p002','product 2','22,5 x 8,5 x 13 cm','',2,212,'2015-10-15 10:28:24','2015-10-17 11:08:47',NULL),
	(4,'p003','product 3','57 x 65   Cm','',2,332,'2015-10-15 10:28:38','2015-10-17 11:40:26',NULL),
	(5,'p005','product 4',NULL,'',1,66,'2015-10-15 10:28:56','2015-10-15 10:28:56',NULL),
	(6,'p006','product 5',NULL,'',1,44555,'2015-10-15 10:29:17','2015-10-15 10:29:17',NULL);

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_order`;

CREATE TABLE `product_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `output_product_id` int(11) DEFAULT NULL,
  `input_product_id` int(11) DEFAULT NULL,
  `num_product` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_no` varchar(200) DEFAULT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `delivery_location` varchar(255) DEFAULT NULL,
  `difference_percent` int(11) DEFAULT NULL,
  `output_product_note` varchar(200) DEFAULT NULL,
  `special_note` text,
  `created_user_id` int(11) DEFAULT NULL,
  `approved_user_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_order` WRITE;
/*!40000 ALTER TABLE `product_order` DISABLE KEYS */;

INSERT INTO `product_order` (`id`, `output_product_id`, `input_product_id`, `num_product`, `customer_id`, `order_no`, `delivery_date`, `delivery_location`, `difference_percent`, `output_product_note`, `special_note`, `created_user_id`, `approved_user_id`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(1,3,4,30000,1,'001','2015-10-28 00:00:00','ho chi minh',-3,'2  Con/tá» in','HÃ ng Ä‘Æ°á»£c Ä‘Ã³ng trong bao nylon trÆ°á»›c khi vÃ o thÃ¹ng carton. \r\nGiao hÃ ng Ä‘Ãºng thá»i gian trÃªn',3,3,'2015-10-16 19:10:44','2015-10-16 19:47:46',NULL);

/*!40000 ALTER TABLE `product_order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_order_progress
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_order_progress`;

CREATE TABLE `product_order_progress` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_order_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_order_progress` WRITE;
/*!40000 ALTER TABLE `product_order_progress` DISABLE KEYS */;

INSERT INTO `product_order_progress` (`id`, `product_order_id`, `name`, `location`, `description`, `order`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(10,1,'Cáº¯t giáº¥y táº¥m','TrÆ°á»ng SÆ¡n','Khá»• 65',1,'2015-10-16 19:47:46','2015-10-16 19:47:46',NULL),
	(11,1,'In 4 MÃ€U CMYK','Há»’NG PHÃšC','',2,'2015-10-16 19:47:46','2015-10-16 19:47:46',NULL),
	(12,1,'CÃ¡n uv','HAVUPACKAGE','',3,'2015-10-16 19:47:46','2015-10-16 19:47:46',NULL),
	(13,1,'Báº¿ ','Havupackage','',4,'2015-10-16 19:47:46','2015-10-16 19:47:46',NULL),
	(14,1,'DÃ¡n','Havupackage','',5,'2015-10-16 19:47:46','2015-10-16 19:47:46',NULL),
	(15,1,'ÄÃ³ng gÃ³i','Havupackage','',6,'2015-10-16 19:47:46','2015-10-16 19:47:46',NULL);

/*!40000 ALTER TABLE `product_order_progress` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_unit
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_unit`;

CREATE TABLE `product_unit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `product_unit` WRITE;
/*!40000 ALTER TABLE `product_unit` DISABLE KEYS */;

INSERT INTO `product_unit` (`id`, `name`)
VALUES
	(1,'EACH'),
	(2,'Piece');

/*!40000 ALTER TABLE `product_unit` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table purchase_order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `purchase_order`;

CREATE TABLE `purchase_order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `purchase_order` WRITE;
/*!40000 ALTER TABLE `purchase_order` DISABLE KEYS */;

INSERT INTO `purchase_order` (`id`, `customer_id`, `order_no`, `order_date`, `received_date`, `buyer_name`, `term`, `ship_via`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(1,9,'PO-001','2015-08-31 00:00:00','2015-10-31 00:00:00','Khuong','term','1','2015-10-15 19:29:48','2015-10-18 10:08:44',NULL),
	(2,3,'PO-002','2015-10-04 00:00:00','2015-10-31 00:00:00','test 2','term','1','2015-10-16 08:32:51','2015-10-17 14:22:24',NULL);

/*!40000 ALTER TABLE `purchase_order` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table purchase_order_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `purchase_order_product`;

CREATE TABLE `purchase_order_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `purchase_order_id` int(11) NOT NULL,
  `num_item` int(11) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `purchase_order_product` WRITE;
/*!40000 ALTER TABLE `purchase_order_product` DISABLE KEYS */;

INSERT INTO `purchase_order_product` (`id`, `product_id`, `purchase_order_id`, `num_item`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(4,4,2,3,'2015-10-17 14:22:24','2015-10-17 14:22:24',NULL),
	(5,3,2,44,'2015-10-17 14:22:24','2015-10-17 14:22:24',NULL),
	(10,2,1,226,'2015-10-18 10:08:44','2015-10-18 10:08:44',NULL),
	(11,4,1,2,'2015-10-18 10:08:44','2015-10-18 10:08:44',NULL),
	(12,3,1,33,'2015-10-18 10:08:44','2015-10-18 10:08:44',NULL);

/*!40000 ALTER TABLE `purchase_order_product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table purchase_order_vendor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `purchase_order_vendor`;

CREATE TABLE `purchase_order_vendor` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `vendor_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `purchase_order_vendor` WRITE;
/*!40000 ALTER TABLE `purchase_order_vendor` DISABLE KEYS */;

INSERT INTO `purchase_order_vendor` (`id`, `vendor_id`, `order_no`, `order_date`, `received_date`, `seller_name`, `term`, `ship_via`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(1,1,'ewew','2015-10-26 00:00:00','2015-10-28 00:00:00','rer','re','1','2015-10-18 09:54:28','2015-10-18 10:08:28',NULL);

/*!40000 ALTER TABLE `purchase_order_vendor` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table purchase_order_vendor_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `purchase_order_vendor_product`;

CREATE TABLE `purchase_order_vendor_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `purchase_order_vendor_id` int(11) NOT NULL,
  `num_item` int(11) NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `purchase_order_vendor_product` WRITE;
/*!40000 ALTER TABLE `purchase_order_vendor_product` DISABLE KEYS */;

INSERT INTO `purchase_order_vendor_product` (`id`, `product_id`, `purchase_order_vendor_id`, `num_item`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(6,2,1,22,'2015-10-18 10:08:28','2015-10-18 10:08:28',NULL),
	(7,3,1,33,'2015-10-18 10:08:28','2015-10-18 10:08:28',NULL);

/*!40000 ALTER TABLE `purchase_order_vendor_product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table salary
# ------------------------------------------------------------

DROP TABLE IF EXISTS `salary`;

CREATE TABLE `salary` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `salary` WRITE;
/*!40000 ALTER TABLE `salary` DISABLE KEYS */;

INSERT INTO `salary` (`id`, `customer_id`, `user_id`, `amount`, `date`, `mark_up`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(1,9,3,40328297,'2015-10-02 00:00:00',10,'2015-10-18 05:02:46','2015-10-18 05:45:17',NULL),
	(2,9,3,59837765,'2015-10-06 00:00:00',5,'2015-10-18 05:16:16','2015-10-18 05:16:16',NULL),
	(3,10,3,308255241,'2015-10-12 00:00:00',3,'2015-10-18 05:16:40','2015-10-18 05:16:40',NULL),
	(4,10,3,170595999,'2015-10-12 00:00:00',4,'2015-10-18 05:16:48','2015-10-18 05:16:48',NULL),
	(5,11,3,81060000,'2015-10-13 00:00:00',2,'2015-10-18 05:16:59','2015-10-18 05:16:59',NULL),
	(6,10,3,49923536,'2015-10-13 00:00:00',2,'2015-10-18 05:17:16','2015-10-18 05:17:16',NULL),
	(7,10,3,105980647,'2015-10-06 00:00:00',2,'2015-10-18 05:17:50','2015-10-18 05:17:50',NULL),
	(8,11,3,214737165,'2015-10-07 00:00:00',3,'2015-10-18 05:18:05','2015-10-18 05:18:05',NULL),
	(9,11,3,42738329,'2015-10-12 00:00:00',40,'2015-10-18 05:18:22','2015-10-18 05:18:22',NULL),
	(10,12,3,1111,'2015-10-02 00:00:00',2,'2015-10-18 05:57:45','2015-10-18 06:01:23','2015-10-18 06:01:23'),
	(11,9,5,1221,'2015-10-05 00:00:00',434,'2015-10-18 06:00:15','2015-10-18 06:00:15',NULL),
	(12,10,5,54545454,'2015-10-15 00:00:00',23232,'2015-10-18 06:00:29','2015-10-18 06:00:29',NULL);

/*!40000 ALTER TABLE `salary` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table settings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(100) DEFAULT NULL,
  `val` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;

INSERT INTO `settings` (`id`, `key`, `val`, `name`)
VALUES
	(1,'assumed','1000','Assumed');

/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_admin`;

CREATE TABLE `user_admin` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_admin` WRITE;
/*!40000 ALTER TABLE `user_admin` DISABLE KEYS */;

INSERT INTO `user_admin` (`id`, `name`, `email`, `username`, `password`, `status`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(1,'Admin','admin',NULL,'7c4a8d09ca3762af61e59520943dc26494f8941b',0,NULL,NULL,NULL);

/*!40000 ALTER TABLE `user_admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_role
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;

INSERT INTO `user_role` (`id`, `name`, `description`, `created_time`, `deleted_time`, `updated_time`)
VALUES
	(2,'Administrator','Administrator',NULL,NULL,NULL),
	(3,'Staff','Staff',NULL,NULL,NULL);

/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_role_access
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_role_access`;

CREATE TABLE `user_role_access` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_role_access_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`),
  CONSTRAINT `user_role_access_user` FOREIGN KEY (`user_id`) REFERENCES `wp_users` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_role_access` WRITE;
/*!40000 ALTER TABLE `user_role_access` DISABLE KEYS */;

INSERT INTO `user_role_access` (`id`, `role_id`, `user_id`, `created_time`, `deleted_time`, `updated_time`)
VALUES
	(1,2,3,'2015-10-17 15:51:22',NULL,'2015-10-17 15:51:22'),
	(3,3,4,'2015-10-17 17:59:08',NULL,'2015-10-17 17:59:08'),
	(6,3,5,'2015-10-17 18:13:46',NULL,'2015-10-17 18:13:46');

/*!40000 ALTER TABLE `user_role_access` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_role_right
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_role_right`;

CREATE TABLE `user_role_right` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) unsigned NOT NULL,
  `plugin` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `controller` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_role_right_role` (`role_id`),
  CONSTRAINT `user_role_right_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_role_right` WRITE;
/*!40000 ALTER TABLE `user_role_right` DISABLE KEYS */;

INSERT INTO `user_role_right` (`id`, `role_id`, `plugin`, `controller`, `action`, `description`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(109,3,NULL,'CostingController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(110,3,NULL,'CustomerController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(111,3,NULL,'DashboardController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(112,3,NULL,'FileController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(113,3,NULL,'LeadController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(114,3,NULL,'ProductController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(115,3,NULL,'ProductOrderController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(116,3,NULL,'PurchaseOrderController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(117,3,NULL,'PurchaseOrderVendorController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(118,3,NULL,'SalaryController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(119,3,NULL,'VendorController',NULL,NULL,'2015-10-18 09:45:16','2015-10-18 09:45:16',NULL),
	(120,2,NULL,'CostingController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(121,2,NULL,'CustomerController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(122,2,NULL,'DashboardController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(123,2,NULL,'FileController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(124,2,NULL,'LeadController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(125,2,NULL,'ProductController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(126,2,NULL,'ProductOrderController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(127,2,NULL,'PurchaseOrderController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(128,2,NULL,'PurchaseOrderVendorController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(129,2,NULL,'SalaryController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(130,2,NULL,'SettingsController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(131,2,NULL,'VendorController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(132,2,'User','UserController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(133,2,'User','UserRoleAccessController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(134,2,'User','UserRoleController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL),
	(135,2,'User','UserRoleRightController',NULL,NULL,'2015-10-18 09:45:20','2015-10-18 09:45:20',NULL);

/*!40000 ALTER TABLE `user_role_right` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vendor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vendor`;

CREATE TABLE `vendor` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `vendor` WRITE;
/*!40000 ALTER TABLE `vendor` DISABLE KEYS */;

INSERT INTO `vendor` (`id`, `name`, `code`, `email`, `phone`, `fax`, `address`, `info`, `deleted_time`)
VALUES
	(1,'Buffet Ngá»c Thá»§y','WDPZUTKCAEDCCBRL','ngocthuybuffet@yahoo.com','0838378543','0838378543','214 B Nguyá»…n TrÃ£i, PhÆ°á»ng Nguyá»…n CÆ° Trinh, Quáº­n 1 - Há»“ ChÃ­ Minh','Æ¯u Ä‘iá»ƒm : \r\n- Thá»©c Äƒn ngon vÃ  phong phÃº, Ä‘áº·c biá»‡t lÃ  cÃ³ nhiá»u háº£i sáº£n.',NULL),
	(2,'Dá»‹ch vá»¥ Káº¿ toÃ¡n TrÃ­ Viá»‡t','EVNVGNTDLKHURRGN','trivietacc@gmail.com','0934534541','0934534541','251 Chu VÄƒn An - Há»“ ChÃ­ Minh','Cung cáº¥p cÃ¡c dá»‹ch vá»¥ káº¿ toÃ¡n cho doanh nghiá»‡p nhÆ° dá»‹ch vá»¥ káº¿ toÃ¡n thuáº¿ trá»n gÃ³i, dá»‹ch vá»¥ láº­p bÃ¡o cÃ¡o tÃ i chÃ­nh, dá»‹ch vá»¥ káº¿ toÃ¡n trá»n gÃ³i,..',NULL);

/*!40000 ALTER TABLE `vendor` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table wp_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wp_users`;

CREATE TABLE `wp_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_pass` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_activation_key` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `user_status` int(11) NOT NULL DEFAULT '0',
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_login_key` (`user_login`),
  KEY `user_nicename` (`user_nicename`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;

INSERT INTO `wp_users` (`id`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `firstname`, `lastname`, `display_name`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(3,'admin','$P$BAlJQI3ykZULnoEspvSt/ssjDj1wH3/','','admin@gmail.com','','0000-00-00 00:00:00','55f81a472136e1875bb8fd073404f53a',0,'F Name','L Name','F Name L Name',NULL,'2015-10-17 18:00:11',NULL),
	(4,'user2','$P$BHfhMh3uBeIxNUaf/C4Pt/HVcSUQZa1','','user2@gmail.com','','0000-00-00 00:00:00','',0,'user','2','user 2','2015-10-17 17:58:45','2015-10-17 18:10:21',NULL),
	(5,'user1','$P$BejzpWP3cQAhre9umA/SoosnfJD0ci/','','user1@gmail.com','','0000-00-00 00:00:00','',0,'user ','1','user  1','2015-10-17 18:13:46','2015-10-17 18:13:46',NULL);

/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
