-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 15, 2024 at 08:01 PM
-- Server version: 11.2.2-MariaDB
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bgpdb`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `GetAllAsns`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllAsns` ()   BEGIN
	SELECT * FROM asn ORDER BY asn ASC;
END$$

DROP PROCEDURE IF EXISTS `GetAsnByProvince`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAsnByProvince` (IN `provinceInput` VARCHAR(255))   BEGIN
	SELECT * FROM asn WHERE province = provinceInput ORDER BY asn ASC;
END$$

DROP PROCEDURE IF EXISTS `GetLastUpdateDate`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetLastUpdateDate` ()   BEGIN
	SELECT UPDATE_TIME
    FROM   information_schema.tables
    WHERE  TABLE_SCHEMA = 'bgpdb'
    	AND TABLE_NAME = 'asn';
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `asn`
--

DROP TABLE IF EXISTS `asn`;
CREATE TABLE IF NOT EXISTS `asn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asn` int(11) NOT NULL,
  `org_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `asn_date` date DEFAULT NULL,
  `org_date` date DEFAULT NULL,
  `province` varchar(32) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ASN` (`asn`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;