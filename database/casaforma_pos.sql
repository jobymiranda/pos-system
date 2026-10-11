-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2026 at 10:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `casaforma_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('casaforma_session:2d73e30e68d66f93759788d283bd290f', '::1', '2026-10-11 07:25:42', 0x5f5f63695f6c6173745f726567656e65726174657c693a313739313730333534303b5f63695f70726576696f75735f75726c7c733a35373a22687474703a2f2f6c6f63616c686f73743a383038302f70726f64756374733f63617465676f72793d4465636f722b2532362b416363656e7473223b757365725f69647c733a313a2232223b757365726e616d657c733a393a2270726f666573736f72223b66756c6c5f6e616d657c733a31363a22466163756c7479205265766965776572223b726f6c657c733a383a225265766965776572223b6176617461727c4e3b69734c6f67676564496e7c623a313b5f5f63695f766172737c613a303a7b7d),
('casaforma_session:e1851ab761c0a8b9b5ea2b4bfaa8f9a2', '::1', '2026-10-11 07:49:06', 0x5f5f63695f6c6173745f726567656e65726174657c693a313739313730343838393b5f63695f70726576696f75735f75726c7c733a33393a22687474703a2f2f6c6f63616c686f73743a383038302f70726f64756374733f713d43462d534541223b757365725f69647c733a313a2231223b757365726e616d657c733a373a2261646d696e3031223b66756c6c5f6e616d657c733a31393a224a6f6279204d6165204d2e204d6972616e6461223b726f6c657c733a31333a2241646d696e6973747261746f72223b6176617461727c4e3b69734c6f67676564496e7c623a313b5f5f63695f766172737c613a303a7b7d);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `full_name`, `email`, `phone`, `created_at`, `deleted_at`) VALUES
(1, 'Andrea Santos', 'andrea.santos@example.com', '0917-321-4401', '2026-10-11 13:22:20', NULL),
(2, 'Miguel Reyes', 'miguel.reyes@example.com', '0918-520-3388', '2026-10-11 13:22:20', NULL),
(3, 'Sofia Garcia', 'sofia.garcia@example.com', '0919-704-1132', '2026-10-11 13:22:20', NULL),
(4, 'Daniel Cruz', 'daniel.cruz@example.com', '0920-881-2210', '2026-10-11 13:22:20', NULL),
(5, 'Isabella Mendoza', 'isabella.mendoza@example.com', '0921-447-0928', '2026-10-11 13:22:20', NULL),
(6, 'Noah Villanueva', 'noah.villanueva@example.com', '0922-115-6830', '2026-10-11 13:22:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `sku` varchar(30) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL DEFAULT 'Sofa & Seating',
  `price` decimal(10,2) NOT NULL,
  `stock_quantity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `sku`, `name`, `category`, `price`, `stock_quantity`, `image`, `description`, `created_at`, `deleted_at`) VALUES
