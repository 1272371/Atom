-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 19, 2018 at 03:42 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_risk`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `school` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `school`) VALUES
(10, 'COMPUTER SCIENCE', 1),
(11, 'COMPUTATIONAL AND APPLIED MATHS', 1),
(12, 'PHYSICS', 3),
(13, 'STATISTICS', 9),
(14, 'ACTUARIAL SCIENCE', 9),
(15, 'ECONOMICS', 11),
(16, 'INFORMATION SYSTEMS', 14);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `faculty_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `faculty_name`) VALUES
(3, 'COMMERCE'),
(10, 'EDUCATION'),
(7, 'ENGINEERING AND THE BUILT ENVIRONMENT'),
(9, 'HEALTH SCIENCE'),
(4, 'HUMANITIES'),
(1, 'SCIENCE');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `weight` int(11) NOT NULL COMMENT 'weight of the test',
  `test_total` int(11) NOT NULL,
  `percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(65) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(1, 'dfea83452bd8389f35b1cca32ff98c629bb87ee7', 2),
(2, 'da9f034987ccc64151e04b276a3e1f080f64ee07', 2),
(3, '9a67112ffe736a3e3d8bfb5c5998e6cd04b12495', 2),
(4, 'cd7d2125e4a31e13bcc9c09bbe12cc7008b7bf28', 2),
(5, '86a6877497ba0453e312545153a80a2454235d7c', 2),
(6, '954189eb3f2fe75b2455fdbc899776da130c1f84', 2),
(7, '6f2620fcdcc22a5a579d6327e91f9cd57e69fe21', 2),
(8, '8f4a4b01f674e07df70071c6599b7855b90a0552', 2);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `course` int(11) NOT NULL,
  `module_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `module_name`, `course`, `module_code`) VALUES
(1, 'DATABASE FUNDAMENTALS', 10, 'COMS 2002'),
(2, 'FORMAL LANGUAGES AND AUTOMATA', 10, 'COMS 3003'),
(3, 'PHYSICS MAJOR', 12, 'PHYS 1000'),
(4, 'COMPUTATIONAL AND APPLIED MATHEMATICS', 11, 'CAM 1006');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_name`, `faculty_id`) VALUES
(1, 'COMPUTER SCIENCE AND APPLIED MATHEMATICS', 1),
(3, 'PHYSICS', 1),
(4, 'CHEMISTRY', 1),
(7, 'MATHEMATICS', 1),
(8, 'BIOLOGY', 1),
(9, 'STATISTICS AND ACTUARIAL SCIENCE', 1),
(10, 'ACCOUNTING SCIENCES', 3),
(11, 'ECONOMICS', 3),
(14, 'INFORMATION SYSTEMS', 3),
(15, 'COMMERCIAL LAW', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `student_nr` varchar(20) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `user_name` varchar(65) NOT NULL,
  `user_surname` varchar(65) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_coursecode` varchar(65) NOT NULL,
  `user_school` varchar(65) NOT NULL,
  `user_enrollmentyear` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `student_nr`, `user_type`, `user_name`, `user_surname`, `user_password`, `user_coursecode`, `user_school`, `user_enrollmentyear`) VALUES
(1, '1234567', 'student', 'John', 'Doe', '$2y$10$bmdRYH.OfzTtpmG4FjoB1u1PXxhWo0xC0molW1y5hM7fd0mVnEDFO', 'BSC000', 'MATHS', 2018),
(2, '123456', 'STAFF', 'Lesego', 'Seritili', '$2y$10$iYN61ahiJ9B3r8z9sKIIW.e5ahlGkWi8Fvn3Qo84EEi1x4.kZ0SAu', 'SCIENCE', 'CSAM', 2000),
(6, '78291b', 'Staff', 'Hello', 'World', '$2y$10$VZiItd9GKVj98arr7CR4L.WxBbScplLZh.KosQuhBy3xBefPJ/Ufi', 'Science', 'Physics', 2008),
(7, '8383893', 'Student', 'iosdjdois', 'oijfaoidg', '$2y$10$z.74b8grilLfomjXuunqQe4T6g3AZrDaFQ1ATeyp7Q.TtAQ4C8DOm', 'Science', 'Maths', 2007);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_name` (`course_name`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faculty_name` (`faculty_name`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module_code` (`module_code`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_nr` (`student_nr`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
