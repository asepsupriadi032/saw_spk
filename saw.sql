-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2022 at 01:28 AM
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
(2, 'admin@admin.com', 'admin', 'admin', 1, 'default.png', 'sb_admin');

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
  `status_karyawan` enum('Tetap','Kontrak') NOT NULL,
  `tanggal_pengangkatan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id`, `nip`, `nama`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `alamat`, `status_karyawan`, `tanggal_pengangkatan`) VALUES
(1, 123, 'aaa', 'aaa', '2022-03-01', 'Laki-laki', '', 'Tetap', NULL),
(2, 1234, 'bb', 'bbb', '2022-03-02', 'Perempuan', '<p>\r\n	bbb</p>\r\n', 'Kontrak', NULL),
(3, 333333, 'cccc', 'ccc', '2022-06-01', 'Perempuan', '', 'Tetap', '2022-09-04'),
(4, 4444, 'ddd', 'ddd', '2022-06-01', 'Perempuan', '', 'Kontrak', NULL),
(5, 555, 'eee', 'eeee', '2022-06-01', 'Laki-laki', '', 'Tetap', NULL);

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
(2, 1, 'c2', 'Disiplin', 'cost', 15),
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
  `masa_kerja` int(3) NOT NULL,
  `ujian_tes` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nilai_karyawan`
--

INSERT INTO `nilai_karyawan` (`id`, `id_karyawan`, `id_periode`, `kinerja`, `disiplin`, `loyalitas`, `masa_kerja`, `ujian_tes`) VALUES
(1, 1, 1, 65, 95, 75, 1, 65),
(2, 2, 1, 75, 85, 95, 2, 65),
(3, 3, 1, 85, 85, 65, 3, 75),
(4, 4, 1, 70, 85, 70, 3, 70),
(5, 5, 2, 66, 70, 76, 45, 56);

-- --------------------------------------------------------

--
-- Table structure for table `normalisasi`
--

CREATE TABLE `normalisasi` (
  `id_normalisasi` int(5) NOT NULL,
  `id_karyawan` int(5) NOT NULL,
  `id_periode` int(5) NOT NULL,
  `c1` decimal(10,3) NOT NULL,
  `c2` decimal(10,3) NOT NULL,
  `c3` decimal(10,3) NOT NULL,
  `c4` decimal(10,3) NOT NULL,
  `c5` decimal(10,3) NOT NULL,
  `nilai_akhir` decimal(4,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `normalisasi`
--

INSERT INTO `normalisasi` (`id_normalisasi`, `id_karyawan`, `id_periode`, `c1`, `c2`, `c3`, `c4`, `c5`, `nilai_akhir`) VALUES
(13, 1, 1, '0.765', '0.895', '0.789', '0.333', '1.000', '0.683'),
(14, 2, 1, '0.882', '1.000', '1.000', '0.667', '1.000', '0.871'),
(15, 3, 1, '1.000', '1.000', '0.684', '1.000', '0.867', '0.924'),
(16, 4, 1, '0.824', '1.000', '0.737', '1.000', '0.929', '0.896'),
(17, 5, 2, '1.000', '1.000', '1.000', '1.000', '1.000', '1.000');

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(2) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `periode` date NOT NULL,
  `jumlah_pengangkatan` int(5) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `tanggal_kalkulasi` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `judul`, `periode`, `jumlah_pengangkatan`, `status`, `tanggal_kalkulasi`, `keterangan`) VALUES
(1, 'Testing', '2022-08-22', 4, 1, '2022-09-03 16:45:41', '<p>\r\n	Testing</p>\r\n'),
(2, 'lagi', '2022-09-03', 1, 1, '2022-09-03 17:03:56', '');

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
(37, 1, 'Hasil Perhitungan', 'admin/normalisasi', 'fa fa-book', 6, 1, 'Admin');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bobot`
--
ALTER TABLE `bobot`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `nilai_karyawan`
--
ALTER TABLE `nilai_karyawan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `normalisasi`
--
ALTER TABLE `normalisasi`
  MODIFY `id_normalisasi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tjm_menu`
--
ALTER TABLE `tjm_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
