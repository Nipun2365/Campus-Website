-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 01, 2024 at 11:55 AM
-- Server version: 8.2.0
-- PHP Version: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_prop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(1, 'admin@gmail.com', '$2a$12$tOmwugh6vsfB/TmTjJ6NyeC1iGwpS9F3atFtqSQe3814/UFjsTtN.');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pid` int NOT NULL,
  `uid` int NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(20) NOT NULL,
  `message` varchar(199) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) NOT NULL,
  `squarefeet` int NOT NULL,
  `nobeds` int NOT NULL,
  `nobathrooms` int NOT NULL,
  `price` int NOT NULL,
  `image` varchar(200) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `ownerID` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `name`, `address`, `squarefeet`, `nobeds`, `nobathrooms`, `price`, `image`, `latitude`, `longitude`, `status`, `ownerID`) VALUES
(1, 'Luxury Villa', '29A Thalagala Road, Pitipana, Homagama.   Tel: 0774915064', 300, 4, 4, 45000, 'ac.jpg', '6.799246796255356', '80.03908385578585', 'Approved', 1),
(2, 'Brick House', '27/2  Meegoda, Homagama. Tel: 0773515314', 1200, 3, 2, 12000, 'header3.jpg', '6.819147935179479', '80.03527708053022', 'Approved', 0),
(3, 'Luxury Home Upscale', '27/2 School junction, Thalagala Rd, Homagama. Tel: 0773515314', 500, 1, 1, 12500, 'he.jpg', '6.819147935179479', '80.03527708053022', 'Approved', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `contact` varchar(16) NOT NULL,
  `userType` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `contact`, `userType`, `password`) VALUES
(1, 'demo', 'demo10', 'demo10@gmail.com', '123456789', '', '$2y$10$yxZJ0hmtCGUIomjmt4VKqedwrw.5BYIdl.XJpI0fsBdsNM7jdtVa.'),
(2, 'chamu', 'chamu', 'chamu@gmail.com', '0774915064', 'Landlord', '$2y$10$sgNzpwsu6kN6Ibp7XHi7ve9OlCHlSvovPOJCNCgpwNINa0JQTVpUe'),
(3, 'Nimesh Nipun', 'Nimesh10', 'Nimesh10@gmail.com', '123456789', 'Landlord', '$2y$10$yvixb/kq2mWRcWD5qQoF2uUGZ4sQalgDXF4Mq/6njqdphpJyriPWW');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
