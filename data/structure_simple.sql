--
-- Extend Article by Extra Fields
--

--
-- Price
--
ALTER TABLE `article` ADD `price` FLOAT NOT NULL DEFAULT '0' AFTER `label`;