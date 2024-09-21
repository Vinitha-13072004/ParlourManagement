-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2024 at 04:39 PM
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
-- Database: `bpms`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_login`
--

CREATE TABLE `account_login` (
  `account_email` varchar(255) NOT NULL,
  `account_password` varchar(255) NOT NULL,
  `account_type` enum('admin','holder','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account_login`
--

INSERT INTO `account_login` (`account_email`, `account_password`, `account_type`) VALUES
('ajay@gmail.com', 'Ajay@123', 'user'),
('ajaykiran@gmail.com', 'Ajay@123', 'holder'),
('anie@gmail.com', 'Anie@123', 'holder'),
('kiran@gmail.com', 'Kiran@123', 'holder'),
('rahul@gmail.com', 'Rahul@123', 'user'),
('roymonnithin@gamil.com', 'vini@6553', 'holder'),
('vashni@gmail.com', 'vini@6553', 'holder'),
('vashu@gmail.com', 'Vini@6553', 'holder'),
('vini1@gmail.com', 'Vini@123', 'holder'),
('vini@gmail.com', 'Vini@123', 'admin'),
('vinitha@gmail.com', 'Vini@6553', 'user'),
('vp@gmail.com', 'Vp@123', 'holder');

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `account_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `account_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`account_id`, `firstname`, `phonenumber`, `account_email`) VALUES
(1000, 'Vinitha', '9875463218', 'vini@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `availability` enum('pending','accepted','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `shop_id`, `user_id`, `appointment_date`, `appointment_time`, `availability`) VALUES
(2, 10000, 1000, '2024-09-27', '15:42:00', 'accepted'),
(3, 10000, 1000, '2024-09-13', '20:52:00', 'rejected'),
(4, 10005, 1000, '2024-09-28', '20:52:00', 'pending'),
(5, 10005, 1000, '2024-09-12', '19:11:00', 'pending'),
(6, 10006, 1000, '2024-09-27', '21:09:00', 'pending'),
(7, 10001, 1001, '2024-09-28', '22:12:00', 'pending'),
(8, 10000, 1001, '2024-09-27', '19:14:00', 'accepted'),
(9, 10003, 1000, '2024-09-27', '22:03:00', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `holder_details`
--

CREATE TABLE `holder_details` (
  `account_id` int(11) NOT NULL,
  `parlorname` varchar(255) NOT NULL,
  `holdername` varchar(255) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `permission` enum('allow','pending','reject') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holder_details`
--

INSERT INTO `holder_details` (`account_id`, `parlorname`, `holdername`, `account_email`, `city`, `phonenumber`, `permission`) VALUES
(10000, 'vini', 'vini', 'vini1@gmail.com', 'IDUKKI', 2147483647, 'allow'),
(10001, 'vp', 'vp', 'vp@gmail.com', 'IDUKKI', 2147483647, 'allow'),
(10002, 'vini', 'Anie', 'roymonnithin@gamil.com', 'roymonnithin@gamil.com', 2147483647, 'allow'),
(10003, 'kiran', 'kiran', 'kiran@gmail.com', 'anakkara', 2147483647, 'allow'),
(10004, 'vashu', 'vashni', 'vashni@gmail.com', 'periyar', 2147483647, 'allow'),
(10005, 'vashu', 'vashni', 'vashu@gmail.com', 'periyar', 2147483647, 'allow'),
(10006, 'vashu', 'Anie', 'anie@gmail.com', 'pambanar', 2147483647, 'allow');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `account_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL,
  `account_email` varchar(255) NOT NULL,
  `permission` enum('allow','pending','reject') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`account_id`, `username`, `city`, `phonenumber`, `account_email`, `permission`) VALUES
(1000, 'Ajay', 'IDUKKI', '09961019368', 'ajay@gmail.com', 'allow'),
(1001, 'vinitha', 'pambanar', '09961019368', 'vinitha@gmail.com', 'allow');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_login`
--
ALTER TABLE `account_login`
  ADD PRIMARY KEY (`account_email`);

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `account_email` (`account_email`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `holder_details`
--
ALTER TABLE `holder_details`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `account_email` (`account_email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `account_email` (`account_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `holder_details`
--
ALTER TABLE `holder_details`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1002;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD CONSTRAINT `admin_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `holder_details` (`account_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`account_id`);

--
-- Constraints for table `holder_details`
--
ALTER TABLE `holder_details`
  ADD CONSTRAINT `holder_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`account_email`) REFERENCES `account_login` (`account_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
