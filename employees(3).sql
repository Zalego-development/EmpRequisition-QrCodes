-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 02, 2021 at 10:27 AM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_documentation`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `userId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accessLevel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '1',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employeeNumber` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companyId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departmentId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designationId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `joiningDate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT 'https://hrmis.zalegoacademy.ac.ke/zalegohrms/public/images/admin.png',
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nationalId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `resident` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kra` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nssf` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nhif` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reportsTo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contractStart` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contractEnd` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `corporateEmail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postalCode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `empType` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dailyHours` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hourlyRates` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dailyRates` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentOption` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contractStatus` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `suspendDate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `achve_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `adminStatus` int(191) DEFAULT '0',
  `signature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firebase_token` longtext COLLATE utf8mb4_unicode_ci,
  `token` longtext COLLATE utf8mb4_unicode_ci,
  `role` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT 'Employee',
  `contractReason` longtext COLLATE utf8mb4_unicode_ci,
  `contractMarks` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `userId`, `accessLevel`, `email`, `employeeNumber`, `firstname`, `lastname`, `surname`, `companyId`, `contact`, `departmentId`, `designationId`, `joiningDate`, `profile`, `gender`, `nationalId`, `dob`, `resident`, `kra`, `nssf`, `nhif`, `reportsTo`, `region`, `contractStart`, `contractEnd`, `province`, `town`, `country`, `corporateEmail`, `postalCode`, `empType`, `dailyHours`, `hourlyRates`, `dailyRates`, `paymentOption`, `contractStatus`, `suspendDate`, `email_verified_at`, `password`, `achve_status`, `remember_token`, `created_at`, `updated_at`, `adminStatus`, `signature`, `firebase_token`, `token`, `role`, `contractReason`, `contractMarks`) VALUES
(28, '357241', '1', 'thmsoduor1989@gmail.com', 'ZAL-013', 'Thomas', NULL, 'Oduor', '3', '254724712623', '19', '11', '2021-01-04', 'https://hrmis.zalegoacademy.ac.ke/zalegohrms/public/public/hrfiles/https://hrmis.zalegoacademy.ac.ke/zalegohrms/public/public/hrfiles/Tom photo_1614688645.jpg', 'Male', '27453036', '1989-02-14', 'Resident', 'A007180550G', '2025725843', '9579467', '912763', '6', '2021-01-01', '2021-12-31', 'Machakos', 'Athi-River', 'Kenya', 'thomas@zalegoacademy.ac.ke', '00100', '--Select value--', '8', NULL, NULL, NULL, 'Confirmed', NULL, NULL, '$2y$10$7WgeOby16BBuOo0GkWbPseV1CuTNIfd8CXXCVSyaY8/6my0pGnwiO', '0', NULL, '2020-12-07 12:19:07', '2021-06-22 19:47:15', 0, NULL, NULL, NULL, 'Employee', 'You have to ensure you meet the set target for the next upcoming intakes', '48.3'),
(30, '965347', '1', 'salome@zalegoacademy.ac.ke', 'ZAL-012', 'Salome', 'Otina', 'Otina', '3', '254724726084', '19', '30', '2021-01-04', 'https://hrmis.zalegoacademy.ac.ke/zalegoemp/public/storage/users/WNocbqdyXacBxj9qyOxtTfT7pEC8gwBabbC45sJd.jpg', 'Female', '25065086', '1986-10-31', 'Resident', 'A006858680U', '2032941356', '14005481', '734592', NULL, '2021-04-01', '2021-12-31', NULL, NULL, 'Kenya', 'salome@zalegoacademy.ac.ke', NULL, '--Select value--', '8', NULL, NULL, NULL, 'Confirmed', NULL, NULL, '$2y$10$heI5MN9lOD1EwS.a4xYa.O5X.di6/UlZmCBaJWmG6.fsbq9eAvETi', '0', NULL, '2020-12-08 14:08:42', '2021-06-21 09:17:42', 0, 'https://hrmis.zalegoacademy.ac.ke/zalegoemp/public/storage/users/k4n8yrmfjdzCXFKj5dJxIqQ1UrG45O8AXHK1TvnY.jpeg', NULL, NULL, 'Employee', 'You have to ensure you meet the set target for the next intake', '40'),
(905, '673148', '1', 'ann@zalegoacademy.ac.ke', 'Zal-034', 'Ann', 'Ayako', 'Okore', '3', '704254893', '19', '30', '2021-04-29', 'https://hrmis.zalegoacademy.ac.ke/zalegoemp/public/storage/users/y1BTxePn9GoEBUzsKRN9p2xeBhyNcbVuU3wqiTH4.jpg', 'Female', '28263263', '1990-09-23', 'Resident', 'A008717362J', '200794958X', '5577862', '734592', '6', '2021-05-03', '2021-12-31', 'Kenya', 'Nairobi', 'Kenya', 'ann@zalegoacademy.ac.ke', NULL, '--Select value--', '8', NULL, NULL, NULL, 'Confirmed', NULL, NULL, '$2y$10$m8RRv.aVknauWFmLApFFs.H54Li53h5aNdw3zq30klVBt/gJ1oGjW', '0', NULL, '2021-05-03 06:06:25', '2021-06-29 06:15:35', 0, NULL, NULL, NULL, 'Employee', NULL, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=951;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
