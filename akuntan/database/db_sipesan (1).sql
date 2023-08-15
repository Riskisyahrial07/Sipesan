-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2023 at 04:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sipesan`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `no_reff` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_reff` varchar(40) NOT NULL,
  `keterangan` varchar(40) NOT NULL,
  `is_laba_rugi` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`no_reff`, `id_user`, `nama_reff`, `keterangan`, `is_laba_rugi`) VALUES
(1000, 1, 'Kas', 'Kas', 0),
(1010, 1, 'Bank', 'bank', 0),
(1020, 1, 'piutang', 'piutang dagang\r\n', 0),
(1040, 1, 'Perlengkapan', 'Perlengkapan Usaha', 0),
(1500, 1, 'Peralatan', 'Peralatan Kantor', 0),
(2000, 1, 'Hutang Dagang', 'hutang dagang', 0),
(3000, 1, 'Modal', 'Modal Usaha', 0),
(3010, 1, 'Prive', 'Prive', 0),
(4010, 1, 'Pendapatan Jasa Spanduk', 'Pendapatan Penjualan Spanduk', 1),
(4020, 1, 'Pendapatan Jasa Stiker', 'Pendapatan Penjualan Stiker', 1),
(4030, 1, 'Pendapatan Jasa Brosur', 'Pendapatan Penjualan Brosur', 1),
(4040, 1, 'Pendapatan Jasa Desain', 'Pendapatan Pembuatan Desain', 1),
(4050, 1, 'Pendapatan Jasa Kartu', 'Pendapatan Pembuatan Kartu', 1),
(5000, 1, 'Biaya Gaji', 'Gaji Karyawan', 1),
(5010, 1, 'Biaya Listrik', 'Bayar listrik', 1),
(5020, 1, 'Biaya Air', 'Pembayaran Air', 1),
(5030, 1, 'Biaya ATK', 'Alat Tulis Kantor', 1),
(5040, 1, 'Biaya Sewa', 'Biaya sewa gedung/kendaraan', 1),
(5900, 1, 'Biaya Cetak', 'Biaya pembuatan spanduk', 1),
(5999, 1, 'Biaya Serba-Serbi', 'Biaya lain-lain diluar biaya yang dicant', 1),
(6000, 1, 'Ikhtisar Laba Rugi', 'Ikhtisar Laba Rugi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `no_reff` int(11) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jenis_saldo` enum('debit','kredit','','') NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `no_reff`, `tgl_input`, `tgl_transaksi`, `jenis_saldo`, `saldo`) VALUES
(55, 1, 1000, '2023-07-12 06:49:37', '2022-03-01', 'debit', 1500000),
(56, 1, 3000, '2023-07-12 06:49:55', '2022-03-01', 'kredit', 1500000),
(58, 1, 4010, '2023-07-12 11:33:11', '2023-07-12', 'debit', 100000),
(59, 1, 4010, '2023-07-12 18:14:40', '2023-07-12', 'debit', 500000),
(60, 1, 4020, '2023-07-12 18:17:11', '2023-07-12', 'debit', 750000),
(61, 1, 5000, '2023-07-12 20:41:50', '2023-07-12', 'kredit', 250000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` enum('laki-laki','perempuan','','') NOT NULL,
  `alamat` varchar(40) NOT NULL,
  `email` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `jk`, `alamat`, `email`, `username`, `password`, `last_login`) VALUES
(1, 'Arrahmat', 'laki-laki', 'JL.H.B Jassin No.337', 'hidayatchandra08@gmail.com', 'admin', '69005bb62e9622ee1de61958aacf0f63', '2023-07-21 05:48:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_reff`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `no_reff` (`no_reff`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
