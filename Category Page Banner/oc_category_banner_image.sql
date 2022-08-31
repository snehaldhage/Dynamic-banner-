-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2022 at 07:02 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ted`
--

-- --------------------------------------------------------

--
-- Table structure for table `oc_category_banner_image`
--

CREATE TABLE `oc_category_banner_image` (
  `category_banner_image_id` int(11) NOT NULL,
  `category_banner_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `mobile_image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oc_category_banner_image`
--

INSERT INTO `oc_category_banner_image` (`category_banner_image_id`, `category_banner_id`, `language_id`, `title`, `link`, `image`, `mobile_image`, `sort_order`) VALUES
(31, 1, 1, 'second', 'https://www.true-elements.com/seeds-and-nuts/on-the-go-healthy-snacks/crunchy-minis', 'catalog/-category-banners/desktop/breakfast-mix.jpg', '', 1),
(32, 1, 1, 'first', 'https://www.true-elements.com/index.php?route=checkout/cart&amp;product_id=6561&amp;option_id=1&amp;option_value_id=338', 'catalog/-category-banners/desktop/diabetic.jpg', '', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_category_banner_image`
--
ALTER TABLE `oc_category_banner_image`
  ADD PRIMARY KEY (`category_banner_image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `oc_category_banner_image`
--
ALTER TABLE `oc_category_banner_image`
  MODIFY `category_banner_image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
