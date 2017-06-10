-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2017 at 11:01 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

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
-- Table structure for table `purchase_inward_vouchers`
--

CREATE TABLE `purchase_inward_vouchers` (
  `id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `voucher_number` int(10) NOT NULL,
  `franchise_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `total` decimal(15,2) NOT NULL,
  `freight_amount` decimal(10,2) NOT NULL,
  `grand_total` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_inward_voucher_details`
--

CREATE TABLE `purchase_inward_voucher_details` (
  `id` int(10) NOT NULL,
  `purchase_inward_voucher_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `rate` decimal(15,2) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchase_inward_vouchers`
--
ALTER TABLE `purchase_inward_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_inward_voucher_details`
--
ALTER TABLE `purchase_inward_voucher_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase_inward_vouchers`
--
ALTER TABLE `purchase_inward_vouchers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_inward_voucher_details`
--
ALTER TABLE `purchase_inward_voucher_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
