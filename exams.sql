-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2023 at 04:50 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exams`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `role` varchar(10) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `fullName`, `email`, `password`, `gender`, `age`, `role`, `created_time`) VALUES
(1, 'dusky', 'araz ezat mustafa', 'araz.maseeky@gmail.com', '$2y$10$6IBAtZ4Kf/wvFpz6sZJ7ZegZcaLG.b3dSdMr4Nc6BbNbey7L3BYvW', 'Male', 22, 'teacher', '2021-05-06 13:53:22'),
(2, 'omar', 'omar ismail mustafa', 'omarmaltay@gmail.com', '$2y$10$JKAL.MLd9eK87evw/.7Y7Ot4XGhM.D4nyzAXb3Mxw6j4DsQRgsKFC', 'Male', 19, 'teacher', '2021-05-08 12:55:39'),
(3, 'ahmed98', 'ahmed adel hussein', 'ahmedadel@gmail.com', '$2y$10$zsbNbKUKOy0hlIZk6d5eKOl15b61SA0VvzLR7mapXzL3nUlOXE.yi', 'Male', 20, 'teacher', '2021-05-06 13:53:31'),
(8, 'admin', 'ahmed adel hussein', 'ahmed@gmail.com', '$2y$10$XfsEW2YwCJ/3BoI5YRrLquj87DTymCIrsa36k6a1p0X12obuMaeNW', 'male', 21, 'admin', '2021-05-28 22:53:19'),
(14, 'a98', 'student', 'aaa@yahoo', '$2y$10$KDceZQEgn7R81WaRHTfCEeRiArCctK254p9AKYIiPL/1AZRQGJjZO', 'male', 11, 'student', '2021-05-10 21:18:07'),
(17, 'adhem', 'adham dawoon muhammed', 'adham.dawood@gmail.com', '$2y$10$FBGT4vr/BCKj/29ZDCIdoeKvHi2kOFf4X6mt15HBW2.CSObfLWkzG', 'male', 22, 'student', '2021-05-17 20:12:06'),
(18, 'ahmed', 'ahmed adel hussein', 'ahmed.adel@gmail.com', '$2y$10$WyCJcJYM/r7EFxyTLZvRO.Xl1xyYYOzPYRdkgNq/8j7UdQKBLW6FS', 'male', 22, 'student', '2021-05-17 20:56:42'),
(19, 'ahmedKareem', 'ahmed omar kareem', 'ahmed.kareem@gmail.com', '$2y$10$k31HRq/KDZU497ty2sUL/O2SWdp5DMSjqPbf2eMjZULvY8jFW82BO', 'male', 22, 'teacher', '2021-05-17 21:13:39'),
(20, 'omarAli', 'omar ali mohamed', 'omar.ali@gmail.com', '$2y$10$Hn0TOeiB6prTVpDu/PbyR.9TFp98G69anPYusI6yIlGeOsqpr4TbK', 'male', 25, 'student', '2021-05-17 21:21:31'),
(21, 'aram', 'aram omar mohamed', 'jhvbj@mb.ddd', '$2y$10$lt3Y/UABAR4d2BcoN50OhO4NcRFgiCBvyfVtNzLmmrPJQtYZHiguG', 'male', 22, 'teacher', '2021-05-28 17:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `answer`
--

CREATE TABLE `answer` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answered_index` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `answer`
--

