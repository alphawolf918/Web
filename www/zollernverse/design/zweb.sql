-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2015 at 05:00 PM
-- Server version: 5.6.17
-- PHP Version: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zweb`
--
CREATE DATABASE IF NOT EXISTS `zweb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `zweb`;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--
-- Creation: May 26, 2015 at 08:06 PM
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `message`) VALUES
(1, 'bob', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--
-- Creation: May 26, 2015 at 07:09 PM
--

DROP TABLE IF EXISTS `sites`;
CREATE TABLE IF NOT EXISTS `sites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL DEFAULT 'Web Site',
  `s1` text NOT NULL,
  `s2` text NOT NULL,
  `url` text NOT NULL,
  `about` text NOT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `name`, `s1`, `s2`, `url`, `about`, `added`) VALUES
(1, 'GIGA Inc. (LAN)', 'giga/lan/giga1.png', 'giga/lan/giga2.png', '#', 'This is an Intranet web site that I developed for GIGA Inc., designed to work only on their IIS 7.5 LAN, and hosted by their domain (which is why there''s no Live Link for this entry). It features clocking in and out, calendar events, time cards, groups, departments, and documentation. It was meant to digitize certain aspects of the company.', '2015-05-26 20:48:14'),
(2, 'GIGA Inc. (Main)', 'giga/main/giga1.png', 'giga/main/giga2.png', 'http://www.gigainc.com', 'This is GIGA Inc.''s main web site, completely renovated by yours truly, using Joomla! 2.5 and modifying the source code of the templates, as well as tweaking the settings. I was able to directly modify the source code of the templates to meet the company''s needs, without having to keep changing which one I was using. I was able to do something for them that no one else knew how to do.', '2015-05-26 20:58:31'),
(3, 'GIGA Inc. (Survey)', 'giga/survey/giga1.png', 'giga/survey/giga2.png', '#', 'This is a survey page I created for them using a piece of paper as a reference.', '2015-05-27 15:02:55');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
