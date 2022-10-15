-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_items`
--

CREATE TABLE `category_items` (
  `categoryItemsId` int NOT NULL,
  `userId` int NOT NULL,
  `categoryId` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `classId` int NOT NULL,
  `studentId` int NOT NULL,
  `classMasterId` int NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`classId`, `studentId`, `classMasterId`, `datecreated`, `dateupdated`, `userId`) VALUES
(1, 5, 2, '2022-04-21 00:20:46', '2022-04-21 11:05:39', 4),
(2, 6, 1, '2022-04-21 21:39:18', '2022-04-21 21:39:18', 4),
(3, 8, 1, '2022-04-21 21:40:52', '2022-04-21 22:02:32', 4),
(4, 9, 1, '2022-04-21 21:41:03', '2022-04-21 22:02:40', 4),
(5, 10, 1, '2022-04-21 22:02:14', '2022-04-21 22:02:48', 4),
(6, 14, 1, '2022-04-21 22:03:01', '2022-04-21 22:03:01', 4),
(7, 15, 1, '2022-04-21 22:03:09', '2022-04-21 22:03:09', 4),
(8, 16, 2, '2022-04-21 22:03:18', '2022-04-21 22:03:18', 4),
(9, 17, 2, '2022-04-21 22:03:26', '2022-04-21 22:03:26', 4),
(10, 18, 2, '2022-04-21 22:03:34', '2022-04-21 22:03:34', 4),
(11, 19, 2, '2022-04-21 22:03:44', '2022-04-21 22:03:44', 4),
(12, 20, 2, '2022-04-21 22:03:54', '2022-04-21 22:03:54', 4),
(13, 21, 3, '2022-04-21 22:04:07', '2022-04-21 22:04:07', 4),
(14, 22, 3, '2022-04-21 22:04:24', '2022-04-21 22:04:24', 4),
(15, 23, 3, '2022-04-21 22:04:34', '2022-04-21 22:04:34', 4),
(16, 24, 3, '2022-04-21 22:04:45', '2022-04-21 22:04:45', 4),
(17, 25, 3, '2022-04-21 22:04:55', '2022-04-21 22:04:55', 4),
(18, 26, 4, '2022-04-21 22:05:07', '2022-04-21 22:05:07', 4),
(19, 27, 4, '2022-04-21 22:05:16', '2022-04-21 22:05:16', 4),
(20, 28, 4, '2022-04-21 22:05:27', '2022-04-21 22:05:27', 4),
(21, 29, 4, '2022-04-21 22:05:39', '2022-04-21 22:05:39', 4),
(22, 30, 4, '2022-04-21 22:05:48', '2022-04-21 22:05:48', 4),
(23, 31, 5, '2022-04-21 22:05:56', '2022-04-21 22:05:56', 4),
(24, 32, 5, '2022-04-21 22:06:06', '2022-04-21 22:06:06', 4),
(25, 33, 5, '2022-04-21 22:06:25', '2022-04-21 22:06:25', 4),
(26, 34, 5, '2022-04-21 22:06:37', '2022-04-21 22:06:37', 4),
(27, 35, 5, '2022-04-21 22:06:48', '2022-04-21 22:06:48', 4),
(28, 36, 6, '2022-04-21 22:06:58', '2022-04-21 22:06:58', 4),
(29, 37, 6, '2022-04-21 22:07:09', '2022-04-21 22:07:09', 4),
(30, 38, 6, '2022-04-21 22:07:31', '2022-04-21 22:07:31', 4),
(31, 39, 6, '2022-04-21 22:09:37', '2022-04-21 22:09:37', 4),
(32, 40, 6, '2022-04-21 22:09:54', '2022-04-21 22:09:54', 4),
(33, 45, 2, '2022-05-04 23:53:06', '2022-05-04 23:55:45', 4);

-- --------------------------------------------------------

--
-- Table structure for table `classes_master_data`
--

CREATE TABLE `classes_master_data` (
  `classMasterId` int NOT NULL,
  `grade` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Deleted') COLLATE utf8_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes_master_data`
--

INSERT INTO `classes_master_data` (`classMasterId`, `grade`, `section`, `status`, `datecreated`, `dateupdated`, `userId`) VALUES
(1, '1', 'Marcelo H Del Pilar', 'Active', '2022-04-20 23:30:22', '2022-04-22 22:52:12', 4),
(2, '2', 'Andres Bonifacio', 'Active', '2022-04-20 23:34:22', '2022-04-21 22:00:01', 4),
(3, '3', 'Gabriela Silang', 'Active', '2022-04-20 23:35:26', '2022-04-21 22:00:18', 4),
(4, '4', 'Jose Abad Santos', 'Active', '2022-04-21 21:40:33', '2022-04-21 22:00:38', 4),
(5, '5', 'Felipe Agoncillo', 'Active', '2022-04-21 22:01:33', '2022-04-21 22:01:33', 4),
(6, '6', 'Jose Rizal', 'Active', '2022-04-21 22:01:48', '2022-04-21 22:01:48', 4);

