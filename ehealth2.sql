-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2019 at 12:35 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehealth2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `BirthDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chatnotification`
--

CREATE TABLE `chatnotification` (
  `SessionID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `NumberOfMessages` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chatnotification`
--

INSERT INTO `chatnotification` (`SessionID`, `UserID`, `NumberOfMessages`) VALUES
(13, 2, 0),
(24, 4, 1),
(25, 55, 0),
(26, 56, 0),
(27, 57, 0),
(28, 58, 0),
(29, 59, 0),
(30, 60, 0),
(31, 61, 0),
(32, 62, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `timestamp`, `status`) VALUES
(1, 2, 4, 'Hi', '2019-03-15 16:57:52', 0),
(2, 2, 4, 'Hi again', '2019-03-15 16:58:52', 0),
(3, 2, 4, 'Hiiii', '2019-03-15 17:09:48', 0),
(4, 2, 4, 'Hi\n', '2019-03-15 17:10:42', 0),
(5, 4, 2, 'Heloo', '2019-03-15 17:11:59', 0),
(21, 4, 2, 'Hi', '2019-03-16 13:07:42', 0),
(7, 4, 2, 'Yes', '2019-03-15 17:32:12', 0),
(8, 2, 4, 'Here', '2019-03-15 17:33:16', 0),
(9, 4, 2, 'now', '2019-03-15 17:34:35', 0),
(37, 2, 4, '?', '2019-04-26 13:14:49', 0),
(38, 4, 2, '?', '2019-04-26 13:15:05', 0),
(39, 4, 2, '??', '2019-04-26 13:15:11', 0),
(23, 2, 4, 'heloo', '2019-03-16 13:08:09', 0),
(24, 2, 4, 'hi\n', '2019-03-20 15:23:01', 0),
(40, 4, 2, 'yes', '2019-04-26 13:15:29', 0),
(26, 5, 4, 'ho', '2019-03-20 16:06:11', 1),
(42, 4, 2, '?', '2019-04-26 13:16:26', 0),
(43, 4, 2, '?', '2019-04-26 13:16:30', 0),
(44, 2, 4, '?', '2019-04-26 13:16:53', 0),
(45, 2, 4, '?\n', '2019-04-26 13:16:57', 0),
(46, 4, 2, '?', '2019-04-26 13:18:42', 0),
(47, 4, 2, '?', '2019-04-26 13:18:54', 0),
(48, 2, 4, '?', '2019-04-26 13:19:08', 0),
(49, 2, 4, '?', '2019-04-26 13:19:12', 0),
(50, 4, 2, '?', '2019-04-26 13:19:26', 0),
(51, 4, 2, '?', '2019-04-26 13:21:55', 0),
(52, 4, 2, '?', '2019-04-26 13:22:01', 0),
(53, 4, 2, '1', '2019-04-26 13:23:12', 0),
(54, 4, 2, '1', '2019-04-26 13:23:34', 0),
(55, 4, 2, 'hello', '2019-04-26 13:25:22', 0),
(56, 4, 2, 'Heeloooooo', '2019-04-26 13:25:40', 0),
(57, 4, 2, 'Helllllllll', '2019-04-26 13:25:51', 0),
(58, 2, 4, 'Heelo', '2019-04-26 13:26:19', 0),
(59, 2, 4, '', '2019-04-26 13:26:19', 0),
(60, 2, 4, 'hi', '2019-04-26 13:31:47', 0),
(61, 4, 2, 'Heellllll', '2019-04-26 13:31:57', 0),
(62, 4, 2, 'HOOO', '2019-04-26 13:43:35', 0),
(63, 4, 2, 'Hii', '2019-04-26 13:45:33', 0),
(64, 4, 2, 'Hi', '2019-04-26 13:48:21', 0),
(65, 4, 2, 'Hi', '2019-04-26 13:48:50', 0),
(66, 4, 2, 'Heellloooooo', '2019-04-26 13:56:00', 0),
(67, 4, 2, 'hoi', '2019-04-26 14:02:49', 0),
(68, 4, 2, 'hi', '2019-04-26 14:02:55', 0),
(69, 4, 2, 'Hi', '2019-04-26 14:03:24', 0),
(70, 2, 4, 'Hi', '2019-04-26 14:03:36', 0),
(71, 2, 4, 'HI', '2019-04-26 14:04:15', 0),
(72, 4, 2, 'HI', '2019-04-26 14:04:26', 0),
(73, 2, 4, 'How are yu?', '2019-04-26 14:04:36', 0),
(74, 4, 2, 'Hows', '2019-04-26 14:04:54', 0),
(75, 4, 2, 'Hi', '2019-04-26 15:47:55', 0),
(76, 4, 2, 'Hi', '2019-04-26 15:50:04', 0),
(77, 4, 2, 'Helooooo', '2019-04-29 06:51:39', 0),
(78, 4, 2, 'How are you?', '2019-04-29 06:52:08', 0),
(79, 4, 2, 'Heyy', '2019-04-29 06:52:46', 0),
(80, 4, 2, 'Hello', '2019-04-29 09:05:58', 0),
(81, 4, 2, 'How are you?', '2019-04-29 09:06:03', 0),
(82, 4, 2, 'Hello', '2019-04-29 10:41:03', 0),
(83, 4, 2, 'Hi', '2019-05-03 08:06:49', 0),
(84, 4, 61, 'Hello', '2019-05-04 15:38:12', 0),
(85, 61, 4, 'HI', '2019-05-04 15:38:17', 0),
(86, 4, 61, 'HEllo', '2019-05-04 15:39:19', 0),
(87, 4, 2, 'fsdf', '2019-05-04 15:41:33', 0),
(88, 4, 2, 'sdfsd', '2019-05-04 15:41:35', 0),
(89, 4, 2, 'HEllo', '2019-05-04 15:47:00', 0),
(90, 4, 2, 'How are you', '2019-05-04 16:04:32', 0),
(91, 4, 2, 'Hello', '2019-05-04 16:04:56', 0),
(92, 4, 2, 'Hello', '2019-05-04 16:15:40', 0),
(93, 4, 2, 'HElllo', '2019-05-04 16:22:33', 0),
(94, 4, 2, 'How are you?', '2019-05-04 16:23:01', 0),
(95, 4, 2, 'Ho', '2019-05-04 16:25:44', 0),
(96, 4, 2, 'df', '2019-05-04 16:28:09', 0),
(97, 4, 2, 'fdg', '2019-05-04 16:28:17', 0),
(98, 4, 2, 'hi', '2019-05-04 16:34:11', 0),
(99, 4, 2, 'Hi', '2019-05-04 16:39:24', 0),
(100, 4, 2, 'hi', '2019-05-04 16:42:02', 0),
(101, 4, 2, 'fhgf', '2019-05-04 16:42:21', 0),
(102, 4, 2, 'gdf', '2019-05-04 16:42:27', 0),
(103, 4, 2, 'HI', '2019-05-04 16:48:11', 0),
(104, 4, 2, '', '2019-05-04 16:48:12', 0),
(105, 4, 2, 'HI', '2019-05-04 16:55:12', 0),
(106, 4, 2, 'gdsfgfd', '2019-05-04 16:55:25', 0),
(107, 4, 2, 'dgdf', '2019-05-04 16:58:30', 0),
(108, 4, 2, 'sgfdg', '2019-05-04 16:59:59', 0),
(109, 4, 2, 'dfg', '2019-05-04 17:02:48', 0),
(110, 4, 2, 'gdfg', '2019-05-04 17:03:10', 0),
(111, 2, 4, '', '2019-05-04 17:06:34', 0),
(112, 4, 2, 'asd', '2019-05-04 17:06:45', 0),
(113, 4, 2, 'dasdas', '2019-05-04 17:07:09', 0),
(114, 4, 2, 'ght', '2019-05-04 17:09:25', 0),
(115, 4, 2, 'fsdf', '2019-05-04 19:15:19', 0),
(116, 4, 2, 'sdfsd', '2019-05-04 19:15:25', 0),
(117, 4, 2, 'dfsdf', '2019-05-04 19:15:30', 0),
(118, 4, 2, 'sdfsd', '2019-05-04 19:15:34', 0),
(119, 2, 4, 'hi', '2019-05-04 19:21:18', 0),
(120, 2, 4, 'sdf', '2019-05-04 19:21:38', 0),
(121, 2, 4, 'sdf', '2019-05-04 19:21:58', 0),
(122, 2, 4, 'rh', '2019-05-04 19:34:27', 0),
(123, 2, 4, 'sdfg', '2019-05-04 19:35:20', 0),
(124, 2, 4, 'gdg', '2019-05-04 19:35:39', 0),
(125, 2, 4, 'sdfsdf', '2019-05-04 19:38:29', 0),
(126, 2, 4, 'fsdf', '2019-05-04 19:39:49', 0),
(127, 2, 4, 'sdfsdf', '2019-05-04 19:40:30', 0),
(128, 2, 4, 'dfs', '2019-05-04 19:40:39', 0),
(129, 2, 4, 'dfgdg', '2019-05-05 07:19:15', 0),
(130, 4, 2, 'hii', '2019-05-06 12:23:12', 0),
(131, 2, 4, 'fdf', '2019-05-06 13:11:32', 0),
(132, 4, 2, 'ghrgh', '2019-05-06 13:26:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DoctorID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `BirthDate` date NOT NULL,
  `Specialization` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DoctorID`, `UserID`, `Name`, `Surname`, `BirthDate`, `Specialization`) VALUES
(1, 4, 'Doctor5', 'surename5', '1980-10-10', 'Heart'),
(5, 16, 'doctor', 'doctor', '2019-03-21', 'fsf'),
(27, 56, 'Batoul', 'h', '2019-04-15', 'heart'),
(29, 62, 'Batoul', 'Alhasani', '2019-05-08', 'heart');

-- --------------------------------------------------------

--
-- Table structure for table `doctorpatient`
--

CREATE TABLE `doctorpatient` (
  `DoctorPatientID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `doctorpatient`
--

INSERT INTO `doctorpatient` (`DoctorPatientID`, `DoctorID`, `PatientID`) VALUES
(1, 1, 2),
(2, 1, 3),
(27, 1, 28),
(28, 1, 29),
(30, 1, 31),
(31, 27, 32);

-- --------------------------------------------------------

--
-- Table structure for table `emergencycase`
--

CREATE TABLE `emergencycase` (
  `EmergencyCaseID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `Flag` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emergencycase`
--

INSERT INTO `emergencycase` (`EmergencyCaseID`, `PatientID`, `Flag`) VALUES
(1, 2, 2),
(3, 2, 2),
(6, 2, 2),
(8, 2, 0),
(9, 2, 0),
(10, 2, 0),
(11, 2, 0),
(12, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`login_details_id`, `user_id`, `last_activity`) VALUES
(7, 2, '2019-05-06 12:26:08'),
(18, 18, '2019-04-23 17:12:02'),
(17, 17, '2019-04-23 17:09:01'),
(11, 4, '2019-05-10 09:10:42'),
(23, 23, '2019-04-24 13:34:42'),
(22, 22, '2019-04-24 13:12:23'),
(21, 21, '2019-04-24 13:11:04'),
(20, 20, '2019-04-23 17:20:28'),
(19, 19, '2019-04-23 17:12:38'),
(15, 15, '2019-03-20 14:47:53'),
(16, 16, '2019-03-20 15:13:55'),
(24, 24, '2019-04-24 13:36:10'),
(25, 25, '2019-04-24 13:38:29'),
(26, 26, '2019-04-24 13:39:49'),
(27, 27, '2019-04-24 13:41:05'),
(28, 28, '2019-04-24 13:41:09'),
(29, 29, '2019-04-24 13:42:42'),
(30, 30, '2019-04-24 13:54:52'),
(31, 31, '2019-04-24 14:00:02'),
(32, 32, '2019-04-24 14:00:32'),
(33, 33, '2019-04-24 14:02:33'),
(34, 34, '2019-04-24 14:04:55'),
(35, 35, '2019-04-24 14:05:50'),
(36, 36, '2019-04-24 14:22:50'),
(37, 37, '2019-04-24 14:29:25'),
(38, 38, '2019-04-24 14:32:48'),
(39, 39, '2019-04-24 14:38:43'),
(40, 40, '2019-04-24 14:39:23'),
(41, 41, '2019-04-24 14:39:40'),
(42, 42, '2019-04-24 14:45:33'),
(43, 43, '2019-04-24 14:51:04'),
(44, 44, '2019-04-24 15:44:14'),
(45, 45, '2019-04-24 15:47:31'),
(46, 46, '2019-04-24 16:38:39'),
(47, 47, '2019-04-24 16:49:52'),
(48, 48, '2019-04-24 19:34:55'),
(49, 49, '2019-04-24 20:17:59'),
(50, 50, '2019-04-29 07:06:14'),
(51, 51, '2019-04-29 07:06:55'),
(52, 52, '2019-04-29 07:07:22'),
(53, 53, '2019-04-29 07:07:41'),
(54, 54, '2019-04-29 07:28:35'),
(55, 55, '2019-04-29 08:56:42'),
(56, 56, '2019-04-29 08:45:10'),
(57, 57, '2019-04-29 09:47:50'),
(58, 58, '0000-00-00 00:00:00'),
(59, 59, '0000-00-00 00:00:00'),
(60, 60, '0000-00-00 00:00:00'),
(61, 61, '2019-05-04 14:40:21'),
(62, 62, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `BirthDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `UserID`, `Name`, `Surname`, `BirthDate`) VALUES
(2, 2, 'patient2', 'patientSurname2', '1997-11-15'),
(3, 5, 'TestNamet1', 'TestSurnamet1', '2018-11-14'),
(28, 55, 'Batoul', 'h', '2019-04-26'),
(29, 57, 'Batoul', 'Alhasani', '2019-04-10'),
(31, 60, 'Batoul', 'Alhasani', '2019-05-14'),
(32, 61, 'Batoul', 'h', '2019-05-15');

-- --------------------------------------------------------

--
-- Table structure for table `sensorreading`
--

CREATE TABLE `sensorreading` (
  `SensorReadingID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `HeartRate` double NOT NULL,
  `Temperature` double NOT NULL,
  `SPO2` double NOT NULL,
  `ReadingTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sensorreading`
--

INSERT INTO `sensorreading` (`SensorReadingID`, `PatientID`, `HeartRate`, `Temperature`, `SPO2`, `ReadingTime`) VALUES
(1, 2, 2.5, 3, 3, '2018-11-16 00:00:00'),
(2, 2, 2.4, 3, 3, '2018-11-16 05:00:00'),
(3, 2, 2.7, 3, 3, '2018-11-16 07:00:00'),
(4, 2, 2.4, 3, 3, '2018-11-16 09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `standardrates`
--

CREATE TABLE `standardrates` (
  `StandardRatesID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `LowHeartRate` double NOT NULL,
  `HighHeartRate` double NOT NULL,
  `LowTemperature` double NOT NULL,
  `HighTemperature` double NOT NULL,
  `LowSPO2` double NOT NULL,
  `HighSPO2` double NOT NULL,
  `SettingTime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `standardrates`
--

INSERT INTO `standardrates` (`StandardRatesID`, `PatientID`, `LowHeartRate`, `HighHeartRate`, `LowTemperature`, `HighTemperature`, `LowSPO2`, `HighSPO2`, `SettingTime`) VALUES
(1, 2, 22, 10, 12, 12, 12, 12, '2019-04-23 18:51:32'),
(2, 8, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(3, 3, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(4, 4, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(5, 5, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(6, 10, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(7, 11, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(8, 12, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(9, 13, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(10, 14, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(11, 15, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(12, 16, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(13, 17, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(14, 18, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(15, 19, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(16, 20, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(17, 21, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(18, 22, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(19, 23, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(20, 24, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(21, 25, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(22, 26, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(23, 27, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(24, 28, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(25, 29, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(26, 30, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(27, 31, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(28, 32, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UserType` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `UserType`) VALUES
(3, 'username3', '3', 'Admin'),
(2, 'username2', '2', 'Patient'),
(4, 'username5', '5', 'Doctor'),
(5, 'TestUsernamet1', 'TestPasswordt1', ''),
(55, 'h', '1234567aA', 'Patient'),
(16, 'sdfs', 'hi', 'Doctor'),
(61, 'h3', '12345678aA', 'Patient'),
(57, 'Batoul12345', 'weewadasdas2S', 'Patient'),
(60, 'bb', 'bff29fe2c3269812851d6fda69b3472d', 'Patient'),
(56, 'h2', '1234567aA', 'Doctor'),
(62, 'h4', '12345678aA', 'Doctor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `chatnotification`
--
ALTER TABLE `chatnotification`
  ADD PRIMARY KEY (`SessionID`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DoctorID`);

--
-- Indexes for table `doctorpatient`
--
ALTER TABLE `doctorpatient`
  ADD PRIMARY KEY (`DoctorPatientID`);

--
-- Indexes for table `emergencycase`
--
ALTER TABLE `emergencycase`
  ADD PRIMARY KEY (`EmergencyCaseID`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `sensorreading`
--
ALTER TABLE `sensorreading`
  ADD PRIMARY KEY (`SensorReadingID`);

--
-- Indexes for table `standardrates`
--
ALTER TABLE `standardrates`
  ADD PRIMARY KEY (`StandardRatesID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chatnotification`
--
ALTER TABLE `chatnotification`
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `doctorpatient`
--
ALTER TABLE `doctorpatient`
  MODIFY `DoctorPatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `emergencycase`
--
ALTER TABLE `emergencycase`
  MODIFY `EmergencyCaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `sensorreading`
--
ALTER TABLE `sensorreading`
  MODIFY `SensorReadingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `standardrates`
--
ALTER TABLE `standardrates`
  MODIFY `StandardRatesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
