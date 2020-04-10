-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 10, 2020 at 08:06 AM
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
  `booking_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_mobile` varchar(8) NOT NULL,
  `customer_name` varchar(64) DEFAULT NULL,
  `provider_mobile` varchar(8) NOT NULL,
  `provider_name` varchar(128) DEFAULT NULL,
  `provider_service` varchar(128) NOT NULL,
  `booking_time` varchar(5) NOT NULL,
  `booking_date` varchar(10) NOT NULL,
  `booking_price` double(5,2) NOT NULL,
  `booking_status` int(1) DEFAULT NULL,
  `booking_payment_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=50000041 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `customer_mobile`, `customer_name`, `provider_mobile`, `provider_name`, `provider_service`, `booking_time`, `booking_date`, `booking_price`, `booking_status`, `booking_payment_status`) VALUES
(50000018, '91239123', 'Nic', '1', 'Agnes Lam', 'Feeding', '18:00', 'fri', 45.00, 0, 1),
(50000019, '91239123', 'Nic', '2', 'Nicolas Wijaya', 'Strumming', '19:00', 'fri', 35.67, 1, 1),
(50000020, '91239123', 'Nic', '2', 'Nicolas Wijaya', '2', '16:20', 'tue', 16.20, 1, 1),
(50000021, '91239123', 'Agnes', '3', 'Chantel', 'Boy Breaker', '18:38', 'tue', 99.99, 1, 1),
(50000022, '91239123', 'Yi Yi ', '5', 'Pei Yi', 'Girlfriend Service', '18:47', 'sun', 18.47, 0, 1),
(50000023, '91239123', 'M M ', '4', 'Ming Miao', 'Stress', '18:42', 'mon', 18.42, 0, 1),
(50000024, '91239123', 'Nic', '2', 'Nicolas Wijaya', 'Fingerstyle', '16:21', 'tue', 16.21, 1, 1),
(50000025, '91239123', 'Nic', '2', 'Nicolas Wijaya', 'Er Hu', '18:06', 'tue', 18.06, 1, 1),
(50000026, '91239123', 'Nic', '2', 'Nicolas Wijaya', 'Strumming', '19:00', 'fri', 35.67, 1, 1),
(50000027, '91239123', 'Agnes', '3', 'Chantel', 'Disappoint Boys', '18:41', 'tue', 18.41, 0, 1),
(50000028, '91239123', 'Nic', '2', 'Nicolas Wijaya', 'Fingerstyle', '16:21', 'tue', 16.21, 1, 1),
(50000029, '91239123', 'Agnes', '3', 'Chantel', 'Disappoint Boys', '18:41', 'tue', 18.41, 0, 1),
(50000030, '91239123', '91239123', '5', 'Pei Yi', 'Girlfriend Service', '18:47', 'sun', 18.47, 0, 0),
(50000031, '91239123', '91239123', '3', 'Chantel', 'Disappoint Boys', '18:41', 'tue', 18.41, 0, 0),
(50000032, '91239123', '91239123', '3', 'Chantel', 'Boy Breaker', '18:38', 'tue', 99.99, 0, 0),
(50000033, '91239123', '91239123', '1', 'Agnes Lam', 'Feeding', '18:00', 'fri', 45.00, 0, 0),
(50000034, '91239123', '91239123', '4', 'Ming Miao', 'Stress', '18:42', 'mon', 18.42, 0, 0),
(50000035, '91239123', '91239123', '2', 'Nic Pet Services', 'Grooming', '19:00', 'fri', 35.67, 0, 0),
(50000036, '91239123', '91239123', '2', 'Nic Pet Services', 'Grooming', '19:00', 'fri', 35.67, 1, 1),
(50000037, '91239123', '91239123', '3', 'Nalgene Furs', 'Ear Cleaning', '18:38', 'tue', 99.99, 1, 1),
(50000038, '91239123', '91239123', '3', 'Nalgene Furs', 'Clipping & filing nails', '18:41', 'tue', 18.41, 1, 1),
(50000039, '91239123', '91239123', '4', 'Champion Pets', 'Brush teeth (Doesn', '18:42', 'mon', 18.42, 1, 0),
(50000040, '91239123', 'Super User', '5', 'Kingkong Dog Services', 'Paw hair trimming', '18:47', 'sun', 18.47, 0, 1);
--
-- Database: `g7t3_payment`
--
CREATE DATABASE IF NOT EXISTS `g7t3_payment` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `g7t3_payment`;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `booking_price` int(11) NOT NULL,
  `provider_mobile` int(11) DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `booking_id`, `booking_price`, `provider_mobile`) VALUES
(50000001, 50000001, 36, 2),
(50000003, 50000003, 45, 1),
(50000004, 50000004, 36, 2),
(50000005, 50000005, 17, 2),
(50000006, 50000006, 18, 2),
(50000007, 50000007, 45, 2),
(50000010, 50000010, 45, 2),
(50000011, 50000011, 16, 2),
(50000012, 50000012, 45, 2),
(50000013, 50000013, 18, 2),
(50000014, 50000014, 36, 2),
(50000015, 50000015, 100, 2),
(50000016, 50000016, 18, 2),
(50000017, 50000017, 18, 2),
(50000018, 50000018, 45, 2),
(50000019, 50000019, 36, 2),
(50000020, 50000020, 16, 2),
(50000036, 50000036, 36, 2),
(50000037, 50000037, 100, 3),
(50000038, 50000038, 18, 3),
(50000040, 50000040, 18, 5);
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
  `booking_id` int(11) NOT NULL,
  `review_star` int(11) NOT NULL,
  `review_comment` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`booking_id`, `review_star`, `review_comment`) VALUES
(50000036, 1, 'Good Service'),
(50000038, 5, 'Good Service Provided.'),
(50000039, 1, 'Bad Service');
--
-- Database: `g7t3_serviceprovidertrial`
--
CREATE DATABASE IF NOT EXISTS `g7t3_serviceprovidertrial` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `g7t3_serviceprovidertrial`;

-- --------------------------------------------------------

--
-- Table structure for table `serviceprovider_trial`
--

DROP TABLE IF EXISTS `serviceprovider_trial`;
CREATE TABLE IF NOT EXISTS `serviceprovider_trial` (
  `provider_mobile` varchar(8) NOT NULL COMMENT 'Serial number for the service provider.',
  `provider_name` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  `provider_price` decimal(10,2) NOT NULL,
  `provider_time` varchar(5) NOT NULL,
  `provider_day` varchar(3) NOT NULL,
  `provider_service` varchar(128) CHARACTER SET utf8mb4 NOT NULL,
  PRIMARY KEY (`provider_mobile`,`provider_service`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serviceprovider_trial`
