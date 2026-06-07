-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2026 at 07:25 PM
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
-- Database: `db_sinar_plastik`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_category`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Plastik', '2026-06-03 04:15:21', '2026-06-04 16:34:40'),
(3, 'Kemasan Makanan', '2026-06-04 16:23:09', '2026-06-04 16:23:09'),
(4, 'Bahan Kue', '2026-06-04 16:24:24', '2026-06-04 16:24:24'),
(5, 'Aksesoris & Perlengkapan', '2026-06-04 16:34:57', '2026-06-05 06:40:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `stock` int(11) NOT NULL,
  `minimum_stock` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_product`, `id_category`, `code`, `name`, `unit`, `stock`, `minimum_stock`, `created_at`, `updated_at`) VALUES
(3, 2, 'plstk01', 'Kantong Plastik Hitam', 'Pack', 15, 10, '2026-06-05 07:16:54', '2026-06-06 03:22:00'),
(4, 2, 'plstk02', 'Kantong Plastik Putih', 'pack', 25, 5, '2026-06-05 07:17:22', '2026-06-06 03:20:49'),
(5, 2, 'plstk03', 'Kantong Klip 2x3', 'pack', 33, 10, '2026-06-05 07:17:48', '2026-06-06 03:21:12'),
(6, 2, 'plstk04', 'Kantong Ziplock', 'pack', 25, 15, '2026-06-05 07:18:17', '2026-06-05 07:18:17'),
(7, 2, 'plstk05', 'Kantong Sampah Besar', 'pack', 8, 3, '2026-06-05 07:18:45', '2026-06-05 07:18:45'),
(8, 2, 'plstk06', 'Plastik Wrap', 'pack', 14, 5, '2026-06-05 07:19:14', '2026-06-05 07:19:14'),
(9, 2, 'plstk07', 'Plastik PP Transparan', 'pack', 14, 5, '2026-06-05 07:19:53', '2026-06-05 07:19:53'),
(10, 2, 'plstk08', 'Plastik OPP', 'pack', 20, 6, '2026-06-05 07:20:28', '2026-06-05 07:20:28'),
(11, 2, 'plstk09', 'Plastik HDPE', 'pack', 18, 7, '2026-06-05 07:21:11', '2026-06-05 07:21:11'),
(12, 2, 'plstk10', 'Plastik Shrink', 'pack', 12, 4, '2026-06-05 07:21:35', '2026-06-05 07:21:35'),
(13, 3, 'mkan01', 'Mika Puding Bulat', 'pack', 20, 5, '2026-06-05 07:24:53', '2026-06-05 07:24:53'),
(14, 3, 'mkan02', 'Kotak Bento 3 Sekat', 'pcs', 200, 50, '2026-06-05 07:25:16', '2026-06-05 07:25:16'),
(15, 3, 'mkan03', 'Thinwall Box 500ml', 'pack', 24, 7, '2026-06-05 07:25:43', '2026-06-05 07:25:43'),
(16, 3, 'mkan04', 'Gelas Plastik 16oz', 'pack', 15, 5, '2026-06-05 07:26:04', '2026-06-05 07:26:04'),
(17, 3, 'mkan05', 'Cup Cake Paper', 'pack', 20, 7, '2026-06-05 07:26:26', '2026-06-05 07:26:26'),
(18, 3, 'mkan06', 'Dus Makanan Kraft', 'pcs', 80, 15, '2026-06-05 07:27:05', '2026-06-05 07:27:05'),
(19, 3, 'mkan07', 'Styrofoam Nasi', 'pack', 10, 3, '2026-06-05 07:27:29', '2026-06-05 07:27:29'),
(20, 3, 'mkan08', 'Mika Kue Kotak', 'pack', 15, 4, '2026-06-05 07:27:53', '2026-06-05 07:27:53'),
(21, 3, 'mkan09', 'Tutup Gelas Plastik', 'pack', 18, 5, '2026-06-05 07:28:16', '2026-06-05 07:28:16'),
(22, 3, 'mkan10', 'Kertas Roti', 'pack', 20, 3, '2026-06-05 07:29:44', '2026-06-05 07:29:44'),
(23, 4, 'bhnku01', 'Tepung Terigu', 'pack', 5, 8, '2026-06-05 07:30:35', '2026-06-05 07:30:35'),
(24, 4, 'bhnku02', 'Tepung Maizena', 'pack', 4, 5, '2026-06-05 07:30:51', '2026-06-05 07:30:51'),
(25, 4, 'bhnku03', 'Tepung Tapioka', 'pack', 6, 8, '2026-06-05 07:31:41', '2026-06-05 07:31:41'),
(26, 4, 'bhnku04', 'Gula Pasir', 'pack', 6, 7, '2026-06-05 07:32:03', '2026-06-05 07:32:03'),
(27, 4, 'bhnku05', 'Gula Halus', 'pack', 5, 6, '2026-06-05 07:32:26', '2026-06-05 07:32:26'),
(28, 5, 'aksrs01', 'Sedotan Plastik Biasa', 'pack', 9, 10, '2026-06-05 07:33:08', '2026-06-05 07:33:08'),
(29, 5, 'aksrs02', 'Sedotan Jumbo', 'pack', 12, 15, '2026-06-05 07:33:25', '2026-06-05 07:33:25'),
(30, 5, 'aksrs03', 'Karet Gelang', 'pack', 11, 14, '2026-06-05 07:33:39', '2026-06-05 07:33:39'),
(31, 5, 'aksrs04', 'Tali Rafia', 'pack', 10, 12, '2026-06-05 07:34:00', '2026-06-05 07:34:00'),
(32, 5, 'aksrs05', 'Pita Plastik', 'pack', 5, 10, '2026-06-05 07:34:22', '2026-06-05 07:34:22'),
(33, 5, 'aksrs06', 'Tutup Botol Plastik', 'pack', 0, 5, '2026-06-05 07:35:28', '2026-06-05 07:35:28'),
(34, 5, 'aksrs07', 'Stopper Kecil', 'pcs', 0, 20, '2026-06-05 07:35:59', '2026-06-05 07:35:59'),
(35, 5, 'aksrs08', 'Selotip Plastik', 'pack', 0, 10, '2026-06-05 07:36:19', '2026-06-05 07:36:19'),
(36, 5, 'aksrs09', 'Bubble Wrap', 'pack', 0, 12, '2026-06-05 07:36:54', '2026-06-05 07:36:54'),
(37, 5, 'aksrs10', 'Gantungan Kunci Plastik', 'pcs', 0, 20, '2026-06-05 07:37:54', '2026-06-05 07:37:54');

