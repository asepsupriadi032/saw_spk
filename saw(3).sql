-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 06:31 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `gambar` varchar(255) NOT NULL DEFAULT 'default.png',
  `theme` varchar(20) NOT NULL DEFAULT 'sb_admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `nama`, `status`, `gambar`, `theme`) VALUES
(2, 'admin@admin.com', 'admin1', 'admin', 1, 'default.png', 'sb_admin'),
(3, 'riko@gmail.com', '123456', 'RIKO SAPUTRA', 1, 'default.png', 'sb_admin');

-- --------------------------------------------------------

--
-- Table structure for table `bobot`
--

CREATE TABLE `bobot` (
  `id` int(2) NOT NULL,
  `nilai_awal` int(3) NOT NULL,
  `nilai_akhir` int(3) NOT NULL,
  `bobot` float NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bobot`
--

INSERT INTO `bobot` (`id`, `nilai_awal`, `nilai_akhir`, `bobot`, `keterangan`) VALUES
(1, 0, 19, 0.1, 'Sangat Buruk'),
(2, 20, 39, 0.15, 'Buruk'),
(3, 40, 59, 0.15, 'Cukup'),
(4, 60, 79, 0.25, 'Baik'),
(5, 80, 100, 0.35, 'Sangat Baik');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_perhitungan`
--

CREATE TABLE `hasil_perhitungan` (
  `id` int(11) NOT NULL,
  `id_periode` int(4) DEFAULT NULL,
  `id_karyawan` int(4) DEFAULT NULL,
  `periode` date DEFAULT NULL,
  `rangking` int(4) DEFAULT NULL,
  `nip` int(10) DEFAULT NULL,
  `nama` varchar(150) DEFAULT NULL,
  `jenis_kelamin` text DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `tanggal_kalkulasi` datetime DEFAULT NULL,
  `c1` decimal(10,3) DEFAULT NULL,
  `c2` decimal(10,3) DEFAULT NULL,
  `c3` decimal(10,3) DEFAULT NULL,
  `c4` decimal(10,3) DEFAULT NULL,
  `c5` decimal(10,3) DEFAULT NULL,
  `nilai_akhir` decimal(10,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_perhitungan`
--

INSERT INTO `hasil_perhitungan` (`id`, `id_periode`, `id_karyawan`, `periode`, `rangking`, `nip`, `nama`, `jenis_kelamin`, `status`, `tanggal_kalkulasi`, `c1`, `c2`, `c3`, `c4`, `c5`, `nilai_akhir`) VALUES
(130, 20, 75, '2018-11-14', 1, 23092, 'MAUL', 'Laki-laki', 'Tetap', '2022-11-28 14:59:56', '1.000', '0.778', '1.000', '1.000', '1.000', '0.967'),
(131, 20, 74, '2018-11-14', 2, 101, 'Bewok', 'Laki-laki', 'Kontrak', '2022-11-28 14:59:56', '0.778', '0.889', '1.000', '0.667', '0.897', '0.818'),
(132, 20, 76, '2018-11-14', 3, 7479, 'PUJO', 'Laki-laki', 'Kontrak', '2022-11-28 14:59:56', '0.889', '1.000', '0.778', '0.667', '0.875', '0.815');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id` int(5) NOT NULL,
  `nip` int(10) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') NOT NULL,
  `alamat` text NOT NULL,
  `status_karyawan` enum('Kontrak','Tetap') NOT NULL,
  `tanggal_pengangkatan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `status_karyawan`, `tanggal_pengangkatan`) VALUES
(64, 1, 'Ace', 'cibinong', '2022-11-18', 'Laki-laki', '<p>\r\n	ads</p>\r\n', 'Kontrak', NULL),
(65, 2, 'Asep', 'bogor', '2014-11-27', 'Laki-laki', '<p>\r\n	cxz</p>\r\n', 'Tetap', '2022-12-06'),
(66, 3, 'akhbarudi', 'bandung', '2013-11-08', 'Laki-laki', '<p>\r\n	ccs</p>\r\n', 'Kontrak', NULL),
(67, 4, 'a.manan', 'cibinong', '2012-11-29', 'Laki-laki', '<p>\r\n	sdsfsf</p>\r\n', 'Kontrak', NULL),
(68, 5, 'Uci Si', 'bogor', '2014-11-19', 'Laki-laki', '<p>\r\n	fdewfw</p>\r\n', 'Kontrak', NULL),
(69, 6, 'deden', 'depok', '2012-11-21', 'Laki-laki', '<p>\r\n	dsqd</p>\r\n', 'Kontrak', NULL),
(70, 7, 'dadan', 'bogor', '2012-11-06', 'Laki-laki', '<p>\r\n	dfeserg</p>\r\n', 'Kontrak', NULL),
(71, 8, 'Dadi', 'bogor', '2015-04-15', 'Laki-laki', '<p>\r\n	fewfwegwrqg</p>\r\n', 'Kontrak', NULL),
(72, 9, 'Djarkasih', 'depok', '2012-06-13', 'Laki-laki', '<p>\r\n	safefew</p>\r\n', 'Kontrak', NULL),
(73, 10, 'endang', 'depok', '2014-06-18', 'Laki-laki', '<p>\r\n	safEDFDSF</p>\r\n', 'Kontrak', NULL),
(74, 101, 'Bewok', 'bogor', '2012-11-21', 'Laki-laki', '<p>\r\n	dsfdsfdaf</p>\r\n', 'Kontrak', NULL),
(76, 7479, 'PUJO', 'bogor', '1997-12-24', 'Laki-laki', '<p>\r\n	FEFSF</p>\r\n', 'Kontrak', NULL),
(80, 93892, 'Soni', 'cibinong', '2022-05-09', 'Laki-laki', '<p>\r\n	sqsq</p>\r\n', 'Kontrak', NULL),
(81, 23782, 'EDI', 'bandung', '2015-11-25', 'Laki-laki', '<p>\r\n	wEWEEW</p>\r\n', 'Tetap', '2022-12-05'),
(82, 72367, 'DANI', 'cibinong', '2013-11-13', 'Laki-laki', '<p>\r\n	sdaaD</p>\r\n', 'Kontrak', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id` int(4) NOT NULL,
  `id_periode` int(3) NOT NULL,
  `kode` varchar(5) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `jenis` enum('benefit','cost') NOT NULL,
  `bobot` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id`, `id_periode`, `kode`, `nama_kriteria`, `jenis`, `bobot`) VALUES
(1, 1, 'c1', ' 	\nKinerja ', 'benefit', 25),
(2, 1, 'c2', 'Disiplin', 'benefit', 15),
(3, 1, 'c3', 'Loyalitas', 'benefit', 20),
(4, 1, 'c4', 'Masa Kerja', 'benefit', 30),
(5, 1, 'c5', 'Ujian Tes', 'cost', 10);

-- --------------------------------------------------------

--
-- Table structure for table `nilai_karyawan`
--

CREATE TABLE `nilai_karyawan` (
  `id` int(3) NOT NULL,
  `id_karyawan` int(3) NOT NULL,
  `id_periode` int(4) NOT NULL,
  `kinerja` int(3) NOT NULL,
  `disiplin` int(3) NOT NULL,
  `loyalitas` int(3) NOT NULL,
  `masa_kerja` enum('1','2','3') NOT NULL,
  `ujian_tes` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_karyawan`
--

INSERT INTO `nilai_karyawan` (`id`, `id_karyawan`, `id_periode`, `kinerja`, `disiplin`, `loyalitas`, `masa_kerja`, `ujian_tes`) VALUES
(53, 64, 19, 86, 90, 80, '1', 70),
(54, 65, 19, 86, 90, 83, '3', 70),
(55, 66, 19, 86, 90, 80, '3', 85),
(56, 67, 19, 90, 80, 78, '2', 75),
(57, 68, 19, 83, 70, 66, '2', 75),
(58, 69, 19, 70, 85, 75, '2', 75),
(59, 70, 19, 70, 71, 72, '3', 75),
(60, 71, 19, 75, 71, 64, '2', 80),
(61, 72, 19, 76, 70, 70, '1', 60),
(64, 65, 19, 86, 90, 80, '3', 70),
(65, 66, 19, 86, 90, 80, '3', 85),
(66, 67, 19, 90, 80, 78, '2', 75),
(67, 68, 19, 83, 70, 66, '2', 75),
(68, 69, 19, 70, 85, 75, '2', 75),
(69, 70, 19, 70, 71, 72, '3', 75),
(79, 80, 22, 90, 80, 70, '2', 80),
(80, 81, 22, 90, 80, 80, '2', 70),
(81, 82, 22, 80, 80, 70, '2', 80);

-- --------------------------------------------------------

--
-- Table structure for table `normalisasi`
--

CREATE TABLE `normalisasi` (
  `id_normalisasi` int(5) NOT NULL,
  `id_nilai` int(5) NOT NULL,
  `id_karyawan` int(5) NOT NULL,
  `id_periode` int(5) NOT NULL,
  `c1` decimal(10,3) NOT NULL,
  `c2` decimal(10,3) NOT NULL,
  `c3` decimal(10,3) NOT NULL,
  `c4` decimal(10,3) NOT NULL,
  `c5` decimal(10,3) NOT NULL,
  `nilai_akhir` decimal(4,3) NOT NULL,
  `rangking` int(3) NOT NULL,
  `status` enum('Kontrak','Tetap') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `normalisasi`
--

INSERT INTO `normalisasi` (`id_normalisasi`, `id_nilai`, `id_karyawan`, `id_periode`, `c1`, `c2`, `c3`, `c4`, `c5`, `nilai_akhir`, `rangking`, `status`) VALUES
(130, 54, 54, 18, '0.956', '1.000', '0.964', '0.333', '0.857', '0.767', 7, 'Kontrak'),
(131, 55, 55, 18, '0.956', '1.000', '1.000', '1.000', '0.857', '0.975', 1, 'Kontrak'),
(132, 56, 56, 18, '0.956', '1.000', '0.964', '1.000', '0.706', '0.952', 2, 'Kontrak'),
(133, 57, 57, 18, '1.000', '0.889', '0.940', '0.667', '0.800', '0.851', 4, 'Kontrak'),
(134, 58, 58, 18, '0.922', '0.778', '0.795', '0.667', '0.800', '0.786', 6, 'Kontrak'),
(135, 59, 59, 18, '0.778', '0.944', '0.904', '0.667', '0.800', '0.797', 5, 'Kontrak'),
(136, 60, 60, 18, '0.778', '0.789', '0.867', '1.000', '0.800', '0.866', 3, 'Kontrak'),
(137, 61, 61, 18, '0.833', '0.789', '0.771', '0.667', '0.750', '0.756', 8, 'Kontrak'),
(138, 62, 62, 18, '0.844', '0.778', '0.843', '0.333', '1.000', '0.696', 10, 'Kontrak'),
(139, 63, 63, 18, '0.889', '0.833', '0.843', '0.333', '0.857', '0.702', 9, 'Kontrak'),
(140, 64, 64, 19, '0.956', '1.000', '0.964', '0.333', '0.857', '0.767', 7, 'Kontrak'),
(141, 65, 65, 19, '0.956', '1.000', '0.964', '1.000', '0.857', '0.967', 1, 'Tetap'),
(142, 66, 66, 19, '0.956', '1.000', '0.964', '1.000', '0.706', '0.952', 2, 'Kontrak'),
(143, 67, 67, 19, '1.000', '0.889', '0.940', '0.667', '0.800', '0.851', 4, 'Kontrak'),
(144, 68, 68, 19, '0.922', '0.778', '0.795', '0.667', '0.800', '0.786', 6, 'Kontrak'),
(145, 69, 69, 19, '0.778', '0.944', '0.904', '0.667', '0.800', '0.797', 5, 'Kontrak'),
(146, 70, 70, 19, '0.778', '0.789', '0.867', '1.000', '0.800', '0.866', 3, 'Kontrak'),
(147, 71, 71, 19, '0.833', '0.789', '0.771', '0.667', '0.750', '0.756', 8, 'Kontrak'),
(148, 72, 72, 19, '0.844', '0.778', '0.843', '0.333', '1.000', '0.696', 10, 'Kontrak'),
(149, 73, 73, 19, '0.889', '0.833', '0.843', '0.333', '0.857', '0.702', 9, 'Kontrak'),
(150, 74, 74, 20, '0.778', '0.889', '1.000', '0.667', '0.897', '0.818', 2, 'Kontrak'),
(151, 75, 75, 20, '1.000', '0.778', '1.000', '1.000', '1.000', '0.967', 1, 'Tetap'),
(152, 76, 76, 20, '0.889', '1.000', '0.778', '0.667', '0.875', '0.815', 3, 'Kontrak'),
(153, 80, 80, 22, '1.000', '1.000', '0.875', '1.000', '0.875', '0.963', 2, 'Kontrak'),
(154, 81, 81, 22, '1.000', '1.000', '1.000', '1.000', '1.000', '1.000', 1, 'Tetap'),
(155, 82, 82, 22, '0.889', '1.000', '0.875', '1.000', '0.875', '0.935', 3, 'Kontrak');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(2) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `periode` date NOT NULL,
  `jumlah_pengangkatan` int(5) NOT NULL,
  `status_periode` enum('Tidak Aktif','Aktif') NOT NULL,
  `tanggal_kalkulasi` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `judul`, `periode`, `jumlah_pengangkatan`, `status_periode`, `tanggal_kalkulasi`, `keterangan`) VALUES
(19, 'rekomendasi pengangkatan pegawai', '2019-11-13', 1, 'Tidak Aktif', NULL, '<p>\r\n	Tetap</p>\r\n'),
(22, 'coba lagi', '2022-10-04', 1, 'Tidak Aktif', NULL, '<p>\r\n	wewee</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tjm_menu`
--

CREATE TABLE `tjm_menu` (
  `id` int(11) NOT NULL,
  `parent_menu` int(11) NOT NULL DEFAULT 1,
  `nama_menu` varchar(50) NOT NULL,
  `url_menu` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL,
  `urutan` tinyint(3) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `type` enum('Admin') NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tjm_menu`
--

INSERT INTO `tjm_menu` (`id`, `parent_menu`, `nama_menu`, `url_menu`, `icon`, `urutan`, `status`, `type`) VALUES
(1, 1, 'root', '/', '', 0, 0, 'Admin'),
(2, 1, 'dashboard', 'admin/dashboard', 'fa fa-fw fa-dashboard', 1, 1, 'Admin'),
(4, 1, 'Menu', 'admin/menu', 'fa fa-gear', 100, 0, 'Admin'),
(31, 1, 'Logout', 'admin/login/logout', 'fa fa-sign-out ', 101, 1, 'Admin'),
(32, 1, 'Periode', 'admin/periode', 'fa fa-book', 1, 1, 'Admin'),
(33, 1, 'Kriteria', 'admin/kriteria', 'fa fa-book', 2, 1, 'Admin'),
(34, 1, 'Karyawan', 'admin/karyawan', 'fa fa-book', 3, 1, 'Admin'),
(35, 1, 'Nilai Karyawan', 'admin/nilai', 'fa fa-book', 4, 1, 'Admin'),
(36, 1, 'Perhitungan', 'admin/perhitungan', 'fa fa-book', 5, 1, 'Admin'),
(37, 1, 'Log Perhitungan', 'admin/log_perhitungan', 'fa fa-book', 6, 1, 'Admin'),
(38, 1, 'User', 'admin/Useradmin', 'fa fa-user', 99, 1, 'Admin'),
(39, 1, 'Reset Password', 'admin/Akun/reset_password', 'fa fa-key', 9, 1, 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bobot`
--
ALTER TABLE `bobot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil_perhitungan`
--
ALTER TABLE `hasil_perhitungan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai_karyawan`
--
ALTER TABLE `nilai_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `normalisasi`
--
ALTER TABLE `normalisasi`
  ADD PRIMARY KEY (`id_normalisasi`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tjm_menu`
--
ALTER TABLE `tjm_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `hasil_perhitungan`
--
ALTER TABLE `hasil_perhitungan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai_karyawan`
--
ALTER TABLE `nilai_karyawan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `normalisasi`
--
ALTER TABLE `normalisasi`
  MODIFY `id_normalisasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tjm_menu`
--
ALTER TABLE `tjm_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
