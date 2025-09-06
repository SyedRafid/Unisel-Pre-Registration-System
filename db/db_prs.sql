-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2023 at 05:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_prs`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cid` int(11) NOT NULL,
  `courseCode` varchar(10) NOT NULL,
  `courseName` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cid`, `courseCode`, `courseName`, `CreationDate`) VALUES
(2, 'MPU3322', 'Introduction To Malaysian Legal System', '2023-10-25 10:10:15'),
(3, 'MPU3472', 'Green Awareness And Sustainability In Community ', '2023-10-25 10:11:32'),
(5, 'IAS1322', 'Information System', '2023-10-25 10:56:53'),
(6, 'ZES1133', 'Technical English 1', '2023-10-25 10:57:32'),
(7, 'ZES1243', 'Technical English 2', '2023-10-25 10:57:50'),
(8, 'IAS1253', 'Computer Fundamental', '2023-10-25 10:58:27'),
(9, 'IAS1162', 'Human Personality & Team Building', '2023-10-25 11:01:21'),
(10, 'IAS1112', 'Excellent Ethics and Manners', '2023-10-25 11:01:44'),
(11, 'ZLU1222', 'Mandarin 1', '2023-10-25 11:02:00'),
(12, 'ZLU1232', 'Arabic 1', '2023-10-25 11:02:15'),
(13, 'IAS3313', 'IT Sales and marketing', '2023-10-25 11:02:43'),
(14, 'IAS3113', 'Interactive Multimedia', '2023-10-25 11:02:59'),
(15, 'IAS3373', 'Telecomunication', '2023-10-25 11:03:12'),
(16, 'IAS3213', 'E-Commerce', '2023-10-25 11:03:29'),
(17, 'IAS2343', 'Managing IT', '2023-10-25 11:03:43'),
(18, 'MPU3152', 'Falsafah dan Isu Semasa', '2023-10-25 11:05:11'),
(19, 'MPU3182', 'Penghayatan Etika dan Peradaban', '2023-10-25 11:05:26'),
(20, 'MPU3142', 'Bahasa Melayu Komunikasi', '2023-10-25 11:05:39'),
(21, 'MPU3232', 'Kemahiran Al Quran 2', '2023-10-25 11:05:52'),
(22, 'MPU3222', 'Social Work Skills', '2023-10-25 11:06:04'),
(23, 'MPU3212', 'Bahasa Kebangsaan A', '2023-10-25 11:06:17'),
(24, 'MPU3312', 'Dakwah Islam di Malaysia', '2023-10-25 11:06:36'),
(25, 'MPU3342', 'Pengajian Selangor', '2023-10-25 11:08:42'),
(26, 'MPU3352', 'Integriti dan Anti Rasuah', '2023-10-25 11:09:00'),
(27, 'MPU3462', 'Wellness & Physical Activities/Health & Fitness', '2023-10-25 11:09:31'),
(28, 'ISS1123', 'Introduction to Software Engineering', '2023-10-25 11:10:58'),
(29, 'ISS2113', 'Software Requirement', '2023-10-25 11:11:15'),
(30, 'ISS2263', 'Software Design and Architecture', '2023-10-25 11:11:34'),
(31, 'ISS2283', 'Software Testing', '2023-10-25 11:11:54'),
(32, 'ISS2253', 'Software Construction', '2023-10-25 11:12:07'),
(33, 'ISS2273', 'Software Quality Assurance', '2023-10-25 11:12:24'),
(34, 'ISS3163', 'Software Maintenance and Evolution', '2023-10-25 11:12:37'),
(35, 'IAS1123', 'Programming Methodology', '2023-10-25 11:12:51'),
(36, 'IAS1313', 'Object Oriented Programming', '2023-10-25 11:13:06'),
(37, 'IAS2253', 'Computer and Network Security', '2023-10-25 11:13:26'),
(38, 'IAS2143', 'Database System', '2023-10-25 11:13:41'),
(39, 'IAS2213', 'Discrete Mathematics', '2023-10-25 11:13:56'),
(40, 'IAS2313', 'Artificial Intelligence', '2023-10-25 11:14:14'),
(41, 'IAS2163', 'Visual Programming', '2023-10-25 11:14:38'),
(42, 'IAS2243', 'Web Application Development', '2023-10-25 11:20:05'),
(43, 'IAS3153', 'Mobile Programming', '2023-10-25 11:21:09'),
(44, 'IAS3232', 'Final Year Project 1', '2023-10-25 11:21:32'),
(45, 'IAS3244', 'Final Year Project 2', '2023-10-25 11:21:48'),
(46, 'IAS1233', 'Operating System', '2023-10-25 11:23:20'),
(47, 'FMS1113', 'Mathematics', '2023-10-25 11:26:48'),
(48, 'ZES2312', 'Public Speaking & Communication Skills', '2023-10-25 11:27:19'),
(51, 'IAS1113', 'Intro To Web Design', '2023-10-25 11:47:46'),
(52, 'IAS2363', 'Technoprenurship', '2023-10-25 11:49:18'),
(53, 'FMS1323', 'Statistics', '2023-10-25 11:50:13'),
(55, 'IAS2223', 'Human Computer Interaction', '2023-10-25 11:52:10'),
(56, 'IAS3133', 'Project Management', '2023-10-25 12:02:14'),
(57, 'IAS2123', 'Computer Organization', '2023-10-25 12:04:04'),
(58, 'IAS2153', 'Computer Networking', '2023-10-25 12:04:24'),
(59, 'IAS1223', 'Data Structures and Algorithms', '2023-10-25 12:04:53'),
(60, 'IAS3316', 'Industrial Trainning', '2023-10-25 12:06:50');

-- --------------------------------------------------------

--
-- Table structure for table `extracredit`
--

CREATE TABLE `extracredit` (
  `ecid` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `sid` int(11) NOT NULL,
  `reason` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `kola` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `pCode` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `pName` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`pCode`, `pName`) VALUES
('AD301', 'DIPLOMA IN DIGITAL GRAPHIC DESIGN'),
('AD302', 'DIPLOMA IN PHOTOGRAPHY TECHNOLOGY'),
('AD401', 'BACHELOR IN DIGITAL GRAPHIC DESIGN'),
('CM301', 'DIPLOMA IN COMMUNICATION AND MEDIA'),
('CM402', 'BACHELOR OF COMMUNICATION (HONS) (JOURNALISM)'),
('CM403', 'BACHELOR OF COMMUNICATION (HONOURS) (CORPORATE COMMUNICATION)'),
('CM601', 'MASTER OF COMMUNICATION STRATEGIC AND GRAPHIC DESIGN'),
('FS401', 'BACHELOR OF SCIENCE (HONOURS) MATHEMATICS WITH STATISTICS'),
('IT301', 'DIPLOMA IN INFORMATION TECHNOLOGY '),
('IT302', 'DIPLOMA IN COMPUTER SCIENCE (INDUSTRIAL COMPUTING)'),
('IT303', 'DIPLOMA IN MULTIMEDIA INDUSTRY'),
('IT401', 'BACHELOR OF INFORMATION TECHNOLOGY '),
('IT402', 'BACHELOR OF SOFTWARE ENGINEERING '),
('IT403', 'BACHELOR OF COMPUTER SCIENCE'),
('IT405', 'BACHELOR OF MULTIMEDIA INDUSTRY'),
('IT601', 'MASTER OF INFORMATION TECHNOLOGY'),
('IT603', 'MASTER OF SCIENCE (COMPUTING)'),
('IT701', 'DOCTORATE OF PHILOSOPHY'),
('SS301', 'DIPLOMA IN LIBRARY MANAGEMENT'),
('SS402', 'BACHELOR OF LIBRARY MANAGEMENT');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `sid` int(11) NOT NULL,
  `SemesterCode` int(10) NOT NULL,
  `semesterName` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `startDate` datetime DEFAULT NULL,
  `endDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`sid`, `SemesterCode`, `semesterName`, `CreationDate`, `status`, `startDate`, `endDate`) VALUES
