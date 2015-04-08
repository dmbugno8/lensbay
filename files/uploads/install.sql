-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 30, 2015 at 07:14 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `syncrypts_inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `about` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `about`) VALUES
(1, 'Mr. Admin', 'admin@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Sample quotes about ');

-- --------------------------------------------------------

-- Table structure for table `manufacture`
--

DROP TABLE IF EXISTS `manufacture`;
CREATE TABLE IF NOT EXISTS `manufacture` (
`manufacture_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `about` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `manufacture`
--

INSERT INTO `manufacture` (`manufacture_id`, `name`, `email`, `password`, `about`) VALUES
(1, 'Mr. Manufacture', 'manufacture@example.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Sample quotes about ');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
`customer_id` int(11) NOT NULL,
  `customer_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `gender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `damaged_product`
--

DROP TABLE IF EXISTS `damaged_product`;
CREATE TABLE IF NOT EXISTS `damaged_product` (
`damaged_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
`employee_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
`invoice_id` int(11) NOT NULL,
  `invoice_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_entries` longtext COLLATE utf8_unicode_ci NOT NULL,
  `discount_percentage` int(11) NOT NULL,
  `vat_percentage` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
`message_id` int(11) NOT NULL,
  `message_thread_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `message_body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `message_thread`
--

DROP TABLE IF EXISTS `message_thread`;
CREATE TABLE IF NOT EXISTS `message_thread` (
`message_thread_id` int(11) NOT NULL,
  `message_thread_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sender` longtext COLLATE utf8_unicode_ci NOT NULL,
  `receiver` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
`order_id` int(11) NOT NULL,
  `order_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `shipping_address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `payment_status` int(11) NOT NULL DEFAULT '0',
  `note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
`payment_id` int(11) NOT NULL,
  `type` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'income expense',
  `method` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'paypal cash cheque card',
  `amount` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
`product_id` int(11) NOT NULL,
  `serial_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `purchase_price` longtext COLLATE utf8_unicode_ci NOT NULL,
  `selling_price` longtext COLLATE utf8_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

DROP TABLE IF EXISTS `purchase`;
CREATE TABLE IF NOT EXISTS `purchase` (
`purchase_id` int(11) NOT NULL,
  `purchase_code` longtext COLLATE utf8_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `timestamp` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
`settings_id` int(11) NOT NULL,
  `type` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'company_name', 'Your Company Name'),
(3, 'address', 'USA'),
(4, 'phone', '12345566'),
(5, 'company_email', 'admin@yourcompanyname.com'),
(6, 'currency', 'usd'),
(7, 'vat_percentage', '10'),
(8, 'discount_percentage', '5');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
`sub_category_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
`supplier_id` int(11) NOT NULL,
  `company` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

-- Indexes for table `manufacture`
--
ALTER TABLE `manufacture`
 ADD PRIMARY KEY (`manufacture_id`);


--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `damaged_product`
--
ALTER TABLE `damaged_product`
 ADD PRIMARY KEY (`damaged_product_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
 ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `message_thread`
--
ALTER TABLE `message_thread`
 ADD PRIMARY KEY (`message_thread_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
 ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
 ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
 ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
 ADD PRIMARY KEY (`supplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `manufacture`
--
ALTER TABLE `manufacture`
MODIFY `manufacture_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--

-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `damaged_product`
--
ALTER TABLE `damaged_product`
MODIFY `damaged_product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message_thread`
--
ALTER TABLE `message_thread`
MODIFY `message_thread_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
