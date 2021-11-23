-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2021 at 10:16 AM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zalegohrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `lead_progress_options`
--

CREATE TABLE `lead_progress_options` (
  `progressId` int(191) NOT NULL,
  `options` longtext,
  `created_at` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_progress_options`
--

INSERT INTO `lead_progress_options` (`progressId`, `options`, `created_at`) VALUES
(1, 'Lead has confirmed reporting', '2021-03-31'),
(2, 'Lead has not yet confirmed reporting', '2021-03-31'),
(3, 'Lead will not report', '2021-03-31'),
(4, 'Lead did not pick calls', '2021-06-17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lead_progress_options`
--
ALTER TABLE `lead_progress_options`
  ADD PRIMARY KEY (`progressId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lead_progress_options`
--
ALTER TABLE `lead_progress_options`
  MODIFY `progressId` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
