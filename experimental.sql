-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 04:36 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `experimental`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `expenses` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `year`, `expenses`) VALUES
(1, '2010', '10000'),
(2, '2015', '15000'),
(3, '2020', '20000'),
(4, '2025', '25000'),
(5, '2030', '30000'),
(6, '2040', '40000');

-- --------------------------------------------------------

--
-- Table structure for table `ci_providers`
--

CREATE TABLE `ci_providers` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `email` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_providers`
--

INSERT INTO `ci_providers` (`user_id`, `fullname`, `lat`, `lng`, `email`) VALUES
(1, 'ahmed', 29.956051, 30.913300, 'webeasystep@gmail.com'),
(2, 'fakhr', 29.957001, 30.914499, 'info@webeasystep.com'),
(3, 'lin', -1.327593, 36.878429, 'ss@gmail.com'),
(3, 'gov', -1.326556, 36.878036, 'ss@webeasystep.com');

-- --------------------------------------------------------

--
-- Table structure for table `ci_services`
--

CREATE TABLE `ci_services` (
  `ServiceId` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ServiceName` varchar(50) DEFAULT NULL,
  `ServiceDesc` varchar(255) DEFAULT NULL,
  `CreatedAt` int(11) NOT NULL,
  `Order` int(11) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='Services Table';

--
-- Dumping data for table `ci_services`
--

INSERT INTO `ci_services` (`ServiceId`, `user_id`, `ServiceName`, `ServiceDesc`, `CreatedAt`, `Order`, `Status`) VALUES
(1, 1, 'Service Name', 'Service Describtion', 1488098862, 1, 1),
(2, 2, 'Service Name', 'Service Describtion', 1488098862, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL COMMENT 'Primary Key',
  `name` varchar(255) NOT NULL COMMENT 'name',
  `sell` varchar(55) NOT NULL COMMENT 'sell',
  `created_at` varchar(30) NOT NULL COMMENT 'created at'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Atomic database';

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `sell`, `created_at`) VALUES
(1, 'Coca Cola', '5000', '2021-05-01'),
(2, 'Pepsi', '7000', '2021-05-02'),
(3, 'Coke Zero', '19000', '2021-05-03'),
(4, 'Pepsi Max', '1500', '2021-05-04'),
(5, 'Diet Coke', '19000', '2021-05-05'),
(6, 'Pepsi Light', '3000', '2021-05-06'),
(7, 'Gatorade', '12000', '2021-05-07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `code`, `active`) VALUES
(1, 'amagovelenear@gmail.com', '1234567', '6ZH3OBlarfAh', 1),
(2, 'amagovelenear@gmail.com', '1234567', 'S5l4CcgU9RvJ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_locations`
--

CREATE TABLE `user_locations` (
  `id` int(11) NOT NULL,
  `latitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `longitude` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `location_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_locations`
--

INSERT INTO `user_locations` (`id`, `latitude`, `longitude`, `location_name`, `info`) VALUES
(1, '-1.3267539', '36.8783694', 'Nairobi', 'Ramco'),
(2, '-1.3284228947462904', '36.87437706103288', 'Imara', 'Imara Railway Station'),
(3, '-1.328186798541733', '36.885211758374034', 'Msa Road', 'Doshi group'),
(4, '-1.3274677781435322', '36.881349886054416', 'Msa Road', 'System Furniture'),
(5, '-1.3274677781435322', '36.881349886054416', 'Serena', 'Serena Hotel');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_services`
--
ALTER TABLE `ci_services`
  ADD PRIMARY KEY (`ServiceId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_locations`
--
ALTER TABLE `user_locations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ci_services`
--
ALTER TABLE `ci_services`
  MODIFY `ServiceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_locations`
--
ALTER TABLE `user_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
