-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 08:55 AM
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
-- Database: `brgydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `message`, `date`) VALUES
(3, 'asdxqweadf', '2024-10-19 06:54:39');

-- --------------------------------------------------------

--
-- Table structure for table `blotter_report`
--

CREATE TABLE `blotter_report` (
  `blotter_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `report_content` text DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','assigned','canceled') DEFAULT 'pending',
  `meeting_date` date DEFAULT NULL,
  `meeting_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blotter_report`
--

INSERT INTO `blotter_report` (`blotter_id`, `user_id`, `report_content`, `reason`, `status`, `meeting_date`, `meeting_time`, `created_at`) VALUES
(83, 28, 'sinapak ako ni quisto', 'trip ko lang', 'canceled', NULL, NULL, '2024-10-19 04:37:42'),
(84, 27, 'sinapak ako ni nils', 'trip ko lang din\r\n', 'assigned', '2024-10-09', '16:54:00', '2024-10-19 04:38:13'),
(85, 25, 'awq', 'axa', 'pending', NULL, NULL, '2024-10-19 06:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `residents`
--

CREATE TABLE `residents` (
  `id` int(11) NOT NULL,
  `household_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `age` int(11) NOT NULL,
  `is_registered_voter` tinyint(1) DEFAULT 0,
  `date_of_birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `house_no` varchar(10) NOT NULL,
  `street` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` enum('male','female','other') NOT NULL,
  `account_type` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `last_name`, `first_name`, `middle_name`, `contact_number`, `email`, `password`, `house_no`, `street`, `barangay`, `municipality`, `position`, `age`, `sex`, `account_type`) VALUES
(15, 'Staff1', 'Staff', 'Staff', '09565413', 'staff@gmail.com', '$2y$10$CGpbSXRiAw.Z0x2moiOdbOswGPeUR.I5sq8tnw6Z3TcijiLW/h7He', '3543', '12512', '123asds', 'batangas', 'small forward', 213, 'male', 2),
(16, 'Staff2', 'S', 'Staff2', 'qwewqe', 'staff2@gmail.com', '$2y$10$G8ycFJUdJAzBV5s2rlg6guZJTcmwoUAgWQe5Q5purTTvJ8XUnX4ii', 'sa', 'sadqw', 'qqw', 'asd', 'qwc', 23, 'male', 2);

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
(15, 'user', 'users', 'user', '', 654216441, 'user', '$2y$10$vkS7lq1pIE8vwKlzfsdpH.FpCeE8S.wgsdZsYGQKisq.uFs3LKCE2', 3, '2024-10-05 05:52:09'),
(16, 'staff', 'st', 'staff', '', 654216441, 'staff', '$2y$10$5yY6zWWxaqdX0DmP.9sDPupXGcNu./VpFjLHnctF4oPyFIKRmqsSC', 2, '2024-10-05 05:52:22'),
(25, 'user2', 'user', 'user2', 'asd', 955264132, 'user2@gmail.com', '$2y$10$LaHPwhaZHA0QRf9k6JEsbuXXOV.dTTEYGZzc04z4LUh.H15cc2WJO', 3, '2024-10-19 02:22:25'),
(26, 'admin', 'admin', 'admin', 'a', 654216441, 'admin@gmail.com', '$2y$10$0eBm9nuEDGfzs8cYt6dNKuChngVBCP3opqm1KlvzJCxc2/sk7P1MG', 1, '2024-10-19 03:04:01'),
(27, 'JV', 'n', 'Quisto', 'n', 654216441, 'jv@gmail.com', '$2y$10$MBN9kKFBGQbJYcIEbGdvGudUnlAf2oCOr53n8EtLqZWt/6QTdDjwO', 3, '2024-10-19 04:34:10'),
(28, 'Nils', 'user', 'Martija', 'a', 654216441, 'nils@gmail.com', '$2y$10$WjHP8waN5/MULUtFXYFhq.uTgSUju9hqHURluSsIJDIqJu/N4duGO', 3, '2024-10-19 04:36:56'),
(29, 'kevin', 'raul', 'jamess', 'asd', 98784315, 'k@gmail.com', '$2y$10$5lbXuO2Mt/ZSpT./MGyxVe0ezV7nm5vKZ6piVpNFu1wZrgRGryIWi', 3, '2024-10-19 06:18:12'),
(30, 'lebron', 'haha', 'Martija', 'a', 955264132, 'l@gmail.com', '$2y$10$lilmDcqlrgh/B33D/ZenbO/oVyWYOrnHMHb3BmUXs0SdtcKogCzkK', 3, '2024-10-19 06:19:38'),
(31, '', NULL, '', NULL, 0, 'staff@gmail.com', '$2y$10$CGpbSXRiAw.Z0x2moiOdbOswGPeUR.I5sq8tnw6Z3TcijiLW/h7He', 2, '2024-10-19 06:22:36'),
(32, '', NULL, '', NULL, 0, 'staff2@gmail.com', '$2y$10$G8ycFJUdJAzBV5s2rlg6guZJTcmwoUAgWQe5Q5purTTvJ8XUnX4ii', 2, '2024-10-19 06:52:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blotter_report`
--
ALTER TABLE `blotter_report`
  ADD PRIMARY KEY (`blotter_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `residents`
--
ALTER TABLE `residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

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
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `blotter_report`
--
ALTER TABLE `blotter_report`
  MODIFY `blotter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blotter_report`
--
ALTER TABLE `blotter_report`
  ADD CONSTRAINT `blotter_report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
