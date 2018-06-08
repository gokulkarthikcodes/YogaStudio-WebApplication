-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 19, 2017 at 08:27 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `light_yoga`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `classid` int(11) NOT NULL AUTO_INCREMENT,
  `classname` varchar(20) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`classid`),
  KEY `classidindex` (`classid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classid`, `classname`, `description`) VALUES
(4, 'Gentle Hatha Yoga', 'Intended for beginners and anyone wishing a grounded foundationin the practice of yoga, this 60 minutes class of poses and slow movement focuses on asana (proper alignement and posture), pranayama (breath work), and guided meditation to foster your mind and body connection.'),
(5, 'Vinyasa Yoga', 'Although designed for intermediate to advanced students, beginners are welcome to sample this 60 mintues class that focuses on breath-synchronized movement -- you will inhale and exhale as you flow energetically through yoga poses.'),
(6, 'Restorative Yoga', 'This 90 minutes class features very slow movement and long poses that are supported by chair or wall. This calming, restorative experience is suitable for students of any level of experience. This practice can be a perfect way to help rehabilitate an ingury.');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `clientid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`clientid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientid`, `name`, `address`, `phone`, `email`, `password`) VALUES
(1, 'Gokul', 'Arlington', '6822569955', 'gokul@gmail.com', 'Password1'),
(2, 'Karthik', 'Dallas', '6822569956', 'karthik@gmail.com', 'Password2'),
(3, 'Rajan', 'Irving', '68225699557', 'rajan@gmail.com', 'Password3'),
(4, 'Mahesh', 'FortWorth', '6822569958', 'mahesh@gmail.com', 'Password4'),
(5, 'Harish', 'Irving', '6822569959', 'harsih@gmail.com', 'Password5'),
(6, 'Annamalai', 'Bedford', '6822569960', 'annamalai@gmail.com', 'Password6'),
(7, 'Surya', 'Mansfield', '6822569961', 'surya@gmail.com', 'Password7'),
(8, 'Sriram', 'Pantego', '6822569962', 'sriram@gmail.com', 'Password8'),
(9, 'Ranjith', 'Euless', '6822569963', 'ranjith@gmail.com', 'Password9'),
(10, 'Ashok', 'Arlington', '6822569964', 'ashok@gmail.com', 'Password10'),
(11, 'Gautham', 'Dallas', '6822569965', 'gautham@gmail.com', 'Password11'),
(12, 'Ganesh', 'Irving', '6822569966', 'ganesh@gmail.com', 'Password12');

-- --------------------------------------------------------

--
-- Table structure for table `client_schedule`
--

DROP TABLE IF EXISTS `client_schedule`;
CREATE TABLE IF NOT EXISTS `client_schedule` (
  `clientid` int(11) NOT NULL,
  `timeid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `daysid` int(11) NOT NULL,
  KEY `clientid` (`clientid`),
  KEY `timeid` (`timeid`),
  KEY `classid` (`classid`),
  KEY `daysid` (`daysid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_schedule`
--

INSERT INTO `client_schedule` (`clientid`, `timeid`, `classid`, `daysid`) VALUES
(12, 1, 4, 1),
(1, 1, 4, 2),
(2, 1, 4, 3),
(3, 1, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `name` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comments` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`name`, `email`, `comments`) VALUES
('', '', ''),
('Gokul', 'gokul@gmail.com', 'Good'),
('Karthik', 'karthik@gmail.com', 'Excellent'),
('Rajan', 'rajan@gmail.com', 'Average'),
('Mahesh', 'mahesh@gmail.com', 'Bad');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE IF NOT EXISTS `days` (
  `daysid` int(11) NOT NULL AUTO_INCREMENT,
  `daysname` varchar(10) NOT NULL,
  PRIMARY KEY (`daysid`),
  KEY `daysidindex` (`daysid`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`daysid`, `daysname`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `timeid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `daysid` int(11) NOT NULL,
  KEY `timeid` (`timeid`),
  KEY `classid` (`classid`),
  KEY `daysid` (`daysid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`timeid`, `classid`, `daysid`) VALUES
(1, 4, 1),
(1, 4, 2),
(1, 4, 3),
(1, 4, 4),
(1, 4, 5),
(6, 5, 1),
(6, 5, 2),
(6, 5, 3),
(6, 5, 4),
(6, 5, 5),
(21, 6, 1),
(21, 6, 2),
(21, 6, 3),
(21, 6, 4),
(21, 6, 5),
(22, 4, 1),
(22, 4, 2),
(22, 4, 3),
(22, 4, 4),
(22, 4, 5),
(6, 4, 6),
(6, 4, 7),
(23, 5, 6),
(23, 5, 7),
(24, 4, 6),
(24, 4, 7),
(25, 6, 6),
(25, 6, 7),
(21, 6, 6),
(21, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

DROP TABLE IF EXISTS `time`;
CREATE TABLE IF NOT EXISTS `time` (
  `timeid` int(11) NOT NULL AUTO_INCREMENT,
  `time` datetime NOT NULL,
  PRIMARY KEY (`timeid`),
  KEY `timeIdIndex` (`timeid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time`
--

INSERT INTO `time` (`timeid`, `time`) VALUES
(1, '2017-11-20 09:00:00'),
(6, '2017-11-20 10:30:00'),
(21, '2017-11-20 17:30:00'),
(22, '2017-11-20 19:00:00'),
(23, '2017-11-20 12:00:00'),
(24, '2017-11-20 13:30:00'),
(25, '2017-11-20 15:00:00');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`classid`) REFERENCES `class` (`classid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`daysid`) REFERENCES `days` (`daysid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`timeid`) REFERENCES `time` (`timeid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
