-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2017 at 08:27 AM
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
-- Table structure for table `item_ledgers`
--

CREATE TABLE `item_ledgers` (
  `id` int(10) NOT NULL,
  `city_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `franchise_id` int(10) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `purchase_inward_voucher_id` int(10) NOT NULL,
  `rate` decimal(15,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_ledgers`
--

INSERT INTO `item_ledgers` (`id`, `city_id`, `supplier_id`, `item_id`, `franchise_id`, `warehouse_id`, `purchase_inward_voucher_id`, `rate`, `status`, `quantity`, `transaction_date`) VALUES
(1, 0, 1, 1, 0, 0, 0, '0.00', '', '1.00', '0000-00-00'),
(2, 0, 1, 1, 0, 0, 0, '0.00', '', '1.00', '0000-00-00'),
(3, 0, 1, 1, 0, 0, 0, '0.00', '', '1.00', '0000-00-00'),
(4, 0, 1, 1, 0, 1, 0, '0.00', '', '1.00', '0000-00-00'),
(5, 0, 1, 1, 0, 1, 0, '0.00', '', '6.00', '2017-06-12'),
(6, 0, 1, 1, 0, 1, 0, '0.00', '', '7.00', '2017-06-12'),
(7, 0, 1, 1, 0, 2, 0, '0.00', '', '1.00', '0000-00-00'),
(8, 0, 1, 1, 0, 2, 0, '0.00', '', '5.00', '2017-06-12'),
(9, 0, 1, 1, 0, 2, 0, '0.00', '', '10.00', '2017-06-12'),
(10, 0, 0, 1, 0, 2, 0, '0.00', '', '8.00', '2017-06-12'),
(11, 0, 1, 1, 0, 0, 0, '0.00', '', '8.00', '2017-06-12'),
(12, 0, 0, 1, 0, 2, 0, '0.00', '', '9.00', '2017-06-12'),
(13, 0, 1, 1, 0, 0, 0, '0.00', '', '9.00', '2017-06-12'),
(14, 0, 0, 1, 0, 1, 0, '0.00', 'out', '2.00', '2017-06-12'),
(15, 0, 1, 1, 0, 0, 0, '0.00', 'in', '2.00', '2017-06-12'),
(16, 0, 0, 1, 0, 1, 0, '0.00', 'out', '1.00', '2017-06-12'),
(17, 0, 1, 1, 0, 0, 0, '0.00', 'out', '1.00', '2017-06-12');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`) VALUES
(1, 'Pratap Nagar'),
(2, 'Seva Sharam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_ledgers`
--
ALTER TABLE `item_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_ledgers`
--
ALTER TABLE `item_ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
