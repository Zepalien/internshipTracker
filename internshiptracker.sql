-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2026 at 07:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internshiptracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `company_address` varchar(100) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `interview_date` datetime DEFAULT NULL,
  `interview_type` varchar(50) DEFAULT NULL,
  `interview_location` text DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `modify` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `company_name`, `company_address`, `role`, `status`, `interview_date`, `interview_type`, `interview_location`, `created`, `modify`) VALUES
(11, 'Loreal', 'JB', 'Data analyst', 3, NULL, NULL, NULL, '2026-05-09 00:32:09', '2026-05-09 08:32:09'),
(14, 'Persada', 'PETALING JAYA', 'SYSTEM ANALYST', 0, NULL, NULL, NULL, '2026-05-09 00:25:38', '2026-05-09 00:25:38'),
(16, 'Deloitte', 'TTDI', 'System Developer', 2, '2026-05-23 10:30:00', '', '', '2026-05-10 02:28:44', '2026-05-10 10:28:44'),
(17, 'Petronas', 'Cyberjaya', 'Data analyst', 1, NULL, NULL, NULL, '2026-05-09 00:56:36', '2026-05-09 08:56:36'),
(18, 'Legoland', 'JB', 'Secure Data', 1, NULL, NULL, NULL, '2026-05-09 00:57:24', '2026-05-09 08:57:24'),
(19, 'Loreal', 'jb', 'Secure Data', 2, '2026-05-30 19:43:00', 'Online', 'gjh,hk', '2026-05-11 05:43:29', '2026-05-11 13:43:29'),
(21, 'Aeon Bank', 'Petaling Jaya', 'SYSTEM ANALYST', 2, NULL, 'Physical', '', '2026-05-18 20:50:14', '2026-05-19 04:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `application_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `application_id`, `name`, `file_path`, `type`, `category`, `created`) VALUES
(1, 10, 'RESUME New', 'AULYANABILA BINTI ANUAR RESUME.pdf', 'application/pdf', 'Resume', '2026-05-09 02:02:57'),
(2, 16, 'RESUME', 'AULYANABILA BINTI ANUAR RESUME.pdf', 'application/pdf', 'Resume', '2026-05-09 10:13:19'),
(4, NULL, 'Transcript', 'TRANSKRIP_MINI_ENG_HEA.pdf', 'application/pdf', 'Transcript', '2026-05-09 15:57:23'),
(6, 21, 'RESUME', 'Resume_Aulya.pdf', 'application/pdf', 'Resume', '2026-05-13 13:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `name` varchar(250) NOT NULL,
  `emel_adress` varchar(500) NOT NULL,
  `password` varchar(255) NOT NULL,
  `course_code` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `emel_adress`, `password`, `course_code`) VALUES
(1, 'Aulya', 'aulyanabila.bella@gmail.com', 'Bella30', 'SI262'),
(2, 'Bella', 'bella@gmail.com', 'bellacomel30', 'IMS566'),
(3, 'nini', 'aulya@gmail.com', '12345678', 'SI262'),
(4, 'Aulya', 'aulyanabila.bella@gmail.com', '12', 'SI262');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
