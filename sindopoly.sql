-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.5.18-MariaDB-0+deb11u1-log - Debian 11
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for sindopoly_db
CREATE DATABASE IF NOT EXISTS `sindopoly_db` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `sindopoly_db`;

-- Dumping structure for table sindopoly_db.game
CREATE TABLE IF NOT EXISTS `game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gamename` varchar(255) NOT NULL DEFAULT '0',
  `p1name` varchar(255) NOT NULL DEFAULT '',
  `p2name` varchar(255) NOT NULL DEFAULT '',
  `p1pos` int(11) NOT NULL DEFAULT 0,
  `p2pos` int(11) NOT NULL DEFAULT 0,
  `p1money` int(11) NOT NULL DEFAULT 3000,
  `p2money` int(11) NOT NULL DEFAULT 3000,
  `p1token` varchar(100) DEFAULT NULL,
  `p2token` varchar(100) DEFAULT NULL,
  `pturn` tinyint(4) DEFAULT 1,
  `pr1` tinyint(4) NOT NULL DEFAULT 0,
  `pr2` tinyint(4) NOT NULL DEFAULT 0,
  `pr3` tinyint(4) NOT NULL DEFAULT 0,
  `pr5` tinyint(4) NOT NULL DEFAULT 0,
  `pr6` tinyint(4) NOT NULL DEFAULT 0,
  `pr8` tinyint(4) NOT NULL DEFAULT 0,
  `pr9` tinyint(4) NOT NULL DEFAULT 0,
  `pr11` tinyint(4) NOT NULL DEFAULT 0,
  `pr12` tinyint(4) NOT NULL DEFAULT 0,
  `pr13` tinyint(4) NOT NULL DEFAULT 0,
  `pr14` tinyint(4) NOT NULL DEFAULT 0,
  `pr15` tinyint(4) NOT NULL DEFAULT 0,
  `pr16` tinyint(4) NOT NULL DEFAULT 0,
  `pr18` tinyint(4) NOT NULL DEFAULT 0,
  `pr19` tinyint(4) NOT NULL DEFAULT 0,
  `pr21` tinyint(4) NOT NULL DEFAULT 0,
  `pr23` tinyint(4) NOT NULL DEFAULT 0,
  `pr24` tinyint(4) NOT NULL DEFAULT 0,
  `pr25` tinyint(4) NOT NULL DEFAULT 0,
  `pr26` tinyint(4) NOT NULL DEFAULT 0,
  `pr27` tinyint(4) NOT NULL DEFAULT 0,
  `pr28` tinyint(4) NOT NULL DEFAULT 0,
  `pr29` tinyint(4) NOT NULL DEFAULT 0,
  `pr31` tinyint(4) NOT NULL DEFAULT 0,
  `pr32` tinyint(4) NOT NULL DEFAULT 0,
  `pr34` tinyint(4) NOT NULL DEFAULT 0,
  `pr35` tinyint(4) NOT NULL DEFAULT 0,
  `pr37` tinyint(4) NOT NULL DEFAULT 0,
  `pr39` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
