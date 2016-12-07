-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2016 at 09:49 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ntbkeg`
--

-- --------------------------------------------------------

--
-- Table structure for table `unitkerja`
--

CREATE TABLE IF NOT EXISTS `unitkerja` (
  `unit_kode` int(5) NOT NULL,
  `unit_nama` varchar(254) NOT NULL,
  `unit_parent` int(5) DEFAULT NULL,
  `unit_jenis` int(1) NOT NULL,
  `unit_dibuat_waktu` datetime NOT NULL,
  `unit_dibuat_oleh` varchar(20) NOT NULL,
  `unit_diupdate_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `unit_diupdate_oleh` varchar(20) NOT NULL,
  `unit_eselon` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unitkerja`
--

INSERT INTO `unitkerja` (`unit_kode`, `unit_nama`, `unit_parent`, `unit_jenis`, `unit_dibuat_waktu`, `unit_dibuat_oleh`, `unit_diupdate_waktu`, `unit_diupdate_oleh`, `unit_eselon`) VALUES
(52000, 'BPS Provinsi Nusa Tenggara Barat', NULL, 1, '2016-12-06 08:12:08', 'mika', '2016-12-06 00:12:08', 'mika', 2),
(52010, 'BPS Kabupaten Lombok Barat', 52000, 2, '2016-12-06 09:22:39', 'mika', '2016-12-06 08:24:32', 'mika', 3),
(52020, 'BPS Kabupaten Lombok Tengah', 52000, 2, '2016-12-06 09:25:49', 'mika', '2016-12-06 08:26:36', 'mika', 3),
(52030, 'BPS Kabupaten Lombok Timur', 52000, 2, '2016-12-06 09:26:21', 'mika', '2016-12-06 08:26:21', 'mika', 3),
(52040, 'BPS Kabupaten Sumbawa', 52000, 2, '2016-12-06 09:26:54', 'mika', '2016-12-06 08:26:54', 'mika', 3),
(52050, 'BPS Kabupaten Dompu', 52000, 2, '2016-12-06 09:28:40', 'mika', '2016-12-06 08:28:40', 'mika', 3),
(52060, 'BPS Kabupaten Bima', 52000, 2, '2016-12-06 09:30:55', 'mika', '2016-12-06 08:30:55', 'mika', 3),
(52070, 'BPS Kabupaten Sumbawa Barat', 52000, 2, '2016-12-06 09:31:13', 'mika', '2016-12-06 08:31:13', 'mika', 3),
(52080, 'BPS Kabupaten Lombok Utara', 52000, 2, '2016-12-06 09:31:27', 'mika', '2016-12-06 08:31:27', 'mika', 3),
(52510, 'Bagian Tata Usaha', 52000, 1, '2016-12-06 09:35:55', 'mika', '2016-12-06 08:35:55', 'mika', 3),
(52520, 'BIdang Statistik Sosial', 52000, 1, '2016-12-06 09:36:50', 'mika', '2016-12-06 08:36:50', 'mika', 3),
(52530, 'Bidang Statistik Produksi', 52000, 1, '2016-12-06 09:37:57', 'mika', '2016-12-06 08:37:57', 'mika', 3),
(52540, 'Bidang Statistik Distribusi', 52000, 1, '2016-12-07 07:42:46', 'mika', '2016-12-07 06:42:46', 'mika', 3),
(52550, 'Bidang Neraca Wilayah dan Analisis Statistik', 52000, 1, '2016-12-07 07:42:25', 'mika', '2016-12-07 06:42:25', 'mika', 3),
(52560, 'Bidang IPDS', 52000, 1, '2016-12-06 09:34:35', 'mika', '2016-12-07 06:40:41', 'mika', 3),
(52561, 'Seksi Integrasi Pengolahan Data', 52560, 1, '2016-12-06 09:23:00', 'mika', '2016-12-06 08:37:00', 'mika', 4),
(52562, 'Seksi Jaringan dan Rujukan Statistik', 52560, 1, '2016-12-06 09:25:26', 'mika', '2016-12-06 08:37:10', 'mika', 4),
(52563, 'Seksi Diseminasi dan Layanan Statistik', 52560, 1, '2016-12-06 09:36:17', 'mika', '2016-12-06 08:37:18', 'mika', 4),
(52710, 'BPS Kota Mataram', 52000, 2, '2016-12-06 09:32:53', 'mika', '2016-12-06 08:32:53', 'mika', 3),
(52720, 'BPS Kota Bima', 52000, 2, '2016-12-06 09:33:10', 'mika', '2016-12-06 08:33:10', 'mika', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`user_no` int(9) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `user_nama` varchar(254) NOT NULL,
  `user_passwd` varchar(32) NOT NULL,
  `user_email` varchar(254) NOT NULL,
  `user_unitkerja` int(5) NOT NULL,
  `user_dibuat_waktu` datetime NOT NULL,
  `user_lastlogin` datetime NOT NULL,
  `user_lastip` varchar(20) NOT NULL,
  `user_dibuat_oleh` varchar(20) NOT NULL,
  `user_status` int(1) NOT NULL,
  `user_diupdate_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_diupdate_oleh` varchar(20) NOT NULL,
  `user_level` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `user_id`, `user_nama`, `user_passwd`, `user_email`, `user_unitkerja`, `user_dibuat_waktu`, `user_lastlogin`, `user_lastip`, `user_dibuat_oleh`, `user_status`, `user_diupdate_waktu`, `user_diupdate_oleh`, `user_level`) VALUES
(1, 'mika', 'I Putu Dyatmika', 'f3e602226149ae540e7a9fba728931c4', 'dyatmika@bps.go.id', 52563, '2016-12-06 08:02:45', '2016-12-07 16:43:48', '10.52.6.31', 'mika', 1, '2016-12-07 08:43:48', 'mika', 5),
(6, 'zam', 'Akhmad Zammiluny', 'af86ac1129b1c68cee5c200259d8e11d', 'zammiluny@bps.go.id', 52540, '2016-12-07 16:45:06', '0000-00-00 00:00:00', '', 'mika', 1, '2016-12-07 08:45:06', 'mika', 4),
(7, 'endang', 'Endang Tri Wahyuningsih', '715e8efadb0019bf7e885934fef9460d', 'endang_t@bps.go.id', 52000, '2016-12-07 16:45:36', '0000-00-00 00:00:00', '', 'mika', 1, '2016-12-07 08:45:36', 'mika', 3),
(8, 'supratna', 'Lalu Supratna', 'b57fd1497a390d03389db5c2d2ceb7c9', 'supratna@bps.go.id', 52020, '2016-12-07 16:46:12', '0000-00-00 00:00:00', '', 'mika', 1, '2016-12-07 08:46:12', 'mika', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `unitkerja`
--
ALTER TABLE `unitkerja`
 ADD PRIMARY KEY (`unit_kode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`user_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_no` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
