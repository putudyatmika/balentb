-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2017 at 03:29 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ntbkeg`
--

-- --------------------------------------------------------

--
-- Table structure for table `kegiatan`
--

CREATE TABLE `kegiatan` (
  `keg_id` int(11) NOT NULL,
  `keg_nama` varchar(254) NOT NULL,
  `keg_unitkerja` int(5) NOT NULL,
  `keg_start` date NOT NULL,
  `keg_end` date NOT NULL,
  `keg_dibuat_oleh` varchar(20) NOT NULL,
  `keg_dibuat_waktu` datetime NOT NULL,
  `keg_diupdate_oleh` varchar(20) NOT NULL,
  `keg_diupdate_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keg_jenis` int(1) NOT NULL,
  `keg_total_target` int(11) NOT NULL,
  `keg_target_satuan` varchar(254) NOT NULL,
  `keg_spj` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keg_detil`
--

CREATE TABLE `keg_detil` (
  `keg_d_id` int(11) NOT NULL,
  `keg_id` int(11) NOT NULL,
  `keg_d_unitkerja` int(5) NOT NULL,
  `keg_d_tgl` date NOT NULL,
  `keg_d_jumlah` int(11) NOT NULL,
  `keg_d_dibuat_oleh` varchar(20) NOT NULL,
  `keg_d_dibuat_waktu` datetime NOT NULL,
  `keg_d_diupdate_oleh` varchar(20) NOT NULL,
  `keg_d_diupdate_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keg_d_jenis` int(1) NOT NULL,
  `keg_d_link_laci` varchar(254) DEFAULT NULL,
  `keg_d_ket` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keg_d_file`
--

CREATE TABLE `keg_d_file` (
  `file_id` bigint(12) NOT NULL,
  `keg_d_id` int(11) NOT NULL,
  `file_nama` varchar(255) NOT NULL,
  `file_tipe` int(1) NOT NULL,
  `file_tanggal` datetime NOT NULL,
  `file_update` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keg_spj`
--

CREATE TABLE `keg_spj` (
  `keg_s_id` int(11) NOT NULL,
  `keg_id` int(11) NOT NULL,
  `keg_s_unitkerja` int(5) NOT NULL,
  `keg_s_target` int(11) NOT NULL,
  `keg_s_dibuat_oleh` varchar(20) NOT NULL,
  `keg_s_dibuat_waktu` datetime NOT NULL,
  `keg_s_diupdate_oleh` varchar(20) NOT NULL,
  `keg_s_diupdate_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keg_s_point_waktu` float(6,4) NOT NULL,
  `keg_s_point_jumlah` float(6,4) NOT NULL,
  `keg_s_point` float(6,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `keg_target`
--

CREATE TABLE `keg_target` (
  `keg_t_id` int(11) NOT NULL,
  `keg_id` int(11) NOT NULL,
  `keg_t_unitkerja` int(5) NOT NULL,
  `keg_t_target` int(11) NOT NULL,
  `keg_t_dibuat_oleh` varchar(20) NOT NULL,
  `keg_t_dibuat_waktu` datetime NOT NULL,
  `keg_t_diupdate_oleh` varchar(20) NOT NULL,
  `keg_t_diupdate_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keg_t_point_waktu` float(6,4) NOT NULL,
  `keg_t_point_jumlah` float(6,4) NOT NULL,
  `keg_t_point` float(6,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spj_detil`
--

CREATE TABLE `spj_detil` (
  `spj_d_id` int(11) NOT NULL,
  `keg_id` int(11) NOT NULL,
  `spj_d_unitkerja` int(5) NOT NULL,
  `spj_d_tgl` date NOT NULL,
  `spj_d_jumlah` int(11) NOT NULL,
  `spj_d_dibuat_oleh` varchar(20) NOT NULL,
  `spj_d_dibuat_waktu` datetime NOT NULL,
  `spj_d_diupdate_oleh` varchar(20) NOT NULL,
  `spj_d_diupdate_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `spj_d_jenis` int(1) NOT NULL,
  `spj_d_link_laci` varchar(254) DEFAULT NULL,
  `spj_d_ket` varchar(254) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unitkerja`
--

CREATE TABLE `unitkerja` (
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
(52511, 'Subbagian Bina Program', 52510, 1, '2016-12-10 13:28:49', 'mika', '2016-12-10 05:28:49', 'mika', 4),
(52512, 'Subbagian Kepegawaian & Hukum', 52510, 1, '2016-12-10 13:33:23', 'mika', '2016-12-10 05:33:23', 'mika', 4),
(52513, 'Subbagian Keuangan', 52510, 1, '2016-12-10 13:35:10', 'mika', '2016-12-10 05:35:10', 'mika', 4),
(52514, 'Subbagian Urusan Dalam', 52510, 1, '2016-12-10 13:35:54', 'mika', '2016-12-10 05:37:11', 'mika', 4),
(52515, 'Subbagian Perlengkapan', 52510, 1, '2016-12-10 13:40:09', 'mika', '2016-12-10 05:40:09', 'mika', 4),
(52520, 'Bidang Statistik Sosial', 52000, 1, '2016-12-06 09:36:50', 'mika', '2016-12-10 05:39:26', 'mika', 3),
(52521, 'Seksi Statistik Kependudukan', 52520, 1, '2016-12-10 13:43:19', 'mika', '2016-12-10 05:43:19', 'mika', 4),
(52522, 'Seksi Statistik Ketahanan Sosial', 52520, 1, '2016-12-10 13:43:51', 'mika', '2016-12-10 05:43:51', 'mika', 4),
(52523, 'Seksi Statistik Kesejahteraan Rakyat', 52520, 1, '2016-12-10 13:44:14', 'mika', '2016-12-10 05:44:14', 'mika', 4),
(52530, 'Bidang Statistik Produksi', 52000, 1, '2016-12-06 09:37:57', 'mika', '2016-12-06 08:37:57', 'mika', 3),
(52531, 'Seksi Statistik Pertanian', 52530, 1, '2016-12-10 18:52:16', 'mika', '2016-12-10 10:52:16', 'mika', 4),
(52532, 'Seksi Statistik Industri', 52530, 1, '2016-12-10 18:52:50', 'mika', '2016-12-10 10:52:50', 'mika', 4),
(52533, 'Seksi Statistik Pertambangan, Energi dan Konstruksi', 52530, 1, '2016-12-10 18:53:38', 'mika', '2016-12-10 10:53:38', 'mika', 4),
(52540, 'Bidang Statistik Distribusi', 52000, 1, '2016-12-07 07:42:46', 'mika', '2016-12-07 06:42:46', 'mika', 3),
(52541, 'Seksi Statistik Harga Konsumen dan Harga Perdagangan Besar', 52540, 1, '2016-12-10 18:54:22', 'mika', '2016-12-10 10:54:22', 'mika', 4),
(52542, 'Seksi Statistik Keuangan Dan Harga Produsen', 52540, 1, '2016-12-10 18:54:47', 'mika', '2016-12-10 10:54:47', 'mika', 4),
(52543, 'Seksi Statistik Niaga dan Jasa', 52540, 1, '2016-12-10 18:55:20', 'mika', '2016-12-10 10:55:20', 'mika', 4),
(52550, 'Bidang Neraca Wilayah dan Analisis Statistik', 52000, 1, '2016-12-07 07:42:25', 'mika', '2016-12-07 06:42:25', 'mika', 3),
(52551, 'Seksi Neraca Produksi', 52550, 1, '2016-12-10 18:58:18', 'mika', '2016-12-10 10:58:18', 'mika', 4),
(52552, 'Seksi Neraca Konsumsi', 52550, 1, '2016-12-10 18:58:43', 'mika', '2016-12-10 10:58:43', 'mika', 4),
(52553, 'Seksi Analisis Statistik Lintas Sektoral', 52550, 1, '2016-12-10 18:59:06', 'mika', '2016-12-10 10:59:06', 'mika', 4),
(52560, 'Bidang Integrasi Pengolahan Dan Diseminasi Statistik', 52000, 1, '2016-12-06 09:34:35', 'mika', '2016-12-10 05:24:28', 'mika', 3),
(52561, 'Seksi Integrasi Pengolahan Data', 52560, 1, '2016-12-06 09:23:00', 'mika', '2016-12-06 08:37:00', 'mika', 4),
(52562, 'Seksi Jaringan dan Rujukan Statistik', 52560, 1, '2016-12-06 09:25:26', 'mika', '2016-12-06 08:37:10', 'mika', 4),
(52563, 'Seksi Diseminasi dan Layanan Statistik', 52560, 1, '2016-12-06 09:36:17', 'mika', '2016-12-06 08:37:18', 'mika', 4),
(52710, 'BPS Kota Mataram', 52000, 2, '2016-12-06 09:32:53', 'mika', '2016-12-06 08:32:53', 'mika', 3),
(52720, 'BPS Kota Bima', 52000, 2, '2016-12-06 09:33:10', 'mika', '2016-12-06 08:33:10', 'mika', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
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
  `user_diupdate_waktu` datetime NOT NULL,
  `user_diupdate_oleh` varchar(20) NOT NULL,
  `user_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `user_id`, `user_nama`, `user_passwd`, `user_email`, `user_unitkerja`, `user_dibuat_waktu`, `user_lastlogin`, `user_lastip`, `user_dibuat_oleh`, `user_status`, `user_diupdate_waktu`, `user_diupdate_oleh`, `user_level`) VALUES
(1, 'mika', 'I Putu Dyatmika', 'f3e602226149ae540e7a9fba728931c4', 'dyatmika@bps.go.id', 52563, '2016-12-06 08:02:45', '2017-02-24 08:47:48', '10.52.6.31', 'mika', 1, '2016-12-21 15:25:42', 'admin', 5),
(7, 'endang', 'Endang Tri Wahyuningsih', '715e8efadb0019bf7e885934fef9460d', 'endang_t@bps.go.id', 52000, '2016-12-07 16:45:36', '2017-01-25 10:29:29', '10.52.6.31', 'mika', 1, '2016-12-13 15:54:44', 'mika', 1),
(8, 'supratna', 'Lalu Supratna', 'b57fd1497a390d03389db5c2d2ceb7c9', 'supratna@bps.go.id', 52020, '2016-12-07 16:46:12', '0000-00-00 00:00:00', '', 'mika', 1, '2016-12-13 15:54:55', 'mika', 1),
(10, 'meta', 'Meta', '4a2f6ca06815700a4f806f7b6dbdc317', 'meta@bps.go.id', 52530, '2016-12-10 13:44:58', '2017-02-23 10:14:25', '10.52.7.14', 'mika', 1, '2017-02-22 07:41:42', 'cassli', 3),
(11, 'bps5203', 'BPS Kabupaten Lombok Timur', 'df2b6ea76b54463bf83b447e585fa35c', 'bps5203@bps.go.id', 52030, '2016-12-13 15:48:00', '2017-01-29 08:45:31', '192.168.1.9', 'mika', 1, '2017-01-26 14:49:40', 'mika', 2),
(12, 'agus', 'Agus Sudibyo', 'a6c343878b521fa0b4d96b261417a7aa', 'agus_sudibyo@bps.go.id', 52560, '2016-12-13 15:48:38', '2017-02-22 14:51:13', '10.52.6.31', 'mika', 1, '2017-01-26 21:18:07', 'mika', 1),
(13, 'lina', 'Lina Winarni', 'e09bd07477bf7953be894bef8074623c', 'lina@bps.go.id', 52510, '2016-12-14 14:53:47', '2017-01-24 14:13:02', '10.52.6.31', 'mika', 1, '2017-01-29 09:14:16', 'fathi', 3),
(14, 'cassli', 'Casslirais Surawan', 'c0c2be89659678fffe142b9475a32d81', 'casslirais@bps.go.id', 52560, '2016-12-16 08:57:47', '2017-02-24 07:49:34', '10.52.6.31', 'mika', 1, '2017-01-29 09:02:12', 'fathi', 4),
(15, 'fathi', 'M. Fathi', '608c18749a87198c9bfeb55cec1d66d3', 'fathi@bps.go.id', 52560, '2016-12-16 08:58:11', '2017-01-30 10:57:36', '10.52.6.31', 'mika', 1, '2016-12-16 11:04:14', 'mika', 4),
(16, 'bps5201', 'BPS Kabupaten Lombok Barat', '8dac61b870997b5d8c707d7f03cd0a03', 'bps5201@bps.go.id', 52010, '2016-12-16 11:19:42', '2017-01-26 23:06:22', '192.168.1.6', 'mika', 1, '2017-01-26 14:49:25', 'mika', 2),
(17, 'isna', 'Isna Zuriatina', '238b2b7c02d936921098267a025774c8', 'isna@bps.go.id', 52520, '2016-12-16 16:58:08', '2017-02-22 09:15:50', '10.52.6.31', 'mika', 1, '2016-12-21 10:52:45', 'isna', 3),
(18, 'admin', 'Admin Sistem', '09dc140248a067f821a5743906af9fdc', 'admin@bpsntb.web.id', 52000, '2016-12-21 15:24:48', '2017-01-25 10:31:08', '10.52.6.31', 'mika', 1, '2016-12-21 15:24:48', 'mika', 5),
(19, 'agus_alwi', 'Agus Alwi', 'a6c343878b521fa0b4d96b261417a7aa', 'agus_alwi@bps.go.id', 52010, '2016-12-21 16:04:11', '0000-00-00 00:00:00', '', 'agus', 1, '2016-12-21 16:04:11', 'agus', 1),
(20, 'bps5271', 'BPS Kota Mataram', '93b80fad7b14744763b3d2d16338ec14', 'bps5271@bps.go.id', 52710, '2017-01-26 14:48:38', '0000-00-00 00:00:00', '', 'mika', 1, '2017-01-26 14:48:38', 'mika', 2),
(21, 'bps5272', 'BPS Kota Bima', 'f8c175ac1590729f8cc138d9435bb5cf', 'bps5272@bps.go.id', 52720, '2017-01-26 14:49:06', '2017-01-26 14:49:53', '10.52.6.31', 'mika', 1, '2017-01-26 14:49:06', 'mika', 2),
(22, 'lukman', 'Lukman', 'd2a1b65dc026e1b3c7d42796f159cb83', 'lukman@bps.go.id', 52562, '2017-01-26 21:19:02', '0000-00-00 00:00:00', '', 'mika', 1, '2017-01-26 21:19:02', 'mika', 4),
(23, 'bps5202', 'BPS Kabupaten Lombok Tengah', '1993348013f7debc4d959bb6833ecc8a', 'bps5202@bps.go.id', 52020, '2017-01-29 08:34:13', '2017-01-29 08:34:34', '192.168.1.9', 'mika', 1, '2017-01-29 08:34:13', 'mika', 2),
(24, 'yudis', 'I Putu Yudhistira', '99c1b3ffcff7097facf1f17eb76405af', 'putu.yudhistira@bps.go.id', 52560, '2017-01-29 09:03:02', '0000-00-00 00:00:00', '', 'fathi', 1, '2017-01-29 09:03:02', 'fathi', 3),
(25, 'bps5204', 'BPS Kabupaten Sumbawa', '6f764a7b026818aff864142e91f59b46', 'bps5204@bps.go.id', 52040, '2017-01-29 09:03:47', '0000-00-00 00:00:00', '', 'fathi', 1, '2017-01-29 09:03:47', 'fathi', 2),
(26, 'bps5205', 'BPS Kabupaten Dompu', '2b76c21701762947a13db61af19081d7', 'bps5205@bps.go.id', 52050, '2017-01-29 09:04:14', '2017-02-10 12:01:09', '10.52.6.33', 'fathi', 1, '2017-01-29 09:04:14', 'fathi', 2),
(27, 'bps5206', 'BPS Kabupaten Bima', '817fa25ba269d516582ad355e16bb9a5', 'bps5206@bps.go.id', 52060, '2017-01-29 09:04:45', '0000-00-00 00:00:00', '', 'fathi', 1, '2017-01-29 09:04:45', 'fathi', 2),
(28, 'bps5207', 'BPS Kabupaten Sumbawa Barat', 'bad1c016afc4ad0ada93500c5aedc3e8', 'bps5207@bps.go.id', 52070, '2017-01-29 09:05:22', '0000-00-00 00:00:00', '', 'fathi', 1, '2017-01-29 09:05:22', 'fathi', 2),
(29, 'bps5208', 'BPS Kabupaten Lombok Utara', '0e09a471bd653559e8e3e10ed5f37b9b', 'bps5208@bps.go.id', 52080, '2017-01-29 09:06:28', '0000-00-00 00:00:00', '', 'fathi', 1, '2017-01-29 09:06:28', 'fathi', 2),
(30, 'wini', 'Wini Widiastuti', '5107e325c0924177c23fd39fc25bb9cc', 'winiwidiastuti@bps.go.id', 52540, '2017-01-29 09:15:07', '2017-02-23 10:16:51', '10.52.7.13', 'fathi', 1, '2017-01-29 09:15:07', 'fathi', 3),
(31, 'omang', 'Ni Nyoman Ratna', '164eafb8d97db9db7b80b2f991829b35', 'nyomanratna@bps.go.id', 52550, '2017-02-22 07:43:23', '2017-02-24 09:55:56', '10.52.6.33', 'cassli', 1, '2017-02-22 07:43:23', 'cassli', 3),
(32, 'tri', 'Tri Harjanto', '7c8fb9436da61e1f3d79ed7537129284', 'harjan@bps.go.id', 52540, '2017-02-23 10:14:47', '2017-02-23 10:15:09', '10.52.7.12', 'cassli', 1, '2017-02-23 10:14:47', 'cassli', 3),
(33, 'indra', 'Indra Sasmita', '7bfb03fcc394b7b88622ca9dd0d28169', 'indra@bps.go.id', 52550, '2017-02-23 10:15:52', '2017-02-23 10:56:50', '10.52.7.13', 'cassli', 1, '2017-02-23 10:15:52', 'cassli', 3),
(34, 'wika', 'Wikayatu Diny', '9c6ec2f1cec958d3ab163b995978e74f', 'wikayatu@bps.go.id', 52510, '2017-02-24 10:27:47', '0000-00-00 00:00:00', '', 'mika', 1, '2017-02-24 10:27:47', 'mika', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kegiatan`
--
ALTER TABLE `kegiatan`
  ADD PRIMARY KEY (`keg_id`);

--
-- Indexes for table `keg_detil`
--
ALTER TABLE `keg_detil`
  ADD PRIMARY KEY (`keg_d_id`);

--
-- Indexes for table `keg_d_file`
--
ALTER TABLE `keg_d_file`
  ADD PRIMARY KEY (`file_id`);

--
-- Indexes for table `keg_spj`
--
ALTER TABLE `keg_spj`
  ADD PRIMARY KEY (`keg_s_id`);

--
-- Indexes for table `keg_target`
--
ALTER TABLE `keg_target`
  ADD PRIMARY KEY (`keg_t_id`);

--
-- Indexes for table `spj_detil`
--
ALTER TABLE `spj_detil`
  ADD PRIMARY KEY (`spj_d_id`);

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
-- AUTO_INCREMENT for table `kegiatan`
--
ALTER TABLE `kegiatan`
  MODIFY `keg_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keg_detil`
--
ALTER TABLE `keg_detil`
  MODIFY `keg_d_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keg_d_file`
--
ALTER TABLE `keg_d_file`
  MODIFY `file_id` bigint(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keg_spj`
--
ALTER TABLE `keg_spj`
  MODIFY `keg_s_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `keg_target`
--
ALTER TABLE `keg_target`
  MODIFY `keg_t_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `spj_detil`
--
ALTER TABLE `spj_detil`
  MODIFY `spj_d_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_no` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