(1, 'CF-SOF-001', 'Arden Three-Seat Sofa', 'Sofa & Seating', 34990.00, 8, '7b987ffc6bab6091116826b1270d83bd.jpg', 'A vivid cobalt three-seat sofa with deep cushions and a silhouette made for conversation.', '2026-10-11 13:22:20', NULL),
(2, 'CF-SEA-002', 'Luna Lounge Chair', 'Sofa & Seating', 16990.00, 5, 'c6362223426d1a3d0a52007e765a31fc.jpg', 'A compact sculptural lounge chair with a generous curved seat and confident color-block presence.', '2026-10-11 13:22:20', NULL),
(3, 'CF-TAB-003', 'Solace Coffee Table', 'Tables & Dining', 12990.00, 10, '11222325c25806287d56ff4e7b49cb5c.jpg', 'A low-profile coffee table that balances a softened circular top with a bold graphic base.', '2026-10-11 13:22:20', NULL),
(4, 'CF-BED-004', 'Haven Queen Bed Frame', 'Bedroom', 28990.00, 4, '82353960880154781d2f4d2254bb3897.jpg', 'A calm, durable queen bed frame designed to anchor a restful modern bedroom.', '2026-10-11 13:22:20', NULL),
(5, 'CF-DIN-005', 'Forma Dining Chair', 'Tables & Dining', 6990.00, 18, 'dfe6f6f83d1c0f8fef24c0f37c0ecf54.jpg', 'A lightweight dining chair with a geometric back and an easy everyday profile.', '2026-10-11 13:22:20', NULL),
(6, 'CF-TAB-006', 'Oslo Dining Table', 'Tables & Dining', 24990.00, 6, '80d1c6ccba37eb8510554e09592b7466.jpg', 'A spacious dining table for colorful gatherings, studio lunches, and long conversations.', '2026-10-11 13:22:20', NULL),
(7, 'CF-LIG-007', 'Halo Floor Lamp', 'Lighting', 7990.00, 3, '5057c5485c56b850364798c0c7c039ab.jpg', 'A statement floor lamp that adds a sculptural vertical accent and warm ambient light.', '2026-10-11 13:22:20', NULL),
(8, 'CF-STO-008', 'Celine Sideboard', 'Storage', 21990.00, 7, '2822cf21068132145421b9603ab92c66.jpg', 'A streamlined sideboard with ample concealed storage and a clean gallery-like front.', '2026-10-11 13:22:20', NULL),
(9, 'CF-STO-009', 'Noma Bookshelf', 'Storage', 14990.00, 9, 'ecfce3ff45a0e65cf89a2c665b3696b8.jpg', 'An open bookshelf for books, ceramics, records, and the objects that make a home personal.', '2026-10-11 13:22:20', NULL),
(10, 'CF-BED-010', 'Terra Bedside Table', 'Bedroom', 8990.00, 12, 'e2fbb9100fa3fb335be65ad4024efca9.jpg', 'A compact bedside table with a soft-edged form and practical everyday storage.', '2026-10-11 13:22:20', NULL),
(11, 'CF-SEA-011', 'Sienna Accent Chair', 'Sofa & Seating', 13990.00, 2, '92d085da40fd61ba9260f458819ff122.jpg', 'A playful accent chair that gives a reading corner or lounge area instant personality.', '2026-10-11 13:22:20', NULL),
(12, 'CF-DEC-012', 'Elara Console Table', 'Decor & Accents', 17990.00, 0, '577c2dfdb4a3598579b1ef8a9d5a3265.jpg', 'A versatile console table for art books, flowers, lighting, and curated entryway moments.', '2026-10-11 13:22:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `sold_by` int(10) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `product_id`, `customer_id`, `sold_by`, `quantity`, `total_price`, `created_at`) VALUES
(1, 3, 1, 1, 1, 12990.00, '2026-10-11 13:22:20'),
(2, 5, NULL, 3, 2, 13980.00, '2026-10-11 13:22:20'),
(3, 7, 2, 1, 1, 7990.00, '2026-10-10 13:22:20'),
(4, 10, 3, 3, 1, 8990.00, '2026-10-09 13:22:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'Staff',
  `avatar` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `full_name`, `password`, `role`, `avatar`, `created_at`, `deleted_at`) VALUES
(1, 'admin01', 'Joby Mae M. Miranda', '$2y$10$az4PGZcm6QV5wSL.kyYP6OGdrcI/rbjLoNChMk8A1j7DNxB7kmuNy', 'Administrator', NULL, '2026-10-11 13:22:20', NULL),
(2, 'professor', 'Faculty Reviewer', '$2y$10$lImGbjkt7C4A5gg3O3TpxeRfF5SRJsmGNE.F/QEAhDzIMsqUBX2ae', 'Reviewer', NULL, '2026-10-11 13:22:20', NULL),
(3, 'cashier01', 'Mika Santos', '$2y$10$az4PGZcm6QV5wSL.kyYP6OGdrcI/rbjLoNChMk8A1j7DNxB7kmuNy', 'Cashier', NULL, '2026-10-11 13:22:20', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `idx_ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_customers_name` (`full_name`),
  ADD KEY `idx_customers_deleted_at` (`deleted_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_products_name` (`name`),
  ADD KEY `idx_products_stock` (`stock_quantity`),
  ADD KEY `idx_products_deleted_at` (`deleted_at`),
  ADD KEY `idx_products_category` (`category`),
  ADD KEY `idx_products_sku` (`sku`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_sales_created_at` (`created_at`),
  ADD KEY `idx_sales_product` (`product_id`),
  ADD KEY `idx_sales_customer` (`customer_id`),
  ADD KEY `idx_sales_user` (`sold_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idx_users_deleted_at` (`deleted_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales_customer` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `fk_sales_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_sales_user` FOREIGN KEY (`sold_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
