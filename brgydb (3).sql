-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2024 at 06:28 AM
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
(3, 'asdfadf', '2024-10-14 14:25:54'),
(17, '**🐾 Pawville Annual Dog League Announcement 🐾**\n\nAttention, all dogs and villagers of Pawville!\n\nWe are excited to announce the **Pawville Annual Dog League**, happening on **December 25th**! This year\'s league will be the biggest and most exciting yet, featuring friendly competitions in **agility, obedience, frisbee catching, and tug-of-war**!\n\n📅 **Date**: December 25, 2024  \n📍 **Location**: Pawville Central Park  \n🎉 **Time**: 10:00 AM onwards\n\nBring your best paws forward and join in the fun! Whether you\'re competing or cheering from the sidelines, there will be **prizes, treats, and lots of tail-wagging excitement** for everyone.\n\n🐶 **Event Highlights**:\n- **Agility Course**: Test your speed and skill!\n- **Frisbee Catching Contest**: Show off your high-flying jumps.\n- **Tug-of-War**: Strength and teamwork at its finest.\n- **Obedience Showcase**: Celebrate discipline and training!\n\nDon’t miss out on the biggest celebration of canine talent in Pawville!  \nLet’s make this holiday season pawsome! 🐕🎄\n\nFor more information, bark with your local event coordinator or check out the village bulletin.\n\nSee you all there! 🐾\n\n', '2024-10-15 05:46:13'),
(19, 'Narito ang isang halimbawa ng announcement para sa barangay:\r\n\r\n---\r\n\r\n**PAGTITIPON SA BARANGAY PARA SA PAGDIRIWANG**\r\n\r\nInaanyayahan po ang lahat ng residente ng ating barangay na dumalo sa isang pagtitipon bilang bahagi ng pagdiriwang ng ating anibersaryo. Ito ay gaganapin sa darating na Sabado, Oktubre 20, 2024, mula alas-9 ng umaga hanggang alas-3 ng hapon sa barangay covered court.\r\n\r\nMagkakaroon ng mga sumusunod na aktibidad:\r\n\r\n- Programang Pampasaya\r\n- Palaro para sa mga kabataan\r\n- Pamamahagi ng mga papremyo\r\n- Kainan at kasiyahan para sa lahat\r\n\r\nHinihikayat po ang lahat na magsuot ng damit na kumakatawan sa kulay ng ating barangay. \r\n\r\n**Para sa karagdagang impormasyon, makipag-ugnayan lamang po sa ating Barangay Office.**\r\n\r\nMabuhay ang ating barangay!\r\n\r\n---\r\n\r\nPuwede mo itong gamitin sa iyong proyekto o palitan ang detalye ayon sa aktwal na mga plano ng barangay.', '2024-10-15 10:21:32');

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
(74, 15, 'asd', 'asd', 'canceled', NULL, NULL, '2024-10-19 03:37:29'),
(75, 15, 'asd', 'asd', 'assigned', '2024-10-09', '12:17:00', '2024-10-19 04:14:03'),
(76, 15, 'qw', 'dq', 'assigned', '2024-10-15', '16:19:00', '2024-10-19 04:14:10'),
(77, 15, 'asd', 'dda', 'pending', NULL, NULL, '2024-10-19 04:16:20'),
(78, 15, 'asd', 'zzzzzz', 'pending', NULL, NULL, '2024-10-19 04:19:13'),
(79, 15, 'aqxwe', 'qwecqwe', 'canceled', NULL, NULL, '2024-10-19 04:19:32'),
(80, 15, 'aaaaaaaaaaaa', 'addddddddd', 'assigned', '2024-10-22', '02:22:00', '2024-10-19 04:19:43'),
(81, 15, 'zq', 'zq', 'canceled', NULL, NULL, '2024-10-19 04:23:14'),
(82, 15, 'qzqx', 'xqx', 'assigned', '2024-10-09', '13:29:00', '2024-10-19 04:23:25');

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
(10, 'Martijaasdasdasd', 'Nilsasd', '', '09565413', 'nils@gmail.com', '$2y$10$8dXLWI82x1tyviEVboKo1.5ic0/iMGouq5T9qXRdtcJgbUs4RvM4W', '1231231', '353', '213', 'qd', 'asdasd', 24, 'male', 2);

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
(17, '', NULL, '', NULL, 0, 'staff@gmail.com', '$2y$10$003ZKyGwwHiGkR5YLuH3zOGplb8.jDmaF2qLk9GY0Fw2Ou6CLeuLK', 2, '2024-10-14 09:59:03'),
(18, '', NULL, '', NULL, 0, 's@gmail.com', '$2y$10$jwhLM/t9sqCiSEpsBe9Yh.8fOwwVbxL4tiIYZUcHXMQCnwzIILCym', 2, '2024-10-14 10:00:03'),
(19, '', NULL, '', NULL, 0, 'a@gmail.com', '$2y$10$kxld8vdaLE5Mei1x8xY3LOVgxfAVFlgPpzIdxPPBzwF1NuYySJ3.O', 2, '2024-10-14 10:03:40'),
(20, '', NULL, '', NULL, 0, 'nils@gmail.com', '$2y$10$8dXLWI82x1tyviEVboKo1.5ic0/iMGouq5T9qXRdtcJgbUs4RvM4W', 2, '2024-10-15 08:42:37'),
(22, '', NULL, '', NULL, 0, 'a1@gmail.com', '$2y$10$SVV.zBzO7WAXv7G1DRg/aOjBYPWa2EBUtr85ttMUwuWYYwlCpIGp6', 2, '2024-10-15 08:44:31'),
(23, '', NULL, '', NULL, 0, 'aq@gmail.com', '$2y$10$PMOzbbMkrMtB4PXRrhtB4OSu7suEM1btrYhd/l9XZCm5TtOVRG8FG', 2, '2024-10-15 09:01:09'),
(24, '', NULL, '', NULL, 0, 'r@gmail.com', '$2y$10$5csSEFh7qf6rCE1uIXCKq.GTmtKoYyETW08YEGiBvwdQyyojEsnNi', 2, '2024-10-15 09:09:04'),
(25, 'user2', 'user', 'user2', 'asd', 955264132, 'user2@gmail.com', '$2y$10$LaHPwhaZHA0QRf9k6JEsbuXXOV.dTTEYGZzc04z4LUh.H15cc2WJO', 3, '2024-10-19 02:22:25'),
(26, 'admin', 'admin', 'admin', 'a', 654216441, 'admin@gmail.com', '$2y$10$0eBm9nuEDGfzs8cYt6dNKuChngVBCP3opqm1KlvzJCxc2/sk7P1MG', 1, '2024-10-19 03:04:01');

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
  MODIFY `blotter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `residents`
--
ALTER TABLE `residents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