(1, 12334, 'Semester April 2023', '2023-10-25 09:19:16', 2, '2023-11-05 23:59:00', '2023-11-30 23:58:00'),
(2, 22334, 'Semester August 2023', '2023-10-25 09:52:46', 1, '2023-12-11 23:59:00', '2023-12-20 23:58:00'),
(3, 32334, 'Semester November 2023', '2023-10-26 09:53:14', 0, '2023-11-12 23:59:00', '2023-11-21 23:58:00'),
(4, 12434, 'Semester April 2024', '2023-10-26 09:53:29', 0, '2023-11-04 23:59:00', '2023-11-16 23:59:00'),
(5, 22434, 'Semester August 2024', '2023-10-26 09:53:54', 0, '2023-10-11 23:59:00', '2023-10-20 16:22:41'),
(6, 32434, 'Semester November 2024', '2023-10-26 09:54:37', 0, '2023-11-04 23:59:00', '2023-11-14 23:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `semestercourse`
--

CREATE TABLE `semestercourse` (
  `uid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `studentId` varchar(15) DEFAULT NULL,
  `icno` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contactNo` text DEFAULT NULL,
  `intake` int(11) DEFAULT NULL,
  `pCode` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `userType` varchar(5) NOT NULL,
  `CreationDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `studentId`, `icno`, `email`, `contactNo`, `intake`, `pCode`, `password`, `userType`, `CreationDate`) VALUES
(7, 'Syed Muztaba Rafid Shuvon', '4183008591', 'BW0050130', 'syed.shuvon@gmail.com', '0163451445', 21902, 'IT402', '$2y$10$Tw7vD5qiAivUiIQIEJNRaep4fwnYS8zcVnopooAL6QP6.tiiMjevS', 'admin', '2023-10-25 16:11:17');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--

CREATE TABLE `userlog` (
  `id` int(11) NOT NULL,
  `uid` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `userip` binary(30) DEFAULT NULL,
  `loginTime` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `extracredit`
--
ALTER TABLE `extracredit`
  ADD PRIMARY KEY (`ecid`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`pCode`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `semestercourse`
--
ALTER TABLE `semestercourse`
  ADD PRIMARY KEY (`uid`,`sid`,`cid`),
  ADD KEY `FK_sid` (`sid`),
  ADD KEY `Fk_cid` (`cid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `FK_pCode` (`pCode`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK` (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `extracredit`
--
ALTER TABLE `extracredit`
  MODIFY `ecid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `semestercourse`
--
ALTER TABLE `semestercourse`
  ADD CONSTRAINT `FK_sid` FOREIGN KEY (`sid`) REFERENCES `semester` (`sid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_uid` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_cid` FOREIGN KEY (`cid`) REFERENCES `course` (`cid`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_pCode` FOREIGN KEY (`pCode`) REFERENCES `program` (`pCode`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
