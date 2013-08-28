-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 31, 2013 at 08:40
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
  PRIMARY KEY (`categoryID`),
  KEY `categoryID` (`categoryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `categoryName`, `parentID`) VALUES
(5, 'uygun', 20),
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
(19, 'basdbacb', NULL),
(20, 'uyfguhyjgyuh', 5);

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
('37c16af99588e913b4d09fc75ed8cec3', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.72 Safari/537.36', 1375295697, 'a:8:{s:9:"user_data";s:0:"";s:6:"userID";s:1:"1";s:9:"userEmail";s:24:"mehmet.uygun@hotmail.com";s:13:"userFirstName";s:6:"Mehmet";s:12:"userLastName";s:5:"Uygun";s:12:"userFullName";s:12:"Mehmet Uygun";s:4:"role";s:1:"1";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturer`
--

CREATE TABLE IF NOT EXISTS `manufacturer` (
  `manufacturerID` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturerName` varchar(45) NOT NULL,
  PRIMARY KEY (`manufacturerID`),
  KEY `manufacturerID` (`manufacturerID`)
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
(16, 'aqweqqweqwqqwqweweeqqweqwe'),
(17, 'poac'),
(18, 'poacm'),
(19, 'poacmkm');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
 `productID` int(11) NOT NULL AUTO_INCREMENT,
 `productName` varchar(75) NOT NULL,
 `productDescription` text,
 `productStatus` tinyint(1) NOT NULL DEFAULT '0',
 `productAddedDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
 `productUpdatedDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
 `productPrice` double(11,2) NOT NULL DEFAULT '0.00',
 `manufacturerID` varchar(11) DEFAULT NULL,
 `categoryID` varchar(11) DEFAULT NULL,
 `defaultImage` int(11) DEFAULT NULL,
 PRIMARY KEY (`productID`),
 KEY `manufacturerID` (`manufacturerID`),
 KEY `categoryID` (`categoryID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `productName`, `productDescription`, `productStatus`, `productAddedDate`, `productPrice`, `manufacturerID`, `categoryID`) VALUES
(1, 'test product', NULL, NULL, '2013-07-28 19:14:17', NULL, '', ''),
(2, 'test productq', NULL, NULL, '2013-07-28 19:14:41', NULL, '', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `imageID` int(11) NOT NULL AUTO_INCREMENT,
  `imageFullName` varchar(25) NOT NULL,
  `imageOriginal` varchar(255) NOT NULL,
  `size_64` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `size_135` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `size_200` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `size_300` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `size_500` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`imageID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `object_image`
--

CREATE TABLE IF NOT EXISTS `object_image` (
  `imageID` int(11) NOT NULL,
  `objectType` enum('product','user','manufacturer','category') CHARACTER SET latin1 NOT NULL,
  `objectID` int(11) NOT NULL,
  KEY `object` (`objectType`,`objectID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `payment_id` int(10) unsigned NOT NULL DEFAULT '0',
  `total_price` float NOT NULL DEFAULT '0',
  `shipping_address` int(10) unsigned NOT NULL,
  `billing_address` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `gateway_ref` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
