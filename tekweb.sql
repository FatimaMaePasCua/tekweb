-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 30, 2018 at 03:56 AM
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
-- Database: `tekweb`
--
CREATE DATABASE IF NOT EXISTS `tekweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tekweb`;

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
CREATE TABLE IF NOT EXISTS `announcements` (
  `annID` int(11) NOT NULL AUTO_INCREMENT,
  `subj` varchar(250) NOT NULL,
  `announcement` text NOT NULL,
  `dateOfValidity` date NOT NULL,
  `classID` int(11) NOT NULL,
  PRIMARY KEY (`annID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

DROP TABLE IF EXISTS `assignments`;
CREATE TABLE IF NOT EXISTS `assignments` (
  `assignID` int(11) NOT NULL AUTO_INCREMENT,
  `dateUploaded` date NOT NULL,
  `dateOfSubmission` date NOT NULL,
  `filename` varchar(150) NOT NULL,
  `assignNumber` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'ongoing',
  `classID` int(11) NOT NULL,
  PRIMARY KEY (`assignID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `classID` int(11) NOT NULL AUTO_INCREMENT,
  `classCode` varchar(100) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `genCode` varchar(250) NOT NULL,
  `studentCount` int(3) NOT NULL DEFAULT '0',
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`classID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `deptID` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(150) NOT NULL,
  PRIMARY KEY (`deptID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `gradesID` int(11) NOT NULL AUTO_INCREMENT,
  `Preliminary` varchar(100) DEFAULT NULL,
  `Midterms` varchar(100) DEFAULT NULL,
  `Finals` varchar(100) DEFAULT NULL,
  `classID` int(11) NOT NULL,
  PRIMARY KEY (`gradesID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

DROP TABLE IF EXISTS `invitations`;
CREATE TABLE IF NOT EXISTS `invitations` (
  `invtnID` int(11) NOT NULL AUTO_INCREMENT,
  `studentID` int(11) NOT NULL,
  `classID` int(11) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`invtnID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentclasses`
--

DROP TABLE IF EXISTS `studentclasses`;
CREATE TABLE IF NOT EXISTS `studentclasses` (
  `regstdID` int(11) NOT NULL AUTO_INCREMENT,
  `classID` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `studentID` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`regstdID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `subID` int(11) NOT NULL AUTO_INCREMENT,
  `assignID` int(11) NOT NULL,
  `studentID` int(11) NOT NULL,
  `dateSubmitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `filename` varchar(100) NOT NULL,
  PRIMARY KEY (`subID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `transID` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action` varchar(250) NOT NULL,
  `userID` int(11) NOT NULL,
  PRIMARY KEY (`transID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(45) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `idnumber` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `course` varchar(50) DEFAULT NULL,
  `year` int(1) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `firstname`, `lastname`, `idnumber`, `password`, `type`, `course`, `year`, `status`, `department`) VALUES
(1, 'admin', 'admin', 1, 'admin', 'admin', '', 0, 'active', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
