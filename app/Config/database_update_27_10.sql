ALTER TABLE  `customer` DROP  `info` ;
ALTER TABLE  `customer` CHANGE  `email`  `email` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE  `customer` ADD  `website` VARCHAR( 255 ) NULL AFTER  `address` ,
ADD  `foundation` DATE NOT NULL COMMENT  'ngày thành lập' AFTER  `website` ,
ADD  `investment` VARCHAR( 255 ) NULL COMMENT  'số vốn' AFTER  `foundation` ,
ADD  `career` VARCHAR( 255 ) NULL COMMENT  'ngành nghề' AFTER  `investment` ;
ALTER TABLE  `customer_contact` DROP  `fax` ,
DROP  `info` ;
ALTER TABLE  `customer_contact` CHANGE  `email`  `email` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE  `phone`  `phone` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE  `customer_contact` ADD  `birthday` DATE NULL AFTER  `address` ,
ADD  `position` VARCHAR( 255 ) NULL COMMENT  'chức vụ' AFTER  `birthday` ;
UPDATE  `baobigiay`.`customer` SET  `foundation` =  '2015-01-01'
INSERT INTO `baobigiay`.`user_role` (`id`, `name`, `description`, `created_time`, `deleted_time`, `updated_time`) VALUES ('4', 'Customer', 'Customer', NULL, NULL, NULL);
