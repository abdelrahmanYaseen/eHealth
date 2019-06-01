-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2019 at 04:15 PM
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
(24, 4, 0),
(25, 55, 0),
(26, 56, 0),
(27, 57, 0),
(28, 58, 0),
(29, 59, 0),
(30, 60, 0),
(31, 61, 0),
(32, 62, 0),
(33, 64, 0),
(34, 65, 1),
(35, 66, 0),
(36, 67, 0),
(37, 68, 0),
(38, 69, 0),
(39, 70, 0),
(40, 71, 1),
(41, 72, 0);

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
(139, 65, 69, 'HI', '2019-05-21 06:51:55', 1),
(141, 4, 2, 'Hi', '2019-05-23 13:15:48', 0),
(136, 71, 4, 'Hi', '2019-05-19 16:28:45', 1),
(135, 2, 4, 'Hi', '2019-05-19 16:28:33', 0),
(134, 4, 71, 'hi', '2019-05-19 16:27:57', 0);

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
(1, 4, 'Abelrahman', 'Yaseen', '1980-10-10', 'Cardiologist'),
(31, 65, 'Ahmad', 'Altawil', '1972-06-22', 'Cardiologist'),
(30, 64, 'Dana', 'Alhalabi', '1987-07-23', 'Cardiologist'),
(33, 72, 'Mohsin', 'Shamaa', '1992-07-21', 'Cardiologist');

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
(32, 5, 33),
(33, 1, 34),
(34, 31, 35),
(36, 1, 37);

-- --------------------------------------------------------

--
-- Table structure for table `emergencycase`
--

