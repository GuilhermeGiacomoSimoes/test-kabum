CREATE DATABASE  `administrative_area`;

USE `administrative_area`;

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `client_id` int NOT NULL AUTO_INCREMENT,
  `client_name` varchar(50) DEFAULT NULL,
  `client_date_of_birth` varchar(20) DEFAULT NULL,
  `client_cpf` varchar(20) DEFAULT NULL,
  `client_rg` varchar(20) DEFAULT NULL,
  `client_phone` varchar(20) DEFAULT NULL,
  `client_address` text,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


LOCK TABLES `client` WRITE;
UNLOCK TABLES;

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

LOCK TABLES `user` WRITE;

UNLOCK TABLES;
