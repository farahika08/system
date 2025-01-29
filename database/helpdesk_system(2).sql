-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2025 at 07:51 AM
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
-- Table structure for table `hd_category`
--

CREATE TABLE `hd_category` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hd_category`
--

INSERT INTO `hd_category` (`id`, `name`, `status`) VALUES
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
  `client_name` varchar(100) NOT NULL,
  `client_phone` varchar(50) NOT NULL,
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
  `payment` varchar(15) NOT NULL,
  `invoice_number` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hd_tickets`
--

INSERT INTO `hd_tickets` (`id`, `uniqid`, `user`, `title`, `client_name`, `client_phone`, `init_msg`, `department`, `date`, `last_reply`, `user_read`, `admin_read`, `resolved`, `created_at`, `resolved_at`, `branch`, `priority`, `payment`, `invoice_number`) VALUES
(16, '6784e611e5d68', 1, 'EPSON L3250 - Cannot print', '', '', 'EPSON L3250 - Cannot print', 7, '1736762897', 2, 1, 1, 1, '2025-01-13 10:08:17', '2025-01-18 03:53:24', 'Panji', '', '', ''),
(17, '678b39b64a7bf', 1, 'BROTHER DCP-T220 - Print Error', '', '', 'BROTHER DCP-T220 - Print Error', 7, '1737177526', 1, 0, 1, 0, '2025-01-18 05:18:46', NULL, 'Panji', '', '', ''),
(18, '678b57703edb4', 1, 'ASUS VIVOBOOK A1504F - No display', '', '', 'ASUS VIVOBOOK A1504F - No display', 3, '1737185136', 1, 1, 1, 0, '2025-01-18 07:25:36', NULL, 'KTCC', '', '', ''),
(19, '678c78835d8b8', 1, 'Acer Aspire 3 - Format ', '', '', 'Acer Aspire 3 - Format ', 5, '1737259139', 2, 1, 1, 1, '2025-01-19 03:58:59', '2025-01-29 05:01:11', 'Panji', '', '', 'INV-20250129-06436'),
(74, '05983', 1, '27//1', 'ETTSDTSTdQWDFQWE', '0179524316', 'NO', 1, '1738088637', 1, 0, 1, 1, '2025-01-28 18:23:57', '2025-01-29 04:20:16', 'KTCC', '0', 'RM 12.00', 'INV-20250129-10316'),
(75, '38400', 1, 'kopoiii', 'ETTSDTSTdQWDFQWE', '0179524316', 'qadeqaawsdaef', 1, '1738088829', 1, 0, 1, 0, '2025-01-28 18:27:09', '2025-01-29 04:56:11', 'KTCC', '1', '133.00', 'INV-20250129-89094'),
(83, '28726', 1, 'hp zenbook 12', 'ikaaa', '012343456', 'okkkk hsterhsdfswefwsjse tyjktfjtf rkydrkAFEASDF', 9, '1738126439', 1, 0, 1, 0, '2025-01-29 04:53:59', NULL, 'KTCC', '0', '1001112314', '');

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
(51, 1, 'ooo\r\noik', '56', '1737973333'),
(52, 2, 'kk\r\nk\r\nk\r\nk', '56', '1737991653'),
(54, 1, '56im 658d5 ', '25', '1738064858'),
(56, 1, ',jnb', '53', '1738078372'),
(57, 1, 'to7tb', '69', '1738078987'),
(58, 1, 'r6ki5', '69', '1738079432'),
(59, 1, 'dgsgsrgs', '69', '1738079981'),
(60, 1, 'dgsgsrgs', '69', '1738080003'),
(61, 1, 'fjdrfj', '69', '1738080114'),
(62, 1, 'fjdrfj nfxcncncfn', '69', '1738080127'),
(63, 1, ', hvn gv', '69', '1738080348'),
(64, 1, 'gcnjn', '69', '1738080352'),
(65, 1, 'YGHJKK', '69', '1738081107'),
(66, 1, 'GIKUOI', '70', '1738081177'),
(67, 1, '9999', '69', '1738082087');

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
(14, 'farahtt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2025-01-27 18:20:35', 'Farah TEST', 'admin', 1),
(15, 'farahaF@gmail.com', '96e79218965eb72c92a549dd5a330112', '2025-01-28 23:12:14', 'FFFF', 'admin', 1),
(16, 'j2hgedjyw@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2025-01-29 01:57:42', 'kero', 'admin', 1),
(18, 'farahaFff@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2025-01-29 09:34:12', 'FFFFfff', 'admin', 1),
(19, 'gggg@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2025-01-29 10:26:42', 'ggg', 'user', 1),
(20, 'ggghlg@gmail.com', 'bae730754d5c75fb489b890db146508e', '2025-01-29 11:53:28', 'lhlhulh', 'user', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hd_category`
--
ALTER TABLE `hd_category`
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
-- AUTO_INCREMENT for table `hd_category`
--
ALTER TABLE `hd_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hd_tickets`
--
ALTER TABLE `hd_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `hd_ticket_replies`
--
ALTER TABLE `hd_ticket_replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `hd_users`
--
ALTER TABLE `hd_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
