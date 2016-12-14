-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2016 at 09:19 AM
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
-- Table structure for table `kegiatan`
--

CREATE TABLE IF NOT EXISTS `kegiatan` (
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
  `keg_target_satuan` varchar(254) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kegiatan`
--

INSERT INTO `kegiatan` (`keg_id`, `keg_nama`, `keg_unitkerja`, `keg_start`, `keg_end`, `keg_dibuat_oleh`, `keg_dibuat_waktu`, `keg_diupdate_oleh`, `keg_diupdate_waktu`, `keg_jenis`, `keg_total_target`, `keg_target_satuan`) VALUES
(1, 'Pengiriman DDA 2017', 52563, '2017-07-19', '2017-08-17', 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 17:23:12', 4, 10, 'Buku'),
(2, 'Pencacahan Sakernas 2016', 52521, '2017-02-01', '2017-03-07', 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:17:59', 3, 100, 'Blok Sensus'),
(3, 'Perjanjian Kinerja 2017', 52511, '2017-01-02', '2017-01-31', 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:44', 4, 10, 'Dokumen'),
(4, 'Berita Acara Updating MFD Online Semeter 1', 52562, '2017-07-03', '2017-07-31', 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:32', 3, 10, 'Laporan'),
(5, 'Survei Harga Konsumens (HK 1.1)', 52541, '2017-01-01', '2017-12-31', 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', 1, 1000, 'Usaha'),
(6, 'Pengolahan Sakernas Feb 2016 SEM 1', 52561, '2017-03-01', '2017-03-31', 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:32', 3, 100, 'Blok Sensus'),
(7, 'Pencacahan SKD-D 2017', 52563, '2017-04-20', '2017-07-31', 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:43', 4, 150, 'Responden');

-- --------------------------------------------------------

--
-- Table structure for table `keg_detil`
--

CREATE TABLE IF NOT EXISTS `keg_detil` (
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
  `keg_d_file` varchar(255) DEFAULT NULL,
  `keg_d_link_laci` varchar(254) DEFAULT NULL,
  `keg_d_ket` varchar(254) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keg_detil`
--

INSERT INTO `keg_detil` (`keg_d_id`, `keg_id`, `keg_d_unitkerja`, `keg_d_tgl`, `keg_d_jumlah`, `keg_d_dibuat_oleh`, `keg_d_dibuat_waktu`, `keg_d_diupdate_oleh`, `keg_d_diupdate_waktu`, `keg_d_jenis`, `keg_d_file`, `keg_d_link_laci`, `keg_d_ket`) VALUES
(1, 4, 52010, '2016-12-13', 1, 'mika', '2016-12-13 00:58:56', 'mika', '2016-12-12 16:58:56', 1, NULL, '', NULL),
(2, 4, 52030, '2016-12-31', 1, 'mika', '2016-12-13 00:58:56', 'mika', '2016-12-12 16:58:56', 1, NULL, '', NULL),
(3, 4, 52030, '2016-12-31', 1, 'mika', '2016-12-13 00:58:56', 'mika', '2016-12-12 16:58:56', 2, NULL, '', NULL),
(4, 4, 52010, '2016-12-13', 1, 'mika', '2016-12-13 00:58:56', 'mika', '2016-12-12 16:58:56', 2, NULL, '', NULL),
(5, 5, 52710, '2016-12-06', 34, 'mika', '2016-12-13 01:17:59', 'mika', '2016-12-12 17:17:59', 1, NULL, '', NULL),
(6, 5, 52710, '2016-12-13', 22, 'mika', '2016-12-13 01:19:20', 'mika', '2016-12-12 17:19:20', 1, NULL, '', NULL),
(7, 5, 52710, '2016-12-14', 23, 'mika', '2016-12-13 01:20:53', 'mika', '2016-12-12 17:20:53', 1, NULL, '', NULL),
(8, 5, 52710, '2016-12-13', 79, 'mika', '2016-12-13 01:22:03', 'mika', '2016-12-12 17:22:03', 2, NULL, '', NULL),
(9, 4, 52020, '2016-12-13', 1, 'mika', '2016-12-13 10:40:28', 'mika', '2016-12-13 02:40:28', 0, NULL, '', 'Pak POS'),
(10, 4, 52020, '2016-12-14', 2, 'mika', '2016-12-13 10:43:45', 'mika', '2016-12-13 02:43:45', 1, NULL, '', 'Pak POS'),
(11, 4, 52080, '2016-12-14', 1, 'mika', '2016-12-13 10:45:18', 'mika', '2016-12-13 02:45:18', 1, NULL, '', 'Pak budy'),
(12, 4, 52050, '2016-12-13', 1, 'mika', '2016-12-13 10:49:30', 'mika', '2016-12-13 02:49:30', 1, NULL, '', 'pandusiwi'),
(13, 5, 52080, '2016-12-14', 15, 'mika', '2016-12-13 10:49:59', 'mika', '2016-12-13 02:49:59', 1, NULL, '', 'email'),
(14, 5, 52080, '2016-12-14', 35, 'mika', '2016-12-13 10:50:15', 'mika', '2016-12-13 02:50:15', 1, NULL, '', 'email lagi'),
(15, 5, 52720, '2016-12-15', 100, 'mika', '2016-12-13 10:50:50', 'mika', '2016-12-13 02:50:50', 1, NULL, '', 'email'),
(16, 1, 52020, '2016-12-13', 1, 'mika', '2016-12-13 11:52:33', 'mika', '2016-12-13 03:52:33', 1, NULL, '', 'Pak Opik'),
(17, 1, 52020, '2016-12-13', 1, 'mika', '2016-12-13 11:59:33', 'mika', '2016-12-13 03:59:33', 2, NULL, '', ''),
(18, 1, 52020, '2016-12-13', 1, 'mika', '2016-12-13 12:00:09', 'mika', '2016-12-13 04:00:09', 2, NULL, '', NULL),
(19, 5, 52720, '2016-12-13', 100, 'mika', '2016-12-13 12:00:57', 'mika', '2016-12-13 04:00:57', 2, NULL, '', NULL),
(20, 6, 52030, '2016-12-13', 10, 'mika', '2016-12-13 12:03:18', 'mika', '2016-12-13 04:03:18', 1, NULL, '', 'email'),
(21, 5, 52080, '2016-12-13', 30, 'mika', '2016-12-13 12:04:10', 'mika', '2016-12-13 07:02:53', 1, NULL, 'https://laci.bps.go.id/index.php/s/jxgXYrEN3ghrLsu', 'email'),
(22, 5, 52080, '2016-12-13', 20, 'mika', '2016-12-13 12:05:21', 'mika', '2016-12-13 04:05:22', 1, NULL, '', 'email'),
(23, 5, 52080, '2016-12-13', 80, 'mika', '2016-12-13 13:50:12', 'mika', '2016-12-13 05:50:12', 2, NULL, NULL, NULL),
(24, 5, 52070, '2016-12-14', 2, 'mika', '2016-12-13 13:52:39', 'mika', '2016-12-13 05:52:39', 2, NULL, NULL, NULL),
(25, 5, 52070, '2016-12-07', 80, 'mika', '2016-12-13 14:03:40', 'mika', '2016-12-13 06:03:40', 1, NULL, NULL, 'JNE'),
(26, 5, 52070, '2016-12-07', 20, 'mika', '2016-12-13 14:06:01', 'mika', '2016-12-13 06:59:55', 1, NULL, NULL, 'JNE'),
(27, 5, 52070, '2016-12-13', 82, 'mika', '2016-12-13 14:06:33', 'mika', '2016-12-13 06:06:33', 2, NULL, NULL, NULL),
(28, 5, 52080, '2016-12-13', 20, 'mika', '2016-12-13 14:06:47', 'mika', '2016-12-13 06:06:47', 2, NULL, NULL, NULL),
(29, 5, 52020, '2016-12-14', 71, 'mika', '2016-12-13 14:08:08', 'mika', '2016-12-13 07:01:47', 1, NULL, NULL, 'jne'),
(30, 5, 52040, '2016-12-13', 86, 'mika', '2016-12-13 14:08:41', 'mika', '2016-12-13 07:00:26', 1, NULL, NULL, 'JNE'),
(31, 4, 52040, '2016-12-06', 3, 'mika', '2016-12-13 14:18:48', 'mika', '2016-12-13 06:18:48', 1, NULL, NULL, 'JNE'),
(32, 3, 52720, '2016-12-14', 1, 'mika', '2016-12-13 15:45:40', 'mika', '2016-12-13 07:45:40', 1, NULL, NULL, 'JNE'),
(33, 3, 52720, '2016-12-13', 1, 'mika', '2016-12-13 15:46:32', 'mika', '2016-12-13 07:46:32', 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keg_target`
--

CREATE TABLE IF NOT EXISTS `keg_target` (
`keg_t_id` int(11) NOT NULL,
  `keg_id` int(11) NOT NULL,
  `keg_t_unitkerja` int(5) NOT NULL,
  `keg_t_target` int(11) NOT NULL,
  `keg_t_dibuat_oleh` varchar(20) NOT NULL,
  `keg_t_dibuat_waktu` datetime NOT NULL,
  `keg_t_diupdate_oleh` varchar(20) NOT NULL,
  `keg_t_diupdate_waktu` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `keg_t_point` float(3,2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keg_target`
--

INSERT INTO `keg_target` (`keg_t_id`, `keg_id`, `keg_t_unitkerja`, `keg_t_target`, `keg_t_dibuat_oleh`, `keg_t_dibuat_waktu`, `keg_t_diupdate_oleh`, `keg_t_diupdate_waktu`, `keg_t_point`) VALUES
(1, 1, 52010, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 09:56:47', NULL),
(2, 1, 52020, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 09:56:47', NULL),
(3, 1, 52030, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 09:56:47', NULL),
(4, 1, 52040, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 09:56:47', NULL),
(5, 1, 52050, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 09:56:47', NULL),
(6, 1, 52060, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 09:56:47', NULL),
(7, 1, 52070, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 09:56:47', NULL),
(8, 1, 52080, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 09:56:47', NULL),
(9, 1, 52710, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 17:22:59', NULL),
(10, 1, 52720, 1, 'mika', '2016-12-12 17:56:46', 'mika', '2016-12-12 17:22:59', NULL),
(11, 2, 52010, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:17:59', NULL),
(12, 2, 52020, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:17:59', NULL),
(13, 2, 52030, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:17:59', NULL),
(14, 2, 52040, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:18:00', NULL),
(15, 2, 52050, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:18:00', NULL),
(16, 2, 52060, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:18:00', NULL),
(17, 2, 52070, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:18:00', NULL),
(18, 2, 52080, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:18:00', NULL),
(19, 2, 52710, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:18:01', NULL),
(20, 2, 52720, 10, 'mika', '2016-12-12 18:17:59', 'mika', '2016-12-12 10:18:01', NULL),
(21, 3, 52010, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:45', NULL),
(22, 3, 52020, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:45', NULL),
(23, 3, 52030, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:45', NULL),
(24, 3, 52040, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:45', NULL),
(25, 3, 52050, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:45', NULL),
(26, 3, 52060, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:45', NULL),
(27, 3, 52070, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:45', NULL),
(28, 3, 52080, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:46', NULL),
(29, 3, 52710, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:46', NULL),
(30, 3, 52720, 1, 'mika', '2016-12-12 18:22:44', 'mika', '2016-12-12 10:22:46', NULL),
(31, 4, 52010, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:32', NULL),
(32, 4, 52020, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:32', NULL),
(33, 4, 52030, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:32', NULL),
(34, 4, 52040, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:32', NULL),
(35, 4, 52050, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:32', NULL),
(36, 4, 52060, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:32', NULL),
(37, 4, 52070, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:33', NULL),
(38, 4, 52080, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:33', NULL),
(39, 4, 52710, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:33', NULL),
(40, 4, 52720, 1, 'mika', '2016-12-12 21:13:32', 'mika', '2016-12-12 13:13:33', NULL),
(41, 5, 52010, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(42, 5, 52020, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(43, 5, 52030, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(44, 5, 52040, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(45, 5, 52050, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(46, 5, 52060, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(47, 5, 52070, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(48, 5, 52080, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(49, 5, 52710, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(50, 5, 52720, 100, 'mika', '2016-12-12 21:34:15', 'zam', '2016-12-13 08:14:40', NULL),
(51, 6, 52010, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:32', NULL),
(52, 6, 52020, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:33', NULL),
(53, 6, 52030, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:33', NULL),
(54, 6, 52040, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:33', NULL),
(55, 6, 52050, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:33', NULL),
(56, 6, 52060, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:33', NULL),
(57, 6, 52070, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:34', NULL),
(58, 6, 52080, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:34', NULL),
(59, 6, 52710, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:34', NULL),
(60, 6, 52720, 10, 'mika', '2016-12-13 12:02:32', 'mika', '2016-12-13 04:02:35', NULL),
(61, 7, 52010, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:43', NULL),
(62, 7, 52020, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:44', NULL),
(63, 7, 52030, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:44', NULL),
(64, 7, 52040, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:44', NULL),
(65, 7, 52050, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:44', NULL),
(66, 7, 52060, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:44', NULL),
(67, 7, 52070, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:44', NULL),
(68, 7, 52080, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:44', NULL),
(69, 7, 52710, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:44', NULL),
(70, 7, 52720, 15, 'mika', '2016-12-13 15:05:43', 'mika', '2016-12-13 07:05:44', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_no`, `user_id`, `user_nama`, `user_passwd`, `user_email`, `user_unitkerja`, `user_dibuat_waktu`, `user_lastlogin`, `user_lastip`, `user_dibuat_oleh`, `user_status`, `user_diupdate_waktu`, `user_diupdate_oleh`, `user_level`) VALUES
(1, 'mika', 'I Putu Dyatmika', 'f3e602226149ae540e7a9fba728931c4', 'dyatmika@bps.go.id', 52563, '2016-12-06 08:02:45', '2016-12-13 16:14:50', '10.52.6.31', 'mika', 1, '2016-12-13 08:14:50', 'mika', 5),
(6, 'zam', 'Akhmad Zammiluny', 'af86ac1129b1c68cee5c200259d8e11d', 'zammiluny@bps.go.id', 52540, '2016-12-07 16:45:06', '2016-12-13 16:14:18', '10.52.6.31', 'mika', 1, '2016-12-13 08:14:18', 'mika', 3),
(7, 'endang', 'Endang Tri Wahyuningsih', '715e8efadb0019bf7e885934fef9460d', 'endang_t@bps.go.id', 52000, '2016-12-07 16:45:36', '2016-12-11 10:50:06', '192.168.1.18', 'mika', 1, '2016-12-13 07:54:44', 'mika', 1),
(8, 'supratna', 'Lalu Supratna', 'b57fd1497a390d03389db5c2d2ceb7c9', 'supratna@bps.go.id', 52020, '2016-12-07 16:46:12', '0000-00-00 00:00:00', '', 'mika', 1, '2016-12-13 07:54:55', 'mika', 1),
(9, 'arsana', 'I Made Arsana', '413050282b36fa042e65ccea76600211', 'arsana@bps.go.id', 52515, '2016-12-10 13:42:37', '2016-12-13 16:12:22', '10.52.6.31', 'mika', 1, '2016-12-13 08:12:22', 'mika', 3),
(10, 'rita', 'Rita', '8db5287529c36a281b9f32880b198947', 'rita@bps.go.id', 52530, '2016-12-10 13:44:58', '2016-12-13 16:11:56', '10.52.6.31', 'mika', 1, '2016-12-13 08:11:56', 'mika', 3),
(11, 'bps5203', 'Operator BPS5203', 'df2b6ea76b54463bf83b447e585fa35c', 'bps5203@bps.go.id', 52030, '2016-12-13 15:48:00', '2016-12-13 15:48:56', '10.52.6.31', 'mika', 1, '2016-12-13 07:55:19', 'mika', 2),
(12, 'agus', 'Agus Sudibyo', 'a6c343878b521fa0b4d96b261417a7aa', 'agus_sudibyo@bps.go.id', 52560, '2016-12-13 15:48:38', '0000-00-00 00:00:00', '', 'mika', 1, '2016-12-13 07:48:38', 'mika', 4);

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
-- Indexes for table `keg_target`
--
ALTER TABLE `keg_target`
 ADD PRIMARY KEY (`keg_t_id`);

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
MODIFY `keg_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `keg_detil`
--
ALTER TABLE `keg_detil`
MODIFY `keg_d_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `keg_target`
--
ALTER TABLE `keg_target`
MODIFY `keg_t_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `user_no` int(9) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