CREATE TABLE `emergencycase` (
  `EmergencyCaseID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `Description` text COLLATE utf8_unicode_ci NOT NULL,
  `Latitude` double NOT NULL,
  `Longitude` double NOT NULL,
  `TimeOfOccurrence` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Flag` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emergencycase`
--

INSERT INTO `emergencycase` (`EmergencyCaseID`, `PatientID`, `Description`, `Latitude`, `Longitude`, `TimeOfOccurrence`, `Flag`) VALUES
(16, 37, 'Actuators are showing that the user is Lying down but ECG readings indicates that the activity is Running', 0, 0, '2019-05-21 17:56:25', 0),
(17, 34, 'Actuators are showing that the user is Lying down but ECG readings indicates that the activity is Running', 0, 0, '2019-05-21 17:56:25', 0),
(18, 35, 'Actuators are showing that the user is Lying down but ECG readings indicates that the activity is Running', 0, 0, '2019-05-21 17:56:25', 2),
(19, 2, 'Actuators are showing that the user is Lying down but ECG readings indicates that the activity is Running', 35.248353, 33.024055, '2019-05-21 17:56:58', 0),
(20, 2, 'ECG readings indicates that the activity is Jogging but Actuators are showing that the user is Standing still', 35.1981, 32.9914, '2019-05-31 19:36:25', 2),
(21, 2, 'ECG readings indicates that the activity is Jogging but Actuators are showing that the user is Standing still', 35.1981, 32.9914, '2019-05-31 19:37:01', 2),
(22, 2, 'ECG readings indicates that the activity is Cycling but Actuators are showing that the user is Sitting and relaxing', 35.1981, 32.9914, '2019-05-31 19:38:05', 2),
(23, 2, 'ECG readings indicates that the activity is Jogging but Actuators are showing that the user is Sitting and relaxing', 36.9081, 30.6956, '2019-06-01 13:11:55', 2),
(24, 2, 'ECG readings indicates that the activity is Running but Actuators are showing that the user is Lying down', 36.9081, 30.6956, '2019-06-01 14:00:33', 2);

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
(7, 2, '2019-06-01 04:29:26'),
(18, 18, '2019-04-23 17:12:02'),
(17, 17, '2019-04-23 17:09:01'),
(11, 4, '2019-06-01 04:29:28'),
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
(62, 62, '0000-00-00 00:00:00'),
(63, 64, '0000-00-00 00:00:00'),
(64, 65, '0000-00-00 00:00:00'),
(65, 66, '0000-00-00 00:00:00'),
(66, 67, '0000-00-00 00:00:00'),
(67, 68, '0000-00-00 00:00:00'),
(68, 69, '2019-05-21 05:53:26'),
(69, 70, '0000-00-00 00:00:00'),
(70, 71, '2019-06-01 12:40:56'),
(71, 72, '0000-00-00 00:00:00');

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
(2, 2, 'Batoul', 'Alhasani', '1996-03-13'),
(33, 67, 'Ahmad', 'Dibs', '1961-03-14'),
(34, 68, 'Ayman', 'Tammam', '1983-05-16'),
(35, 69, 'Nihad', 'Salam', '1970-10-10'),
(37, 71, 'Adham', 'Raihan', '1960-03-16');

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
  `ReadingTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sensorreading`
--

INSERT INTO `sensorreading` (`SensorReadingID`, `PatientID`, `HeartRate`, `Temperature`, `SPO2`, `ReadingTime`) VALUES
(71, 2, 0.33125975, 0, 0, '2019-05-29 03:10:12'),
(70, 2, 0.33125975, 0, 0, '2019-05-29 03:10:12'),
(69, 2, 0.32815031, 0, 0, '2019-05-29 03:10:12'),
(68, 2, 0.32503901, 0, 0, '2019-05-29 03:10:12'),
(57, 2, 0.32892674, 0, 0, '2019-05-29 03:10:12'),
(56, 2, 0.3258173, 0, 0, '2019-05-29 03:10:12'),
(55, 2, 0.33048146, 0, 0, '2019-05-29 03:10:12'),
(54, 2, 0.33281447, 0, 0, '2019-05-29 03:10:12'),
(53, 2, 0.33514786, 0, 0, '2019-05-29 03:10:12'),
(52, 2, 0.33514786, 0, 0, '2019-05-29 03:10:12'),
(51, 2, 0.3359254, 0, 0, '2019-05-29 03:10:12'),
(50, 2, 0.33981332, 0, 0, '2019-05-29 03:10:12'),
(49, 2, 0.34447897, 0, 0, '2019-05-29 03:10:12'),
(48, 2, 0.37169552, 0, 0, '2019-05-29 03:10:12'),
(58, 2, 0.33903578, 0, 0, '2019-05-29 03:10:12'),
(59, 2, 0.34758935, 0, 0, '2019-05-29 03:10:12'),
(60, 2, 0.35692065, 0, 0, '2019-05-29 03:10:12'),
(61, 2, 0.34214615, 0, 0, '2019-05-29 03:10:12'),
(62, 2, 0.31959655, 0, 0, '2019-05-29 03:10:12'),
(63, 2, 0.31803997, 0, 0, '2019-05-29 03:10:12'),
(64, 2, 0.31881826, 0, 0, '2019-05-29 03:10:12'),
(65, 2, 0.32503901, 0, 0, '2019-05-29 03:10:12'),
(66, 2, 0.73638458, 0, 0, '2019-05-29 03:10:12'),
(67, 2, 0.19673453, 0, 0, '2019-05-29 03:10:12'),
(72, 2, 0.33437012, 0, 0, '2019-05-29 03:10:12'),
(73, 2, 0.3413686, 0, 0, '2019-05-29 03:10:12'),
(74, 2, 0.35147739, 0, 0, '2019-05-29 03:10:12'),
(75, 2, 0.36003102, 0, 0, '2019-05-29 03:10:12'),
(76, 2, 0.37402853, 0, 0, '2019-05-29 03:10:12'),
(77, 2, 0.38491344, 0, 0, '2019-05-29 03:10:12'),
(78, 2, 0.39735493, 0, 0, '2019-05-29 03:10:12'),
(79, 2, 0.42379449, 0, 0, '2019-05-29 03:10:12'),
(80, 2, 0.41290772, 0, 0, '2019-05-29 03:10:12'),
(81, 2, 0.37947099, 0, 0, '2019-05-29 03:10:12'),
(82, 2, 0.352255, 0, 0, '2019-05-29 03:10:12'),
(83, 2, 0.3359254, 0, 0, '2019-05-29 03:10:12'),
(84, 2, 0.33359276, 0, 0, '2019-05-29 03:10:12'),
(85, 2, 0.33359276, 0, 0, '2019-05-29 03:10:12'),
(86, 2, 0.32970503, 0, 0, '2019-05-29 03:10:12'),
(87, 2, 0.32737202, 0, 0, '2019-05-29 03:10:12'),
(88, 2, 0.32659373, 0, 0, '2019-05-29 03:10:12'),
(89, 2, 0.32503901, 0, 0, '2019-05-29 03:10:12'),
(90, 2, 0.32348429, 0, 0, '2019-05-29 03:10:12'),
(91, 2, 0.33514786, 0, 0, '2019-05-29 03:10:12'),
(92, 2, 0.34758935, 0, 0, '2019-05-29 03:10:12'),
(93, 2, 0.36236385, 0, 0, '2019-05-29 03:10:12'),
(94, 2, 0.3468118, 0, 0, '2019-05-29 03:10:12'),
(95, 2, 0.31803997, 0, 0, '2019-05-29 03:10:12'),
(96, 2, 0.322706, 0, 0, '2019-05-29 03:10:12'),
(97, 2, 0.31415224, 0, 0, '2019-05-29 03:10:12'),
(100, 2, 0.36002, 37.1, 95.7, '2019-06-01 16:11:53'),
(101, 2, 0.31816, 37.1, 95.7, '2019-06-01 16:11:53'),
(102, 2, 0.45212, 37.1, 95.7, '2019-06-01 16:11:53'),
(103, 2, 0.38514, 37.1, 95.7, '2019-06-01 16:11:53'),
(104, 2, 0.21769, 37.1, 95.7, '2019-06-01 16:11:53'),
(105, 2, 0.19257, 37.1, 95.7, '2019-06-01 16:11:53'),
(106, 2, -0.15070999999999998, 37.1, 95.7, '2019-06-01 16:11:53'),
(107, 2, -0.071167, 37.1, 95.7, '2019-06-01 16:11:53'),
(108, 2, -0.14652, 37.1, 95.7, '2019-06-01 16:11:53'),
(109, 2, -0.016745, 37.1, 95.7, '2019-06-01 16:11:53'),
(110, 2, 0.48142, 37.1, 95.7, '2019-06-01 16:11:53'),
(111, 2, -0.1842, 37.1, 95.7, '2019-06-01 16:11:53'),
(112, 2, -0.26792, 37.1, 95.7, '2019-06-01 16:11:53'),
(113, 2, -0.1842, 37.1, 95.7, '2019-06-01 16:11:53'),
(114, 2, -0.33909, 37.1, 95.7, '2019-06-01 16:11:53'),
(115, 2, -0.27211, 37.1, 95.7, '2019-06-01 16:11:53'),
(116, 2, -0.4395600000000001, 37.1, 95.7, '2019-06-01 16:11:53'),
(117, 2, 1.5573, 37.1, 95.7, '2019-06-01 16:11:53'),
(118, 2, 1.0842, 37.1, 95.7, '2019-06-01 16:11:53'),
(119, 2, -0.61538, 37.1, 95.7, '2019-06-01 16:11:53'),
(120, 2, -0.18838, 37.1, 95.7, '2019-06-01 16:11:53'),
(121, 2, -0.083726, 37.1, 95.7, '2019-06-01 16:11:53'),
(122, 2, 0.037677, 37.1, 95.7, '2019-06-01 16:11:53'),
(123, 2, -0.19257, 37.1, 95.7, '2019-06-01 16:11:53'),
(124, 2, -0.16745, 37.1, 95.7, '2019-06-01 16:11:53'),
(125, 2, -0.13396, 37.1, 95.7, '2019-06-01 16:11:53'),
(126, 2, 0.037677, 37.1, 95.7, '2019-06-01 16:11:53'),
(127, 2, 0.2428, 37.1, 95.7, '2019-06-01 16:11:53'),
(128, 2, 0.041863, 37.1, 95.7, '2019-06-01 16:11:53'),
(129, 2, -0.07954, 37.1, 95.7, '2019-06-01 16:11:53'),
(130, 2, 0.012559, 37.1, 95.7, '2019-06-01 16:11:53'),
(131, 2, -0.083726, 37.1, 95.7, '2019-06-01 16:11:53'),
(132, 2, -0.11303, 37.1, 95.7, '2019-06-01 16:11:53'),
(133, 2, -0.12559, 37.1, 95.7, '2019-06-01 16:11:53'),
(134, 2, -0.025118, 37.1, 95.7, '2019-06-01 16:11:53'),
(135, 2, -0.012559, 37.1, 95.7, '2019-06-01 16:11:53'),
(136, 2, -0.062794, 37.1, 95.7, '2019-06-01 16:11:53'),
(137, 2, -0.058608000000000014, 37.1, 95.7, '2019-06-01 16:11:53'),
(138, 2, -0.029304000000000007, 37.1, 95.7, '2019-06-01 16:11:53'),
(139, 2, -0.1214, 37.1, 95.7, '2019-06-01 16:11:53'),
(140, 2, -0.029304000000000007, 37.1, 95.7, '2019-06-01 16:11:53'),
(141, 2, -0.0041863, 37.1, 95.7, '2019-06-01 16:11:53'),
(142, 2, 0.03349, 37.1, 95.7, '2019-06-01 16:11:53'),
(143, 2, 0.21769, 37.1, 95.7, '2019-06-01 16:11:53'),
(144, 2, 0.03349, 37.1, 95.7, '2019-06-01 16:11:53'),
(145, 2, -0.5525899999999999, 37.1, 95.7, '2019-06-01 16:11:53'),
(146, 2, 2.2857, 37.1, 95.7, '2019-06-01 16:11:53'),
(147, 2, 2.2815, 37.1, 95.7, '2019-06-01 16:11:53'),
(148, 2, -0.07954, 37.1, 95.7, '2019-06-01 16:11:53'),
(149, 2, 0.0083726, 37.1, 95.7, '2019-06-01 16:11:53'),
(150, 37, 1, 0, 0, '2019-06-01 16:32:48'),
(151, 37, 2, 0, 0, '2019-06-01 16:32:48'),
(152, 2, 2.1852, 37.1, 95.7, '2019-06-01 17:00:32'),
(153, 2, -1.2894, 37.1, 95.7, '2019-06-01 17:00:32'),
(154, 2, -0.80795, 37.1, 95.7, '2019-06-01 17:00:32'),
(155, 2, -0.71167, 37.1, 95.7, '2019-06-01 17:00:32'),
(156, 2, -0.74935, 37.1, 95.7, '2019-06-01 17:00:32'),
(157, 2, -0.97959, 37.1, 95.7, '2019-06-01 17:00:32'),
(158, 2, -0.98796, 37.1, 95.7, '2019-06-01 17:00:32'),
(159, 2, -0.77865, 37.1, 95.7, '2019-06-01 17:00:32'),
(160, 2, -0.92936, 37.1, 95.7, '2019-06-01 17:00:32'),
(161, 2, -0.14232999999999998, 37.1, 95.7, '2019-06-01 17:00:32'),
(162, 2, -0.2428, 37.1, 95.7, '2019-06-01 17:00:32'),
(163, 2, -0.47305, 37.1, 95.7, '2019-06-01 17:00:32'),
(164, 2, -0.4395600000000001, 37.1, 95.7, '2019-06-01 17:00:32'),
(165, 2, -0.44375, 37.1, 95.7, '2019-06-01 17:00:32'),
(166, 2, -0.54003, 37.1, 95.7, '2019-06-01 17:00:32'),
(167, 2, -0.35165, 37.1, 95.7, '2019-06-01 17:00:32'),
(168, 2, 0.062794, 37.1, 95.7, '2019-06-01 17:00:32'),
(169, 2, -0.3349, 37.1, 95.7, '2019-06-01 17:00:32'),
(170, 2, -0.29723, 37.1, 95.7, '2019-06-01 17:00:32'),
(171, 2, -0.72004, 37.1, 95.7, '2019-06-01 17:00:32'),
(172, 2, -0.14652, 37.1, 95.7, '2019-06-01 17:00:32'),
(173, 2, 1.2936, 37.1, 95.7, '2019-06-01 17:00:32'),
(174, 2, 2.3108, 37.1, 95.7, '2019-06-01 17:00:32'),
(175, 2, -1.0801, 37.1, 95.7, '2019-06-01 17:00:32'),
(176, 2, -0.60283, 37.1, 95.7, '2019-06-01 17:00:32'),
(177, 2, -0.8330700000000001, 37.1, 95.7, '2019-06-01 17:00:32'),
(178, 2, 0.075353, 37.1, 95.7, '2019-06-01 17:00:32'),
(179, 2, -0.63213, 37.1, 95.7, '2019-06-01 17:00:32'),
(180, 2, -0.26792, 37.1, 95.7, '2019-06-01 17:00:32'),
(181, 2, -0.33909, 37.1, 95.7, '2019-06-01 17:00:32'),
(182, 2, -0.23025, 37.1, 95.7, '2019-06-01 17:00:32'),
(183, 2, -0.071167, 37.1, 95.7, '2019-06-01 17:00:32'),
(184, 2, 0.13396, 37.1, 95.7, '2019-06-01 17:00:32'),
(185, 2, 0.16745, 37.1, 95.7, '2019-06-01 17:00:32'),
(186, 2, 0.23025, 37.1, 95.7, '2019-06-01 17:00:32'),
(187, 2, -0.075353, 37.1, 95.7, '2019-06-01 17:00:32'),
(188, 2, -0.23862, 37.1, 95.7, '2019-06-01 17:00:32'),
(189, 2, -0.12977, 37.1, 95.7, '2019-06-01 17:00:32'),
(190, 2, -0.18838, 37.1, 95.7, '2019-06-01 17:00:32'),
(191, 2, -0.5232899999999999, 37.1, 95.7, '2019-06-01 17:00:32'),
(192, 2, -0.59445, 37.1, 95.7, '2019-06-01 17:00:32'),
(193, 2, -0.6907399999999999, 37.1, 95.7, '2019-06-01 17:00:32'),
(194, 2, -0.87075, 37.1, 95.7, '2019-06-01 17:00:32'),
(195, 2, 1.3815, 37.1, 95.7, '2019-06-01 17:00:32'),
(196, 2, 1.5154, 37.1, 95.7, '2019-06-01 17:00:32'),
(197, 2, -0.67818, 37.1, 95.7, '2019-06-01 17:00:32'),
(198, 2, -0.80795, 37.1, 95.7, '2019-06-01 17:00:32'),
(199, 2, -0.52747, 37.1, 95.7, '2019-06-01 17:00:32'),
(200, 2, -0.42282, 37.1, 95.7, '2019-06-01 17:00:32'),
(201, 2, -0.16745, 37.1, 95.7, '2019-06-01 17:00:32');

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
(1, 2, 70, 100, 36.5, 37.5, 95, 100, '2019-05-20 15:00:48'),
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
(28, 32, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(29, 33, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(30, 34, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(31, 35, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(32, 36, 0, 0, 0, 0, 0, 0, '0000-00-00 00:00:00'),
(33, 37, 0, 0, 0, 0, 0, 0, '2019-05-19 20:13:22');

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
(2, 'Batoul', '12345678aA', 'Patient'),
(4, 'Abdelrahman', '12345678aA', 'Doctor'),
(67, 'AhmadDibs', 'ahmad1234A', 'Patient'),
(69, 'NihadSalam', 'Nihad1234Q', 'Patient'),
(71, 'AdhamRaihan', '1234asdfD', 'Patient'),
(68, 'AymanTammam', 'ayman1234A', 'Patient'),
(64, 'DanaAlhalabi', 'dana1234B', 'Doctor'),
(63, 'Khalid', '12345678aA', 'Admin'),
(72, 'MohsinShamaa', 'abcdef123E', 'Doctor'),
(65, 'AhmadAltawil', 'ahmad1234S', 'Doctor');

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
  MODIFY `SessionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `doctorpatient`
--
ALTER TABLE `doctorpatient`
  MODIFY `DoctorPatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `emergencycase`
--
ALTER TABLE `emergencycase`
  MODIFY `EmergencyCaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sensorreading`
--
ALTER TABLE `sensorreading`
  MODIFY `SensorReadingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=202;

--
-- AUTO_INCREMENT for table `standardrates`
--
ALTER TABLE `standardrates`
  MODIFY `StandardRatesID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
