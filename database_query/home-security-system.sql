-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2024 at 04:35 PM
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
-- Database: `home-security-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`) VALUES
(1, 'jeyapragash', 'admin@gmail.com', 'Jeyapragash', '$2y$10$QdbLKsrB6LTHeRpa3W9VmuBS4nIcPNVG9gx2YTWRSaAnZbwYIz8Eu'),
(2, 'test', 'test@gmail.com', 'test', '$2y$10$LXc33ywy9yxKstpHNWrOaOZWJaRYFfPBnWtP2yTkWHU.0u.nx0ZNa'),
(3, 'demo', 'demo@gmail.com', 'demo', '$2y$10$9nNAuW.03uUYcm5HyQQKZeYRxvOuJj0tM.JYIywCqXttT1OWt2mTS'),
(4, 'lakiya', 'laki@gmail.com', 'laki', '$2y$10$VsuMqjxzCUZ2n6ZTFgbjQeU5ohpaQ3RPIfY6t1Tg.QqPWKCJqHzIa'),
(5, 'sayuru sandaru', 'sayuru@gmail.com', 'Sayuru', '$2y$10$ASQ8DQt.8gNd84sXWB8dn.krJ8.sf4Cp28eF7x0puCgRf8MJ88Pt6'),
(8, 'Lakshitha Chamantha', 'lakshitha@gmail.com', 'Lakshitha Chamantha', '$2y$10$wOAc/LC3/C/ddOYrG5kRn.4Ww.Sa3pTVNiLuPO6JbcBVjMBm.DwXO');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `visitorId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reason` varchar(300) NOT NULL,
  `action_taken` enum('checked_in','checked_out','reported') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`visitorId`, `name`, `date`, `time`, `reason`, `action_taken`) VALUES
(2, 'kamal', '2024-07-28', '15:44:00', 'meet owner', 'checked_out'),
(3, 'nimal', '2024-07-28', '15:45:00', 'meet', 'reported'),
(9, 'sayuru', '2024-08-05', '14:24:00', 'to meet frined', 'checked_in'),
(10, 'test', '2024-08-05', '17:54:00', 'meet', 'checked_in'),
(11, 'sadew', '2024-08-05', '16:00:00', 'meet girl friend', 'checked_out'),
(12, 'pradeep', '2024-08-01', '18:56:00', 'meet friend', 'reported'),
(13, 'chanuth', '2024-08-06', '19:21:00', 'to meet friend', 'checked_in'),
(14, 'pradeep', '2024-08-05', '20:06:00', 'deliver goods', 'checked_in'),
(15, 'ravindu', '2024-08-06', '20:02:00', 'neighbor', 'checked_out'),
(16, 'lakshitha', '2024-08-05', '20:08:00', 'deliver good amazon', 'checked_in');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`visitorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `visitorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
