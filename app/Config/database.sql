# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.20)
# Database: baobigiay
# Generation Time: 2015-10-17 15:53:59 +0000
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
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `code` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;

INSERT INTO `customer` (`id`, `name`, `code`)
VALUES
	(1,'Customer 1','Cus Code 1'),
	(2,'Customer 2','Cus Code 2'),
	(3,'Customer 3','Cus Code 3');

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
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
	(1,'Item001','test item name',NULL,'des',1,1212.12,'2015-10-13 10:12:05','2015-10-13 10:41:50',NULL),
	(2,'Item002','product 2',NULL,'',2,232,'2015-10-13 10:42:19','2015-10-13 10:44:37','2015-10-13 10:44:37'),
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
	(1,2,'PO-001','2015-08-31 00:00:00','2015-10-31 00:00:00','Khuong','term','1','2015-10-15 19:29:48','2015-10-17 14:22:09',NULL),
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
	(1,4,1,2,'2015-10-17 14:22:09','2015-10-17 14:22:09',NULL),
	(2,3,1,33,'2015-10-17 14:22:09','2015-10-17 14:22:09',NULL),
	(3,1,1,4,'2015-10-17 14:22:09','2015-10-17 14:22:09',NULL),
	(4,4,2,3,'2015-10-17 14:22:24','2015-10-17 14:22:24',NULL),
	(5,3,2,44,'2015-10-17 14:22:24','2015-10-17 14:22:24',NULL),
	(6,1,2,5,'2015-10-17 14:22:24','2015-10-17 14:22:24',NULL);

/*!40000 ALTER TABLE `purchase_order_product` ENABLE KEYS */;
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
	(1,2,3,'2015-10-17 15:51:22',NULL,'2015-10-17 15:51:22');

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
	(45,3,NULL,'DashboardController',NULL,NULL,'2015-10-17 16:59:27','2015-10-17 16:59:27',NULL),
	(46,2,NULL,'DashboardController',NULL,NULL,'2015-10-17 16:59:31','2015-10-17 16:59:31',NULL),
	(47,2,NULL,'ProductController',NULL,NULL,'2015-10-17 16:59:31','2015-10-17 16:59:31',NULL),
	(48,2,NULL,'ProductOrderController',NULL,NULL,'2015-10-17 16:59:31','2015-10-17 16:59:31',NULL),
	(49,2,'User','UserController',NULL,NULL,'2015-10-17 16:59:31','2015-10-17 16:59:31',NULL);

/*!40000 ALTER TABLE `user_role_right` ENABLE KEYS */;
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
	(3,'useradd','$P$BZHSmeyinPSE3ckxnPRM283CtITNi31','','testadd1@gmail.com','','0000-00-00 00:00:00','55f81a472136e1875bb8fd073404f53a',0,'fa1','fl1','fa1 fl1',NULL,'2015-10-16 10:10:15',NULL);

/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
