-- phpMyAdmin SQL Dump
-- version 4.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 26, 2013 at 12:30 PM
-- Server version: 5.5.33-0+wheezy1
-- PHP Version: 5.4.4-14+deb7u7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `donneurSang`
--

-- --------------------------------------------------------

--
-- Table structure for table `donneur`
--

CREATE TABLE IF NOT EXISTS `donneur` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `age` int(2) unsigned NOT NULL,
  `gender` varchar(5) NOT NULL,
  `address` varchar(512) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `date_donation` date DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `postal_code` varchar(16) DEFAULT NULL,
  `groupe_sangun` varchar(10) NOT NULL,
  `vehicle` varchar(8) DEFAULT 'Non',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `donneur`
--

INSERT INTO `donneur` (`id`, `first_name`, `last_name`, `age`, `gender`, `address`, `phone`, `date_donation`, `email`, `postal_code`, `groupe_sangun`, `vehicle`) VALUES
(14, 'CHEBOUB', 'Abdelatif', 23, 'M', 'zeboudja center hai enasser, chlef', '0771952635', NULL, 'abdelatif02@hotmail.com', NULL, 'A+', 'Non'),
(15, 'GHIBOUB', 'Khalid', 21, 'M', 'zeboudja center', '0699909501', NULL, 'ak_ghiboub@esi.dz', NULL, 'A+', 'Non'),
(16, 'BEKHTAOUI', 'Ismail', 22, 'M', 'zeboudja', '0696251478', NULL, 'ak_ghiboub@hotmail.co.uk', NULL, 'AB+', 'Non'),
(17, 'BENZIANE', 'Oussama', 22, 'M', 'zeboudja', '0791265487', '2013-12-26', 'd@sdcfds.com', NULL, 'B-', 'Oui'),
(18, 'khalid', 'ghiobu', 30, 'M', 'sldjflsdfkjdsl', '65465465', '2013-12-25', 'ak_ghiboub@hotmail.co.uk', NULL, 'O+', 'Non'),
(19, 'oussama', 'ghiobu', 22, 'M', 'smlkdsmk mslkdfmk', '2154854454', '2013-12-25', 'ak_ghiboub@es.dz', NULL, 'O+', 'Oui'),
(20, 'sddsdf', 'sdfgsd', 30, 'M', 'dfgdfg', 'dfgfd', '2013-12-16', 'd@sdcfds.com', NULL, 'O+', 'Non'),
(21, 'dflklk', 'mlmlkmlk', 30, 'M', 'mlkmlkmlk', 'mlkmlkmlk', '2013-12-25', 'd@sdcfds.com', NULL, 'O+', 'Non');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(512) NOT NULL,
  `firt_name` varchar(128) DEFAULT NULL,
  `last_name` varchar(128) DEFAULT NULL,
  `isActivated` tinyint(1) NOT NULL DEFAULT '0',
  `isAdministrator` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `firt_name`, `last_name`, `isActivated`, `isAdministrator`) VALUES
(12, 'root', '$6$iLCY9zEy6gjR$t5WMMlC4q6Qn6gFp0mGioLXyRR33Sq.y/ENlyha2TRjYXPNqKmGcQUeEwY22UqjhaB5iPnQgLV7a/k5SlFU6t.', 'ak_ghiboub@esi.dz', 'khalid', 'ghiboub', 1, 1),
(20, 'test', '$6$mExliISoa2XT$r7kJoRnqo6ZwgHfBivdG4j58gNfysy5lycEP9at8.av4FwIdEWPbpjVwFb1BoTA1.HZDqYQ9/nEYY5wPeb5Os/', 'test@test.test', 'test', 'test', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
