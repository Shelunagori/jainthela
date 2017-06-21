-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2017 at 02:27 PM
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
-- Table structure for table `combo_offers`
--

CREATE TABLE `combo_offers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `print_rate` decimal(10,2) NOT NULL,
  `discount_per` decimal(5,2) NOT NULL,
  `sales_rate` decimal(10,2) NOT NULL,
  `image` varchar(100) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `combo_offers`
--

INSERT INTO `combo_offers` (`id`, `name`, `print_rate`, `discount_per`, `sales_rate`, `image`, `jain_thela_admin_id`, `created_on`) VALUES
(1, 'Summer Offer', '500.00', '50.00', '250.00', '', 1, '2017-06-20 09:28:31'),
(2, 'Summer Offer', '500.00', '50.00', '250.00', '', 1, '2017-06-20 09:30:09'),
(4, 'Juicy July', '200.00', '70.00', '60.00', '', 1, '2017-06-20 10:45:13'),
(5, 'Mango May', '100.00', '30.00', '70.00', '5949057f9fe24.', 1, '2017-06-20 11:22:39'),
(6, 'Mango May', '100.00', '30.00', '70.00', '594905afa9807.', 1, '2017-06-20 11:23:27'),
(7, 'Jambo June', '50.00', '20.00', '40.00', '594905dc00e5c.jpg', 1, '2017-06-20 11:24:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `combo_offers`
--
ALTER TABLE `combo_offers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `combo_offers`
--
ALTER TABLE `combo_offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
