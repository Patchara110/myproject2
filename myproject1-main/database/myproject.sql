-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 04:17 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
-- /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
-- /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
-- /*!40101 SET NAMES utf8mb4 */;

-- Database: `myproject`

-- --------------------------------------------------------

-- Table structure for table `categories`
CREATE TABLE `categories` (
  `cat_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `cat_name` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `products`
CREATE TABLE `products` (
  `pro_id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pro_name` VARCHAR(255) NOT NULL,
  `cat_id` INT(11) NOT NULL,
  `pro_price` DECIMAL(10,2) NOT NULL,
  `pro_cost` DECIMAL(10,2) NOT NULL,
  `pro_img` VARCHAR(255) NOT NULL,
  FOREIGN KEY (`cat_id`) REFERENCES `categories`(`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `userdata`
CREATE TABLE `userdata` (
  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fullname` VARCHAR(200) NOT NULL,
  `username` VARCHAR(20) NOT NULL,
  `useremail` VARCHAR(100) NOT NULL,
  `usermobile` VARCHAR(10) NOT NULL,
  `loginpassword` VARCHAR(255) NOT NULL,
  `regdate` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table `userdata`
INSERT INTO `userdata` (`id`, `fullname`, `username`, `useremail`, `usermobile`, `loginpassword`, `regdate`) VALUES
(1, 'kanitha', 'kanitha', 'kanitha@mail.com', '1234567890', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '2024-12-12 04:59:07'),
(2, 'user1', 'user1', 'user1@mail.com', '1236547896', '5994471abb01112afcc18159f6cc74b4f511b99806da59b3caf5a9c173cacfc5', '2024-12-19 01:56:52');

-- Indexes for dumped tables
-- Indexes for table `userdata`
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

-- Auto increment for table `userdata`
ALTER TABLE `userdata`
  MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

COMMIT;

-- SQL Queries for Managing Categories and Products
-- Add a new category
-- INSERT INTO `categories` (`cat_name`) VALUES ('ชื่อประเภทสินค้า');

-- Update a category
-- UPDATE `categories` SET `cat_name` = 'ชื่อประเภทสินค้าใหม่' WHERE `cat_id` = 'รหัสประเภทสินค้า';

-- Delete a category
-- DELETE FROM `categories` WHERE `cat_id` = 'รหัสประเภทสินค้า';

-- Add a new product
-- INSERT INTO `products` (`pro_name`, `cat_id`, `pro_price`, `pro_cost`, `pro_img`) 
-- VALUES ('ชื่อสินค้า', 'รหัสประเภทสินค้า', 'ราคาทุน', 'ราคาขาย', 'ลิ้งรูปภาพ');

-- Update a product
-- UPDATE `products` SET `pro_name` = 'ชื่อสินค้าใหม่', `cat_id` = 'รหัสประเภทใหม่', 
-- `pro_price` = 'ราคาทุนใหม่', `pro_cost` = 'ราคาขายใหม่', `pro_img` = 'ลิ้งรูปภาพใหม่' 
-- WHERE `pro_id` = 'รหัสสินค้า';

-- Delete a product
-- DELETE FROM `products` WHERE `pro_id` = 'รหัสสินค้า';

-- /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
-- /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
-- /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
