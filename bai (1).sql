-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 16, 2023 at 07:06 PM
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
-- Database: `bai`
--

-- --------------------------------------------------------

--
-- Table structure for table `servent_details`
--

CREATE TABLE `servent_details` (
  `SrNo.` int(10) NOT NULL,
  `b_name` varchar(100) NOT NULL,
  `b_phoneno` int(10) NOT NULL,
  `aadharOrPan` varchar(100) NOT NULL,
  `aad_pan_input` varchar(20) NOT NULL,
  `b_gender` varchar(10) NOT NULL,
  `b_marital_status` int(30) NOT NULL,
  `b_age` int(3) NOT NULL,
  `b_email` varchar(100) NOT NULL,
  `b_state` varchar(30) NOT NULL,
  `b_city` varchar(30) NOT NULL,
  `b_address` varchar(250) NOT NULL,
  `b_area` varchar(30) NOT NULL,
  `b_landmark` varchar(30) NOT NULL,
  `b_pincode` int(6) NOT NULL,
  `b_username` varchar(10) NOT NULL,
  `b_password` varchar(10) NOT NULL,
  `b_cpassword` varchar(10) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `servent_details`
--

INSERT INTO `servent_details` (`SrNo.`, `b_name`, `b_phoneno`, `aadharOrPan`, `aad_pan_input`, `b_gender`, `b_marital_status`, `b_age`, `b_email`, `b_state`, `b_city`, `b_address`, `b_area`, `b_landmark`, `b_pincode`, `b_username`, `b_password`, `b_cpassword`, `dt`) VALUES
(1, 'r', 4, 'aadhar', '', 'male', 0, 4, 'shrutihushe@gmail.com', 'telangana', '4', '4', '4', '44', 4, '4', '$2y$10$BpL', '', '2023-09-16 21:53:01'),
(2, 'd', 4, 'aadhar', '', 'male', 0, 6, 's@f', 'telangana', 'mumbai', 'nb', '4', 'near 110 bus-stop', 34, 'sdf', '$2y$10$lCy', '', '2023-09-16 22:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `Sr no.` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `phoneno` int(10) NOT NULL,
  `u_state` varchar(30) NOT NULL,
  `u_city` varchar(30) NOT NULL,
  `u_address` varchar(1000) NOT NULL,
  `u_area` varchar(30) NOT NULL,
  `u_landmark` varchar(30) NOT NULL,
  `u_pincode` int(6) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `cpassword` varchar(10) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`Sr no.`, `name`, `phoneno`, `u_state`, `u_city`, `u_address`, `u_area`, `u_landmark`, `u_pincode`, `email`, `username`, `password`, `cpassword`, `dt`) VALUES
(1, 'Vinesh Ryapak', 4, 'karnataka', 'mumbai', 'kuka sadan  nwbvxugewhoxkbjevwbxhcenwkbcxj   ', '3', 'Near Central Railway Ground', 4, 'shrutihushe@gmail.com', '4', '$2y$10$9uW', '', '2023-09-16 21:48:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `servent_details`
--
ALTER TABLE `servent_details`
  ADD PRIMARY KEY (`SrNo.`,`b_username`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`Sr no.`,`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `servent_details`
--
ALTER TABLE `servent_details`
  MODIFY `SrNo.` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `Sr no.` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
