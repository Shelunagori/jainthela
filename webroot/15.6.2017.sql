-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2017 at 09:24 AM
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
-- Table structure for table `account_categories`
--

CREATE TABLE `account_categories` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_categories`
--

INSERT INTO `account_categories` (`id`, `name`) VALUES
(1, 'Assets'),
(2, 'Liabilities'),
(3, 'Income'),
(4, 'Expense');

-- --------------------------------------------------------

--
-- Table structure for table `account_groups`
--

CREATE TABLE `account_groups` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `account_category_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bulk_booking_leads`
--

CREATE TABLE `bulk_booking_leads` (
  `id` int(10) NOT NULL,
  `lead_no` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `lead_description` text NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL DEFAULT 'Open',
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Udaipur'),
(2, 'Jaipur'),
(3, 'Bikaner');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobile`, `email`, `address`) VALUES
(1, 'Yashwant', '9876543210', '', 'hiran mangri sec4');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `jain_thela_admin_id`) VALUES
(1, 'Mahesh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grns`
--

CREATE TABLE `grns` (
  `id` int(10) NOT NULL,
  `grn_no` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `purchase_booked` varchar(10) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grns`
--

INSERT INTO `grns` (`id`, `grn_no`, `transaction_date`, `vendor_id`, `jain_thela_admin_id`, `created_on`, `purchase_booked`) VALUES
(1, 1, '2017-06-11', 4, 1, '2017-06-14 04:42:30', 'No'),
(2, 2, '2017-06-11', 4, 1, '2017-06-14 04:43:12', 'No'),
(3, 3, '2017-06-11', 4, 1, '2017-06-14 04:43:30', 'No'),
(4, 4, '2017-06-11', 4, 1, '2017-06-14 04:43:46', 'No'),
(5, 5, '2017-06-11', 4, 1, '2017-06-14 04:43:57', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `grn_details`
--

CREATE TABLE `grn_details` (
  `id` int(10) NOT NULL,
  `grn_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grn_details`
--

INSERT INTO `grn_details` (`id`, `grn_id`, `item_id`, `quantity`) VALUES
(1, 1, 3, '1.36'),
(2, 1, 3, '29.00'),
(3, 2, 3, '1.36'),
(4, 2, 3, '29.00'),
(5, 3, 3, '1.36'),
(6, 3, 3, '29.00'),
(7, 4, 3, '1.36'),
(8, 4, 3, '29.00'),
(9, 5, 3, '1.36'),
(10, 5, 3, '29.00');

-- --------------------------------------------------------

--
-- Table structure for table `history_sales_rates`
--

CREATE TABLE `history_sales_rates` (
  `id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `print_rate` decimal(10,2) NOT NULL,
  `discount_per` decimal(5,2) NOT NULL,
  `sales_rate` decimal(10,2) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `item_category_id` int(10) NOT NULL,
  `unit_id` int(10) NOT NULL,
  `alias_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `minimum_stock` decimal(10,2) NOT NULL,
  `freeze` tinyint(1) NOT NULL,
  `minimum_quantity_factor` decimal(10,2) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `ready_to_sale` varchar(10) NOT NULL DEFAULT 'No',
  `print_rate` decimal(10,0) NOT NULL,
  `discount_per` decimal(5,2) NOT NULL,
  `sales_rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `item_category_id`, `unit_id`, `alias_name`, `description`, `minimum_stock`, `freeze`, `minimum_quantity_factor`, `seller_id`, `jain_thela_admin_id`, `ready_to_sale`, `print_rate`, `discount_per`, `sales_rate`) VALUES
(4, 'Appale', 6, 6, 'seb', 'eqwe', '10.00', 0, '0.50', 0, 1, 'Yes', '100', '10.00', '0.00'),
(5, 'mango', 6, 7, 'aam', 'sfdsf', '10.00', 0, '1.00', 0, 1, 'No', '200', '5.00', '0.00'),
(6, 'Leady Fingure', 7, 7, 'bhindi', 'wqe', '10.00', 0, '1.00', 0, 1, 'Yes', '300', '30.00', '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `item_categories`
--

CREATE TABLE `item_categories` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `jain_thela_admin_id` int(10) NOT NULL,
  `seller_id` int(10) NOT NULL,
  `city_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_categories`
--

INSERT INTO `item_categories` (`id`, `name`, `is_deleted`, `jain_thela_admin_id`, `seller_id`, `city_id`) VALUES
(6, 'Fruits', 0, 1, 0, 1),
(7, 'Vegitables', 0, 1, 0, 1),
(8, 'Sweets', 0, 0, 0, 1),
(9, 'Grocary', 0, 0, 0, 1);

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
  `transaction_date` date NOT NULL,
  `rate_updated` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_ledgers`
--

INSERT INTO `item_ledgers` (`id`, `jain_thela_admin_id`, `driver_id`, `item_id`, `warehouse_id`, `rate`, `status`, `quantity`, `transaction_date`, `rate_updated`) VALUES
(1, 1, 0, 3, 1, '0.00', 'In', '1.36', '2017-06-11', ''),
(2, 1, 0, 3, 1, '0.00', 'In', '29.00', '2017-06-11', '');

-- --------------------------------------------------------

--
-- Table structure for table `jain_cash_points`
--

CREATE TABLE `jain_cash_points` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `point` decimal(10,2) NOT NULL,
  `used_point` decimal(10,2) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jain_thela_admins`
--

CREATE TABLE `jain_thela_admins` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jain_thela_admins`
--

INSERT INTO `jain_thela_admins` (`id`, `name`, `city_id`) VALUES
(1, 'Jain Thela - Udaipur', 1),
(2, 'Jain Thela - Jaipur', 2);

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(10) NOT NULL,
  `lead_no` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `lead_description` text NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL DEFAULT 'Open'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `order_no` int(10) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `amount_from_wallet` decimal(10,2) NOT NULL,
  `amount_from_jain_cash` decimal(10,2) NOT NULL,
  `amount_from_promo_code` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `promo_code_id` int(10) NOT NULL,
  `order_type` varchar(30) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(30) NOT NULL DEFAULT 'In process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` decimal(8,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `benifit_per` decimal(5,2) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `promo_codes`
--

CREATE TABLE `promo_codes` (
  `id` int(10) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_per` decimal(5,2) NOT NULL,
  `item_category_id` int(10) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `valid_from` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `valid_to` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_bookings`
--

CREATE TABLE `purchase_bookings` (
  `id` int(10) NOT NULL,
  `grn_id` int(10) NOT NULL,
  `voucher_no` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_bookings`
--

INSERT INTO `purchase_bookings` (`id`, `grn_id`, `voucher_no`, `transaction_date`, `vendor_id`, `jain_thela_admin_id`, `created_on`) VALUES
(1, 1, 1, '2017-06-14', 4, 1, '2017-06-14 11:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_booking_details`
--

CREATE TABLE `purchase_booking_details` (
  `id` int(10) NOT NULL,
  `purchase_booking_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` decimal(10,2) NOT NULL,
  `invoice_quantity` decimal(10,2) NOT NULL,
  `rate` decimal(12,2) NOT NULL,
  `amount` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_booking_details`
--

INSERT INTO `purchase_booking_details` (`id`, `purchase_booking_id`, `item_id`, `quantity`, `invoice_quantity`, `rate`, `amount`) VALUES
(1, 1, 3, '1.36', '1.00', '10.00', '13.60'),
(2, 1, 3, '29.00', '30.00', '78.98', '2369.40');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `data` blob NOT NULL,
  `expires` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `data`, `expires`) VALUES
('p88f2sev4h2d0kk64bv5teg7d2', 0x436f6e6669677c613a313a7b733a343a2274696d65223b693a313439373031303232383b7d466c6173687c613a303a7b7d417574687c613a313a7b733a343a2255736572223b613a363a7b733a323a226964223b693a313b733a383a22757365726e616d65223b733a363a22617368697368223b733a343a22726f6c65223b733a313a2231223b733a363a22737461747573223b733a313a2231223b733a373a2263726561746564223b4f3a32303a2243616b655c4931386e5c46726f7a656e54696d65223a333a7b733a343a2264617465223b733a32363a22323031372d30362d30392030313a30303a30302e303030303030223b733a31333a2274696d657a6f6e655f74797065223b693a333b733a383a2274696d657a6f6e65223b733a333a22555443223b7d733a383a226d6f646966696564223b4e3b7d7d, -650473417);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(10) NOT NULL,
  `longname` varchar(100) NOT NULL,
  `shortname` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `jain_thela_admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `longname`, `shortname`, `is_deleted`, `jain_thela_admin_id`) VALUES
(5, 'sada', 'asd', 1, 1),
(6, 'Pieces', 'pcs', 0, 1),
(7, 'Kilogram', 'Kg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `city_id` int(10) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `status`, `created`, `modified`, `city_id`, `jain_thela_admin_id`) VALUES
(1, 'jainthelaadmin', '$2y$10$rg61cBlo66vJL.MdAGhokuGiyDaLF9BN34gyy38..aPZRvl39.jSG', 'admin', '1', '2017-06-09 01:00:00', NULL, 1, 1),
(2, 'jainthelajaipur', '$2y$10$rg61cBlo66vJL.MdAGhokuGiyDaLF9BN34gyy38..aPZRvl39.jSG', 'admin', '1', '2017-06-09 01:00:00', NULL, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `address`, `mobile`, `email`, `jain_thela_admin_id`) VALUES
(4, 'Ramesh', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `walkin_sales`
--

CREATE TABLE `walkin_sales` (
  `id` int(10) NOT NULL,
  `transaction_date` date NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `driver_id` int(10) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL,
  `warehouse_id` int(10) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `walkin_sale_details`
--

CREATE TABLE `walkin_sale_details` (
  `id` int(10) NOT NULL,
  `walkin_sale_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `quantity` decimal(8,2) NOT NULL,
  `rate` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) NOT NULL,
  `advance` decimal(10,2) NOT NULL,
  `consumed` decimal(10,2) NOT NULL,
  `plan_id` int(10) NOT NULL,
  `order_id` int(10) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `jain_thela_admin_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `name`, `jain_thela_admin_id`) VALUES
(1, 'Pratap Nagar', 1),
(2, 'Seva Sharam', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_categories`
--
ALTER TABLE `account_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_groups`
--
ALTER TABLE `account_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulk_booking_leads`
--
ALTER TABLE `bulk_booking_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grns`
--
ALTER TABLE `grns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grn_details`
--
ALTER TABLE `grn_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_sales_rates`
--
ALTER TABLE `history_sales_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_categories`
--
ALTER TABLE `item_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_ledgers`
--
ALTER TABLE `item_ledgers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jain_cash_points`
--
ALTER TABLE `jain_cash_points`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jain_thela_admins`
--
ALTER TABLE `jain_thela_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promo_codes`
--
ALTER TABLE `promo_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_bookings`
--
ALTER TABLE `purchase_bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_booking_details`
--
ALTER TABLE `purchase_booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `walkin_sales`
--
ALTER TABLE `walkin_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `walkin_sale_details`
--
ALTER TABLE `walkin_sale_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
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
-- AUTO_INCREMENT for table `account_categories`
--
ALTER TABLE `account_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `account_groups`
--
ALTER TABLE `account_groups`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bulk_booking_leads`
--
ALTER TABLE `bulk_booking_leads`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `grns`
--
ALTER TABLE `grns`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `grn_details`
--
ALTER TABLE `grn_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `history_sales_rates`
--
ALTER TABLE `history_sales_rates`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `item_categories`
--
ALTER TABLE `item_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `item_ledgers`
--
ALTER TABLE `item_ledgers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jain_cash_points`
--
ALTER TABLE `jain_cash_points`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jain_thela_admins`
--
ALTER TABLE `jain_thela_admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `promo_codes`
--
ALTER TABLE `promo_codes`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_bookings`
--
ALTER TABLE `purchase_bookings`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `purchase_booking_details`
--
ALTER TABLE `purchase_booking_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `walkin_sales`
--
ALTER TABLE `walkin_sales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `walkin_sale_details`
--
ALTER TABLE `walkin_sale_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
