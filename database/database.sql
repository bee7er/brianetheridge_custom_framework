-- ***************************************************************************
-- ************ DO NOT DELETE THIS COMMENT BLOCK AT ANYTIME ******************
-- ***************************************************************************
-- ********************** How to use this file *******************************
-- ***************************************************************************
-- This file should have all the database changes (structure and data) in SQL
-- format. This SQL will then be executed on the live database as part of the
-- release process. After that this file will be emptied, and can be used to
-- add fresh SQL for the next release.
-- ***************************************************************************

-- ************************************
-- ADD YOUR SQL FROM THIS POINT ONWARDS
-- ************************************
-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2012 at 10:02 AM
-- Server version: 5.5.24-0ubuntu0.12.04.1
-- PHP Version: 5.3.10-1ubuntu3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `etheridgeb_ccgen_qcf_live`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_role_id` int(10) NOT NULL DEFAULT '0',
  `first_name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email_id` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `account_status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_role_id`, `first_name`, `surname`, `email_id`, `password`, `account_status`, `created_on`, `updated_on`) VALUES
(1, 1, 'Brian', 'Etheridge', 'betheridge@gmail.com', 'd3ee0e4a900ee910c70470feb1205fc8', 'active', '2012-11-01 11:20:00', '0000-00-00 00:00:00'),
(2, 2, 'Barry', 'Fiddlestone', 'betheridge+1@gmail.com', 'd3ee0e4a900ee910c70470feb1205fc8', 'active', '2012-11-01 11:20:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `options_mask` int(10) unsigned NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`user_role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `title`, `options_mask`, `created_on`, `updated_on`) VALUES
(1, 'Administrator', 2, '2012-11-01 11:20:00', '0000-00-00 00:00:00');
(2, 'Clinician', 1, '2012-11-01 11:20:00', '0000-00-00 00:00:00');