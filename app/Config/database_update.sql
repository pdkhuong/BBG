/* baobigiay */ ALTER TABLE `product_order` DROP `output_product_note`;
/* baobigiay */ ALTER TABLE `customer` ADD `user_id` INT(11)  NULL  DEFAULT NULL  AFTER `id`;
/* baobigiay */ ALTER TABLE `lead` ADD `user_id` INT(11)  NOT NULL  AFTER `id`;
/* baobigiay */ ALTER TABLE `vendor` ADD `user_id` INT(11)  NOT NULL  AFTER `id`;
/* baobigiay */ ALTER TABLE `purchase_order` ADD `user_id` INT(11)  NOT NULL  AFTER `customer_id`;
/* baobigiay */ ALTER TABLE `purchase_order_vendor` ADD `user_id` INT(11)  NOT NULL  AFTER `vendor_id`;