--

INSERT INTO `serviceprovider_trial` (`provider_mobile`, `provider_name`, `provider_price`, `provider_time`, `provider_day`, `provider_service`) VALUES
('1', 'Fyfy\'s Love Pet Services', '45.00', '18:00', 'fri', 'Feeding'),
('2', 'Nic Pet Services', '35.67', '19:00', 'fri', 'Grooming'),
('2', 'Nic Pet Services', '16.20', '16:20', 'tue', 'Body Wiping'),
('2', 'Nic Pet Services', '16.21', '16:21', 'tue', 'Hair Brushing'),
('2', 'Nic Pet Services', '17.41', '17:41', 'wed', 'Mind Simulation Exercises'),
('2', 'Nic Pet Services', '17.44', '17:44', 'thu', 'Ear Hair Removal'),
('3', 'Nalgene Furs', '99.99', '18:38', 'tue', 'Ear Cleaning'),
('2', 'Nic Pet Services', '18.06', '18:06', 'tue', 'Shave underparts hair'),
('3', 'Nalgene Furs', '18.41', '18:41', 'tue', 'Clipping & filing nails'),
('4', 'Champion Pets', '18.42', '18:42', 'mon', 'Brush teeth (Doesn\'t apply to aggressive dogs)'),
('5', 'Kingkong Dog Services', '18.47', '18:47', 'sun', 'Paw hair trimming'),
('4', 'Champion Pets', '1.28', '01:28', 'sun', 'Washing'),
('5', 'Kingkong Dog Services', '1.32', '01:32', 'fri', 'grooming');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
