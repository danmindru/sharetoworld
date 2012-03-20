-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 20, 2012 at 01:46 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `share_to_world`
--

-- --------------------------------------------------------

--
-- Table structure for table `facebook_api`
--

DROP TABLE IF EXISTS `facebook_api`;
CREATE TABLE IF NOT EXISTS `facebook_api` (
  `facebook_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `facebook_url` varchar(255) NOT NULL,
  `facebook_clicks` int(11) NOT NULL,
  `facebook_points_per_click` int(11) NOT NULL,
  PRIMARY KEY (`facebook_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `facebook_api`
--

INSERT INTO `facebook_api` (`facebook_id`, `user_id`, `facebook_url`, `facebook_clicks`, `facebook_points_per_click`) VALUES
(1, 15, 'https://www.facebook.com/DanielRoscaPage', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `session_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_start` int(11) NOT NULL,
  `session_last_visit` int(11) NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session_id`, `user_id`, `session_start`, `session_last_visit`) VALUES
('qfj1lalfvbidubplo2anoidu41', 15, 1332233465, 1332233465);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_credits` int(11) NOT NULL DEFAULT '20',
  `user_type` enum('user','moderator','administrator') CHARACTER SET utf8 NOT NULL,
  `user_register_ip` varchar(30) NOT NULL,
  `user_last_login_ip` varchar(30) NOT NULL,
  `user_last_login_date` int(11) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_credits`, `user_type`, `user_register_ip`, `user_last_login_ip`, `user_last_login_date`) VALUES
(1, 'admin', 'admin@admin.com', '$P$BRwh5.Z5VY/PUabY8Smi0fB4lwAxdT1', 1000000, 'administrator', '127.0.0.1', '127.0.0.1', 1326797192),
(13, 'Daniel', 'daniel.rosca.xdh@gmail.com', '$P$BDn1S/yTq3JXQROCAZlbOdjvCDsIDf/', 1000000, 'user', '127.0.0.1', '127.0.0.1', 1332233341),
(14, 'sharetoworld', 'webmaster@sharetoworld.com', '$P$BFP7Cabk//7iFvO/I6kpnrdVDfdrYW0', 1000000, 'user', '127.0.0.1', '127.0.0.1', 1331903859),
(15, 'Gigel', 'gigel@yahoo.com', '$P$Bv19BLrJTVf8FU3U4IzqGRRWEjb8Rk0', 50, 'user', '127.0.0.1', '127.0.0.1', 1332233465);
