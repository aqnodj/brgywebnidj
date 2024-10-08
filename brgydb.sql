-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2024 at 11:35 AM
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
-- Database: `brgydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `purok_population`
--

CREATE TABLE `purok_population` (
  `id` int(11) NOT NULL,
  `purok_name` varchar(50) NOT NULL,
  `population` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purok_population`
--

INSERT INTO `purok_population` (`id`, `purok_name`, `population`) VALUES
(1, 'Purok 1', 120),
(2, 'Purok 2', 150),
(3, 'Purok 3', 100),
(4, 'Purok 4', 130),
(5, 'Purok 5', 90),
(6, 'Purok 6', 160),
(7, 'Purok 7', 110);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) NOT NULL,
  `suffix` varchar(10) DEFAULT NULL,
  `contact` int(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `suffix`, `contact`, `email`, `password`, `account_type`, `created_at`) VALUES
(14, 'admin', 'admin', 'admin', '', 654216441, 'admin', '$2y$10$1iVIX/wW3MUSN2PWlH0IwuLFhbqRK12Eyql9j67Ixo0mQTTFZo9wW', 1, '2024-10-05 05:37:13'),
(15, 'user', 'users', 'user', '', 654216441, 'user', '$2y$10$vkS7lq1pIE8vwKlzfsdpH.FpCeE8S.wgsdZsYGQKisq.uFs3LKCE2', 3, '2024-10-05 05:52:09'),
(16, 'staff', 'st', 'staff', '', 654216441, 'staff', '$2y$10$5yY6zWWxaqdX0DmP.9sDPupXGcNu./VpFjLHnctF4oPyFIKRmqsSC', 2, '2024-10-05 05:52:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purok_population`
--
ALTER TABLE `purok_population`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purok_population`
--
ALTER TABLE `purok_population`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
