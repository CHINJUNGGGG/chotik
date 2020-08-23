-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 23, 2020 at 09:06 AM
-- Server version: 10.3.24-MariaDB-1:10.3.24+maria~focal
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_nails`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `prefixname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `username`, `password`, `tel`, `prefixname`, `firstname`, `lastname`, `status`, `create_at`, `update_at`) VALUES
(1, 'testuser', '$2y$10$0SURszQA.k2mq6P6x.gnZuRzXrm0osU48mzEPDQX7xCUQA3djTehS', '0912347890', 'นาย', 'test', 'นาย', 0, '2020-08-23 08:21:19', '2020-08-23 08:21:19'),
(2, 'testuser1', '$2y$10$aCC5LGrY/lpeT1C063PMQuQPLyfUwXJDU1ofiSMuj/a7YPP7yXTmu', 'test', 'นาย', 'test', 'นาย', 0, '2020-08-23 08:21:56', '2020-08-23 08:21:56'),
(3, 'testuser2', '$2y$10$sUwK2Fo7ee.cGvA8QQuuFegzYCIOfaGNRfqzwgKDf9Us22M93j5kO', '0123456789', 'นางสาว', 'อชิรญา', 'แก้วทรัพย์', 0, '2020-08-23 09:05:34', '2020-08-23 09:06:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
