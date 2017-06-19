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
-- Table structure for table `purchase_outward_details`
--

CREATE TABLE `purchase_outward_details` (
  `id` int(10) NOT NULL,
  `purchase_outward_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `invoice_quantity` decimal(10,0) NOT NULL,
  `rate` decimal(12,2) NOT NULL,
  `amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_outward_details`
--

INSERT INTO `purchase_outward_details` (`id`, `purchase_outward_id`, `item_id`, `quantity`, `invoice_quantity`, `rate`, `amount`) VALUES
(1, 1, 3, '5.00', '0', '0.00', '0.00'),
(2, 1, 4, '7.00', '0', '0.00', '0.00'),
(3, 2, 3, '5.00', '0', '0.00', '0.00'),
(4, 2, 4, '7.00', '0', '0.00', '0.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `purchase_outward_details`
--
ALTER TABLE `purchase_outward_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `purchase_outward_details`
--
ALTER TABLE `purchase_outward_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
