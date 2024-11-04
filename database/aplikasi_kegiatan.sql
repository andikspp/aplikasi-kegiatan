-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2024 at 02:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplikasi_kegiatan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'admin1', '2024-10-15 15:10:27', '2024-10-15 15:10:27'),
(2, 'admin2', 'admin2', '2024-10-16 02:17:01', '2024-10-16 02:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `kegiatans`
--

CREATE TABLE `kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `role` enum('Tata Kelola','Kemitraan','Publikasi','Pembelajaran','PAUD HI','Tata Usaha') NOT NULL,
  `tanggal_pendaftaran` date NOT NULL,
  `selesai_pendaftaran` date NOT NULL,
  `tanggal_kegiatan` date NOT NULL,
  `tempat_kegiatan` varchar(255) NOT NULL,
  `jenis_kegiatan` varchar(255) NOT NULL,
  `link_meeting` varchar(255) DEFAULT NULL,
  `jumlah_jp` int(11) NOT NULL,
  `membutuhkan_mapel` enum('ya','tidak') NOT NULL,
  `membutuhkan_nomor_rekening` enum('ya','tidak') NOT NULL,
  `membutuhkan_lokasi` enum('ya','tidak') NOT NULL,
  `membutuhkan_foto_presensi` enum('ya','tidak') NOT NULL,
  `menggunakan_sertifikat` enum('ya','tidak') NOT NULL,
  `nomor_sertifikat` varchar(255) DEFAULT NULL,
  `nomor_seri_sertifikat` varchar(255) DEFAULT NULL,
  `template_sertifikat` varchar(255) DEFAULT NULL,
  `tanggal_ttd_sertifikat` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kegiatans`
--

INSERT INTO `kegiatans` (`id`, `nama`, `role`, `tanggal_pendaftaran`, `selesai_pendaftaran`, `tanggal_kegiatan`, `tempat_kegiatan`, `jenis_kegiatan`, `link_meeting`, `jumlah_jp`, `membutuhkan_mapel`, `membutuhkan_nomor_rekening`, `membutuhkan_lokasi`, `membutuhkan_foto_presensi`, `menggunakan_sertifikat`, `nomor_sertifikat`, `nomor_seri_sertifikat`, `template_sertifikat`, `tanggal_ttd_sertifikat`, `created_at`, `updated_at`) VALUES
(13, 'Orientasi Teknis', 'Kemitraan', '2024-11-02', '2024-11-02', '2024-11-03', 'Bogor', 'Luring', NULL, 132, 'tidak', 'tidak', 'tidak', 'tidak', 'tidak', NULL, NULL, NULL, NULL, '2024-11-02 08:59:44', '2024-11-03 07:40:23'),
(15, 'Liputan ke TK ABA Mardiputra', 'Publikasi', '2024-11-06', '2024-11-07', '2024-11-08', 'TK ABA Mardiputra', 'Luring', NULL, 2, 'tidak', 'tidak', 'ya', 'ya', 'tidak', NULL, NULL, NULL, NULL, '2024-11-03 17:40:28', '2024-11-03 17:40:28'),
(16, 'Bimtek', 'Pembelajaran', '2024-11-04', '2024-11-05', '2024-11-06', 'Semarang', 'Luring', NULL, 154, 'tidak', 'ya', 'ya', 'ya', 'tidak', NULL, NULL, NULL, NULL, '2024-11-03 17:55:06', '2024-11-03 17:55:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2024_10_15_145840_create_admins_table', 1),
(2, '2024_10_16_022016_create_kegiatans_table', 2),
(3, '2024_11_01_031322_remove_peran_column_from_kegiatans_table', 3),
(4, '2024_11_01_031501_create_peran_kegiatan_table', 4),
(5, '2024_11_01_033650_create_peran_kegiatan_table', 5),
(6, '2024_11_01_063937_add_peran_column_to_kegiatans', 6),
(7, '2024_11_01_064621_remove_peran_column', 7),
(8, '2024_11_01_064707_add_peran_column', 8),
(9, '2024_11_02_154309_remove_peran_column', 9);

-- --------------------------------------------------------

--
-- Table structure for table `peran_kegiatans`
--

CREATE TABLE `peran_kegiatans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kegiatan` bigint(20) UNSIGNED NOT NULL,
  `peran` varchar(255) NOT NULL,
  `nomor_rekening` enum('Ya','Tidak') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `peran_kegiatans`
--

INSERT INTO `peran_kegiatans` (`id`, `id_kegiatan`, `peran`, `nomor_rekening`, `created_at`, `updated_at`) VALUES
(11, 13, 'Narasumber', 'Ya', '2024-11-03 07:42:42', '2024-11-03 07:42:42'),
(12, 13, 'Fasilitator', 'Ya', '2024-11-03 07:42:42', '2024-11-03 07:42:42'),
(13, 15, 'Panitia', 'Ya', '2024-11-03 17:40:28', '2024-11-03 17:40:28'),
(14, 16, 'Narasumber', 'Ya', '2024-11-03 17:55:06', '2024-11-03 17:55:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kegiatans`
--
ALTER TABLE `kegiatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peran_kegiatans`
--
ALTER TABLE `peran_kegiatans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peran_kegiatan_id_kegiatan_foreign` (`id_kegiatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kegiatans`
--
ALTER TABLE `kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peran_kegiatans`
--
ALTER TABLE `peran_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peran_kegiatans`
--
ALTER TABLE `peran_kegiatans`
  ADD CONSTRAINT `peran_kegiatan_id_kegiatan_foreign` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