INSERT INTO `answer` (`answer_id`, `question_id`, `answered_index`, `account_id`, `exam_id`) VALUES
(42, 36, 1, 18, 46),
(43, 38, 2, 18, 46),
(44, 39, 2, 18, 46),
(45, 41, 2, 18, 46),
(46, 42, 2, 18, 58),
(47, 44, 2, 18, 58),
(48, 45, 1, 18, 58),
(49, 47, 3, 18, 58),
(50, 50, 1, 18, 57),
(51, 53, 1, 18, 57),
(52, 54, 2, 18, 57);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(255) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class_name`) VALUES
(2, 'computer'),
(3, 'bio'),
(4, 'phisic'),
(5, 'others'),
(7, 'math');

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `ide` int(255) NOT NULL,
  `examName` text NOT NULL,
  `examCode` varchar(50) NOT NULL,
  `exam_duration` int(11) NOT NULL,
  `isEnable` int(11) NOT NULL,
  `isPublic` int(11) NOT NULL,
  `isRand` int(11) NOT NULL,
  `totalPoints` int(11) NOT NULL,
  `accountId` int(255) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_created_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`ide`, `examName`, `examCode`, `exam_duration`, `isEnable`, `isPublic`, `isRand`, `totalPoints`, `accountId`, `class_id`, `exam_created_time`) VALUES
(45, 'math', '222222', 100, 0, 1, 0, 10, 1, 7, '2021-05-17 18:51:46'),
(46, 'math 1', '333333', 100, 1, 1, 0, 10, 1, 7, '2021-05-17 18:54:23'),
(56, 'mixed exam', '111', 65, 0, 1, 0, 15, 2, 5, '2021-05-18 12:48:38'),
(57, 'sci', '222', 65, 1, 1, 0, 10, 1, 2, '2021-05-27 19:06:38'),
(58, 'math2', '444', 100, 1, 0, 0, 8, 1, 7, '2021-05-27 19:30:51');

-- --------------------------------------------------------

--
-- Table structure for table `exams_taken`
--

CREATE TABLE `exams_taken` (
  `idt` int(255) NOT NULL,
  `account_id` int(11) NOT NULL,
  `score` int(100) NOT NULL,
  `points` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `examId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `exams_taken`
--

INSERT INTO `exams_taken` (`idt`, `account_id`, `score`, `points`, `duration`, `datetime`, `examId`) VALUES
(11, 14, 1, 1, 47, '2021-05-11 03:31:46', 41),
(12, 9, 2, 4, 11, '2021-05-11 18:58:52', 17),
(13, 9, 1, 10, 17, '2021-05-11 19:32:56', 43),
(14, 15, 0, 0, 3, '2021-05-11 19:47:27', 32),
(15, 17, 0, 0, 100, '2021-05-17 20:52:01', 46),
(16, 18, 2, 4, 54, '2021-05-17 21:01:37', 46),
(17, 18, 4, 8, 17, '2021-05-27 19:48:31', 58),
(18, 18, 2, 8, 38, '2021-05-29 08:02:28', 57);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `message` text COLLATE utf8mb4_bin NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `firstname`, `lastname`, `email`, `phone`, `message`, `create_date`) VALUES
(22, 'ahmed', 'adel', 'ahmed.adel@gmail.com', '+9647507560220', 'Hi, I hope you are having a wonderful day', '2021-05-18 13:40:47'),
(23, 'omar', 'duhoki', 'omarduhoki@gmail.com', '07501234567', 'hi how are you', '2021-05-28 13:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `idq` int(255) NOT NULL,
  `Points` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer1` varchar(500) NOT NULL,
  `answer2` varchar(500) NOT NULL,
  `answer3` varchar(500) NOT NULL,
  `answer4` varchar(500) NOT NULL,
  `correct` varchar(500) NOT NULL,
  `examId` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`idq`, `Points`, `question`, `answer1`, `answer2`, `answer3`, `answer4`, `correct`, `examId`) VALUES
(36, 2, '11*11', '111', '123', '120', '200', '1', 46),
(37, 2, '7*7=49', 'false', 'true', '', '', '2', 46),
(38, 2, '13*16', '326', '230', '208', '280', '3', 46),
(39, 2, '6+9', '17', '13', '19', '15', '4', 46),
(41, 2, '42/6', '9', '8', '6', '7', '2', 46),
(45, 2, '4*2', '8', '9', '10', '', '1', 58),
(47, 2, '4*4', '15', '40', '16', '', '3', 58),
(48, 2, '20/4 ?', '4', '5', '6', '2', '2', 58),
(50, 6, 'bjnk', 'jkn', 'bujhkj', '', '', '1', 57),
(52, 2, '1+5 ?', '1', '6', '', '', '2', 58),
(53, 2, 'aaaa', 'water', 'bb', 'aaa', '', '2', 57),
(54, 2, '9+1 ?', '8', '10', '4', '6', '2', 57);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`ide`),
  ADD UNIQUE KEY `examCode` (`examCode`),
  ADD KEY `accountId` (`accountId`);

--
-- Indexes for table `exams_taken`
--
ALTER TABLE `exams_taken`
  ADD PRIMARY KEY (`idt`),
  ADD KEY `examId` (`examId`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`idq`),
  ADD KEY `examId` (`examId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `answer`
--
ALTER TABLE `answer`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `ide` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `exams_taken`
--
ALTER TABLE `exams_taken`
  MODIFY `idt` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `idq` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
