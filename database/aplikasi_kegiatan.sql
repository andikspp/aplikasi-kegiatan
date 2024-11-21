-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 19, 2024 at 03:31 AM
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
(16, 'Bimtek Pembelajaran', 'Pembelajaran', '2024-11-04', '2024-11-05', '2024-11-06', 'Semarang', 'Luring', NULL, 154, 'tidak', 'ya', 'ya', 'ya', 'tidak', NULL, NULL, NULL, NULL, '2024-11-03 17:55:06', '2024-11-03 20:05:13'),
(17, 'kegiatan a', 'Kemitraan', '2024-11-06', '2024-11-06', '2024-11-07', 'Dimana mana', 'Luring', NULL, 132, 'tidak', 'ya', 'ya', 'ya', 'ya', NULL, NULL, NULL, NULL, '2024-11-05 17:49:28', '2024-11-05 17:49:28');

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
(9, '2024_11_02_154309_remove_peran_column', 9),
(10, '2024_10_31_030218_create_quizz_table', 10),
(11, '2024_10_31_034205_create_pertanyaan_tabel_table', 11),
(12, '2024_11_04_025211_create_quizz_table', 12),
(13, '2024_11_04_025318_create_soal_table', 13),
(14, '2024_11_04_135645_add_pokja_column', 14),
(15, '2024_11_04_135919_add_pokja_column', 15),
(16, '2024_11_04_140319_add_id_kegiatan_column', 16),
(17, '2024_11_05_030545_add_quiz_id_column', 17),
(18, '2024_11_05_015616_create_peserta_table', 18),
(19, '2024_11_12_043002_create_peserta_table', 19),
(20, '2024_11_12_044540_create_peserta_table', 20),
(21, '2024_11_12_054336_create_peserta_table', 21),
(22, '2024_11_12_054435_create_peserta_table', 22),
(23, '2024_11_12_070104_create_user_table', 23),
(24, '2024_11_18_024818_add_user_id_column', 24),
(25, '2024_11_18_025634_add_nip_column', 25),
(26, '2024_11_18_070735_drop_user_id_from_peserta_table', 26),
(27, '2024_11_18_070914_add_user_id_column', 27);

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
(15, 16, 'Narasumber', 'Ya', '2024-11-03 20:05:13', '2024-11-03 20:05:13'),
(16, 17, 'Panitia', 'Ya', '2024-11-05 17:49:28', '2024-11-05 17:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `agama` varchar(255) NOT NULL,
  `pendidikan_terakhir` varchar(255) NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `pangkat_golongan` varchar(255) DEFAULT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `masa_kerja` varchar(255) NOT NULL,
  `alamat_kantor` varchar(255) NOT NULL,
  `telp_kantor` varchar(255) NOT NULL,
  `alamat_rumah` varchar(255) NOT NULL,
  `telp_rumah` varchar(255) NOT NULL,
  `alamat_email` varchar(255) NOT NULL,
  `npwp` varchar(255) NOT NULL,
  `peran` varchar(255) NOT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizz`
--

CREATE TABLE `quizz` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `judul` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_mulai` datetime NOT NULL,
  `tanggal_selesai` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quizz`
--

INSERT INTO `quizz` (`id`, `kegiatan_id`, `judul`, `deskripsi`, `tanggal_mulai`, `tanggal_selesai`, `created_at`, `updated_at`) VALUES
(5, 13, 'Kuis Orientasi Teknis', 'Tes', '2024-11-05 10:36:00', '2024-11-05 11:36:00', '2024-11-04 20:36:25', '2024-11-04 20:36:25'),
(6, 16, 'Kuis Bimtek', 'Pilihan Ganda', '2024-11-05 12:16:00', '2024-11-05 13:16:00', '2024-11-04 22:16:52', '2024-11-04 22:16:52'),
(7, 15, 'kuis X', 'ini kuis', '2024-11-12 21:38:00', '2024-11-13 21:38:00', '2024-11-12 07:40:12', '2024-11-12 07:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `soal`
--

CREATE TABLE `soal` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` bigint(20) UNSIGNED NOT NULL,
  `pertanyaan` text NOT NULL,
  `kategori_soal` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `soal`
--

INSERT INTO `soal` (`id`, `quiz_id`, `pertanyaan`, `kategori_soal`, `created_at`, `updated_at`) VALUES
(3, 5, 'tes', 'essai', '2024-11-04 20:36:25', '2024-11-04 20:36:25'),
(4, 6, 'Tes Pilihan Ganda', 'pilihan_ganda', '2024-11-04 22:16:52', '2024-11-04 22:16:52'),
(5, 7, 'soal 1', 'essai', '2024-11-12 07:40:12', '2024-11-12 07:40:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `nip`, `nama`, `password`, `created_at`, `updated_at`) VALUES
(14, 'andiks_pp', 'andhika2003.ap31@gmail.com', '1234512345', 'Andhika Pratama Putra', '$2y$12$bOfexe/d/dfUW1NGjqb7/ed6139RCOUbktYrZAsoLM2feXflagsRG', '2024-11-17 20:22:46', '2024-11-17 20:22:46'),
(15, 'entus_azi', 'entusazi@gmail.com', NULL, 'Entus Azi Bachtiar', '$2y$12$nxUU/JlCaPLtiH/PT00swehF2O15g.tdskRuV4tEsqvMpPVZwClzS', '2024-11-17 20:59:05', '2024-11-17 20:59:05');

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
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `peserta_user_id_kegiatan_id_unique` (`user_id`,`kegiatan_id`),
  ADD KEY `peserta_kegiatan_id_foreign` (`kegiatan_id`);

--
-- Indexes for table `quizz`
--
ALTER TABLE `quizz`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quizz_kegiatan_id_foreign` (`kegiatan_id`);

--
-- Indexes for table `soal`
--
ALTER TABLE `soal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `soal_quiz_id_foreign` (`quiz_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_username_unique` (`username`),
  ADD UNIQUE KEY `user_email_unique` (`email`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `peran_kegiatans`
--
ALTER TABLE `peran_kegiatans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `quizz`
--
ALTER TABLE `quizz`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `soal`
--
ALTER TABLE `soal`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peran_kegiatans`
--
ALTER TABLE `peran_kegiatans`
  ADD CONSTRAINT `peran_kegiatan_id_kegiatan_foreign` FOREIGN KEY (`id_kegiatan`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `peserta_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `quizz`
--
ALTER TABLE `quizz`
  ADD CONSTRAINT `quizz_kegiatan_id_foreign` FOREIGN KEY (`kegiatan_id`) REFERENCES `kegiatans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `soal`
--
ALTER TABLE `soal`
  ADD CONSTRAINT `soal_quiz_id_foreign` FOREIGN KEY (`quiz_id`) REFERENCES `quizz` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
