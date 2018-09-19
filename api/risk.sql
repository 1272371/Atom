-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2018 at 12:12 PM
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
-- Database: `risk`
--

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE `login_tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(65) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, '73839', 'Student', 'Lesego', 'Seritili', '$2y$10$iYN61ahiJ9B3r8z9sKIIW.e5ahlGkWi8Fvn3Qo84EEi1x4.kZ0SAu', 'Scienc', 'CSAM', 2000),
(3, '828271', 'Staff', 'Kenny', 'G', '$2y$10$IAx1WE/B63hTpttBFUKCAupVDtWOulCAQVMmJOmqEEYlCaNX8wEya', 'Scienc', 'Human', 2003),
(5, '82827', 'Staff', 'Kenny', 'G', '$2y$10$RwJECCacdrwTVSaitZYyt.wyaP7EgE5d0PgE7D/CkH7iO6ZmdYBbS', 'Science', 'Humanities', 2003);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`);

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
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
