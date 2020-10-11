-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2020 at 07:48 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chotik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `firstname`, `lastname`, `email`, `password`, `tel`, `status`, `create_at`, `update_at`) VALUES
(1, 'ภานุพงศ์', 'เครือแก้ว', 'ch.chinjung@hotmail.com', '$2y$10$MbytdSvD8/tpTHelt2KKFeOj5KVHm0xHZGPzbN6dBJxE2pTL48una', '0945467731', 0, '2020-10-08 10:29:10', '2020-10-08 10:29:10'),
(2, 'Senior', 'Developer', 'ch.chinjung3@hotmail.com', '$2y$10$.7f868kYkU9PsNujEpCguu9g3avdggLwlLJtPemzFNGJFf98mD4.m', '0945467731', 1, '2020-10-09 03:29:32', '2020-10-09 03:29:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id` int(11) NOT NULL,
  `b_list` int(11) DEFAULT NULL,
  `promotion` int(11) DEFAULT NULL,
  `b_date` date NOT NULL,
  `b_end_date` date NOT NULL,
  `b_start_time` time DEFAULT NULL,
  `b_price` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tech_id` int(11) NOT NULL,
  `b_time` time DEFAULT NULL,
  `b_status` int(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_list`
--

CREATE TABLE `tbl_list` (
  `id` int(11) NOT NULL,
  `list_name` varchar(255) NOT NULL,
  `list_time` time NOT NULL,
  `list_price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_list`
--

INSERT INTO `tbl_list` (`id`, `list_name`, `list_time`, `list_price`) VALUES
(1, 'ทำเล็บ', '01:00:00', '500'),
(2, 'ทำสปา', '01:30:00', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_portfolio`
--

CREATE TABLE `tbl_portfolio` (
  `id` int(11) NOT NULL,
  `type` int(1) NOT NULL DEFAULT 1,
  `picture` longtext NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `admin_id` varchar(11) DEFAULT NULL,
  `detail` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promotion`
--

CREATE TABLE `tbl_promotion` (
  `id` int(11) NOT NULL,
  `pro_name` text NOT NULL,
  `pro_price` varchar(255) DEFAULT NULL,
  `pro_img` longtext NOT NULL,
  `pro_detail` longtext NOT NULL,
  `pro_status` int(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tech`
--

CREATE TABLE `tbl_tech` (
  `id` int(11) NOT NULL,
  `tech_id` varchar(255) NOT NULL,
  `email` text NOT NULL,
  `tel` varchar(50) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `picture` longtext NOT NULL,
  `expert` text NOT NULL,
  `salary` varchar(50) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_tech`
--

INSERT INTO `tbl_tech` (`id`, `tech_id`, `email`, `tel`, `firstname`, `lastname`, `picture`, `expert`, `salary`, `status`, `create_at`, `update_at`) VALUES
(1, 'TECH-00001', 'ch.chinjung4@hotmail.com', '0945467732', 'Panupong', 'Klueakaew', 'img_202010091553557592.jpg', '2 ปี', '450', 0, '2020-10-06 03:54:29', '2020-10-09 06:55:36'),
(2, 'TECH-00002', 'ch.chinjung@hotmail.com', '0945467731', 'Steve', 'Job', 'img_20201006334918032.jpg', '2 ปี', '0', 0, '2020-10-06 03:58:30', NULL),
(3, 'TECH-00003', 'ch.chinjung3@hotmail.com', '0945467731', 'Senior', 'Developer', 'img_20201009989735107.jpg', '3 ปี', '0', 0, '2020-10-09 03:29:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `prefixname` varchar(255) DEFAULT NULL,
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
(1, 'testchotik', '$2y$10$yu1BTb7MtmickVryzC4K1uehTOaY1.NO/D06P/Wf5sO4vYioC8.kS', '0945467731', 'นาย', 'chotik', 'test', 0, '2020-10-11 11:30:27', '2020-10-11 11:30:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_list`
--
ALTER TABLE `tbl_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_portfolio`
--
ALTER TABLE `tbl_portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_promotion`
--
ALTER TABLE `tbl_promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tech`
--
ALTER TABLE `tbl_tech`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_list`
--
ALTER TABLE `tbl_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_portfolio`
--
ALTER TABLE `tbl_portfolio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_promotion`
--
ALTER TABLE `tbl_promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_tech`
--
ALTER TABLE `tbl_tech`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
