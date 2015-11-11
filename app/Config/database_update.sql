ALTER TABLE `facsimile_massage` ADD `attn` VARCHAR(200)  NULL  DEFAULT NULL  AFTER `customer_id`;
ALTER TABLE `product` ADD `structure` text  NULL  DEFAULT NULL  AFTER `specification`;
ALTER TABLE `facsimile_massage_product` ADD `num_color` INT(11)  NULL  DEFAULT NULL  AFTER `num_item`;

ALTER TABLE `user_role_right` ADD `can_create` TINYINT(4)  NULL  DEFAULT NULL  AFTER `is_owner`;




