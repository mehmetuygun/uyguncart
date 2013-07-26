-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 26, 2013 at 09:29 
-- Server version: 5.6.10
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `uyguncart`
--
CREATE DATABASE `uyguncart` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `uyguncart`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(45) NOT NULL,
  `parentID` int(11) DEFAULT NULL,
  PRIMARY KEY (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `parentID`) VALUES
(5, 'uygun', 6),
(6, 'asdasdasds', NULL),
(10, 'easdasd', NULL),
(11, 'easdaasdasd', NULL),
(12, 'easda', NULL),
(13, 'easdaasd', NULL),
(14, 'easdn', NULL),
(15, 'asdasda', NULL),
(16, 'asdasdab', NULL),
(17, 'basdasdb', NULL),
(18, 'basdbac', NULL),
(19, 'basdbacb', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('5b4517e0350cf5ab4f8bfcf72de5c398', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:23.0) Gecko/20100101 Firefox/23.0', 1374700935, 'a:8:{s:9:"user_data";s:0:"";s:6:"userID";s:1:"1";s:9:"userEmail";s:24:"mehmet.uygun@hotmail.com";s:13:"userFirstName";s:6:"Mehmet";s:12:"userLastName";s:5:"Uygun";s:12:"userFullName";s:12:"Mehmet Uygun";s:4:"role";s:1:"1";s:9:"logged_in";b:1;}'),
('8e140a16424af73904caaa9195f27236', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1374694675, 'a:8:{s:9:"user_data";s:0:"";s:6:"userID";s:1:"1";s:9:"userEmail";s:24:"mehmet.uygun@hotmail.com";s:13:"userFirstName";s:6:"Mehmet";s:12:"userLastName";s:5:"Uygun";s:12:"userFullName";s:12:"Mehmet Uygun";s:4:"role";s:1:"1";s:9:"logged_in";b:1;}'),
('fc687c2c4b5ca6e4b49d0990d0033176', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1374857667, 'a:7:{s:6:"userID";s:1:"1";s:9:"userEmail";s:24:"mehmet.uygun@hotmail.com";s:13:"userFirstName";s:6:"Mehmet";s:12:"userLastName";s:5:"Uygun";s:12:"userFullName";s:12:"Mehmet Uygun";s:4:"role";s:1:"1";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturerID` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturerName` varchar(45) NOT NULL,
  PRIMARY KEY (`manufacturerID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `manufacturer`
--

INSERT INTO `manufacturer` (`manufacturerID`, `manufacturerName`) VALUES
(2, 'asdasd'),
(3, 'casdasd'),
(4, 'asdiacn'),
(6, 'asdasdasda'),
(7, 'aqweqweqwe'),
(8, 'testt'),
(10, 'aqweqqwqqwe'),
(14, 'aqweqqweqwqweeqqweqwe'),
(15, 'aqweqqweqwqqweweeqqweqwe'),
(16, 'aqweqqweqwqqwqweweeqqweqwe'),
(17, 'poac'),
(18, 'poacm'),
(19, 'poacmkm');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `productID` int(11) NOT NULL,
  `productName` varchar(75) NOT NULL,
  `productDescription` text NOT NULL,
  `productStatus` tinyint(1) NOT NULL,
  `productAddedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `productPrize` double(11,2) NOT NULL,
  PRIMARY KEY (`productID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userFirstName` varchar(45) NOT NULL,
  `userLastName` varchar(45) NOT NULL,
  `userEmail` varchar(75) NOT NULL,
  `userPassword` varchar(64) NOT NULL,
  `userType` char(1) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `userFirstName`, `userLastName`, `userEmail`, `userPassword`, `userType`) VALUES
(1, 'Mehmet', 'Uygun', 'mehmet.uygun@hotmail.com', '12345678', '1');
