-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2021 at 05:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lab`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(5) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `deskripsi` longtext NOT NULL,
  `stok` int(4) NOT NULL,
  `foto` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `deskripsi`, `stok`, `foto`) VALUES
(24, 'Drone', 'Barang masih bagus', 3, 'IMG_20210708_144335[1].jpg'),
(25, 'Crimping', 'Barang masih bagus', 5, 'IMG_20210708_145456[1].jpg'),
(26, 'Camera canon', 'Barang masih bagus', 6, 'IMG_20210708_144731[1].jpg'),
(27, 'Dazzle', 'Barang masih bagus', 4, 'IMG_20210708_144956[1].jpg'),
(28, 'GoPro', 'Barang masih bagus', 6, 'IMG_20210708_144756[1].jpg'),
(29, 'Tablet Rasberry P1', 'Barang masih bagus', 9, 'IMG_20210708_145122[1].jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `id_pinjam` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `dari` date NOT NULL,
  `sampai` date NOT NULL,
  `surat` varchar(225) NOT NULL,
  `status_kajur` varchar(1) NOT NULL,
  `status_kalab` varchar(1) NOT NULL,
  `bukti_ambil` varchar(100) NOT NULL,
  `bukti_antar` varchar(100) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`id_pinjam`, `id_user`, `nama`, `dari`, `sampai`, `surat`, `status_kajur`, `status_kalab`, `bukti_ambil`, `bukti_antar`, `kode`, `tgl`) VALUES
(10, 2, 'Andi Prins', '2021-07-26', '2021-07-28', 'Mario_Usecase[1].docx', 'Y', 'Y', 'IMG-20210708-WA0004[1].jpg', 'IMG-20210708-WA0004[1].jpg', '23/LAB.TKK/2/21/03/54/06', '2021-07-23');

-- --------------------------------------------------------

--
-- Table structure for table `regist`
--

CREATE TABLE `regist` (
  `id_regist` int(5) NOT NULL,
  `nomor` int(15) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `regist`
--

INSERT INTO `regist` (`id_regist`, `nomor`, `nama`, `hp`, `alamat`) VALUES
(2, 1705063, 'Andi Prins', '0853xxx', 'Buas'),
(38, 1805046, 'Yosua Katuhu', '0822xxx', 'Virgot');

-- --------------------------------------------------------

--
-- Table structure for table `sub_transaksi`
--

CREATE TABLE `sub_transaksi` (
  `id_subtransaksi` int(5) NOT NULL,
  `id_pinjam` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `jlh` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_transaksi`
--

INSERT INTO `sub_transaksi` (`id_subtransaksi`, `id_pinjam`, `id_barang`, `jlh`) VALUES
(14, 10, 26, 2),
(15, 10, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tempo`
--

CREATE TABLE `tempo` (
  `id_tempo` int(5) NOT NULL,
  `id_barang` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `jlh` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `username` varchar(22) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` int(1) NOT NULL,
  `nama` varchar(33) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`, `nama`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 'Adi Nababan', 1),
(2, 'Andi', 'd8578edf8458ce06fbc5bb76a58c5ca4', 4, 'Andi Prins', 1),
(36, 'kajur', 'fa2a64d863ff8a83fee0b8fafd292d26', 3, 'Alfrianus Papuas', 1),
(37, 'kalab', '966676a567d83cf0fbeb8cd5c280a589', 2, 'Stendy B. Sakur', 1),
(38, 'Jojo', 'eb89f40da6a539dd1b1776e522459763', 4, 'Yosua Katuhu', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indexes for table `regist`
--
ALTER TABLE `regist`
  ADD PRIMARY KEY (`id_regist`);

--
-- Indexes for table `sub_transaksi`
--
ALTER TABLE `sub_transaksi`
  ADD PRIMARY KEY (`id_subtransaksi`);

--
-- Indexes for table `tempo`
--
ALTER TABLE `tempo`
  ADD PRIMARY KEY (`id_tempo`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id_pinjam` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `regist`
--
ALTER TABLE `regist`
  MODIFY `id_regist` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sub_transaksi`
--
ALTER TABLE `sub_transaksi`
  MODIFY `id_subtransaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tempo`
--
ALTER TABLE `tempo`
  MODIFY `id_tempo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
