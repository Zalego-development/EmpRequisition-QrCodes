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
-- Table structure for table `lead_reasons`
--

CREATE TABLE `lead_reasons` (
  `reasonId` int(191) NOT NULL,
  `reason` longtext,
  `created_at` varchar(191) DEFAULT NULL,
  `updated_at` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lead_reasons`
--

INSERT INTO `lead_reasons` (`reasonId`, `reason`, `created_at`, `updated_at`) VALUES
(1, 'Fees to high', '2021-03-31', '2021-03-31'),
(2, 'Distance & Location', '2021-03-31', '2021-03-31'),
(3, 'Courses offered not credible', '2021-03-31', '2021-03-31'),
(4, 'Wasn\'t satisfied with previous trainings', '2021-03-31', '2021-03-31'),
(5, 'Not interested with the skill', '2021-03-31', '2021-03-31'),
(6, 'I do not have a laptop', '2021-04-22', '2021-04-22'),
(7, 'I do not have internet connectivity', '2021-04-22', '2021-04-22'),
(8, 'I don\'t have a laptop and internet connectivity', '2021-04-22', '2021-04-22'),
(9, 'Other reasons', '2021-04-22', '2021-04-22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lead_reasons`
--
ALTER TABLE `lead_reasons`
  ADD PRIMARY KEY (`reasonId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lead_reasons`
--
ALTER TABLE `lead_reasons`
  MODIFY `reasonId` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
