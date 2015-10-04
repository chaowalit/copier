-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 16, 2014 at 04:40 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `copiers`
--
CREATE DATABASE IF NOT EXISTS `copiers` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `copiers`;

-- --------------------------------------------------------

--
-- Table structure for table `copy`
--

CREATE TABLE IF NOT EXISTS `copy` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EN` varchar(50) NOT NULL,
  `Full_Name` varchar(50) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Dept_Code` int(11) NOT NULL,
  `Login_ID` varchar(50) DEFAULT NULL,
  `Manager` varchar(50) NOT NULL,
  `Ext` int(11) NOT NULL,
  `Activity` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `copy`
--

INSERT INTO `copy` (`ID`, `EN`, `Full_Name`, `Department`, `Dept_Code`, `Login_ID`, `Manager`, `Ext`, `Activity`, `amount`, `date`) VALUES
(1, '9786167342795', 'Chaowalit k', 'IT', 1234, 'chaowalit_k', 'Santi_p', 111111111, 'Copy Color', 1, '2014-02-15'),
(2, '9786167342795', 'Chaowalit k', 'IT', 1234, 'chaowalit_k', 'Santi_p', 111111111, 'Copy Color', 1, '2014-02-15'),
(3, '9786167342795', 'Chaowalit k', 'IT', 1234, 'chaowalit_k', 'Santi_p', 111111111, 'Copy Color', 1, '2014-02-15'),
(7, '8851932283809', 'attapon_th', 'IT', 4321, 'aabbb', 'Santi_p', 74123, 'Copy Black', 1, '2014-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `EN` varchar(50) NOT NULL,
  `Full_Name` varchar(50) NOT NULL,
  `Department` varchar(50) NOT NULL,
  `Dept_code` int(11) NOT NULL,
  `Login_ID` varchar(50) NOT NULL,
  `Manager` varchar(50) NOT NULL,
  `Ext` int(11) NOT NULL,
  PRIMARY KEY (`EN`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`EN`, `Full_Name`, `Department`, `Dept_code`, `Login_ID`, `Manager`, `Ext`) VALUES
('037437', 'Sakhon Ch.', 'PCBA Manufacturing', 1455, 'th\\Sakorn_Ch', '', 0),
('163964', 'Nongnuch C.', 'PCBA Manufacturing', 1455, '', '', 0),
('101556', 'Kallaya T.', 'PCBA Manufacturing', 1455, 'th\\Kallaya_T', '', 0),
('059347', 'Parnee B.', 'PCBA Manufacturing', 1455, 'th\\Spare_center', '', 0),
('104481', 'Sarinrat_K', 'PCBA Manufacturing', 1455, 'thSpare_center', '', 0),
('064225', 'Anong T', 'PCBA Manufacturing', 1455, 'thSpare_center', '', 0),
('102280', 'Khwanchit_S', 'MFG/Training', 1585, '', 'Panya Phimphakun (Training) MANAGER', 0),
('100032', 'Supattra Sueb-in', 'MFG/Training', 1585, '', '', 0),
('065559', 'Penprapa_T', 'MFG/Training', 1585, '', '', 0),
('175971', 'Gamphol_R', 'MFG/Training', 1585, '', '', 0),
('107123', 'Jintana', 'MFG/Training', 1585, '', '', 0),
('100280', 'Doungdaw_B', 'MFG/Training', 1585, '', '', 0),
('110337', 'Sarawut_W', 'MFG/Training', 1585, '', '', 0),
('103745', 'Natthariya_S', 'MFG/Training', 1585, '', '', 0),
('133106', 'Saranya_S', 'MFG/Training', 1585, '', '', 0),
('106471', 'Temdoung_T', 'MFG/Training', 1585, '', '', 0),
('143077', 'Boonrod_K', 'MFG/Training', 1585, '', '', 0),
('138772', 'Phitsanu_B', 'MFG/Training', 1585, '', '', 0),
('125826', 'Namfon_B', 'MFG/Training', 1585, '', '', 0),
('147501', 'Naiyana_S', 'MFG/Training', 1585, '', '', 0),
('147302', 'Lamai_S', 'MFG/Training', 1585, '', '', 0),
('100811', 'Nookan_M', 'MFG/Training', 1585, '', '', 0),
('172036', 'Orasa_P', 'MFG/Training', 1585, '', '', 0),
('159685', 'Rattanaporn_A', 'MFG/Training', 1585, '', '', 0),
('104211', 'Patthamaporn_P', 'MFG/Training', 1585, '', '', 0),
('127964', 'Patipat_W', 'MFG/Training', 1585, '', '', 0),
('139792', 'Janmanee_Y', 'MFG/Training', 1585, '', '', 0),
('106503', 'Amphon_Sxxx', 'MFG/Trainingxxx', 1585, 'xxxx', 'xxxxx', 1234),
('100025', 'Wanida__P', 'MFG/Training', 1585, '', '', 0),
('117403', 'Han_K', 'MFG/Training', 1585, '', '', 0),
('126624', 'Sawitree_P', 'MFG/Training', 1585, '', '', 0),
('108453', 'Nuengruthai_P', 'MFG/Training', 1585, '', '', 0),
('102995', 'Boonreang_S', 'MFG/Training', 1585, '', '', 0),
('119598', 'Anurom_K', 'MFG/Training', 1585, '', '', 0),
('126653', 'Sangdow_S', 'MFG/Training', 1585, '', '', 0),
('135097', 'Yupin_P', 'MFG/Training', 1585, '', '', 0),
('103474', 'Kingkan_K', 'MFG/Training', 1585, '', '', 0),
('127219', 'Dollaya_K', 'MFG/Training', 1585, '', '', 0),
('108224', 'Sutiraporn_B', 'MFG/Training', 1585, '', '', 0),
('107327', 'Saichon_M', 'MFG/Training', 1585, '', '', 0),
('151375', 'Peerapath_S', 'MFG/Training', 1585, '', '', 0),
('120353', 'Naiyana_S', 'MFG/Training', 1585, '', '', 0),
('9786167342795', 'Chaowalit k', 'IT', 1234, 'chaowalit_k', 'Santi_p', 111111111),
('8850309203020', 'bank  chaowalit', 'IT IT IT', 9999, 'b_007', 'apapap', 0),
('8851932283809', 'attapon_th', 'IT', 4321, 'aabbb', 'Santi_p', 74123);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
