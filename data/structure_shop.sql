ALTER TABLE `article` ADD `description` TEXT NOT NULL AFTER `label`,
ADD `featured_image` VARCHAR(255) NOT NULL DEFAULT '' AFTER `description`;