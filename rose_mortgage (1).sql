-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 01:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rose_mortgage`
--

-- --------------------------------------------------------

--
-- Table structure for table `brokers`
--

CREATE TABLE `brokers` (
  `broker_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) NOT NULL,
  `password` varchar(12) NOT NULL,
  `email_address` text NOT NULL,
  `dob` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brokers`
--

INSERT INTO `brokers` (`broker_id`, `first_name`, `middle_name`, `surname`, `password`, `email_address`, `dob`) VALUES
(1, 'Ak', 'simon', 'unnie', 'them', 'broker@gmail.com', '2004-04-18');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `interest_rate` float NOT NULL,
  `mortgage_term` int(11) NOT NULL,
  `lender` varchar(20) NOT NULL,
  `employment_status` varchar(20) NOT NULL,
  `ltv` float NOT NULL,
  `product_type` varchar(12) NOT NULL,
  `initial_period` int(11) DEFAULT NULL,
  `product_fee` float DEFAULT NULL,
  `min_age` int(11) NOT NULL,
  `max_age` int(11) NOT NULL,
  `min_credit_score` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `interest_rate`, `mortgage_term`, `lender`, `employment_status`, `ltv`, `product_type`, `initial_period`, `product_fee`, `min_age`, `max_age`, `min_credit_score`) VALUES
(2, 5.2, 45, 'Made Up Lender 2', 'Full Time Employment', 75, 'Fixed', 5, NULL, 18, 55, '500'),
(3, 4.25, 30, 'Made Up Lender 1', 'Full Time Employment', 40, 'Fixed', 3, NULL, 18, 50, '600'),
(5, 5.25, 45, 'Made Up Lender 2', 'Full Time Employment', 60, 'Tracker', NULL, NULL, 18, 60, '680'),
(6, 4.4, 35, 'Made Up Lender 2', 'Full Time Employment', 50, 'Fixed', 3, 25, 18, 60, '650'),
(7, 5.25, 30, 'Made Up Lender 2', 'Full Time Employment', 50, 'Tracker', NULL, NULL, 18, 60, '600'),
(8, 40, 10, 'made up lender', 'Full-Time', 90, '300000', 10, 400, 25, 60, '500');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `quote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mortgage_type` varchar(12) NOT NULL,
  `monthly_payment` float NOT NULL,
  `interest_rate` float NOT NULL,
  `product_fee` float DEFAULT NULL,
  `total_payable` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`quote_id`, `user_id`, `mortgage_type`, `monthly_payment`, `interest_rate`, `product_fee`, `total_payable`) VALUES
(10, 1, 'Fixed', 309.91, 3.5, 0, 148758.13),
(11, 1, 'Fixed', 271.17, 3.5, 0, 130163.36),
(12, 1, 'Fixed', 335.85, 5.2, 0, 181358.36),
(13, 1, 'Fixed', 271.17, 3.5, 0, 130163.36),
(14, 2, '300000', 422.77, 40, 400, 51131.81),
(15, 2, '300000', 422.77, 40, 400, 51131.81),
(16, 2, '300000', 422.77, 40, 400, 51131.81);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) NOT NULL,
  `email_address` text NOT NULL,
  `dob` date NOT NULL,
  `postcode` char(6) NOT NULL,
  `password` varchar(12) NOT NULL,
  `contact_number` char(11) NOT NULL,
  `credit_score` varchar(3) NOT NULL,
  `income` varchar(6) NOT NULL,
  `employment_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `middle_name`, `surname`, `email_address`, `dob`, `postcode`, `password`, `contact_number`, `credit_score`, `income`, `employment_status`) VALUES
(1, 'Test', '', 'McGee', 'fakemail@gmail.com', '1970-01-01', 'S12LX', 'shosho', '7444444444', '600', '25000', 'Full time'),
(2, 'Alexa', 'David', 'Simon', 'user@gmail.com', '1970-01-01', 'BD99E', 'alakira', '7444444444', '650', '000000', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brokers`
--
ALTER TABLE `brokers`
  ADD PRIMARY KEY (`broker_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`quote_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `quote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
