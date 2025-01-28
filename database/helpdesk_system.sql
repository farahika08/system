-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 04:09 PM
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
-- Database: `helpdesk_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `hd_departments`
--

CREATE TABLE `hd_departments` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hd_departments`
--

INSERT INTO `hd_departments` (`id`, `name`, `status`) VALUES
(1, 'Technical', 1),
(2, 'Testing', 1),
(3, 'Automation', 1),
(5, 'Programming', 1),
(7, 'Security', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hd_tickets`
--

CREATE TABLE `hd_tickets` (
  `id` int(11) NOT NULL,
  `uniqid` varchar(20) NOT NULL,
  `user` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `init_msg` text NOT NULL,
  `department` int(11) NOT NULL,
  `date` varchar(260) NOT NULL,
  `last_reply` int(11) NOT NULL,
  `user_read` int(11) NOT NULL,
  `admin_read` int(11) NOT NULL,
  `resolved` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `resolved_at` timestamp NULL DEFAULT NULL,
  `branch` varchar(15) NOT NULL,
  `priority` varchar(15) NOT NULL,
  `payment` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hd_tickets`
--

INSERT INTO `hd_tickets` (`id`, `uniqid`, `user`, `title`, `init_msg`, `department`, `date`, `last_reply`, `user_read`, `admin_read`, `resolved`, `created_at`, `resolved_at`, `branch`, `priority`, `payment`) VALUES
(16, '6784e611e5d68', 1, 'EPSON L3250 - Cannot print', 'EPSON L3250 - Cannot print', 7, '1736762897', 2, 1, 1, 1, '2025-01-13 10:08:17', '2025-01-18 03:53:24', 'Panji', '', ''),
(17, '678b39b64a7bf', 1, 'BROTHER DCP-T220 - Print Error', 'BROTHER DCP-T220 - Print Error', 7, '1737177526', 1, 0, 1, 0, '2025-01-18 05:18:46', NULL, 'Panji', '', ''),
(18, '678b57703edb4', 1, 'ASUS VIVOBOOK A1504F - No display', 'ASUS VIVOBOOK A1504F - No display', 3, '1737185136', 1, 0, 1, 0, '2025-01-18 07:25:36', NULL, 'KTCC', '', ''),
(19, '678c78835d8b8', 1, 'Acer Aspire 3 - Format ', 'Acer Aspire 3 - Format ', 5, '1737259139', 2, 1, 1, 0, '2025-01-19 03:58:59', NULL, 'Panji', '', ''),
(21, '679348e14bd30', 1, 'RAWR', 'NEWW', 1, '1737705697', 1, 0, 0, 0, '2025-01-24 08:01:37', NULL, 'Panji', '', ''),
(22, '67934b18f0ece', 1, 'TEST5', 'MIAW', 2, '1737706264', 1, 0, 1, 0, '2025-01-24 08:11:04', NULL, 'Panji', '', ''),
(25, '6793ba0485b3d', 2, 'TEST 2', 'TEST', 5, '1737734660', 1, 1, 1, 0, '2025-01-24 16:04:20', NULL, 'Panji', '', ''),
(50, '679474ab38872', 2, 'TEST6', 'BYE', 3, '1737782443', 1, 0, 1, 0, '2025-01-25 05:20:43', NULL, 'Panji', '', ''),
(51, '41782', 1, 'TEST7', 'ok', 5, '1737879760', 1, 0, 1, 0, '2025-01-26 08:22:40', NULL, 'Panji', '', ''),
(52, '50287', 1, 'TEST8', 'kkk', 2, '1737879773', 1, 0, 1, 0, '2025-01-26 08:22:53', NULL, 'Panji', '1', ''),
(53, '85791', 1, 'TEST9', 'kkkkk', 3, '1737882443', 1, 0, 1, 0, '2025-01-26 09:07:23', NULL, 'KTCC', '0', ''),
(54, '79146', 1, 'TEST9', 'okoko', 2, '1737883687', 1, 0, 1, 0, '2025-01-26 09:28:07', NULL, 'Panji', '0', '-'),
(55, '67822', 1, 'TEST9', 'sssssssssss', 2, '1737884213', 1, 0, 1, 1, '2025-01-26 09:36:53', NULL, 'Panji', '1', '-'),
(56, '18748', 1, '27//1', 'ooo', 2, '1737973316', 1, 0, 1, 1, '2025-01-27 10:21:56', NULL, 'KTCC', '1', 'rm50');

-- --------------------------------------------------------

--
-- Table structure for table `hd_ticket_replies`
--

CREATE TABLE `hd_ticket_replies` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `text` text NOT NULL,
  `ticket_id` text NOT NULL,
  `date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hd_ticket_replies`
--

INSERT INTO `hd_ticket_replies` (`id`, `user`, `text`, `ticket_id`, `date`) VALUES
(1, 1, 'This is fixed', '1', '1634829030'),
(2, 1, 'Please check it.', '1', '1634829129'),
(3, 1, 'The issue is fixed, you can check at your end. Thanks', '2', '1634829404'),
(4, 2, 'fixed', '2', '1635515403'),
(5, 2, 'this is fixed!', '4', '1635517083'),
(6, 1, 'I am looking into this', '5', '1635519340'),
(7, 2, 'ewtewt', '6', '1635519418'),
(8, 5, 'K', '7', '1733249136'),
(9, 1, 'haaha', '14', '1736721254'),
(10, 1, 'meow\r\n', '16', '1736832550'),
(11, 1, 'printer dh siap', '16', '1736832982'),
(12, 1, 'hahahda\r\n', '16', '1736833426'),
(13, 2, 'mkdkfmdmfdk', '14', '1736995548'),
(14, 2, 'lll', '16', '1736996343'),
(15, 1, 'ksaka', '14', '1736996545'),
(16, 1, 'hggjhgh', '14', '1736996577'),
(17, 1, 'siap\r\n', '14', '1736999164'),
(18, 1, 'jjjj', '14', '1737001137'),
(19, 2, 'nanti saya ambil', '16', '1737007034'),
(20, 1, 'woi', '16', '1737007305'),
(21, 2, 'apa', '16', '1737007393'),
(22, 1, 'rawr\r\n', '18', '1737254869'),
(23, 1, 'nfdjfn', '14', '1737259021'),
(24, 1, 'meow', '19', '1737259291'),
(25, 2, 'blabla\r\n', '14', '1737259348'),
(26, 1, 'hiiiiiiiiiiiiiii', '14', '1737259363'),
(27, 2, 'hahaha', '19', '1737259853'),
(28, 1, 'hi', '20', '1737704310'),
(29, 2, 'm', '20', '1737704806'),
(30, 2, 'HI', '25', '1737734767'),
(31, 2, 'HI', '24', '1737734784'),
(32, 1, 'yo', '25', '1737771556'),
(33, 1, 'yo', '26', '1737771575'),
(34, 1, 'hi\r\n', '27', '1737771633'),
(35, 2, 'yo', '27', '1737771653'),
(36, 1, 'hi', '27', '1737771671'),
(37, 1, 'BYE', '26', '1737776733'),
(38, 1, 'BYE', '26', '1737776760'),
(39, 1, 'GHI\r\n', '26', '1737776804'),
(40, 1, 'K', '25', '1737776975'),
(41, 2, 'OK', '26', '1737778691'),
(42, 2, 'YO', '50', '1737782451'),
(43, 1, 'YOY', '50', '1737782465'),
(44, 1, 'hii\r\n', '51', '1737880634'),
(45, 1, 'hii\r\noooo\r\nppp', '51', '1737880639'),
(46, 1, 'hii\r\nhii', '51', '1737880774'),
(47, 1, 'yoo\r\nyoo', '51', '1737880808'),
(48, 1, 'jvwauiegjhjvwi\r\njevnwueh\r\nnwjeivwikj\r\nwjievnwu', '51', '1737881090'),
(49, 1, 'okk', '56', '1737973321'),
(50, 1, 'okk', '56', '1737973326'),
(51, 1, 'ooo\r\noik', '56', '1737973333');

-- --------------------------------------------------------

--
-- Table structure for table `hd_users`
--

CREATE TABLE `hd_users` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `name` varchar(250) NOT NULL,
  `user_type` enum('admin','user','technician') DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hd_users`
--

INSERT INTO `hd_users` (`id`, `email`, `password`, `create_date`, `name`, `user_type`, `status`) VALUES
(1, 'faraha@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-12-04 01:57:42', 'Farah A', 'admin', 1),
(2, 'farahm@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-12-04 01:58:16', 'Farah M', 'user', 1),
(13, 'faraht@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2025-01-13 07:30:37', 'Farah T', 'technician', 1),
(14, 'farahtt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2025-01-27 18:20:35', 'Farah TEST', 'admin', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hd_departments`
--
ALTER TABLE `hd_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hd_tickets`
--
ALTER TABLE `hd_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hd_ticket_replies`
--
ALTER TABLE `hd_ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hd_users`
--
ALTER TABLE `hd_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hd_departments`
--
ALTER TABLE `hd_departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hd_tickets`
--
ALTER TABLE `hd_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `hd_ticket_replies`
--
ALTER TABLE `hd_ticket_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `hd_users`
--
ALTER TABLE `hd_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
