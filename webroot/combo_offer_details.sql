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
-- Table structure for table `combo_offer_details`
--

CREATE TABLE `combo_offer_details` (
  `id` int(10) NOT NULL,
  `combo_offer_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `combo_offer_details`
--

INSERT INTO `combo_offer_details` (`id`, `combo_offer_id`, `item_id`, `quantity`) VALUES
(1, 1, 3, '5.00'),
(2, 1, 4, '3.00'),
(3, 1, 5, '2.00'),
(4, 2, 3, '5.00'),
(5, 2, 4, '3.00'),
(6, 2, 5, '2.00'),
(7, 3, 3, '3.00'),
(8, 3, 4, '1.00'),
(9, 4, 3, '3.00'),
(10, 4, 4, '1.00'),
(11, 5, 4, '3.00'),
(12, 6, 4, '3.00'),
(13, 7, 5, '2.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `combo_offer_details`
--
ALTER TABLE `combo_offer_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `combo_offer_details`
--
ALTER TABLE `combo_offer_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
