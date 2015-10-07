CREATE TABLE `revisions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `object_id` bigint(20) unsigned NOT NULL,
  `model` varchar(255) NOT NULL DEFAULT '',
  `created_time` datetime NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `admin_id` int(11) unsigned DEFAULT NULL,
  `data` longtext,
  `multilanguage` longtext,
  `diff_data` longtext,
  `diff_multilanguage` longtext,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `admin_id` (`admin_id`),
  KEY `created_time` (`created_time`),
  KEY `object_id` (`object_id`),
  KEY `model` (`model`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
