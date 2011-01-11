CREATE TABLE `people` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `first_name` varchar(256) NOT NULL,
  `last_name` varchar(256) NOT NULL,
  `office_phone` varchar(256) NOT NULL,
  `mobile_phone` varchar(256) NOT NULL
) COMMENT='' ENGINE='InnoDB'