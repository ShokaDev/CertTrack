-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2026 at 10:50 AM
-- Server version: 11.8.2-MariaDB-log
-- PHP Version: 8.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sertifikat_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sertifikat`
--

CREATE TABLE `jenis_sertifikat` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `durasi_tahun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `jenis_sertifikat`
--

INSERT INTO `jenis_sertifikat` (`id`, `nama`, `durasi_tahun`) VALUES
(1, 'Filling', 2),
(2, 'Packing', 2),
(3, 'Trimming', 1),
(4, 'Nyolder', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `jenis_id` int(11) DEFAULT NULL,
  `tanggal_berlaku` date DEFAULT NULL,
  `tanggal_expired` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `sertifikat`
--

INSERT INTO `sertifikat` (`id`, `user_id`, `jenis_id`, `tanggal_berlaku`, `tanggal_expired`) VALUES
(1, 1, 1, '2023-01-10', '2025-01-10'),
(2, 1, 2, '2024-02-01', '2026-02-01'),
(3, 2, 3, '2023-06-01', '2024-06-01'),
(4, 2, 1, '2024-01-15', '2026-01-15'),
(5, 3, 2, '2022-05-01', '2024-05-01'),
(6, 4, 4, '2023-03-10', '2024-03-10'),
(7, 4, 1, '2024-02-20', '2026-02-20'),
(8, 5, 1, '2023-07-01', '2025-07-01'),
(9, 6, 3, '2023-08-10', '2024-08-10'),
(10, 6, 2, '2024-01-01', '2026-01-01'),
(11, 7, 1, '2022-01-01', '2024-01-01'),
(12, 8, 2, '2023-05-05', '2025-05-05'),
(13, 9, 4, '2024-01-01', '2025-01-01'),
(14, 10, 3, '2023-02-01', '2024-02-01'),
(15, 11, 1, '2024-03-01', '2026-03-01'),
(16, 12, 2, '2023-06-15', '2025-06-15'),
(17, 13, 3, '2023-09-01', '2024-09-01'),
(18, 14, 4, '2023-04-01', '2024-04-01'),
(19, 15, 1, '2024-01-01', '2026-01-01'),
(20, 16, 2, '2023-11-01', '2025-11-01'),
(21, 17, 3, '2023-10-01', '2024-10-01'),
(22, 18, 4, '2023-12-01', '2024-12-01'),
(23, 19, 1, '2023-05-01', '2025-05-01'),
(24, 20, 2, '2024-02-01', '2026-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `bet_name` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `role` enum('admin','operator') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `bet_name`, `nama`, `role`) VALUES
(1, 'OP001', 'Budi Santoso', 'operator'),
(2, 'OP002', 'Andi Wijaya', 'operator'),
(3, 'OP003', 'Rudi Hartono', 'operator'),
(4, 'OP004', 'Dedi Kurniawan', 'operator'),
(5, 'OP005', 'Agus Saputra', 'operator'),
(6, 'OP006', 'Joko Susilo', 'operator'),
(7, 'OP007', 'Hendra Gunawan', 'operator'),
(8, 'OP008', 'Eko Prasetyo', 'operator'),
(9, 'OP009', 'Fajar Nugroho', 'operator'),
(10, 'OP010', 'Rizky Ramadhan', 'operator'),
(11, 'OP011', 'Ilham Maulana', 'operator'),
(12, 'OP012', 'Bayu Setiawan', 'operator'),
(13, 'OP013', 'Yoga Pratama', 'operator'),
(14, 'OP014', 'Arif Hidayat', 'operator'),
(15, 'OP015', 'Teguh Saputra', 'operator'),
(16, 'OP016', 'Wahyu Firmansyah', 'operator'),
(17, 'OP017', 'Dimas Prakoso', 'operator'),
(18, 'OP018', 'Nanda Saputra', 'operator'),
(19, 'OP019', 'Galih Putra', 'operator'),
(20, 'OP020', 'Reza Maulana', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jenis_sertifikat`
--
ALTER TABLE `jenis_sertifikat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `jenis_id` (`jenis_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jenis_sertifikat`
--
ALTER TABLE `jenis_sertifikat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `sertifikat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sertifikat_ibfk_2` FOREIGN KEY (`jenis_id`) REFERENCES `jenis_sertifikat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
