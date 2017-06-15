-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2017 at 01:31 PM
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
  `jain_thela_admin_id` int(10) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `item_id` int(10) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `rate` decimal(15,2) NOT NULL,
  `status` varchar(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `different_driver_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_ledgers`
--

INSERT INTO `item_ledgers` (`id`, `jain_thela_admin_id`, `driver_id`, `item_id`, `warehouse_id`, `rate`, `status`, `quantity`, `different_driver_id`, `transaction_date`, `creation_date`) VALUES
(1, 0, 1, 1, 0, '0.00', '', '1.00', 0, '0000-00-00', '2017-06-14 05:18:04'),
(2, 0, 1, 1, 0, '0.00', '', '1.00', 0, '0000-00-00', '2017-06-14 05:18:04'),
(3, 0, 1, 1, 0, '0.00', '', '1.00', 0, '0000-00-00', '2017-06-14 05:18:04'),
(4, 0, 1, 1, 1, '0.00', '', '1.00', 0, '0000-00-00', '2017-06-14 05:18:04'),
(5, 0, 1, 1, 1, '0.00', '', '6.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(6, 0, 1, 1, 1, '0.00', '', '7.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(7, 0, 1, 1, 2, '0.00', '', '1.00', 0, '0000-00-00', '2017-06-14 05:18:04'),
(8, 0, 1, 1, 2, '0.00', '', '5.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(9, 0, 1, 1, 2, '0.00', '', '10.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(10, 0, 0, 1, 2, '0.00', '', '8.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(11, 0, 1, 1, 0, '0.00', '', '8.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(12, 0, 0, 1, 2, '0.00', '', '9.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(13, 0, 1, 1, 0, '0.00', '', '9.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(14, 0, 0, 1, 1, '0.00', 'out', '2.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(15, 0, 1, 1, 0, '0.00', 'in', '2.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(16, 0, 0, 1, 1, '0.00', 'out', '1.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(17, 0, 1, 1, 0, '0.00', 'out', '1.00', 0, '2017-06-12', '2017-06-14 05:18:04'),
(18, 1, 0, 3, 1, '0.00', 'out', '7.00', 0, '2017-06-14', '2017-06-14 05:18:04'),
(19, 1, 1, 3, 0, '0.00', 'in', '7.00', 0, '2017-06-14', '2017-06-14 05:18:04'),
(20, 1, 0, 3, 1, '0.00', 'out', '2.00', 0, '2017-06-14', '2017-06-15 11:19:06'),
(21, 1, 1, 3, 0, '0.00', 'in', '1.00', 0, '2017-06-14', '2017-06-15 11:19:40'),
(27, 1, 0, 3, 1, '0.00', 'in', '10.00', 0, '2017-06-14', '2017-06-14 06:25:15'),
(28, 1, 1, 3, 0, '0.00', 'out', '10.00', 0, '2017-06-14', '2017-06-14 06:25:15'),
(29, 1, 0, 3, 1, '0.00', 'in', '1.00', 1, '2017-06-14', '2017-06-14 06:25:15'),
(30, 1, 0, 3, 1, '0.00', 'in', '0.00', 0, '2017-06-14', '2017-06-14 06:30:25'),
(31, 1, 1, 3, 0, '0.00', 'out', '0.00', 0, '2017-06-14', '2017-06-14 06:30:25'),
(32, 1, 0, 3, 1, '0.00', 'out', '5.00', 0, '2017-06-14', '2017-06-14 06:49:37'),
(33, 1, 1, 3, 0, '0.00', 'in', '5.00', 0, '2017-06-14', '2017-06-14 06:49:37'),
(34, 1, 0, 3, 1, '0.00', 'in', '5.00', 0, '2017-06-14', '2017-06-14 06:50:46'),
(35, 1, 1, 3, 0, '0.00', 'out', '5.00', 0, '2017-06-14', '2017-06-14 06:50:46'),
(36, 1, 0, 3, 1, '0.00', 'in', '4.00', 1, '2017-06-14', '2017-06-14 06:50:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_ledgers`
--
ALTER TABLE `item_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_ledgers`
--
ALTER TABLE `item_ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
