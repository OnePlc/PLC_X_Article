ALTER TABLE `article` ADD `description` TEXT NOT NULL AFTER `label`,
ADD `featured_image` VARCHAR(255) NOT NULL DEFAULT '' AFTER `description`,
ADD `web_show_idfs` TINYINT(1) NOT NULL DEFAULT '0' AFTER `label`,
ADD `web_spotlight_idfs` TINYINT(1) NOT NULL DEFAULT '0' AFTER `web_show_idfs`;