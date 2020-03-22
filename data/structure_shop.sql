ALTER TABLE `article` ADD `description` TEXT NOT NULL AFTER `label`,
ADD `featured_image` VARCHAR(255) NOT NULL DEFAULT '' AFTER `description`,
ADD `show_on_web_idfs` TINYINT(1) NOT NULL DEFAULT '0' AFTER `label`,
ADD `web_spotlight_idfs` TINYINT(1) NOT NULL DEFAULT '0' AFTER `show_on_web_idfs`,
ADD `web_sort_id` INT(11) NOT NULL DEFAULT '0' AFTER `show_on_web_idfs`,
ADD `ref_idfs` INT(11) NOT NULL DEFAULT '0' AFTER `web_spotlight_idfs`,
ADD `ref_type` VARCHAR(50) NOT NULL DEFAULT '' AFTER `ref_idfs`;
