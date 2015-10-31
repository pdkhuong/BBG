# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 10.0.17-MariaDB)
# Database: baobigiay
# Generation Time: 2015-10-31 04:30:57 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table calendar
# ------------------------------------------------------------

DROP TABLE IF EXISTS `calendar`;

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `description` text,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `deleted_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table costing
# ------------------------------------------------------------

DROP TABLE IF EXISTS `costing`;

CREATE TABLE `costing` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table customer_contact
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer_contact`;

CREATE TABLE `customer_contact` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table facsimile_massage
# ------------------------------------------------------------

DROP TABLE IF EXISTS `facsimile_massage`;

CREATE TABLE `facsimile_massage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table facsimile_massage_product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `facsimile_massage_product`;

CREATE TABLE `facsimile_massage_product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `facsimile_massage_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `num_item` int(11) NOT NULL,
  `price` float DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table file
# ------------------------------------------------------------

DROP TABLE IF EXISTS `file`;

CREATE TABLE `file` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table lead
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lead`;

CREATE TABLE `lead` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table lead_contact
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lead_contact`;

CREATE TABLE `lead_contact` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
  `special_note` text,
  `created_user_id` int(11) DEFAULT NULL,
  `approved_user_id` int(11) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
	(1,'Each'),
	(2,'Piece');

/*!40000 ALTER TABLE `product_unit` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table purchase_order
# ------------------------------------------------------------

DROP TABLE IF EXISTS `purchase_order`;

CREATE TABLE `purchase_order` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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



# Dump of table purchase_order_vendor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `purchase_order_vendor`;

CREATE TABLE `purchase_order_vendor` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



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
	(1,'printing_ink_price','175','Printing - Ink Price'),
	(2,'ink_loss_prn_color','200',' Ink loss/Prn / Color'),
	(3,'trial_prn','30','Trial Prn'),
	(4,'printing_cost','150','Printing Cost'),
	(5,'time_cost','3500','Time Cost'),
	(6,'time_waste','45','Time Waste'),
	(7,'prn_plate','180000','Prn Plate'),
	(8,'film_cost','800000','Film Cost'),
	(9,'prn_wastg','1','Prn Wastg'),
	(10,'vanish_oil','600','Vanish - Oil'),
	(11,'vanish_uv','950','Vanish - UV'),
	(12,'vanish_opp','1800','Vanish - OPP'),
	(13,'limination','500','Limination'),
	(14,'limination _wastage','1','Limination - Wastage'),
	(15,'die_cut','1500000','Die-Cut'),
	(16,'die_cut_labour','150','Die-Cut - Labour'),
	(17,'die_cut_wastage','1','Die-Cut - Wastage'),
	(18,'gluing_1','40','Gluing 1'),
	(19,'gluing_2','60','Gluing 2'),
	(20,'gluing_3','80','Gluing 3'),
	(21,'sales_tax','0','Sales Tax'),
	(22,'capital_investment','300000','Capital  Investment '),
	(23,'depreciation_period','5','Depreciation Period'),
	(24,'engineer','250','Engineer'),
	(25,'3_team_leaders','600','3 Team Leaders'),
	(26,'12_workers','2400','12 Workers (3 Shifts)'),
	(27,'maintenance','500','Maintenance'),
	(28,'chemical','500','Chemical'),
	(29,'usd_to_vnd','14000','1  USD   to VND'),
	(30,'assumed','2000','Assumed');

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
	(4,'Customer','Customer','2015-10-30 06:44:17',NULL,'2015-10-30 07:41:27'),
	(5,'Marketing','Marketing',NULL,NULL,'2015-10-30 07:42:46'),
	(6,'Accounting','Marketing','2015-10-30 07:46:22',NULL,'2015-10-30 07:46:22'),
	(7,'Design','Design','2015-10-30 07:46:35',NULL,'2015-10-30 07:46:35');

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
  CONSTRAINT `user_role_access_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_role_access` WRITE;
/*!40000 ALTER TABLE `user_role_access` DISABLE KEYS */;

INSERT INTO `user_role_access` (`id`, `role_id`, `user_id`, `created_time`, `deleted_time`, `updated_time`)
VALUES
	(1,5,1,'2015-10-31 05:29:32',NULL,'2015-10-31 05:29:32');

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
  `is_owner` tinyint(4) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `created_time` datetime DEFAULT NULL,
  `updated_time` datetime DEFAULT NULL,
  `deleted_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_role_right_role` FOREIGN KEY (`role_id`) REFERENCES `user_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user_role_right` WRITE;
/*!40000 ALTER TABLE `user_role_right` DISABLE KEYS */;

INSERT INTO `user_role_right` (`id`, `role_id`, `plugin`, `controller`, `action`, `is_owner`, `description`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(1,2,'User',NULL,NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(2,2,NULL,'CalendarController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(3,2,NULL,'CostingController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(4,2,NULL,'CustomerController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(5,2,NULL,'DashboardController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(6,2,NULL,'FacsimileMassageController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(7,2,NULL,'FileController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(8,2,NULL,'LeadController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(9,2,NULL,'ProductController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(10,2,NULL,'PurchaseOrderController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(11,2,NULL,'PurchaseRequestController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(12,2,NULL,'SalaryController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(13,2,NULL,'SettingsController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(14,2,NULL,'VendorController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(15,2,NULL,'WorksSheetController',NULL,NULL,NULL,'2015-10-31 05:21:54','2015-10-31 05:21:54',NULL),
	(16,5,NULL,'CalendarController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(17,5,NULL,'CalendarController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(18,5,NULL,'CalendarController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(19,5,NULL,'CalendarController','feed',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(20,5,NULL,'CostingController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(21,5,NULL,'CostingController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(22,5,NULL,'CostingController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(23,5,NULL,'CustomerController','view',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(24,5,NULL,'CustomerController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(25,5,NULL,'CustomerController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(26,5,NULL,'CustomerController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(27,5,NULL,'DashboardController',NULL,NULL,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(28,5,NULL,'FacsimileMassageController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(29,5,NULL,'FacsimileMassageController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(30,5,NULL,'FacsimileMassageController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(31,5,NULL,'FacsimileMassageController','report',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(32,5,NULL,'FileController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(33,5,NULL,'FileController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(34,5,NULL,'FileController','index',0,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(35,5,NULL,'LeadController','view',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(36,5,NULL,'LeadController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(37,5,NULL,'LeadController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(38,5,NULL,'LeadController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(39,5,NULL,'ProductController','view',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(40,5,NULL,'ProductController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(41,5,NULL,'ProductController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(42,5,NULL,'ProductController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(43,5,NULL,'PurchaseOrderController','view',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(44,5,NULL,'PurchaseOrderController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(45,5,NULL,'PurchaseOrderController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(46,5,NULL,'PurchaseOrderController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(47,5,NULL,'PurchaseRequestController','view',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(48,5,NULL,'PurchaseRequestController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(49,5,NULL,'PurchaseRequestController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(50,5,NULL,'PurchaseRequestController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(51,5,NULL,'SalaryController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(52,5,NULL,'SalaryController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(53,5,NULL,'SalaryController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(54,5,NULL,'VendorController','view',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(55,5,NULL,'VendorController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(56,5,NULL,'VendorController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(57,5,NULL,'VendorController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(58,5,NULL,'WorksSheetController','edit',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(59,5,NULL,'WorksSheetController','delete',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(60,5,NULL,'WorksSheetController','index',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(61,5,NULL,'WorksSheetController','report',1,NULL,'2015-10-31 05:24:14','2015-10-31 05:24:14',NULL),
	(62,6,NULL,'CalendarController','edit',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(63,6,NULL,'CalendarController','delete',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(64,6,NULL,'CalendarController','index',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(65,6,NULL,'CalendarController','feed',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(66,6,NULL,'CostingController','edit',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(67,6,NULL,'CostingController','delete',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(68,6,NULL,'CostingController','index',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(69,6,NULL,'CustomerController','view',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(70,6,NULL,'CustomerController','edit',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(71,6,NULL,'CustomerController','delete',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(72,6,NULL,'CustomerController','index',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(73,6,NULL,'DashboardController',NULL,NULL,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(74,6,NULL,'FacsimileMassageController','edit',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(75,6,NULL,'FacsimileMassageController','delete',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(76,6,NULL,'FacsimileMassageController','index',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(77,6,NULL,'FacsimileMassageController','report',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(78,6,NULL,'FileController','edit',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(79,6,NULL,'FileController','delete',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(80,6,NULL,'FileController','index',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(81,6,NULL,'ProductController','view',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(82,6,NULL,'ProductController','edit',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(83,6,NULL,'ProductController','delete',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(84,6,NULL,'ProductController','index',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(85,6,NULL,'PurchaseRequestController','view',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(86,6,NULL,'PurchaseRequestController','edit',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(87,6,NULL,'PurchaseRequestController','delete',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(88,6,NULL,'PurchaseRequestController','index',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(89,6,NULL,'VendorController','view',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(90,6,NULL,'VendorController','edit',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(91,6,NULL,'VendorController','delete',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(92,6,NULL,'VendorController','index',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(93,6,NULL,'WorksSheetController','edit',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(94,6,NULL,'WorksSheetController','delete',1,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(95,6,NULL,'WorksSheetController','index',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(96,6,NULL,'WorksSheetController','report',0,NULL,'2015-10-31 05:26:29','2015-10-31 05:26:29',NULL),
	(97,7,NULL,'CalendarController','edit',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(98,7,NULL,'CalendarController','delete',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(99,7,NULL,'CalendarController','index',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(100,7,NULL,'CalendarController','feed',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(101,7,NULL,'DashboardController',NULL,NULL,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(102,7,NULL,'FileController','edit',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(103,7,NULL,'FileController','delete',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(104,7,NULL,'FileController','index',0,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(105,7,NULL,'ProductController','view',0,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(106,7,NULL,'ProductController','edit',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(107,7,NULL,'ProductController','delete',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(108,7,NULL,'ProductController','index',0,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(109,7,NULL,'SalaryController','edit',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(110,7,NULL,'SalaryController','delete',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(111,7,NULL,'SalaryController','index',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(112,7,NULL,'WorksSheetController','edit',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(113,7,NULL,'WorksSheetController','delete',1,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(114,7,NULL,'WorksSheetController','index',0,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(115,7,NULL,'WorksSheetController','report',0,NULL,'2015-10-31 05:27:44','2015-10-31 05:27:44',NULL),
	(116,4,NULL,'CalendarController','edit',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(117,4,NULL,'CalendarController','delete',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(118,4,NULL,'CalendarController','index',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(119,4,NULL,'CalendarController','feed',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(120,4,NULL,'CustomerController','view',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(121,4,NULL,'CustomerController','edit',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(122,4,NULL,'CustomerController','delete',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(123,4,NULL,'CustomerController','index',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(124,4,NULL,'DashboardController',NULL,NULL,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(125,4,NULL,'FileController','edit',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(126,4,NULL,'FileController','delete',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(127,4,NULL,'FileController','index',0,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(128,4,NULL,'ProductController','view',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(129,4,NULL,'ProductController','edit',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(130,4,NULL,'ProductController','delete',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(131,4,NULL,'ProductController','index',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(132,4,NULL,'PurchaseOrderController','view',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL),
	(133,4,NULL,'PurchaseOrderController','index',1,NULL,'2015-10-31 05:28:48','2015-10-31 05:28:48',NULL);

/*!40000 ALTER TABLE `user_role_right` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vendor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vendor`;

CREATE TABLE `vendor` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table vendor_contact
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vendor_contact`;

CREATE TABLE `vendor_contact` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table wp_users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `wp_users`;

CREATE TABLE `wp_users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `wp_users` WRITE;
/*!40000 ALTER TABLE `wp_users` DISABLE KEYS */;

INSERT INTO `wp_users` (`id`, `user_login`, `user_pass`, `user_nicename`, `user_email`, `user_url`, `user_registered`, `user_activation_key`, `user_status`, `firstname`, `lastname`, `display_name`, `created_time`, `updated_time`, `deleted_time`)
VALUES
	(1,'marketing','$P$Boj4ZRANYjdBO1G0D9cG2FU35YQ3u7/','','marketing@baobigiay.vn','','0000-00-00 00:00:00','',0,'Test','1','Test 1','2015-10-31 05:29:32','2015-10-31 05:29:32',NULL);

/*!40000 ALTER TABLE `wp_users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
