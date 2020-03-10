-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 10, 2020 at 05:48 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g7t3_booking`
--
CREATE DATABASE IF NOT EXISTS `g7t3_booking` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `g7t3_booking`;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` int(11) NOT NULL,
  `customer_mobile` varchar(8) NOT NULL,
  `provider_mobile` varchar(8) NOT NULL,
  `booking_time` varchar(5) NOT NULL,
  `booking_date` varchar(10) NOT NULL,
  `booking_price` double(5,2) NOT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_mobile`, `provider_mobile`, `booking_time`, `booking_date`, `booking_price`) VALUES
(50000001, '91239123', '90000000', '14:37', '2020-03-06', 50.99),
(50000002, '98765432', '90000000', '19:37', '2020-03-06', 65.70);
--
-- Database: `g7t3_customer`
--
CREATE DATABASE IF NOT EXISTS `g7t3_customer` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `g7t3_customer`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `customer_mobile` varchar(8) NOT NULL,
  `customer_name` varchar(128) NOT NULL,
  `customer_address` varchar(256) NOT NULL,
  PRIMARY KEY (`customer_mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_mobile`, `customer_name`, `customer_address`) VALUES
('91222222', 'Agnes Lam', 'Singapore Management University, Singapore'),
('91239123', 'Nicolas Wijaya', 'Singapore Management University, Singapore');
--
-- Database: `g7t3_review`
--
CREATE DATABASE IF NOT EXISTS `g7t3_review` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `g7t3_review`;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `review_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `review_star` int(11) NOT NULL,
  `review_comment` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `booking_id`, `review_star`, `review_comment`) VALUES
(10000001, 50000001, 4, 'First Comment. Not so bad.');
--
-- Database: `g7t3_serviceprovider`
--
CREATE DATABASE IF NOT EXISTS `g7t3_serviceprovider` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `g7t3_serviceprovider`;

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider`
--

DROP TABLE IF EXISTS `serviceprovider`;
CREATE TABLE IF NOT EXISTS `serviceprovider` (
  `provider_mobile` varchar(8) NOT NULL,
  `provider_name` varchar(128) NOT NULL,
  `provider_service1` varchar(256) NOT NULL,
  `provider_service2` varchar(256) DEFAULT NULL,
  `provider_service3` varchar(256) DEFAULT NULL,
  `provider_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`provider_mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `serviceprovider`
--

INSERT INTO `serviceprovider` (`provider_mobile`, `provider_name`, `provider_service1`, `provider_service2`, `provider_service3`, `provider_price`) VALUES
('90000000', 'Impawssible', 'Showering', 'Petting', '', '25.99'),
('98765432', 'What The Fluff', 'Showering ', 'Blowing', 'Feeding', '50.01');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
