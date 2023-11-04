-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2023 at 04:41 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simera_beta`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_aktivitas`
--

CREATE TABLE `daftar_aktivitas` (
  `id_lapo` int(11) NOT NULL,
  `id_labo` int(11) NOT NULL,
  `id_faku` int(11) NOT NULL,
  `isi_lapo` varchar(1000) NOT NULL,
  `tanggal_buat` timestamp NOT NULL DEFAULT current_timestamp(),
  `respons` varchar(1000) DEFAULT NULL,
  `status_mode` int(20) NOT NULL,
  `status_admn` int(11) NOT NULL,
  `nama_lgkp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_aktivitas`
--

INSERT INTO `daftar_aktivitas` (`id_lapo`, `id_labo`, `id_faku`, `isi_lapo`, `tanggal_buat`, `respons`, `status_mode`, `status_admn`, `nama_lgkp`) VALUES
(1, 38, 8, 'contoh 1', '2023-10-24 02:13:55', 'tes1', 1, 0, 'Moderator'),
(2, 38, 8, 'contoh 2', '2023-10-27 01:44:08', NULL, 1, 1, 'Yanuar Christy Ade Utama'),
(3, 0, 0, 'contoh 3', '2023-10-27 02:59:44', NULL, 1, 1, 'Yanuar Christy Ade Utama');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_akun`
--

CREATE TABLE `daftar_akun` (
  `id_akun` int(11) NOT NULL,
  `nama_lgkp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nomor_telp` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_akun`
--

INSERT INTO `daftar_akun` (`id_akun`, `nama_lgkp`, `email`, `nomor_telp`, `username`, `password`, `role`) VALUES
(1, 'Rangsi Ridho Kayana', '672020007@student.uksw.edu', '087794945522', 'superadmin_1', '1111', 'superadmin'),
(2, 'Yanuar Christy Ade Utama', '672020053@student.uksw.edu', '088224127302', 'superadmin_2', '1111', 'superadmin'),
(3, 'Agna Sulis Krave', 'agnakrave@uksw.edu', '081122334455', 'admin_lab_1', '1111', 'admin'),
(4, 'Sarah Melati Davidson', 'sarahdavidson@uksw.edu', '081122334455', 'admin_lab_2', '1111', 'admin'),
(5, 'Adi Setiawan', 'adisetiawan@uksw.edu', '081122334455', 'admin_lab_3', '1111', 'admin'),
(6, 'Eva Yovita Dwi Utami', 'evautami@uksw.edu', '081122334455', 'admin_lab_4', '1111', 'admin'),
(7, 'Theophilus Yohanis Hermanus Wellem', 'theophiluswellem@uksw.edu', '081122334455', 'admin_lab_5', '1111', 'admin'),
(8, 'Isaac Imanuel Saputra', '672020102@student.uksw.edu', '088983063306', 'user', '1111', 'user'),
(9, 'Moderator', 'moderator@gmail.com', '088224127304', 'moderator', '1111', 'moderator');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_alat`
--

CREATE TABLE `daftar_alat` (
  `id_alat` int(11) NOT NULL,
  `id_labo` int(11) NOT NULL,
  `id_faku` int(11) NOT NULL,
  `kode_alat` varchar(100) NOT NULL,
  `kode_modl` varchar(255) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `kondisi` varchar(100) NOT NULL,
  `catatan` varchar(500) NOT NULL,
  `tanggal_msuk` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'Tersedia',
  `tipe` varchar(20) NOT NULL,
  `kode_pinj` varchar(100) NOT NULL,
  `tanggal_pinj` datetime DEFAULT NULL,
  `waktu_sekarang` datetime DEFAULT NULL,
  `tanggal_sele` datetime DEFAULT NULL,
  `nama_lgkp` varchar(100) NOT NULL,
  `pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_alat`
--

INSERT INTO `daftar_alat` (`id_alat`, `id_labo`, `id_faku`, `kode_alat`, `kode_modl`, `nama_alat`, `harga`, `kondisi`, `catatan`, `tanggal_msuk`, `status`, `tipe`, `kode_pinj`, `tanggal_pinj`, `waktu_sekarang`, `tanggal_sele`, `nama_lgkp`, `pemilik`) VALUES
(528, 38, 8, '-', '', 'TES1', 0, '-', '', '2023-10-27 03:52:06', 'Tersedia', '', '', NULL, '2023-10-27 11:25:14', NULL, '', 'superadmin_2'),
(529, 38, 8, '-', '', 'TES1', 0, '-', '', '2023-10-27 03:52:06', 'Tersedia', '', '', NULL, '2023-10-27 11:25:14', NULL, '', 'superadmin_2'),
(532, 38, 8, '-', '', 'TES2', 0, '-', '', '2023-10-27 03:55:48', 'Tersedia', '', '', NULL, '2023-10-27 11:25:14', NULL, '', 'superadmin_2'),
(533, 38, 8, '-', '', 'TES2', 0, '-', '', '2023-10-27 03:55:48', 'Tersedia', '', '', NULL, '2023-10-27 11:25:14', NULL, '', 'superadmin_2'),
(546, 38, 8, '-', '', 'tes4', 0, '-', '', '2023-10-27 04:14:48', 'Tersedia', '', '', NULL, '2023-10-27 11:25:14', NULL, '', 'superadmin_2'),
(547, 38, 8, '-', '', 'tes4', 0, '-', '', '2023-10-27 04:15:21', 'Tersedia', '', '', NULL, '2023-10-27 11:25:14', NULL, '', 'superadmin_2'),
(550, 38, 8, '-', '', 'tes4', 0, '-', '', '2023-10-27 04:23:46', 'Tersedia', '', '', NULL, '2023-10-27 11:25:14', NULL, '', 'superadmin_2'),
(551, 38, 8, '-', '', 'tes4', 0, '-', '', '2023-10-27 04:25:19', 'Tersedia', '', '', NULL, NULL, NULL, '', 'superadmin_2'),
(555, 0, 0, '-', '', 'TES1', 0, '-', '', '2023-10-30 01:24:21', '0', '', '', NULL, NULL, NULL, '', ''),
(556, 38, 8, '-', '', 'Alat adm 1', 0, '-', '', '2023-11-02 03:21:35', 'Tersedia', '', '', NULL, NULL, NULL, '', 'admin_lab_1'),
(557, 38, 8, '-', '', 'Alat adm 1', 0, '-', '', '2023-11-02 03:21:35', 'Tersedia', '', '', NULL, NULL, NULL, '', 'admin_lab_1');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_bhkimia`
--

CREATE TABLE `daftar_bhkimia` (
  `id_bhkimia` int(11) NOT NULL,
  `id_labo` int(11) NOT NULL,
  `id_faku` int(11) NOT NULL,
  `kode_bhkimia` varchar(255) DEFAULT NULL,
  `nama_bhkimia` varchar(255) NOT NULL,
  `bentuk` varchar(255) NOT NULL,
  `satuan` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `tanggal_masuk` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `keterangan` varchar(2000) NOT NULL,
  `pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_bhkimia`
--

INSERT INTO `daftar_bhkimia` (`id_bhkimia`, `id_labo`, `id_faku`, `kode_bhkimia`, `nama_bhkimia`, `bentuk`, `satuan`, `harga`, `tanggal_masuk`, `status`, `stok`, `keterangan`, `pemilik`) VALUES
(21, 38, 8, 'FKIK0001', 'Akrilamida', 'Bubuk', 'Gram', 50000, '2023-11-01 04:21:35', '', 2, 'Akrilamida (atau amida akrilat) adalah senyawa organik sederhana dengan rumus kimia C3H5NO dan berpotensi berbahaya bagi kesehatan (menyebabkan kanker atau karsinogenik). Nama IUPAC-nya adalah 2-propenamida. Dalam bentuk murni, akrilamida berwujud padatan kristal putih dan tidak berbau. Pada suhu ruang, akrilamida larut dalam air, etanol, eter, dan kloroform. Akrilamida tidak kompatibel dengan asam, basa, agen pengoksidasi, dan besi (dan garamnya). Dalam keadaan normal, akrilamida akan terdekomposisi menjadi amonia tanpa pemanasan, atau menjadi karbon dioksida, karbon monoksida, dan oksida nitrogen dengan pemanasan.', 'superadmin_2'),
(22, 38, 8, 'FKIK0002', 'Aloksan Monohidrat', 'Bubuk', 'Miligram', 250000, '2023-11-01 04:21:54', '', 19, 'Aloksan merupakan bahan kimia yang digunakan untuk menginduksi diabetes pada hewan model hiperglikemik.', 'superadmin_2');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_jadwal`
--

CREATE TABLE `daftar_jadwal` (
  `id_jdwl` int(11) NOT NULL,
  `id_labo` int(11) NOT NULL,
  `id_faku` int(11) NOT NULL,
  `kode_pinj` varchar(100) NOT NULL,
  `kode_modl` varchar(255) NOT NULL,
  `nama_modl` varchar(100) NOT NULL,
  `tanggal_pinj` datetime NOT NULL,
  `tanggal_sele` datetime NOT NULL,
  `nama_lgkp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daftar_lab`
--

CREATE TABLE `daftar_lab` (
  `id_labo` int(11) NOT NULL,
  `id_faku` int(11) NOT NULL,
  `kode_labo` varchar(100) NOT NULL,
  `nama_labo` varchar(100) NOT NULL,
  `prodi` varchar(255) NOT NULL,
  `fakultas` varchar(255) NOT NULL,
  `nama_lgkp` varchar(100) NOT NULL,
  `kapasitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_lab`
--

INSERT INTO `daftar_lab` (`id_labo`, `id_faku`, `kode_labo`, `nama_labo`, `prodi`, `fakultas`, `nama_lgkp`, `kapasitas`) VALUES
(38, 8, 'LBIO01', 'Laboratorium Anatomi', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Anatomi', 25),
(39, 8, 'LBIO02', 'Laboratorium Mikrobiologi (Klinis)', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Mikrobiologi (Klinis)', 50),
(40, 8, 'LBIO03', 'Laboratorium Mikrobiologi (Klinis)', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Mikrobiologi (Klinis)', 50),
(41, 8, 'LBIO04', 'Laboratorium Parasitologi', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Parasitologi', 25),
(42, 8, 'LBIO05', 'Laboratorium Biokimia', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Biokimia', 25),
(43, 8, 'LBIO06', 'Laboratorium Patologi Klinik', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Patologi Klinik', 25),
(44, 8, 'LBIO07', 'Laboratorium Fisiologi', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Fisiologi', 25),
(45, 8, 'LBIO08', 'Laboratorium Farmakologi', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Farmakologi', 25),
(46, 8, 'LBIO09', 'Laboratorium Histologi', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Histologi', 25),
(47, 8, 'LBIO10', 'Laboratorium Patologi Anatomi', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Patologi Anatomi', 25),
(48, 8, 'LBIO11', 'Laboratorium Biologi', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Biologi', 50),
(49, 8, 'LBIO12', 'Laboratorium Biomolekuler', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Biomolekuler', 25),
(50, 8, 'LBIO13', 'Laboratorium Komputer / CBT', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Komputer / CBT', 50),
(51, 8, 'LBIO14', 'Laboratorium Riset Deteksi Molekuler', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Riset Deteksi Molekuler', 10),
(52, 8, 'LBIO15', 'Laboratorium Biosafety Level 3 (BSL-3)', 'Kedokteran', 'Fakultas Kedokteran dan Ilmu Kesehatan', 'Laboran Biosafety Level 3 (BSL-3)', 4),
(161, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(162, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(163, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(164, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(165, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(166, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(167, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(168, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(169, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(170, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(171, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(172, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(173, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(174, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(175, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(176, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(177, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(178, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(179, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(180, 13, '-', '-', 'Pendidikan Biologi', 'Fakultas Biologi', '-', 0),
(185, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(186, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(187, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(188, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(189, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(190, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(191, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(192, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(193, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(194, 14, '-', '-', 'Teknik Informatika', 'Fakultas Teknologi Informasi', '-', 0),
(208, 15, '-', '-', 'Manajemen', 'Fakultas Ekonomi dan Bisnis', '-', 0),
(209, 15, '-', '-', 'Manajemen', 'Fakultas Ekonomi dan Bisnis', '-', 0),
(210, 15, '-', '-', 'Manajemen', 'Fakultas Ekonomi dan Bisnis', '-', 0),
(211, 15, '-', '-', 'Manajemen', 'Fakultas Ekonomi dan Bisnis', '-', 0),
(212, 15, '-', '-', 'Manajemen', 'Fakultas Ekonomi dan Bisnis', '-', 0);

-- --------------------------------------------------------

--
-- Table structure for table `daftar_modul`
--

CREATE TABLE `daftar_modul` (
  `id_modl` int(11) NOT NULL,
  `id_labo` int(11) NOT NULL,
  `id_faku` int(11) NOT NULL,
  `kode_modl` varchar(100) NOT NULL,
  `nama_modl` varchar(100) NOT NULL,
  `pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_modul`
--

INSERT INTO `daftar_modul` (`id_modl`, `id_labo`, `id_faku`, `kode_modl`, `nama_modl`, `pemilik`) VALUES
(21, 38, 8, 'TES1', 'Percobaan 1', 'admin_lab_1'),
(22, 38, 8, 'TES2', 'Percobaan 2', 'admin_lab_2'),
(23, 38, 8, 'TES3', 'Percobaan 3', 'admin_lab_3'),
(26, 38, 8, 'TES4', 'Percobaan 4', 'superadmin_2'),
(27, 38, 8, 'TES5', 'Percobaan 5', 'admin_lab_4'),
(30, 38, 8, 'AYO', 'Anatomi 1', 'admin_lab_1');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_request`
--

CREATE TABLE `daftar_request` (
  `id_req` int(11) NOT NULL,
  `id_labo` int(11) NOT NULL,
  `id_faku` int(11) NOT NULL,
  `kode_bhkimia` varchar(255) NOT NULL,
  `nama_bhkimia` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal_req` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_lgkp` varchar(255) NOT NULL,
  `nama_labo` varchar(255) NOT NULL,
  `catatan` varchar(2000) NOT NULL,
  `balasan` varchar(2000) NOT NULL,
  `status` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_request`
--

INSERT INTO `daftar_request` (`id_req`, `id_labo`, `id_faku`, `kode_bhkimia`, `nama_bhkimia`, `jumlah`, `total_harga`, `tanggal_req`, `nama_lgkp`, `nama_labo`, `catatan`, `balasan`, `status`, `username`) VALUES
(58, 38, 8, 'FKIK0001', 'Akrilamida', 1, 50000, '2023-11-01 05:45:11', '', '', 'tes req', '', 'Selesai', 'superadmin_2'),
(59, 38, 8, 'FKIK0002', 'Aloksan Monohidrat', 2, 500000, '2023-11-01 05:45:18', '', '', 'tes req', '', 'Selesai', 'superadmin_2'),
(60, 38, 8, 'FKIK0001', 'Akrilamida', 2, 100000, '2023-11-01 06:40:28', '', '', 'a', '', 'Dikirim', 'superadmin_2'),
(61, 38, 8, 'FKIK0002', 'Aloksan Monohidrat', 1, 250000, '2023-11-01 06:48:37', '', '', 'cas', '', 'Dikirim', 'superadmin_2'),
(62, 38, 8, 'FKIK0001', 'Akrilamida', 1, 50000, '2023-11-01 06:57:04', '', '', '', '', 'Requested', 'superadmin_2'),
(63, 38, 8, 'FKIK0002', 'Aloksan Monohidrat', 2, 500000, '2023-11-01 07:00:20', '', '', '', '', 'Requested', 'superadmin_2');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_riwayat`
--

CREATE TABLE `daftar_riwayat` (
  `id_rwyt` int(11) NOT NULL,
  `id_labo` int(11) NOT NULL,
  `id_faku` int(11) NOT NULL,
  `kode_alat` varchar(100) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `kode_pinj` varchar(100) NOT NULL,
  `tanggal_pinj` datetime NOT NULL,
  `tanggal_sele` datetime NOT NULL,
  `nama_lgkp` varchar(100) NOT NULL,
  `role` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar_riwayat`
--

INSERT INTO `daftar_riwayat` (`id_rwyt`, `id_labo`, `id_faku`, `kode_alat`, `nama_alat`, `kode_pinj`, `tanggal_pinj`, `tanggal_sele`, `nama_lgkp`, `role`, `tipe`) VALUES
(46, 38, 8, 'tes1', 'tes', '65389cd947f6e', '2023-10-26 11:43:00', '2023-10-27 11:43:00', 'Yanuar Christy Ade Utama', 'superadmin_2', 'Praktikum'),
(47, 38, 8, 'tes2', 'tes', '65389cd947f6e', '2023-10-26 11:43:00', '2023-10-27 11:43:00', 'Yanuar Christy Ade Utama', 'superadmin_2', 'Eksperimen'),
(48, 38, 8, 'TES4', 'Percobaan 4', '02250', '2023-10-26 11:46:00', '2023-10-27 11:46:00', 'Yanuar Christy Ade Utama', 'superadmin_2', 'Praktikum'),
(49, 38, 8, 'tes1', 'tes', '65389f7c4c688', '2023-10-26 11:54:00', '2023-10-27 11:54:00', 'Yanuar Christy Ade Utama', 'superadmin_2', 'Eksperimen'),
(50, 38, 8, 'TES1', 'TES1', '6538bacbcf710', '2023-10-25 15:50:00', '2023-10-25 17:50:00', 'Yanuar Christy Ade Utama', 'superadmin_2', 'Eksperimen'),
(51, 38, 8, 'TES1', 'Percobaan 1', '03655', '2023-10-26 13:52:00', '2023-10-27 13:52:00', 'Yanuar Christy Ade Utama', 'superadmin_2', 'Praktikum'),
(52, 38, 8, 'TES1', 'TES1', '6539cca49e9be', '2023-10-26 09:20:00', '2023-10-26 09:21:00', 'Yanuar Christy Ade Utama', 'superadmin_2', 'Eksperimen'),
(53, 38, 8, 'TES1', 'Percobaan 1', '00963', '2023-10-27 11:17:00', '2023-10-27 12:19:00', 'Yanuar Christy Ade Utama', 'superadmin_2', 'Praktikum');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_aktivitas`
--
ALTER TABLE `daftar_aktivitas`
  ADD PRIMARY KEY (`id_lapo`);

--
-- Indexes for table `daftar_akun`
--
ALTER TABLE `daftar_akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `daftar_alat`
--
ALTER TABLE `daftar_alat`
  ADD PRIMARY KEY (`id_alat`);

--
-- Indexes for table `daftar_bhkimia`
--
ALTER TABLE `daftar_bhkimia`
  ADD PRIMARY KEY (`id_bhkimia`);

--
-- Indexes for table `daftar_jadwal`
--
ALTER TABLE `daftar_jadwal`
  ADD PRIMARY KEY (`id_jdwl`);

--
-- Indexes for table `daftar_lab`
--
ALTER TABLE `daftar_lab`
  ADD PRIMARY KEY (`id_labo`);

--
-- Indexes for table `daftar_modul`
--
ALTER TABLE `daftar_modul`
  ADD PRIMARY KEY (`id_modl`);

--
-- Indexes for table `daftar_request`
--
ALTER TABLE `daftar_request`
  ADD PRIMARY KEY (`id_req`);

--
-- Indexes for table `daftar_riwayat`
--
ALTER TABLE `daftar_riwayat`
  ADD PRIMARY KEY (`id_rwyt`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_aktivitas`
--
ALTER TABLE `daftar_aktivitas`
  MODIFY `id_lapo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `daftar_akun`
--
ALTER TABLE `daftar_akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `daftar_alat`
--
ALTER TABLE `daftar_alat`
  MODIFY `id_alat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=558;

--
-- AUTO_INCREMENT for table `daftar_bhkimia`
--
ALTER TABLE `daftar_bhkimia`
  MODIFY `id_bhkimia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `daftar_jadwal`
--
ALTER TABLE `daftar_jadwal`
  MODIFY `id_jdwl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `daftar_lab`
--
ALTER TABLE `daftar_lab`
  MODIFY `id_labo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `daftar_modul`
--
ALTER TABLE `daftar_modul`
  MODIFY `id_modl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `daftar_request`
--
ALTER TABLE `daftar_request`
  MODIFY `id_req` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `daftar_riwayat`
--
ALTER TABLE `daftar_riwayat`
  MODIFY `id_rwyt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
