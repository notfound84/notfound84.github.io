-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 07:49 AM
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
-- Database: `cottage_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailkelas`
--

CREATE TABLE `detailkelas` (
  `id_detail_kelas` int(11) NOT NULL,
  `id_siswa` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_tahunakademik` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detailkelas`
--

INSERT INTO `detailkelas` (`id_detail_kelas`, `id_siswa`, `id_kelas`, `id_tahunakademik`, `created_at`, `updated_at`) VALUES
(2, 13, 2, 3, NULL, NULL),
(3, 14, 3, 3, '2022-08-06 17:33:46', '2022-08-06 17:33:46'),
(4, 16, 2, 3, '2023-07-05 02:00:34', '2023-07-05 02:00:34'),
(5, 17, 3, 3, '2023-07-05 02:06:41', '2023-07-05 02:06:41'),
(6, 18, 2, 3, '2023-07-05 02:23:42', '2023-07-05 02:23:42'),
(7, 19, 2, 3, '2023-07-05 02:57:14', '2023-07-05 02:57:14'),
(8, 20, 2, 3, '2023-07-28 18:44:52', '2023-07-28 18:44:52'),
(9, 21, 3, 3, '2023-07-28 18:52:28', '2023-07-28 18:52:28'),
(10, 22, 6, 3, '2023-07-28 18:53:18', '2023-07-28 18:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `detailpembayaran`
--

CREATE TABLE `detailpembayaran` (
  `id_detailpembayaran` int(11) NOT NULL,
  `id_pembayaran` int(11) DEFAULT NULL,
  `id_rincianpembayaran` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `detailpembayaran`
--

INSERT INTO `detailpembayaran` (`id_detailpembayaran`, `id_pembayaran`, `id_rincianpembayaran`, `created_at`, `updated_at`) VALUES
(1, 1, 4, '2022-08-08 13:55:54', '2022-08-08 13:55:54'),
(2, 1, 2, '2022-08-08 13:55:54', '2022-08-08 13:55:54'),
(3, 2, 2, '2023-07-28 13:05:48', '2023-07-28 13:05:48'),
(4, 3, 4, '2023-07-28 13:13:05', '2023-07-28 13:13:05'),
(5, 4, 2, '2023-07-28 13:17:27', '2023-07-28 13:17:27'),
(6, 5, 2, '2023-07-29 01:55:00', '2023-07-29 01:55:00'),
(7, 5, 11, '2023-07-29 01:55:00', '2023-07-29 01:55:00'),
(8, 5, 13, '2023-07-29 01:55:00', '2023-07-29 01:55:00'),
(9, 6, 2, '2023-07-30 12:43:23', '2023-07-30 12:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` bigint(20) NOT NULL,
  `nama_kelas` varchar(10) DEFAULT NULL,
  `status` enum('a','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `status`, `created_at`, `updated_at`) VALUES
(2, 'VII', 'a', NULL, '2023-07-28 18:45:12'),
(3, 'VIII', 'a', '2022-08-06 08:50:33', '2023-07-28 18:45:28'),
(6, 'XI', 'a', '2022-08-06 08:55:02', '2023-07-28 18:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_28_072756_add_status_siswa_to_siswa_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `tgl_pembayaran` date NOT NULL,
  `total_pembayaran` int(11) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_siswa`, `tgl_pembayaran`, `total_pembayaran`, `id_petugas`, `created_at`, `updated_at`) VALUES
(1, 13, '2022-08-08', 550000, 3, '2022-08-08 13:55:54', '2022-08-08 13:55:54'),
(2, 19, '2023-07-28', 200000, 6, '2023-07-28 13:05:48', '2023-07-28 13:05:48'),
(3, 14, '2023-07-28', 350000, 6, '2023-07-28 13:13:05', '2023-07-28 13:13:05'),
(4, 18, '2023-07-28', 200000, 3, '2023-07-28 13:17:27', '2023-07-28 13:17:27'),
(5, 20, '2023-07-29', 6000, 3, '2023-07-29 01:55:00', '2023-07-29 01:55:00'),
(6, 20, '2023-07-30', 2000, 3, '2023-07-30 12:43:23', '2023-07-30 12:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` bigint(20) NOT NULL,
  `nama` varchar(191) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telephone` varchar(13) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `level` enum('admin','Bendahara') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama`, `alamat`, `telephone`, `email`, `email_verified_at`, `username`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'admin', 'Kraksaan', '082234321121', 'admin@gmail.com', NULL, 'admin', '$2y$10$b7MPnlPWowIDd.Zb.6pb5ubMVThWD37DqFEEIEOusWIcA1erJ0xOm', 'admin', NULL, '2022-08-06 07:33:43', '2022-08-06 17:30:36'),
(6, 'Bendahara', 'AE', '0857383838', NULL, NULL, 'bendahara', '$2y$10$Hx2TkvAYhooEqh534ty/AePQdc6Obz2AILB9mulN81VpD.6BQVgTS', 'Bendahara', 'Ito49IaX3MerjQVgOYjA8BCsCfkwQXgcNpEYSZ0sT37GMsUpwMtpH35losfc', '2023-07-28 06:05:05', '2023-07-28 06:05:05');

-- --------------------------------------------------------

--
-- Table structure for table `rincianpembayaran`
--

CREATE TABLE `rincianpembayaran` (
  `id_rincianpembayaran` int(11) NOT NULL,
  `uraian_pembayaran` varchar(20) DEFAULT NULL,
  `nominal` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_tahunakademik` int(11) DEFAULT NULL,
  `status` enum('a','n') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rincianpembayaran`
--

INSERT INTO `rincianpembayaran` (`id_rincianpembayaran`, `uraian_pembayaran`, `nominal`, `id_kelas`, `id_tahunakademik`, `status`, `created_at`, `updated_at`) VALUES
(2, 'LKS', 2000, 2, 3, 'a', '2023-07-29 01:46:55', '2023-07-28 18:46:55'),
(3, 'INFAQ', 1000, 3, 3, 'a', '2023-07-29 01:47:10', '2023-07-28 18:47:10'),
(4, 'Semester', 3000, 3, 3, 'a', '2023-07-29 01:47:23', '2023-07-28 18:47:23'),
(8, 'Semester', 3000, 6, 3, 'a', '2023-07-28 18:47:52', '2023-07-28 18:47:52'),
(9, 'LKS', 2000, 6, 3, 'a', '2023-07-28 18:48:17', '2023-07-28 18:48:17'),
(10, 'LKS', 2000, 3, 3, 'a', '2023-07-28 18:48:48', '2023-07-28 18:48:48'),
(11, 'Semester', 3000, 2, 3, 'a', '2023-07-28 18:49:31', '2023-07-28 18:49:31'),
(12, 'INFAQ', 1000, 6, 3, 'a', '2023-07-28 18:51:01', '2023-07-28 18:51:01'),
(13, 'INFAQ', 1000, 2, 3, 'a', '2023-07-28 18:51:27', '2023-07-28 18:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id_siswa` int(11) NOT NULL,
  `nisn` int(11) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('perempuan','laki-laki') DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_telp` char(13) DEFAULT NULL,
  `nama_ayah` varchar(50) DEFAULT NULL,
  `nama_ibu` varchar(50) DEFAULT NULL,
  `pekerjaan_ayah` enum('petani','wirasuwasta','nelayan','guru','pedagang') DEFAULT NULL,
  `pekerjaan_ibu` enum('petani','Ibu rumah tangga','nelayan','guru','pedagang') DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_tahunakademik` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status_siswa` enum('aktif','nonaktif') NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id_siswa`, `nisn`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `alamat`, `no_telp`, `nama_ayah`, `nama_ibu`, `pekerjaan_ayah`, `pekerjaan_ibu`, `id_kelas`, `id_tahunakademik`, `created_at`, `updated_at`, `status_siswa`) VALUES
(20, 1111, 'Ani', 'Besuki', '2001-07-07', 'perempuan', 'Bandung', '0825252262', 'Deni', 'Erni', 'petani', 'nelayan', 2, 3, '2023-07-28 18:44:52', '2023-07-28 18:44:52', 'aktif'),
(21, 2222, 'Yawi', 'Surabaya', '2000-04-04', 'laki-laki', 'Sukorejo', '0825252262', 'Erno', 'Dina', 'guru', 'Ibu rumah tangga', 3, 3, '2023-07-28 18:52:28', '2023-07-28 18:52:28', 'aktif'),
(22, 3333, 'Sani', 'Probolinggo', '2000-05-05', 'laki-laki', 'Dawuhan', '0825252262', 'Deni', 'Bela', 'nelayan', 'guru', 6, 3, '2023-07-28 18:53:18', '2023-07-28 18:53:18', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tahunakademik`
--

CREATE TABLE `tahunakademik` (
  `id_tahunakademik` int(11) NOT NULL,
  `nama_tahunakademik` varchar(11) DEFAULT NULL,
  `status` enum('a','n') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tahunakademik`
--

INSERT INTO `tahunakademik` (`id_tahunakademik`, `nama_tahunakademik`, `status`, `created_at`, `updated_at`) VALUES
(3, '2022-2023', 'a', '2022-08-07 01:38:21', '0000-00-00 00:00:00'),
(4, '2021-2022', 'n', '2022-08-07 01:47:20', '2022-08-06 18:47:20'),
(8, '2023-2024', 'a', '2022-08-07 16:08:17', '2022-08-07 09:08:17');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `level` enum('admin','Bendahara') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailkelas`
--
ALTER TABLE `detailkelas`
  ADD PRIMARY KEY (`id_detail_kelas`);

--
-- Indexes for table `detailpembayaran`
--
ALTER TABLE `detailpembayaran`
  ADD PRIMARY KEY (`id_detailpembayaran`),
  ADD KEY `id_pembayaran_idx` (`id_pembayaran`),
  ADD KEY `id_rincianpembayaran_idx` (`id_rincianpembayaran`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indexes for table `rincianpembayaran`
--
ALTER TABLE `rincianpembayaran`
  ADD PRIMARY KEY (`id_rincianpembayaran`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id_siswa`);

--
-- Indexes for table `tahunakademik`
--
ALTER TABLE `tahunakademik`
  ADD PRIMARY KEY (`id_tahunakademik`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailkelas`
--
ALTER TABLE `detailkelas`
  MODIFY `id_detail_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detailpembayaran`
--
ALTER TABLE `detailpembayaran`
  MODIFY `id_detailpembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rincianpembayaran`
--
ALTER TABLE `rincianpembayaran`
  MODIFY `id_rincianpembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id_siswa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tahunakademik`
--
ALTER TABLE `tahunakademik`
  MODIFY `id_tahunakademik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailpembayaran`
--
ALTER TABLE `detailpembayaran`
  ADD CONSTRAINT `id_pembayaran` FOREIGN KEY (`id_pembayaran`) REFERENCES `pembayaran` (`id_pembayaran`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_rincianpembayaran` FOREIGN KEY (`id_rincianpembayaran`) REFERENCES `rincianpembayaran` (`id_rincianpembayaran`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
