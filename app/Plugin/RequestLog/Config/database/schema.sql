CREATE TABLE `request_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(32) DEFAULT NULL,
  `hostname` varchar(255) DEFAULT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `refer` varchar(255) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `admin_id` int(11) unsigned DEFAULT NULL,
  `plugin` varchar(255) DEFAULT NULL,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `get_data` longtext,
  `post_data` longtext,
  `raw_data` longtext,
  `file_data` longtext,
  `server_data` longtext,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`),
  KEY `hostname` (`hostname`),
  KEY `uri` (`uri`),
  KEY `refer` (`refer`),
  KEY `created_time` (`created_time`),
  KEY `user_id` (`user_id`),
  KEY `admin_id` (`admin_id`),
  KEY `plugin` (`plugin`),
  KEY `controller` (`controller`),
  KEY `action` (`action`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `request_log_tmp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

--ALTER TABLE `request_log` ADD COLUMN `server_data` LONGTEXT NULL DEFAULT NULL AFTER `file_data`;
