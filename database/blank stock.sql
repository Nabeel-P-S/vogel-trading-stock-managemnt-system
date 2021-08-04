-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2020 at 06:15 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock1`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `article_name` varchar(250) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `article_price` decimal(11,2) NOT NULL,
  `article_stock` int(11) NOT NULL DEFAULT 0,
  `article_no` varchar(250) NOT NULL,
  `sales_price` decimal(11,2) NOT NULL,
  `hsn_no` varchar(250) NOT NULL,
  `sgst` varchar(250) NOT NULL,
  `cgst` varchar(250) NOT NULL,
  `igst` varchar(250) NOT NULL,
  `staff_stock` int(11) NOT NULL,
  `enter_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branch_id`, `branch_name`) VALUES
(1, 'THRISSUR'),
(2, 'KUNNAMKULAM'),
(3, 'KODUNGALLUR'),
(4, 'SHORANNUR'),
(5, 'EDAPPAL');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(250) NOT NULL,
  `customer_address` varchar(250) NOT NULL,
  `customer_phone` varchar(250) NOT NULL,
  `customer_gst` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estimation`
--

CREATE TABLE `estimation` (
  `sales_id` int(11) NOT NULL,
  `invoice_no` int(250) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_time` time NOT NULL,
  `staff_id` int(11) NOT NULL,
  `sales` decimal(11,2) NOT NULL,
  `profit` decimal(11,2) NOT NULL,
  `enter_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estimation_articles`
--

CREATE TABLE `estimation_articles` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foc`
--

CREATE TABLE `foc` (
  `foc_id` int(11) NOT NULL,
  `invoice_no` varchar(250) NOT NULL,
  `foc_date` date NOT NULL,
  `foc_time` time NOT NULL,
  `customer_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `foc` decimal(11,2) NOT NULL,
  `profit` decimal(11,2) NOT NULL,
  `paid` varchar(250) NOT NULL,
  `enter_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `foc_articles`
--

CREATE TABLE `foc_articles` (
  `id` int(11) NOT NULL,
  `foc_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grv`
--

CREATE TABLE `grv` (
  `grv_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `grv_date` date NOT NULL,
  `sales` varchar(250) NOT NULL,
  `profit` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grv_articles`
--

CREATE TABLE `grv_articles` (
  `id` int(11) NOT NULL,
  `grv_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_qty` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `invoice_no` varchar(250) NOT NULL,
  `sales_date` date NOT NULL,
  `sales_time` time NOT NULL,
  `customer_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `sales` decimal(11,2) NOT NULL,
  `profit` decimal(11,2) NOT NULL,
  `paid` varchar(250) NOT NULL,
  `enter_datetime` datetime NOT NULL DEFAULT current_timestamp(),
  `category` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_articles`
--

CREATE TABLE `sales_articles` (
  `id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `staff_name` varchar(250) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `salary` varchar(250) NOT NULL,
  `amount_limit` decimal(11,2) NOT NULL,
  `credit_amount` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_articles`
--

CREATE TABLE `staff_articles` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_limit` int(11) NOT NULL,
  `staff_stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `article_qty` varchar(250) NOT NULL,
  `invoice_no` varchar(250) NOT NULL,
  `stock_date` date NOT NULL,
  `lr_no` varchar(250) NOT NULL,
  `cargo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(250) NOT NULL,
  `supplier_address` varchar(250) NOT NULL,
  `supplier_phone` varchar(250) NOT NULL,
  `supplier_gst` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_phone`, `supplier_gst`) VALUES
(1, 'KL GARMENTS', 'NEW BUS STAND TIRUPUR', '9012345678', '12345678901234'),
(2, 'KITES LONDON', 'NEAR OLD BUS STAND TIRUPUR', '90012345678', '12345678900123'),
(3, 'IZAK GARMENTS', 'AVINASHI ROAD TIRUPUR', '9000123467', '12345678900012'),
(4, 'SHALUS GARMENTS', 'DHARAPURAM ROAD TIRUPUR', '9000012345', '12345678900001');

-- --------------------------------------------------------

--
-- Table structure for table `trs`
--

CREATE TABLE `trs` (
  `tr_id` int(11) NOT NULL,
  `tr_date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `amount` varchar(250) NOT NULL,
  `tr_time` time NOT NULL,
  `details` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `status`) VALUES
(1, 'shybi', '$2y$10$N5pgXy2DtqvPrFxfTedLiecm96ZGZCkWlAWExHi2qJyGKqfqMVfL.', '2020-06-12 00:00:00', 0),
(2, 'staff', '$2y$10$ZXB86FEoLfe.UD.Nf9GvquRksfa4zOqZDW41KF3oUYLIbQqu47eSq', '2020-06-12 00:00:00', 0),
(3, 'staff2', '$2y$10$ZXB86FEoLfe.UD.Nf9GvquRksfa4zOqZDW41KF3oUYLIbQqu47eSq', '2020-06-10 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voucher`
--

CREATE TABLE `voucher` (
  `voucher_id` int(11) NOT NULL,
  `voucher_date` date NOT NULL,
  `voucher_time` time NOT NULL,
  `staff_id` int(11) NOT NULL,
  `voucher_amount` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `voucher_details`
--

CREATE TABLE `voucher_details` (
  `id` int(11) NOT NULL,
  `voucher_id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `paid` varchar(250) NOT NULL,
  `method` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `zones`
--

CREATE TABLE `zones` (
  `zone_id` int(11) NOT NULL,
  `zone_name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `estimation`
--
ALTER TABLE `estimation`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `estimation_articles`
--
ALTER TABLE `estimation_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foc`
--
ALTER TABLE `foc`
  ADD PRIMARY KEY (`foc_id`);

--
-- Indexes for table `foc_articles`
--
ALTER TABLE `foc_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grv`
--
ALTER TABLE `grv`
  ADD PRIMARY KEY (`grv_id`);

--
-- Indexes for table `grv_articles`
--
ALTER TABLE `grv_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_articles`
--
ALTER TABLE `sales_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `staff_articles`
--
ALTER TABLE `staff_articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `trs`
--
ALTER TABLE `trs`
  ADD PRIMARY KEY (`tr_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `voucher`
--
ALTER TABLE `voucher`
  ADD PRIMARY KEY (`voucher_id`);

--
-- Indexes for table `voucher_details`
--
ALTER TABLE `voucher_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zones`
--
ALTER TABLE `zones`
  ADD PRIMARY KEY (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimation`
--
ALTER TABLE `estimation`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `estimation_articles`
--
ALTER TABLE `estimation_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foc`
--
ALTER TABLE `foc`
  MODIFY `foc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foc_articles`
--
ALTER TABLE `foc_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grv`
--
ALTER TABLE `grv`
  MODIFY `grv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grv_articles`
--
ALTER TABLE `grv_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_articles`
--
ALTER TABLE `sales_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_articles`
--
ALTER TABLE `staff_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trs`
--
ALTER TABLE `trs`
  MODIFY `tr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `voucher`
--
ALTER TABLE `voucher`
  MODIFY `voucher_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voucher_details`
--
ALTER TABLE `voucher_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `zones`
--
ALTER TABLE `zones`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
