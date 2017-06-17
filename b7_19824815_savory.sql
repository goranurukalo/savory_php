-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: sql104.byethost7.com
-- Generation Time: Jun 17, 2017 at 07:48 AM
-- Server version: 5.6.35-81.0
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `b7_19824815_savory`
--

-- --------------------------------------------------------

--
-- Table structure for table `dish`
--

CREATE TABLE IF NOT EXISTS `dish` (
  `dishID` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `imgLink` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imgAlt` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`dishID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `dish`
--

INSERT INTO `dish` (`dishID`, `name`, `description`, `price`, `imgLink`, `imgAlt`) VALUES
(4, '"BEEF FILLET "MADERA"', 'Beef Tournedos served with Madera Sauce, Chicken Liver and Mushrooms', 19.9, 'images/dish/1489008671img_1.jpg', 'Beef Tournedos'),
(6, 'CHEESE AND GARLIC TOAST', 'Veal Sauteed with Fresh Peppers, Tomato and Onions', 20.9, 'images/dish/1489009083img_2.jpg', 'Veal Sauteed'),
(7, 'GRILLED CHIKEN SALAD', 'Chicken Escalope stuffed with "Kajmak" Milk Cream', 9.99, 'images/dish/1489009140img_3.jpg', 'Chicken Escalope'),
(8, 'ORGANIC EGG', 'Egg with chees on top', 12.9, 'images/dish/1489009279img_4.jpg', 'Egg'),
(9, 'TOMATO SOUP WITH CHICKEN', 'Salmon, tuna, sea bass, prawns', 23.9, 'images/dish/1489009399img_5.jpg', 'Salmon Chicken'),
(10, 'SALAD WITH CRISPY CHICKEN', 'Tempura shrimp, avocado, cucumber - 6 pcs', 5.99, 'images/dish/1489009453img_6.jpg', 'avocado, cucumber');

-- --------------------------------------------------------

--
-- Table structure for table `meni`
--

CREATE TABLE IF NOT EXISTS `meni` (
  `meniID` int(10) NOT NULL AUTO_INCREMENT,
  `meni` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meniLink` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`meniID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `meni`
--

INSERT INTO `meni` (`meniID`, `meni`, `meniLink`) VALUES
(1, 'Menu', 'menu'),
(2, 'Services', 'services'),
(3, 'Contact', 'contact');

-- --------------------------------------------------------

--
-- Table structure for table `pollanswer`
--

CREATE TABLE IF NOT EXISTS `pollanswer` (
  `pollAnswerID` int(4) NOT NULL AUTO_INCREMENT,
  `pollAnswer` varchar(127) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pollQuestionID` int(4) NOT NULL,
  `vote` int(10) NOT NULL,
  PRIMARY KEY (`pollAnswerID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=25 ;

--
-- Dumping data for table `pollanswer`
--

INSERT INTO `pollanswer` (`pollAnswerID`, `pollAnswer`, `pollQuestionID`, `vote`) VALUES
(1, 'Yes', 1, 5),
(2, 'Maybe', 1, 3),
(21, 'No', 1, 2),
(22, 'Da', 3, 2),
(23, 'Da', 3, 0),
(24, 'Da', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pollquestion`
--

CREATE TABLE IF NOT EXISTS `pollquestion` (
  `pollQuestionID` int(2) NOT NULL AUTO_INCREMENT,
  `pollQuestion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `onOff` int(1) NOT NULL,
  PRIMARY KEY (`pollQuestionID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pollquestion`
--

INSERT INTO `pollquestion` (`pollQuestionID`, `pollQuestion`, `onOff`) VALUES
(1, 'Do you like our restaurant?', 1),
(3, 'Da li volite Gorana', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pollvote`
--

CREATE TABLE IF NOT EXISTS `pollvote` (
  `pollVoteID` int(10) NOT NULL AUTO_INCREMENT,
  `pollQuestionID` int(4) NOT NULL,
  `pollAnswerID` int(4) NOT NULL,
  `ipAddress` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`pollVoteID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `pollvote`
--

INSERT INTO `pollvote` (`pollVoteID`, `pollQuestionID`, `pollAnswerID`, `ipAddress`) VALUES
(8, 1, 1, '::1'),
(12, 3, 22, '::1'),
(13, 1, 2, '79.101.184.101'),
(14, 1, 2, '178.221.185.239'),
(15, 1, 21, '109.122.124.202'),
(16, 1, 2, '178.220.212.108'),
(17, 1, 1, '178.220.205.11'),
(18, 3, 22, '178.220.205.11'),
(19, 3, 24, '178.220.213.24'),
(20, 1, 1, '109.245.34.167');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `reservationID` int(15) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `reservationTime` int(12) NOT NULL,
  `numberOfPersons` int(1) NOT NULL,
  `reservationStatus` int(1) NOT NULL,
  PRIMARY KEY (`reservationID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reservationhistory`
--

CREATE TABLE IF NOT EXISTS `reservationhistory` (
  `resHistoryID` int(15) NOT NULL AUTO_INCREMENT,
  `userID` int(10) NOT NULL,
  `reservationTime` int(12) NOT NULL,
  `numberOfPersons` int(1) NOT NULL,
  `reservationStatus` int(1) NOT NULL,
  PRIMARY KEY (`resHistoryID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `reservationhistory`
--

INSERT INTO `reservationhistory` (`resHistoryID`, `userID`, `reservationTime`, `numberOfPersons`, `reservationStatus`) VALUES
(1, 2, 1486302400, 3, 1),
(2, 2, 1488221700, 2, 1),
(3, 2, 1488483780, 2, 1),
(4, 2, 1479757200, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `roleID` int(2) NOT NULL AUTO_INCREMENT,
  `role` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`roleID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`roleID`, `role`) VALUES
(1, 'Admin'),
(2, 'Customer'),
(3, 'Supplier'),
(4, 'Cook'),
(5, 'Barman'),
(6, 'Director');

-- --------------------------------------------------------

--
-- Table structure for table `standardsupplies`
--

CREATE TABLE IF NOT EXISTS `standardsupplies` (
  `supplieID` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(5) NOT NULL,
  `measure` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`supplieID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `standardsupplies`
--

INSERT INTO `standardsupplies` (`supplieID`, `name`, `quantity`, `measure`) VALUES
(1, 'pork', 2, 'kg'),
(2, 'chicken', 3, 'kg'),
(3, 'salad', 4, 'kg'),
(4, 'potato', 2, 'kg'),
(5, 'tomatos', 1, 'kg'),
(6, 'pasta', 3, 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `statusID` int(2) NOT NULL AUTO_INCREMENT,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`statusID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`statusID`, `status`) VALUES
(1, 'Verified'),
(2, 'Banned'),
(3, 'Waiting'),
(4, 'Deleted');

-- --------------------------------------------------------

--
-- Table structure for table `supplie`
--

CREATE TABLE IF NOT EXISTS `supplie` (
  `supplieID` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(5) NOT NULL,
  `date` int(12) NOT NULL,
  `userID` int(15) NOT NULL,
  `measure` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`supplieID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=33 ;

--
-- Dumping data for table `supplie`
--

INSERT INTO `supplie` (`supplieID`, `name`, `quantity`, `date`, `userID`, `measure`) VALUES
(1, 'pork', 2, 1488626745, 3, 'kg'),
(2, 'Voda Rosa', 50, 1488618600, 6, '0.5l'),
(3, 'Vodka', 2, 1488569162, 6, 'l'),
(4, 'Jack Daniels', 1, 1488570783, 6, 'l'),
(7, 'Sugar', 10, 1488623894, 3, 'kg'),
(10, 'chicken', 3, 1488626771, 3, 'kg'),
(11, 'salad', 4, 1488626771, 3, 'kg'),
(12, 'potato', 2, 1488626771, 3, 'kg'),
(13, 'tomatos', 1, 1488626771, 3, 'kg'),
(14, 'pasta', 3, 1488626771, 3, 'kg'),
(15, 'asgag', 23, 1488829961, 3, 'g'),
(16, 'pork', 2, 1489937528, 8, 'kg'),
(17, 'chicken', 3, 1489937528, 8, 'kg'),
(18, 'salad', 4, 1489937528, 8, 'kg'),
(19, 'potato', 2, 1489937528, 8, 'kg'),
(20, 'tomatos', 1, 1489937528, 8, 'kg'),
(21, 'pasta', 3, 1489937528, 8, 'kg'),
(22, 'Novi', 2, 1489937544, 8, '2kg'),
(23, 'Asdas', 2, 1489937576, 8, '1kg'),
(24, 'Novi', 2, 1489937591, 8, 'kg'),
(25, 'pork', 2, 1489937781, 8, 'kg'),
(26, 'chicken', 3, 1489937781, 8, 'kg'),
(27, 'salad', 4, 1489937781, 8, 'kg'),
(28, 'potato', 2, 1489937781, 8, 'kg'),
(29, 'tomatos', 1, 1489937781, 8, 'kg'),
(30, 'pasta', 3, 1489937781, 8, 'kg'),
(31, 'pera', 2, 1490027349, 8, 'kg'),
(32, 'Pera', 2, 1490027374, 8, 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `suppliehistory`
--

CREATE TABLE IF NOT EXISTS `suppliehistory` (
  `supplieID` int(15) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(5) NOT NULL,
  `date` int(12) NOT NULL,
  `userID` int(15) NOT NULL,
  `measure` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`supplieID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `suppliehistory`
--

INSERT INTO `suppliehistory` (`supplieID`, `name`, `quantity`, `date`, `userID`, `measure`) VALUES
(1, 'brasno', 50, 1488618000, 3, 'kg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `userID` int(10) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roleID` int(2) NOT NULL,
  `timeOfReg` int(12) NOT NULL,
  `validationCode` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statusID` int(2) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `firstName`, `lastName`, `email`, `password`, `roleID`, `timeOfReg`, `validationCode`, `statusID`) VALUES
(1, 'Goran', 'Urukalo', 'dev@dev.com', '2923811288d14ae620699230d3f78629', 1, 1487882736, 'GoranGoranGoranGoran', 1),
(2, 'Petar', 'Petrovic', 'petar.petrovic@gmail.com', 'f497078583ccdf07fcb8f248c3ae056b', 2, 1488021083, 'WjRCfjA8HTvfBvz2R1nE', 1),
(3, 'Glavni', 'Kuvar', 'glavni.kuvar@savory.com', '73682a4015860abd5a2c7c4c5bbfa5c5', 4, 1488382252, '0X18U2YYtwgd18Az1054', 1),
(4, 'Glavni', 'Admin', 'glavni.admin@savory.com', '727344d1d12b8355c0ca2f9f25174305', 1, 1488382281, 'jAkE7QmrUaN4W6KW2BN4', 1),
(5, 'Glavni', 'Nabaljivac', 'glavni.nabavljivac@savory.com', '628b372d052fbd8e52ec4f36fa3ada71', 3, 1488382317, 'E80m2F2U6E5t94nJ0sk6', 1),
(6, 'Glavni', 'Barman', 'glavni.barman@savory.com', 'e877fa94331ed2e0d7d0a23c29df6e02', 5, 1488564490, '9F8l3e48iLqxwdb29414', 1),
(7, 'Goran', 'Urukalo', 'goran@urukalo.com', '75c641625c4b101ee9659ffe7e54ec30', 6, 1488817142, 'rIV2U5UGDnSbXKKFtv1d', 1),
(8, 'Nikola', 'Mihajlovic', 'nikola.mihajlovic@ict.edu.rs', '61a4992422b8b204a97a510c3b32be1a', 6, 1489080692, 'OXlm5oe3chkb4mX8KOVW', 1),
(9, 'Petar', 'Pera', 'pera@gmail.com', 'a9f3f17fb5b52c7cec5cc11214a718f8', 2, 1489937341, 'qUw7H040F1gKyryNrpYW', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
