-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 07:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinetest`
--

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE `exam` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `correct` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`id`, `question`, `answer`, `correct`) VALUES
(1, '1 + 1', '[\"3\",\"4\",\"2\",\"1\"]', '2'),
(2, 'mantap', '[\"3\",\"4\",\"2\",\"1\"]', '1'),
(3, '5 +3', '[\"3\",\"4\",\"8\",\"1\"]', '2');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `total_question` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `user`, `score`, `total_question`, `created_at`, `updated_at`) VALUES
(3, 'aldi', 1, 2, '2025-01-09 04:38:44', '2025-01-09 04:38:44'),
(4, 'aldi', 1, 2, '2025-01-09 04:41:10', '2025-01-09 04:41:10'),
(5, 'aldi', 1, 2, '2025-01-09 04:41:53', '2025-01-09 04:41:53'),
(6, 'aldi', 2, 2, '2025-01-09 04:42:21', '2025-01-09 04:42:21'),
(7, 'aldi', 1, 2, '2025-01-09 04:46:52', '2025-01-09 04:46:52'),
(8, 'Haldhira Ladiva', 1, 3, '2025-01-09 14:27:24', '2025-01-09 14:27:24'),
(9, 'Haldhira Ladiva', 2, 3, '2025-01-09 08:46:00', '2025-01-09 08:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'super_admin'),
(2, 'guru'),
(3, 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `photo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_name`, `username`, `photo`) VALUES
('', 'Haldhira Ladiva', 'siswa_satu', 'Haldhira Ladiva.png');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `role` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `failed_attempt` int(11) DEFAULT NULL,
  `password_expiry` date DEFAULT NULL,
  `secret_key` varchar(255) NOT NULL,
  `is_confirm` tinyint(1) NOT NULL DEFAULT 0,
  `remarks` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `name`, `email`, `role`, `username`, `password`, `failed_attempt`, `password_expiry`, `secret_key`, `is_confirm`, `remarks`) VALUES
(1, 'super_admin', 'superadmin@admin.com', 'super_admin', 'super_admin', '$2y$10$SG91TLLnA9Fa5XXXsrfYi.O.Iuh1vVjJyZIrbQ7/eoMDASW16l6Tm', 0, '2023-02-11', '', 0, ''),
(7, 'Haldhira Ladiva', 'siswa@siswa.com', 'siswa', 'siswa_satu', '$2y$10$LN86GPCXE4kUydYr0rUK/udGVOLZ.rIm/vZln5RWqd5XkQhANFBZu', 0, '2025-04-10', '', 0, ''),
(6, 'guru', 'guru@guru.com', 'guru', 'guru_satu', '$2y$10$RzcbBqZIG17qHsC8XEHsieUMl7Hg1pO5Zv9KLsgIThxiGl1LR/N5u', 0, '2025-04-10', '', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
