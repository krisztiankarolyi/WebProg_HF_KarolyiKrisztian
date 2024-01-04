-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

-- Dumping database structure for stocksdb
CREATE DATABASE IF NOT EXISTS `stocksdb` /*!40100 DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_bin */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `stocksdb`;

-- Dumping structure for table stocksdb.stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ticker` varchar(50) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `name` varchar(50) COLLATE utf8mb3_bin NOT NULL DEFAULT '',
  `price` float NOT NULL DEFAULT '0',
  `dividend` float NOT NULL DEFAULT '0',
  `shares` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_bin;
