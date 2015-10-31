/* baobigiay */ ALTER TABLE `product_order` DROP `output_product_note`;
/* baobigiay */ ALTER TABLE `customer` ADD `user_id` INT(11)  NULL  DEFAULT NULL  AFTER `id`;
/* baobigiay */ ALTER TABLE `lead` ADD `user_id` INT(11)  NOT NULL  AFTER `id`;
/* baobigiay */ ALTER TABLE `vendor` ADD `user_id` INT(11)  NOT NULL  AFTER `id`;
/* baobigiay */ ALTER TABLE `purchase_order` ADD `user_id` INT(11)  NOT NULL  AFTER `customer_id`;
/* baobigiay */ ALTER TABLE `purchase_order_vendor` ADD `user_id` INT(11)  NOT NULL  AFTER `vendor_id`;


/* 9:58:21 AM localhost baobigiay */ ALTER TABLE `product` ADD `file_id` INT  NULL  DEFAULT NULL  AFTER `price`;
/* 10:03:55 AM localhost baobigiay */ ALTER TABLE `product` ADD `customer_id` INT(11)  NULL  DEFAULT NULL  AFTER `file_id`;
/* 12:31:07 PM localhost baobigiay */ ALTER TABLE `product` ADD `user_id` INT(11)  NULL  DEFAULT NULL  AFTER `file_id`;

/* 1:42:20 PM localhost baobigiay */ ALTER TABLE `costing` ADD `selling_price` FLOAT  NULL  DEFAULT NULL  AFTER `e_flute_price`;
/* 2:02:22 PM localhost baobigiay */ ALTER TABLE `costing` DROP `person_ic`;
/* 9:43:38 PM localhost baobigiay */ ALTER TABLE `file` ADD `model` VARCHAR(100)  NULL  DEFAULT NULL  AFTER `file_path`;
/* 9:20:11 PM localhost baobigiay */ ALTER TABLE `file` ADD `user_id` INT  NULL  DEFAULT NULL  AFTER `model`;

/* 10:47:53 AM localhost baobigiay */ ALTER TABLE `calendar` ADD `user_id` INT(11)  NULL  DEFAULT NULL  AFTER `name`;


