CREATE TABLE `article` (
  `Article_ID` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `article`
  ADD PRIMARY KEY (`Article_ID`);

ALTER TABLE `article`
  MODIFY `Article_ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;