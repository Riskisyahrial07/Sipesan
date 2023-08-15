-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 10:53 AM
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
(6000, 1, 'Ikhtisar Laba Rugi', 'Ikhtisar Laba Rugi', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sipesan_bahan`
--

CREATE TABLE `sipesan_bahan` (
  `bahan_id` int(12) NOT NULL,
  `bahan_id_pesanan` int(12) NOT NULL,
  `bahan_nama` varchar(255) NOT NULL,
  `bahan_harga` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sipesan_bahan`
--

INSERT INTO `sipesan_bahan` (`bahan_id`, `bahan_id_pesanan`, `bahan_nama`, `bahan_harga`) VALUES
(1, 1, 'Stiker HVS', 10000),
(2, 1, 'Stiker Vinyl', 15000),
(3, 4, 'Art Paper 260 GSM', 3000),
(4, 4, 'Art Paper 260 GSM 2 Sisi', 3200),
(5, 3, 'Art Paper 280 GSM', 70000),
(6, 5, 'Vinyl B', 35000),
(7, 5, 'Korean Glossy', 67000),
(8, 2, 'Vinyl B spanduk', 35000),
(9, 2, 'Korean Glossy spanduk', 67000);

-- --------------------------------------------------------

--
-- Table structure for table `sipesan_faktur`
--

CREATE TABLE `sipesan_faktur` (
  `faktur_id` varchar(10) NOT NULL,
  `faktur_keranjang_id` varchar(10) NOT NULL,
  `faktur_bank` enum('bri','bni') NOT NULL,
  `faktur_alamat` text DEFAULT NULL,
  `faktur_pengambilan` varchar(255) DEFAULT NULL,
  `faktur_status` enum('belum','sudah','tunggu') NOT NULL DEFAULT 'belum',
  `faktur_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sipesan_faktur`
--

INSERT INTO `sipesan_faktur` (`faktur_id`, `faktur_keranjang_id`, `faktur_bank`, `faktur_alamat`, `faktur_pengambilan`, `faktur_status`, `faktur_date_created`) VALUES
('INV-08929', 'CRT-08909', 'bri', '', 'Self Pick Up', 'sudah', '2023-07-28 08:48:49');

-- --------------------------------------------------------

--
-- Table structure for table `sipesan_keranjang`
--

CREATE TABLE `sipesan_keranjang` (
  `keranjang_id` varchar(10) NOT NULL,
  `keranjang_pengguna_id` int(11) NOT NULL,
  `keranjang_total` int(11) NOT NULL,
  `keranjang_status` enum('belum','selesai','bayar_diterima','bayar_menunggu','bayar_verifikasi') NOT NULL DEFAULT 'belum',
  `keranjang_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sipesan_keranjang`
--

INSERT INTO `sipesan_keranjang` (`keranjang_id`, `keranjang_pengguna_id`, `keranjang_total`, `keranjang_status`, `keranjang_date_created`) VALUES
('CRT-08909', 2, 35000, 'bayar_menunggu', '2023-07-28 08:48:30');

-- --------------------------------------------------------

--
-- Table structure for table `sipesan_konfirmasi`
--

CREATE TABLE `sipesan_konfirmasi` (
  `konfirmasi_id` varchar(10) NOT NULL,
  `konfirmasi_faktur_id` varchar(10) NOT NULL,
  `konfirmasi_rekening` varchar(30) NOT NULL,
  `konfirmasi_atas_nama` varchar(50) NOT NULL,
  `konfirmasi_nominal` int(11) NOT NULL,
  `konfirmasi_struk` text NOT NULL,
  `konfirmasi_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sipesan_konfirmasi`
--

INSERT INTO `sipesan_konfirmasi` (`konfirmasi_id`, `konfirmasi_faktur_id`, `konfirmasi_rekening`, `konfirmasi_atas_nama`, `konfirmasi_nominal`, `konfirmasi_struk`, `konfirmasi_date_created`) VALUES
('CFM-08970', 'INV-08929', '465845165468484', 'xdxdx', 35000, '20940930.jpg', '2023-07-28 08:49:30');

-- --------------------------------------------------------

--
-- Table structure for table `sipesan_order`
--

CREATE TABLE `sipesan_order` (
  `id` int(11) NOT NULL,
  `keranjang_id` varchar(25) NOT NULL,
  `panjang` double DEFAULT NULL,
  `lebar` double DEFAULT NULL,
  `ukuran` int(11) DEFAULT NULL,
  `bahan` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) NOT NULL,
  `foto` text NOT NULL,
  `jenis_pesanan` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sipesan_order`
--

INSERT INTO `sipesan_order` (`id`, `keranjang_id`, `panjang`, `lebar`, `ukuran`, `bahan`, `jumlah`, `keterangan`, `total`, `foto`, `jenis_pesanan`, `created_at`) VALUES
(14, 'CRT-08909', 1, 1, NULL, 8, 1, NULL, 35000, '24bff9196a142740b0dfac42bf2f05f8.jpg', 'spanduk', '2023-07-28 08:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `sipesan_pengguna`
--

CREATE TABLE `sipesan_pengguna` (
  `pengguna_id` int(11) NOT NULL,
  `pengguna_username` varchar(255) NOT NULL,
  `pengguna_password` varchar(255) NOT NULL,
  `pengguna_nama` varchar(255) DEFAULT NULL,
  `pengguna_nomor_hp` varchar(20) DEFAULT NULL,
  `pengguna_email` varchar(255) DEFAULT NULL,
  `pengguna_level` enum('administrator','pemesan') NOT NULL,
  `pengguna_date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sipesan_pengguna`
--

INSERT INTO `sipesan_pengguna` (`pengguna_id`, `pengguna_username`, `pengguna_password`, `pengguna_nama`, `pengguna_nomor_hp`, `pengguna_email`, `pengguna_level`, `pengguna_date_created`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL, NULL, NULL, 'administrator', '2019-07-18 16:35:32'),
(2, 'pemesan', 'd58910536eed6faa657ba7dbc012534c', 'Randi', '081234567890', 'pemesan@gmail.com', 'pemesan', '2019-07-24 11:05:24'),
(3, 'testing', '7f2ababa423061c509f4923dd04b6cf1', 'nama test', '1234567', 'testing@gmail.com', 'pemesan', '2019-08-11 23:10:40'),
(4, 'cupu45', '202cb962ac59075b964b07152d234b70', 'cupu', '088274097292', 'cupu@gmail.com', 'pemesan', '2023-06-25 20:10:46'),
(5, 'yoyo', '202cb962ac59075b964b07152d234b70', 'adwawd', '000011112222', 'yoyo@gmail.com', 'pemesan', '2023-06-28 21:02:39');

-- --------------------------------------------------------

--
-- Table structure for table `sipesan_pesanan`
--

CREATE TABLE `sipesan_pesanan` (
  `id` int(12) NOT NULL,
  `nama_pesanan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sipesan_pesanan`
--

INSERT INTO `sipesan_pesanan` (`id`, `nama_pesanan`) VALUES
(1, 'Stiker'),
(2, 'Spanduk'),
(3, 'Kartu Nama'),
(4, 'Brosur'),
(5, 'Desain');

-- --------------------------------------------------------

--
-- Table structure for table `sipesan_ukuran`
--

CREATE TABLE `sipesan_ukuran` (
  `ukuran_id` int(12) NOT NULL,
  `ukuran_id_pesanan` int(12) NOT NULL,
  `ukuran_nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sipesan_ukuran`
--

INSERT INTO `sipesan_ukuran` (`ukuran_id`, `ukuran_id_pesanan`, `ukuran_nama`) VALUES
(1, 1, 'A4'),
(2, 1, 'A5'),
(3, 4, 'A4 Brosur'),
(4, 4, 'A7'),
(5, 3, '8,6 x 5,4 cm');

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
(73, 1, 1000, '2023-07-28 09:41:38', '2023-07-28', 'debit', 10000),
(74, 1, 1010, '2023-07-28 09:41:38', '2023-07-28', 'kredit', 10000),
(75, 1, 1500, '2023-07-28 09:46:20', '2023-07-28', 'kredit', 20000),
(76, 1, 1000, '2023-07-28 09:46:20', '2023-07-28', 'debit', 20000),
(77, 1, 4010, '2023-08-03 12:13:18', '2023-07-28', 'debit', 35000),
(78, 1, 1000, '2023-07-28 00:00:00', '2023-07-28', 'kredit', 35000),
(79, 1, 1000, '2023-08-03 12:37:44', '2023-08-03', 'debit', 1500000),
(80, 1, 3000, '2023-08-03 12:37:44', '2023-08-03', 'kredit', 1500000),
(81, 1, 1000, '2023-08-03 12:38:21', '2023-07-01', 'debit', 1500000),
(82, 1, 3000, '2023-08-03 12:38:21', '2023-07-01', 'kredit', 1500000);

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
(1, 'VCA', 'laki-laki', 'JL.Batu Berlian', 'vcambkm2022@gmail.com', 'admin', '69005bb62e9622ee1de61958aacf0f63', '2023-08-04 08:01:26');

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
-- Indexes for table `sipesan_bahan`
--
ALTER TABLE `sipesan_bahan`
  ADD PRIMARY KEY (`bahan_id`);

--
-- Indexes for table `sipesan_faktur`
--
ALTER TABLE `sipesan_faktur`
  ADD PRIMARY KEY (`faktur_id`),
  ADD KEY `faktur_keranjang_id` (`faktur_keranjang_id`);

--
-- Indexes for table `sipesan_keranjang`
--
ALTER TABLE `sipesan_keranjang`
  ADD PRIMARY KEY (`keranjang_id`),
  ADD KEY `keranjang_pengguna_id` (`keranjang_pengguna_id`);

--
-- Indexes for table `sipesan_konfirmasi`
--
ALTER TABLE `sipesan_konfirmasi`
  ADD PRIMARY KEY (`konfirmasi_id`),
  ADD KEY `konfirmasi_faktur_id` (`konfirmasi_faktur_id`);

--
-- Indexes for table `sipesan_order`
--
ALTER TABLE `sipesan_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sipesan_pengguna`
--
ALTER TABLE `sipesan_pengguna`
  ADD PRIMARY KEY (`pengguna_id`);

--
-- Indexes for table `sipesan_pesanan`
--
ALTER TABLE `sipesan_pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sipesan_ukuran`
--
ALTER TABLE `sipesan_ukuran`
  ADD PRIMARY KEY (`ukuran_id`);

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
-- AUTO_INCREMENT for table `sipesan_bahan`
--
ALTER TABLE `sipesan_bahan`
  MODIFY `bahan_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sipesan_order`
--
ALTER TABLE `sipesan_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sipesan_pengguna`
--
ALTER TABLE `sipesan_pengguna`
  MODIFY `pengguna_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sipesan_pesanan`
--
ALTER TABLE `sipesan_pesanan`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sipesan_ukuran`
--
ALTER TABLE `sipesan_ukuran`
  MODIFY `ukuran_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
