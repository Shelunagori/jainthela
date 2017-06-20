-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2017 at 03:13 PM
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
-- Table structure for table `push_notifications`
--

CREATE TABLE `push_notifications` (
  `id` int(10) NOT NULL,
  `message` text NOT NULL,
  `image` varchar(20) NOT NULL,
  `created_on` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `push_notifications`
--

INSERT INTO `push_notifications` (`id`, `message`, `image`, `created_on`, `link_url`) VALUES
(1, 'dfdfsdfdsf', '5947a7b0f0fe3.', '2017-06-19 10:30:09.030109', ''),
(2, 'aaaaaaaaaaa', '5947b426f00d6.jpg', '2017-06-19 00:00:00.000000', ''),
(3, 'aaaaaaaaaaa', '5947b48723a34.jpg', '2017-06-19 00:00:00.000000', ''),
(4, '11111111111', '5947b8943cf6d.jpg', '2017-06-19 11:42:12.287210', ''),
(5, 'discount', '5947be8d1050e.jpg', '2017-06-19 12:07:41.089330', 'jainthela://home'),
(6, 'hello', '5947bf498b884.jpg', '2017-06-19 12:10:49.589025', 'jainthela://home');

-- --------------------------------------------------------

--
-- Table structure for table `push_notification_customers`
--

CREATE TABLE `push_notification_customers` (
  `id` int(10) NOT NULL,
  `push_notification_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `push_notification_customers`
--

INSERT INTO `push_notification_customers` (`id`, `push_notification_id`, `customer_id`) VALUES
(1, 3, 1),
(2, 3, 2),
(3, 4, 1),
(4, 4, 2),
(5, 5, 1),
(6, 5, 2),
(7, 6, 1),
(8, 6, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `push_notification_customers`
--
ALTER TABLE `push_notification_customers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `push_notifications`
--
ALTER TABLE `push_notifications`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `push_notification_customers`
--
ALTER TABLE `push_notification_customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
