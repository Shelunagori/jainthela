-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2017 at 12:13 PM
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
-- Table structure for table `purchase_outwards`
--

CREATE TABLE `purchase_outwards` (
  `id` int(10) NOT NULL,
  `voucher_no` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_outwards`
--

INSERT INTO `purchase_outwards` (`id`, `voucher_no`, `transaction_date`, `vendor_id`, `jain_thela_admin_id`, `total_amount`, `created_on`) VALUES
(1, 1, '2017-06-20', 4, 1, '0.00', '2017-06-19 08:45:17'),
(2, 2, '2017-06-20', 4, 1, '0.00', '2017-06-19 09:26:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchase_outwards`
--
ALTER TABLE `purchase_outwards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase_outwards`
--
ALTER TABLE `purchase_outwards`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
