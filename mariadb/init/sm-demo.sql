CREATE DATABASE `publications`;

GRANT ALL PRIVILEGES ON publications.* TO 'lain'@'another-database' IDENTIFIED BY 'unsecurepassword';
GRANT ALL PRIVILEGES ON publications.* TO 'lain'@'%' IDENTIFIED BY 'unsecurepassword';

USE `publications`;

DROP TABLE IF EXISTS `classics`;

CREATE TABLE `classics` (
  `author` varchar(128) DEFAULT NULL,
  `title` varchar(128) DEFAULT NULL,
  `category` varchar(16) DEFAULT NULL,
  `year` smallint(6) DEFAULT NULL,
  `isbn` char(13) NOT NULL,
  PRIMARY KEY (`isbn`),
  KEY `author` (`author`(20)),
  KEY `title` (`title`(20)),
  KEY `category` (`category`(4)),
  KEY `year` (`year`),
  KEY `author_2` (`author`(20)),
  FULLTEXT KEY `author_3` (`author`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `classics` WRITE;

INSERT INTO `classics` VALUES ('Charles Dickens','The Old Curiosity Shop','Fiction',1841,'9780099533474'),('William Shakespeare','Romeo and Juliet','Play',1594,'9780192814968'),('Charles Darwin','The Origin of Species','Non-Fiction',1856,'9780517123201'),('Jane Austen','Pride and Prejudice','Fiction',1811,'9780582506206'),('Mark Twain','The Adventures of Tom Sawyer','Fiction',1876,'9781598184891');

LOCK TABLES `classics` WRITE;

UNLOCK TABLES;
