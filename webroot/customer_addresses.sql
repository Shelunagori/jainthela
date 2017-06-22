-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2017 at 02:49 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jainthela`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `house_no` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `locality` varchar(255) NOT NULL,
  `default_address` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `customer_id`, `name`, `mobile`, `house_no`, `address`, `locality`, `default_address`) VALUES
(1, 3, 'Nilesh Tailor', '2147483647', '67', '9874651230', '9874651230', 0),
(2, 3, 'Nilesh JI Tailor', '2147483647', '67', '9874651230', '9874651230', 1),
(3, 3, 'Nilesh Tailor', '2147483647', '67', '9874651230', '9874651230', 0),
(4, 3, 'Nilesh Tailor', '2147483647', '67', '9874651230', '9874651230', 0),
(5, 3, 'Nilesh Tailor', '2147483647', '67', '9874651230', '9874651230', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
