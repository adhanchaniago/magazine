-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2018 at 05:19 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_majalah`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikel`
--

CREATE TABLE `artikel` (
  `artikel_id` int(4) NOT NULL,
  `artikel_judul` varchar(100) NOT NULL,
  `artikel_dok` text NOT NULL,
  `artikel_approve` tinyint(1) NOT NULL DEFAULT '0',
  `artikel_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `artikel_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pegawai_nip` varchar(12) NOT NULL,
  `edisi_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikel`
--

INSERT INTO `artikel` (`artikel_id`, `artikel_judul`, `artikel_dok`, `artikel_approve`, `artikel_created`, `artikel_updated`, `pegawai_nip`, `edisi_id`) VALUES
(1, 'tes', '', 0, '2018-08-21 22:15:23', '2018-08-21 22:15:23', 'tes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `edisi`
--

CREATE TABLE `edisi` (
  `edisi_id` int(10) NOT NULL,
  `edisi_nama` varchar(12) NOT NULL,
  `edisi_status` varchar(100) NOT NULL DEFAULT 'Open',
  `edisi_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `edisi_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `edisi`
--

INSERT INTO `edisi` (`edisi_id`, `edisi_nama`, `edisi_status`, `edisi_created`, `edisi_updated`) VALUES
(1, '1', 'Open', '2018-08-21 22:14:04', '2018-08-21 22:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

CREATE TABLE `identitas` (
  `identitas_id` int(11) NOT NULL,
  `identitas_website` varchar(100) NOT NULL,
  `identitas_deskripsi` text NOT NULL,
  `identitas_keyword` text NOT NULL,
  `identitas_favicon` varchar(200) NOT NULL,
  `identitas_author` varchar(50) NOT NULL,
  `identitas_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `identitas_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`identitas_id`, `identitas_website`, `identitas_deskripsi`, `identitas_keyword`, `identitas_favicon`, `identitas_author`, `identitas_created`, `identitas_updated`) VALUES
(1, 'Humas Disdik', 'Sistem Informasi Majalah Dinas Pendidikan Provinsi Jawa Barat', 'majalah', 'logo.png', 'Baiq Erika Ramadhani', '2018-04-20 13:12:44', '2018-04-30 14:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `pegawai_nip` varchar(12) NOT NULL,
  `pegawai_password` varchar(50) NOT NULL,
  `pegawai_nama` varchar(30) NOT NULL,
  `pegawai_alamat` varchar(100) NOT NULL,
  `pegawai_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pegawai_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jabatan` varchar(100) NOT NULL,
  `sekolah_id` int(4) NOT NULL,
  `golongan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pegawai_nip`, `pegawai_password`, `pegawai_nama`, `pegawai_alamat`, `pegawai_created`, `pegawai_updated`, `jabatan`, `sekolah_id`, `golongan`) VALUES
('tes', '28b662d883b6d76fd96e4ddc5e9ba780', 'dsfsfsd', 'fsdfsdf', '2018-07-17 11:45:57', '2018-07-17 11:46:53', '1', 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `sekolah`
--

CREATE TABLE `sekolah` (
  `sekolah_id` int(4) NOT NULL,
  `sekolah_nama` varchar(50) NOT NULL,
  `sekolah_alamat` varchar(250) NOT NULL,
  `sekolah_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sekolah_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sekolah`
--

INSERT INTO `sekolah` (`sekolah_id`, `sekolah_nama`, `sekolah_alamat`, `sekolah_created`, `sekolah_updated`) VALUES
(1, 'tes', 'tes', '2018-07-17 11:45:32', '2018-07-17 11:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(25) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user_nama` varchar(100) NOT NULL,
  `user_role` varchar(30) NOT NULL,
  `user_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `user_nama`, `user_role`, `user_created`, `user_updated`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin', '2018-04-27 14:55:19', '2018-04-28 00:58:33'),
('kepegum', '3bdbb706da4bb43dc82bdadf1d6b588f', 'Kepegum', 'kepegum', '2018-08-21 20:56:07', '2018-08-21 20:56:07'),
('tes', '28b662d883b6d76fd96e4ddc5e9ba780', 'tes', 'user', '2018-07-17 11:50:22', '2018-07-17 11:50:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`artikel_id`);

--
-- Indexes for table `edisi`
--
ALTER TABLE `edisi`
  ADD PRIMARY KEY (`edisi_id`);

--
-- Indexes for table `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`identitas_id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`pegawai_nip`);

--
-- Indexes for table `sekolah`
--
ALTER TABLE `sekolah`
  ADD PRIMARY KEY (`sekolah_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artikel`
--
ALTER TABLE `artikel`
  MODIFY `artikel_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1213;

--
-- AUTO_INCREMENT for table `edisi`
--
ALTER TABLE `edisi`
  MODIFY `edisi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `sekolah`
--
ALTER TABLE `sekolah`
  MODIFY `sekolah_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
