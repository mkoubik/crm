CREATE TABLE `accounts_contacts` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `account_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  FOREIGN KEY (`account_id`) REFERENCES `accounts` (`id`) ON DELETE CASCADE,
  FOREIGN KEY (`person_id`) REFERENCES `people` (`id`) ON DELETE CASCADE
) COMMENT='' ENGINE='InnoDB'