-- --------------------------------------------------------

--
-- Table structure for table `stock_transactions`
--

CREATE TABLE `stock_transactions` (
  `id_transaction` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock_transactions`
--

INSERT INTO `stock_transactions` (`id_transaction`, `id_product`, `date`, `type`, `quantity`, `description`, `created_at`, `updated_at`) VALUES
(6, 3, '2026-06-04', 'masuk', 10, 'beli barang', '2026-06-06 03:16:26', '2026-06-06 03:16:26'),
(7, 3, '2026-06-05', 'keluar', 10, 'Barang Terjual', '2026-06-06 03:17:22', '2026-06-06 03:17:22'),
(8, 4, '2026-05-20', 'masuk', 10, 'Beli Barang', '2026-06-06 03:20:49', '2026-06-06 03:20:49'),
(9, 5, '2026-05-01', 'masuk', 15, 'Beli Barang', '2026-06-06 03:21:12', '2026-06-06 03:21:12'),
(10, 3, '2026-06-05', 'keluar', 5, 'Barang Terjual', '2026-06-06 03:22:00', '2026-06-06 03:22:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(3, 'Admin Toko', 'admin@gmail.com', '$2y$12$SuceFGa4iqQZfV7hTFqtZ.UN5sCLyxcd0vf76oOnvDLWN02CjNC1a', 'admin', '2026-06-03 08:06:50', '2026-06-03 08:06:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `id_category` (`id_category`);

--
-- Indexes for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_product` (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`);

--
-- Constraints for table `stock_transactions`
--
ALTER TABLE `stock_transactions`
  ADD CONSTRAINT `stock_transactions_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