-- --------------------------------------------------------

--
-- Table structure for table `class_grade`
--

CREATE TABLE `class_grade` (
  `classGradeId` int NOT NULL,
  `classMasterId` int NOT NULL,
  `subjectId` int NOT NULL,
  `quarter` int NOT NULL,
  `columnNumber` int NOT NULL,
  `computationItemsId` int NOT NULL,
  `grade_score` float NOT NULL,
  `studentId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_grade`
--

INSERT INTO `class_grade` (`classGradeId`, `classMasterId`, `subjectId`, `quarter`, `columnNumber`, `computationItemsId`, `grade_score`, `studentId`) VALUES
(1, 1, 1, 1, 0, 13, 20, 6),
(2, 1, 1, 1, 1, 13, 20, 6),
(3, 1, 1, 1, 2, 13, 20, 6),
(4, 1, 1, 1, 3, 13, 20, 6),
(5, 1, 1, 1, 4, 13, 20, 6),
(6, 1, 1, 1, 0, 12, 10, 6),
(7, 1, 1, 1, 1, 12, 9, 6),
(8, 1, 1, 1, 2, 12, 9, 6),
(9, 1, 1, 1, 3, 12, 10, 6),
(10, 1, 1, 1, 4, 12, 8, 6),
(11, 1, 1, 2, 0, 12, 45, 6),
(12, 1, 1, 2, 1, 12, 50, 6),
(13, 1, 1, 2, 2, 12, 50, 6),
(14, 1, 1, 2, 3, 12, 50, 6),
(15, 1, 1, 2, 4, 12, 50, 6),
(16, 1, 1, 2, 0, 13, 50, 6),
(17, 1, 1, 2, 1, 13, 50, 6),
(18, 1, 1, 2, 2, 13, 50, 6),
(19, 1, 1, 2, 3, 13, 50, 6),
(20, 1, 1, 2, 4, 13, 50, 6),
(21, 1, 1, 1, 0, 12, 10, 8),
(22, 1, 1, 1, 1, 12, 10, 8),
(23, 1, 1, 1, 2, 12, 10, 8),
(24, 1, 1, 1, 3, 12, 10, 8),
(25, 1, 1, 1, 4, 12, 10, 8),
(26, 1, 1, 1, 0, 13, 30, 8),
(27, 1, 1, 1, 1, 13, 30, 8),
(28, 1, 1, 1, 2, 13, 30, 8),
(29, 1, 1, 1, 3, 13, 30, 8),
(30, 1, 1, 1, 4, 13, 30, 8),
(31, 1, 1, 1, 5, 12, 10, 8),
(32, 1, 1, 1, 6, 12, 10, 8),
(33, 1, 1, 1, 5, 13, 30, 8),
(34, 1, 1, 1, 6, 13, 30, 8);

-- --------------------------------------------------------

--
-- Table structure for table `class_total_items`
--

CREATE TABLE `class_total_items` (
  `classTotalItemsId` int NOT NULL,
  `classMasterId` int NOT NULL,
  `subjectId` int NOT NULL,
  `quarter` int NOT NULL,
  `totalItems` int NOT NULL,
  `columnNumber` int NOT NULL,
  `computationItemsId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_total_items`
--

INSERT INTO `class_total_items` (`classTotalItemsId`, `classMasterId`, `subjectId`, `quarter`, `totalItems`, `columnNumber`, `computationItemsId`) VALUES
(4, 1, 1, 1, 10, 0, 12),
(5, 1, 1, 1, 10, 1, 12),
(6, 1, 1, 1, 10, 2, 12),
(7, 1, 1, 1, 10, 3, 12),
(8, 1, 1, 1, 10, 4, 12),
(9, 1, 1, 1, 50, 1, 13),
(10, 1, 1, 2, 50, 0, 13),
(11, 1, 1, 2, 50, 1, 13),
(12, 1, 1, 2, 50, 2, 13),
(13, 1, 1, 2, 50, 3, 13),
(14, 1, 1, 2, 50, 4, 13),
(15, 1, 1, 2, 50, 0, 12),
(16, 1, 1, 2, 50, 1, 12),
(17, 1, 1, 2, 50, 2, 12),
(18, 1, 1, 2, 50, 3, 12),
(19, 1, 1, 2, 50, 4, 12),
(20, 1, 1, 3, 50, 0, 12),
(21, 1, 1, 3, 50, 1, 12),
(22, 1, 1, 3, 50, 2, 12),
(23, 1, 1, 3, 50, 3, 12),
(24, 1, 1, 3, 50, 4, 12),
(25, 1, 1, 3, 50, 0, 13),
(26, 1, 1, 3, 50, 1, 13),
(27, 1, 1, 3, 50, 2, 13),
(28, 1, 1, 3, 50, 3, 13),
(29, 1, 1, 3, 50, 4, 13),
(30, 1, 1, 1, 40, 0, 13),
(31, 1, 1, 1, 50, 1, 13),
(32, 1, 1, 1, 100, 2, 13),
(33, 1, 1, 1, 200, 3, 13),
(34, 1, 1, 1, 100, 4, 13),
(35, 1, 1, 1, 40, 0, 13),
(36, 1, 1, 1, 50, 1, 13),
(37, 1, 1, 1, 100, 2, 13),
(38, 1, 1, 1, 200, 3, 13),
(39, 1, 1, 1, 100, 4, 13);

-- --------------------------------------------------------

--
-- Table structure for table `computation_items`
--

CREATE TABLE `computation_items` (
  `computationItemsId` int NOT NULL,
  `computationMasterId` int NOT NULL,
  `userId` int NOT NULL,
  `description` varchar(255) NOT NULL,
  `percentage` int NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `total_exams` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `computation_items`
--

INSERT INTO `computation_items` (`computationItemsId`, `computationMasterId`, `userId`, `description`, `percentage`, `status`, `datecreated`, `dateupdated`, `total_exams`) VALUES
(7, 1, 2, 'Written Works', 40, 'Active', '2022-04-02 21:36:09', '2022-04-28 11:48:49', 0),
(8, 1, 2, 'Performance', 60, 'Active', '2022-04-02 21:37:42', '2022-04-27 20:54:41', 0),
(10, 2, 2, 'Written Works', 50, 'Active', '2022-04-27 20:47:28', '2022-04-27 20:54:01', 0),
(11, 4, 22, '1st Grading Period', 60, 'Active', '2022-04-27 23:06:51', '2022-05-17 10:56:07', 6),
(12, 6, 12, 'Math - Written Works', 50, 'Active', '2022-04-29 11:16:14', '2022-05-17 13:27:06', 7),
(13, 6, 12, 'Math - Performance Tasks', 50, 'Active', '2022-04-29 11:16:33', '2022-05-17 13:27:16', 7),
(14, 7, 12, 'ESP - Written Works', 40, 'Active', '2022-04-29 11:16:58', '2022-05-09 01:23:25', 3),
(15, 7, 12, 'ESP - Performace Tasks', 60, 'Active', '2022-04-29 11:17:31', '2022-05-09 01:23:33', 3),
(16, 8, 3, 'Music - Written Works', 30, 'Active', '2022-04-29 11:19:04', '2022-04-29 11:19:04', 0),
(17, 8, 3, 'Music - Performance Tasks', 70, 'Active', '2022-04-29 11:19:40', '2022-04-29 11:19:40', 0),
(18, 8, 3, 'Arts - Written Works', 30, 'Active', '2022-04-29 11:20:11', '2022-04-29 11:21:30', 0),
(19, 8, 3, 'Arts - Performance Tasks', 70, 'Active', '2022-04-29 11:20:31', '2022-04-29 11:21:42', 0),
(20, 8, 3, 'PE - Written Works', 30, 'Active', '2022-04-29 11:20:48', '2022-04-29 11:20:48', 0),
(21, 8, 3, 'PE - Performance Tasks', 70, 'Active', '2022-04-29 11:21:04', '2022-04-29 11:21:04', 0),
(22, 8, 3, 'Health - Written Works', 30, 'Active', '2022-04-29 11:21:57', '2022-04-29 11:21:57', 0),
(23, 8, 3, 'Health - Performance Tasks', 70, 'Active', '2022-04-29 11:22:15', '2022-04-29 11:22:15', 0),
(24, 9, 42, 'Science- Written Works', 50, 'Active', '2022-04-29 11:26:03', '2022-04-29 11:26:03', 0),
(25, 9, 42, 'Science - Performance Tasks', 50, 'Active', '2022-04-29 11:26:20', '2022-04-29 11:26:20', 0),
(26, 10, 44, 'EPP - Written Works', 30, 'Active', '2022-04-29 11:28:00', '2022-04-29 11:28:00', 0),
(27, 10, 44, 'EPP - Performace Tasks', 70, 'Active', '2022-04-29 11:28:20', '2022-04-29 11:28:20', 0),
(28, 11, 43, 'English - Written Works', 40, 'Active', '2022-04-29 11:31:08', '2022-04-29 11:31:08', 0),
(29, 11, 43, 'English - Performace Tasks', 60, 'Active', '2022-04-29 11:31:23', '2022-04-29 11:31:23', 0),
(30, 11, 43, 'Filipino- Written Works', 40, 'Active', '2022-04-29 11:31:36', '2022-04-29 11:31:36', 0),
(31, 11, 43, 'Filipino- Performace Tasks', 60, 'Active', '2022-04-29 11:31:51', '2022-04-29 11:31:51', 0),
(32, 11, 43, 'Araling Panlipunan - Written Works', 40, 'Active', '2022-04-29 11:32:06', '2022-04-29 11:32:06', 0),
(33, 11, 43, 'Araling Panlipunan- Performance Tasks', 60, 'Active', '2022-04-29 11:32:22', '2022-04-29 11:32:22', 0),
(34, 12, 46, 'Written', 50, 'Active', '2022-05-05 00:21:02', '2022-05-05 00:21:38', 0),
(35, 12, 46, 'Performance', 50, 'Active', '2022-05-05 00:21:18', '2022-05-05 00:21:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `computation_master`
--

CREATE TABLE `computation_master` (
  `computationMasterId` int NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Deleted') COLLATE utf8_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `computation_master`
--

INSERT INTO `computation_master` (`computationMasterId`, `description`, `status`, `datecreated`, `dateupdated`, `userId`) VALUES
(1, '40-60', 'Active', '2022-04-27 20:01:23', '2022-04-27 20:01:23', 2),
(2, '50-50', 'Active', '2022-04-27 20:35:12', '2022-04-27 20:35:12', 2),
(4, 'Filipino', 'Active', '2022-04-27 23:06:21', '2022-04-27 23:06:21', 22),
(5, 'Math', 'Active', '2022-04-29 11:09:31', '2022-04-29 11:09:31', 12),
(6, '50-50', 'Active', '2022-04-29 11:13:25', '2022-04-29 11:13:25', 12),
(7, '40-60', 'Active', '2022-04-29 11:15:38', '2022-04-29 11:15:38', 12),
(8, '30-70', 'Active', '2022-04-29 11:18:45', '2022-04-29 11:18:45', 3),
(9, '50-50', 'Active', '2022-04-29 11:25:46', '2022-04-29 11:25:46', 42),
(10, '30-70', 'Active', '2022-04-29 11:27:46', '2022-04-29 11:27:46', 44),
(11, '40-60', 'Active', '2022-04-29 11:30:15', '2022-04-29 11:30:15', 43),
(12, '50-50', 'Active', '2022-05-05 00:20:35', '2022-05-05 00:20:35', 46);

-- --------------------------------------------------------

--
-- Table structure for table `exam_master_data`
--

CREATE TABLE `exam_master_data` (
  `examMasterId` int NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subjectId` int NOT NULL,
  `computationMasterId` int NOT NULL,
  `computationItemsId` int NOT NULL,
  `eStatus` enum('Active','Inactive','Deleted') COLLATE utf8_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subjectId` int NOT NULL,
  `subjects` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive','Deleted') COLLATE utf8_unicode_ci NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `userId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subjectId`, `subjects`, `description`, `status`, `datecreated`, `dateupdated`, `userId`) VALUES
(1, 'Math', 'Numbers, Fraction', 'Active', '2022-04-21 00:51:55', '2022-04-21 00:54:35', 4),
(2, 'Science', 'Nature', 'Active', '2022-04-21 10:51:14', '2022-04-21 10:51:14', 4),
(3, 'English', 'Grammar', 'Active', '2022-04-21 10:51:53', '2022-04-21 10:51:53', 4),
(4, 'FIlipino', 'Salita', 'Active', '2022-04-21 15:19:51', '2022-04-21 15:19:51', 4),
(5, 'Araling Panlipunan', 'History', 'Active', '2022-04-21 22:10:39', '2022-04-21 22:10:39', 4),
(6, 'Edukasyon sa Pagpapakatao', 'Character', 'Active', '2022-04-21 22:11:21', '2022-04-21 22:11:21', 4),
(7, 'Edukasyong Pantahanan at Pangkabuhayan', 'Pagdidilig ', 'Active', '2022-04-21 22:12:02', '2022-04-21 22:12:02', 4),
(8, 'Music', 'Guitar Lesson', 'Active', '2022-04-21 22:12:14', '2022-04-21 22:12:41', 4),
(9, 'Arts', 'Drawing', 'Active', '2022-04-21 22:12:25', '2022-04-21 22:12:25', 4),
(10, 'Physical Education', 'Dancing', 'Active', '2022-04-21 22:12:58', '2022-04-21 22:12:58', 4),
(11, 'Health', 'Foods', 'Active', '2022-04-21 22:13:11', '2022-04-21 22:13:11', 4);

-- --------------------------------------------------------

--
-- Table structure for table `subjects_assign`
--

CREATE TABLE `subjects_assign` (
  `subjectAssignId` int NOT NULL,
  `subjectId` int NOT NULL,
  `computationMasterId` int NOT NULL,
  `classMasterId` int NOT NULL,
  `teacherId` int NOT NULL,
  `datecreated` datetime NOT NULL,
  `dateupdated` datetime NOT NULL,
  `userId` int NOT NULL,
  `status` enum('Active','Inactive','Deleted') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects_assign`
--

INSERT INTO `subjects_assign` (`subjectAssignId`, `subjectId`, `computationMasterId`, `classMasterId`, `teacherId`, `datecreated`, `dateupdated`, `userId`, `status`) VALUES
(1, 1, 6, 1, 12, '2022-04-21 23:58:30', '2022-04-29 11:33:09', 4, 'Active'),
(2, 2, 9, 2, 42, '2022-04-22 00:01:20', '2022-04-29 11:34:11', 4, 'Active'),
(3, 3, 11, 3, 43, '2022-04-22 11:03:32', '2022-04-29 11:32:41', 4, 'Active'),
(4, 4, 11, 4, 43, '2022-04-22 11:03:45', '2022-04-29 11:32:33', 4, 'Active'),
(5, 5, 11, 5, 43, '2022-04-22 11:04:00', '2022-04-29 11:32:48', 4, 'Active'),
(6, 6, 7, 6, 12, '2022-04-22 11:04:14', '2022-04-29 11:33:18', 4, 'Active'),
(7, 7, 10, 1, 44, '2022-04-22 11:04:25', '2022-04-29 11:34:33', 4, 'Active'),
(8, 8, 8, 2, 3, '2022-04-22 11:04:38', '2022-04-29 11:33:39', 4, 'Active'),
(9, 9, 8, 3, 3, '2022-04-22 11:04:51', '2022-04-29 11:33:45', 4, 'Active'),
(10, 10, 0, 4, 22, '2022-04-22 11:05:05', '2022-05-17 11:00:32', 4, 'Active'),
(11, 11, 8, 5, 3, '2022-04-22 11:05:15', '2022-04-29 11:33:50', 4, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `lrn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `role` enum('Teacher','Student','Admin') NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `status` enum('Active','Inactive','Deleted') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `email`, `lrn`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `role`, `date_created`, `date_updated`, `status`) VALUES
(2, 'arleneorlina@gmail.com', 'none', 'arlene222', '$2y$10$q2/CQmY03D1nJAhHNYYvhO6jWZNPY0gfOgYLWfY5dPSLhZWej/LDe', 'Arlene', 'S', 'Orlina', 'Teacher', '2022-03-20 20:26:15', '2022-05-16 13:11:43', 'Active'),
(3, 'evangelinetamondong@gmail.com', 'none', 'evangeline222', '$2y$10$jXDQ98QD3gHiqRiat4lJveu0fj741fQNxZ1dfXNNqMmgHTqb5nvsS', 'Evangeline', 'P', 'Tamondong', 'Teacher', '2022-03-20 20:31:40', '2022-05-04 23:48:18', 'Active'),
(4, '', 'admin@xyz.com', 'administrator', '$2y$10$02TSC8y1I0cl0QD/nJ/dPOELbw/BDap2vd34f6hRkF0P5Bt1oC26C', 'admin', '', 'admin', 'Admin', '2022-04-02 22:48:54', '2022-04-02 22:48:54', 'Active'),
(5, '', 'student1@xyz.com', 'student1', '$2y$10$GLyT/IhQDKPQhvScBbjMJe.EdGH5JnPCyJ74Kkg2eMXP4ovFBN7Aq', 'student', 'kh', '1', 'Student', '2022-04-02 22:58:53', '2022-04-21 11:06:10', 'Deleted'),
(6, '', 'new@xyz.com', 'newuser', '$2y$10$rSjVQk8j9zhPPwX7GR7xFu65mnExjhMJmPUnm/Fm2BqsuHHDvdcWK', 'New ', 'Ikaw', 'Na Nga', 'Student', '2022-04-03 00:34:41', '2022-04-03 00:37:41', 'Deleted'),
(7, '', 'second@xyz.com', 'second', '$2y$10$s/VxnhVrgBk78EkHPdClh.h51G.jg.AfR93LBSecvABbOClI7uj.y', 'Second', 'MIddle', 'One', 'Admin', '2022-04-03 00:35:27', '2022-04-03 00:37:36', 'Deleted'),
(8, '', 'gerald.taguibao@neu.edu.ph', 'geraldandrew222', '$2y$10$/RqtcvHfs7R/XP5S6HPdqeZMkpaLH1A2Yhrgu1YuWzeeQ.CJ7YcmG', 'Gerald Andrew', 'Tong', 'Taguibao', 'Student', '2022-04-03 16:38:46', '2022-05-16 23:15:16', 'Active'),
(9, '', 'danman.tester@gmail.com', 'admin_test', '$2y$10$WI9E45e/vKXe3Dp/YOpHDOcBvB5FBXUOTvbjWbvuRQ45u33mns9IS', 'Danilo', 'M', 'Manaog Jr.', 'Student', '2022-04-08 21:51:37', '2022-04-08 23:11:41', 'Active'),
(10, '', 'jorge.quilit@neu.edu.ph', 'capstone1', '$2y$10$ooV6mUJIciOh1dzSelCxieGXPHtccDET0D7wrQSVLt0wV6QErwioC', 'Jorge', 'B.', 'Quilit', 'Student', '2022-04-08 21:59:12', '2022-04-20 18:53:42', 'Active'),
(11, '', 'guro@gmail.com', 'Guro', '$2y$10$t47tSjWVdCMYUP/Sl/dlA.9DMM43FsL9eXIGI0iewnpR7M6kOfN7u', 'Guro', 'G', 'Guro', 'Teacher', '2022-04-08 22:03:44', '2022-04-08 22:03:44', 'Active'),
(12, 'margaritataguibao@gmail.com', 'nots - pass = abcd1234', 'margarita222', '$2y$10$5VXhsl7CS4us3DoGaL2LDOMjoUvG/S8rG19.vhB3wlczGZBntO2SS', 'Margarita ', 'Tong', 'Taguibao', 'Teacher', '2022-04-20 18:50:24', '2022-05-16 13:09:07', 'Active'),
(13, '', 'elsimbulan@neu.edu.ph', 'Jhun Simbulan', '$2y$10$duXcaKBD73nElUM4CUDSUuFecuNRz7nXu.nIHkZHdaYN3mSKikHQe', 'Edilberto', 'T', 'Simbulan', 'Teacher', '2022-04-20 18:54:41', '2022-04-20 18:54:41', 'Active'),
(14, '', 'jehwillramento@neu.edu.ph', 'jehwill', '$2y$10$E/LKEuYmpA2YMbzqZk8rKO6Dqkx.IrKVbnAoO/MDortJtbvv76.zi', 'Jehwill', 'G', 'Ramento', 'Student', '2022-04-20 18:55:28', '2022-05-08 09:37:30', 'Active'),
(15, '', 'karl.evalle@neu.edu.ph', 'karl', '$2y$10$jBt/U7ZdMxR4hebpSuZRzOjXLhVz/Famapp0zed8lI2pjbTydbD06', 'Karl', 'B.', 'Evalle', 'Student', '2022-04-20 18:56:17', '2022-04-20 18:56:17', 'Active'),
(16, '', 'Rafael.quizon@neu.edu.ph', 'Rafael', '$2y$10$AT7951yXca6xQYrGtOEC8u0.Irub8jJqHYLHEVTGsGAthb/N/YhYm', 'Rafael', 'U', 'Quizon', 'Student', '2022-04-20 18:57:57', '2022-04-20 18:57:57', 'Active'),
(17, '', 'renato.go@neu.edu.ph', 'Renato123', '$2y$10$duJFk9mC.jBsESWcs4plAe7zXT29WeONfZRTojrj9U8YF1R2Tzg7y', 'Renato', 'C.', 'Go.', 'Student', '2022-04-20 19:33:21', '2022-04-20 19:35:12', 'Active'),
(18, '', 'mark.frondez@neu.edu.ph', 'Markfrodez', '$2y$10$NWu0Y6eJxDYR2PXUtAjJee2rHqilr8UMt.JaFjsh9f4NFgUK8SmE.', 'Mark', 'P.', 'Frondez', 'Student', '2022-04-20 19:37:03', '2022-04-20 19:45:49', 'Active'),
(19, '', 'jazon.uzuma@gmail.com', 'Jazonuzuma', '$2y$10$aIgBOCdOg17zmgR.ZIbiauLpnQFaqYiy4z01XNZi/gRCgMeGiPd/a', 'Jazon', 'R.', 'Uzuma', 'Student', '2022-04-20 19:38:58', '2022-04-20 19:46:18', 'Active'),
(20, '', 'clarrisse@gmail.com', 'Clarisse123', '$2y$10$NleBVNEcdexRvyNOTOO86.kUvNLDS67K5KNIFaurZmuoarNJqAGcG', 'Clarrisse', 'D.', 'Mendoza', 'Student', '2022-04-20 19:41:05', '2022-04-20 19:47:04', 'Active'),
(21, '', 'nicole@gamil.com', 'Nicole123', '$2y$10$Z3vEW57Cuq9qR6GU5Dv6/.Ns4zL2xGlavZ.FucoG/TkomOJZqjrn2', 'Nicole', 'T.', 'Samson', 'Student', '2022-04-20 19:44:37', '2022-04-20 19:47:30', 'Active'),
(22, '', 'rey.aquino@neu.edu.ph', 'Rey123', '$2y$10$m7KjrVHQRHmBZD/gNRWUBOmMcAdTSPOvf2eZkjFFjlGwWud5gSU0m', 'Rey', 'E.', 'Aquino', 'Teacher', '2022-04-20 19:50:24', '2022-04-27 22:46:09', 'Active'),
(23, '', 'michael.bantayan@neu.edu.ph', 'Bantayan123', '$2y$10$1z.QafgyNyVG6H9AcubVhe0ZYkzyCoSovrAi8V9PnaS7osLhxlhhK', 'Michael', 'R.', 'Bantayan', 'Student', '2022-04-20 19:52:40', '2022-04-20 19:55:56', 'Active'),
(24, '', 'dixie.quiambao@neu.edu.ph', 'Dixie123', '$2y$10$18N76qcVXG2Yz3rP4TDFnOfbf6EX8A2wCKSTrScfNtZar01aVO5ky', 'Dixie', 'A.', 'Quiambao', 'Student', '2022-04-20 19:54:29', '2022-04-20 19:56:14', 'Active'),
(25, '', 'renz.cruz@neu.edu.ph', 'Renz123', '$2y$10$Ci1h7v2EyJmuuYajX9uGW.W7P6iBgypU54cAHeMvbODQthQX13YmC', 'Renz', 'P.', 'Cruz', 'Student', '2022-04-20 19:59:56', '2022-04-20 20:00:55', 'Active'),
(26, '', 'sylo.monterde@neu.edu.ph', 'sylo', '$2y$10$15EZmv.EzeTiM7.ZxwemYO5HwbVmYAO1xJo7nbUbdwb0T9k1FsNGy', 'Sylo', 'B.', 'Monterde', 'Student', '2022-04-20 21:14:41', '2022-04-20 21:14:41', 'Active'),
(27, '', 'Rap.Mondala@neu.edu.ph', 'Rap', '$2y$10$niexx1aRs1qoXQh/IqBNfezHm8bERx.1194ciMGW3PFPrs/PTNtfC', 'Rap', 'S', 'Mondala', 'Student', '2022-04-20 21:15:24', '2022-04-20 21:15:24', 'Active'),
(28, '', 'Neo.Esteves@neu.edu.ph', 'NEyo', '$2y$10$xj8i9ZdBH23xExktg1R04ufffhqAqgUpnQtKgLckHH5RlUJ3WGRge', 'Neo', 'M', 'Esteves', 'Student', '2022-04-20 21:15:57', '2022-04-20 21:15:57', 'Active'),
(29, '', 'jeremy.castillo@neu.edu.ph', 'jem', '$2y$10$jD40Lu97t0ApFT.znfRjAO9RHdTQ7aFzqqAO23OYTEXuECoNE0r.K', 'Jeremy', 'C', 'Castillo', 'Student', '2022-04-20 21:18:16', '2022-04-20 21:18:16', 'Active'),
(30, '', 'Mohaymen.barua@neu.edu.ph', 'mocsin', '$2y$10$S8.Um8b04WtDpniKTLWOVexWeb54lmQLX7ELAHgNIm8Y32Jy99SdK', 'Mohaymen', 'D', 'Barua', 'Student', '2022-04-20 21:18:54', '2022-04-20 21:18:54', 'Active'),
(31, '', 'almissal.abdullah@neu.edu.ph', 'almissal', '$2y$10$5QdJUfJIe8G83B6EY8VmM.u0EALKlQeJHPBrTebrIpqKSV1Ji3lxe', 'Almissal', 'S', 'Abdullah', 'Student', '2022-04-20 21:19:54', '2022-04-20 21:19:54', 'Active'),
(32, '', 'Mark.Cafe@neu.edu.ph', 'Mark', '$2y$10$5o8Zw8TwUzFS8EtTjGabIeSy/RSejJiUWHcjiKmOsbjObNW3tc61S', 'Mark', 'F', 'Cafe', 'Student', '2022-04-20 21:20:32', '2022-04-20 21:20:32', 'Active'),
(33, '', 'erik.abad@neu.edu.ph', 'Erik', '$2y$10$4.jT7q.d9YjFB0fsdSXRROoYK6hHkIIvBRd.nmkdzLD9uWfgShTUC', 'Erik', 'M', 'Abad', 'Student', '2022-04-20 21:27:23', '2022-04-20 21:27:23', 'Active'),
(34, '', 'Arnel.nieto@neu.edu.ph', 'Arnel', '$2y$10$1gvH9SOupZCcRZl3nEIUSuoUNA6zSsPsFevsAw8x5BjxpcU4z3aci', 'Arnel', 'T', 'Nieto', 'Student', '2022-04-20 21:28:45', '2022-04-20 21:28:45', 'Active'),
(35, '', 'jeriklein.ragos@neu.edu.ph', 'Jerik', '$2y$10$TBmcWSfBRrWqtK8TV0TbiOgAmDx00kgajfvYDDXfLOrdvxpFtb4tC', 'Jeriklein', 'B.', 'Ragos', 'Student', '2022-04-20 21:29:13', '2022-04-20 21:29:13', 'Active'),
(36, '', 'Arvin.rodrigo@neu.edu.ph', 'Rodrigo', '$2y$10$wSwwSnEnLHtOfjmyRnfBtO8I.oOX0p0d7WuG0sIt0o/vV.HDzM/xy', 'Arvin', 'M', 'Rodrigo', 'Student', '2022-04-20 21:29:59', '2022-04-20 21:29:59', 'Active'),
(37, '', 'Jericho.reyes@neu.edu.ph', 'jericho', '$2y$10$kvOt0ci5YguVNTYVGJMDreup52qQp1FLfzms19aumi.NgLLszklre', 'Jericho', 'S', 'Reyes', 'Student', '2022-04-20 21:30:26', '2022-04-20 21:30:26', 'Active'),
(38, '', 'Wilmer.quizmundo@neu.edu.ph', 'WIlmer', '$2y$10$1T5UsjoB.Bkj0SLm6OZULOVIdg7w5lS45aMpNhVeLAmPpjW/jX7OS', 'WIlmer', 'M', 'Quizmundo', 'Student', '2022-04-20 21:31:01', '2022-04-20 21:31:01', 'Active'),
(39, '', 'christian.suarez@gmail.com', 'Christian', '$2y$10$IewndUEbpl3JwyzT.jx0kek8b45cBCSfA1z.HQi1lXARZmXLhE5.2', 'Christian', 'M', 'Suarez', 'Student', '2022-04-21 22:08:36', '2022-04-21 22:08:36', 'Active'),
(40, 'emard.villaspin@neu.edu.ph', '1000', 'emard', '$2y$10$X3JLnqglZDpzyWG.5gcr8.VKN8EVW0R3GKiUmoWsydVgFc/pYPC2.', 'Emard', 'T', 'Villaspin', 'Student', '2022-04-21 22:09:00', '2022-04-29 10:51:11', 'Active'),
(41, '', 'NewLRN', 'testuser', '$2y$10$mp5Lks0dJ7YHQbOoSP0iHet5CR2FHsJn70fpPR8CZn8ZID6sp/VYu', 'test ', 'account', 'User', 'Admin', '2022-04-21 23:46:23', '2022-04-21 23:46:23', 'Active'),
(42, 'marygracedacillo@gmail.com', 'no', 'marygrace222', '$2y$10$nZYOMLbPbSHKZBlvtqNGEuGus13O/u0HJv.88QLNaUz1KheCPmKXK', 'Mary Grace', 'D', 'Dacillo', 'Teacher', '2022-04-29 10:39:32', '2022-04-29 10:39:32', 'Active'),
(43, 'shellyclaveria@gmail.com', 'nothing', 'shellyclaveria222', '$2y$10$ecnl7CzwaF0ptsRpecDPFepeeHMe24qdGJ9sJ8jMuEE.HGQ5lwWg2', 'Shelly', 'S', 'Claveria', 'Teacher', '2022-04-29 10:40:35', '2022-04-29 10:40:35', 'Active'),
(44, 'ednabelarma@gmail.com', 'not', 'edna222', '$2y$10$mkYUcK55dMyVXmVh4FEn..gRiGi6IZO3e9MswYNwKUFtlNfPjW.Nm', 'Edna', 'V', 'Belarma', 'Teacher', '2022-04-29 10:41:23', '2022-04-29 10:41:23', 'Active'),
(45, 'student@djes.edu.ph', '2022-00001', 'danman', '$2y$10$SaG319V/wTCKThlz8cd6O.eHT6sLeZi2awoj6fj0VIZBvDHTycAbW', 'student1', 'student1', 'student1', 'Student', '2022-05-04 23:26:07', '2022-05-04 23:33:53', 'Active'),
(46, 'testteacher@gmail.com', '', 'testteacher', '$2y$10$lhAPy0eGmBti/jKCkevFxecFeFwGtWWb0QcT7RGvhuEpkNW2PLo6W', 'Test', 'A.', 'Teacher', 'Teacher', '2022-05-05 00:19:27', '2022-05-05 00:19:27', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_items`
--
ALTER TABLE `category_items`
  ADD PRIMARY KEY (`categoryItemsId`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`classId`);

--
-- Indexes for table `classes_master_data`
--
ALTER TABLE `classes_master_data`
  ADD PRIMARY KEY (`classMasterId`);

--
-- Indexes for table `class_grade`
--
ALTER TABLE `class_grade`
  ADD PRIMARY KEY (`classGradeId`);

--
-- Indexes for table `class_total_items`
--
ALTER TABLE `class_total_items`
  ADD PRIMARY KEY (`classTotalItemsId`);

--
-- Indexes for table `computation_items`
--
ALTER TABLE `computation_items`
  ADD PRIMARY KEY (`computationItemsId`);

--
-- Indexes for table `computation_master`
--
ALTER TABLE `computation_master`
  ADD PRIMARY KEY (`computationMasterId`);

--
-- Indexes for table `exam_master_data`
--
ALTER TABLE `exam_master_data`
  ADD PRIMARY KEY (`examMasterId`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subjectId`);

--
-- Indexes for table `subjects_assign`
--
ALTER TABLE `subjects_assign`
  ADD PRIMARY KEY (`subjectAssignId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_items`
--
ALTER TABLE `category_items`
  MODIFY `categoryItemsId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `classId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `classes_master_data`
--
ALTER TABLE `classes_master_data`
  MODIFY `classMasterId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `class_grade`
--
ALTER TABLE `class_grade`
  MODIFY `classGradeId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `class_total_items`
--
ALTER TABLE `class_total_items`
  MODIFY `classTotalItemsId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `computation_items`
--
ALTER TABLE `computation_items`
  MODIFY `computationItemsId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `computation_master`
--
ALTER TABLE `computation_master`
  MODIFY `computationMasterId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `exam_master_data`
--
ALTER TABLE `exam_master_data`
  MODIFY `examMasterId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subjectId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subjects_assign`
--
ALTER TABLE `subjects_assign`
  MODIFY `subjectAssignId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
