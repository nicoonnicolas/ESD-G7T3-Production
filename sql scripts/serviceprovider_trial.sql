-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 20, 2020 at 06:09 AM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g7t3_serviceprovider`
--

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_trial`
--

DROP TABLE IF EXISTS `serviceprovider_trial`;
CREATE TABLE IF NOT EXISTS `serviceprovider_trial` (
  `sn` int(11) NOT NULL AUTO_INCREMENT,
  `provider_name` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `provider_price` decimal(10,2) NOT NULL,
  `provider_time` time NOT NULL,
  `provider_day` date NOT NULL,
  `provider_service` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`sn`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serviceprovider_trial`
--

INSERT INTO `serviceprovider_trial` (`sn`, `provider_name`, `provider_price`, `provider_time`, `provider_day`, `provider_service`) VALUES
(1, 'Agnes Lam', '45.00', '09:00:00', '2020-03-20', 'Feeding');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
