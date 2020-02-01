ALTER TABLE `article` ADD `description` TEXT NOT NULL AFTER `label`,
ADD `price_sell` FLOAT NOT NULL DEFAULT '0' AFTER `price_us`,
