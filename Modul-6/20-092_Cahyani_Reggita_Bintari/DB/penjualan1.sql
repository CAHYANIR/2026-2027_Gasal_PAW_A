-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Nov 2026 pada 23.16
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(10) DEFAULT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `harga`, `stok`, `supplier_id`) VALUES
(1, 'BRG001', 'Beras 5 Kg', 75000, 50, 1),
(2, 'BRG002', 'Minyak Goreng', 18000, 100, 2),
(3, 'BRG003', 'Gula Pasir', 16000, 80, 3),
(4, 'BRG004', 'Tepung Terigu', 12000, 70, 4),
(5, 'BRG005', 'Kopi Sachet', 15000, 90, 5),
(6, 'BRG006', 'Teh Celup', 10000, 60, 1),
(7, 'BRG007', 'Susu Kaleng', 14000, 50, 2),
(8, 'BRG008', 'Mie Instan', 3500, 200, 3),
(9, 'BRG009', 'Kecap Manis', 13000, 45, 4),
(10, 'BRG010', 'Air Mineral', 5000, 150, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` varchar(20) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
('PLG001', 'Andi Saputra', 'L', '081111111111', 'Bangkalan'),
('PLG002', 'Siti Aminah', 'P', '082222222222', 'Surabaya'),
('PLG003', 'Budi Santoso', 'L', '083333333333', 'Sidoarjo'),
('PLG004', 'Dewi Lestari', 'P', '084444444444', 'Gresik'),
('PLG005', 'Rina Amelia', 'P', '085555555555', 'Mojokerto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `waktu_bayar` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `metode` enum('TUNAI','TRANSFER','EDC') DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `waktu_bayar`, `total`, `metode`, `transaksi_id`) VALUES
(1, '2026-11-01 09:00:00', 150000, 'TUNAI', 1),
(2, '2026-11-01 10:00:00', 36000, 'TRANSFER', 2),
(3, '2026-11-02 09:30:00', 48000, 'EDC', 3),
(4, '2026-11-02 11:00:00', 36000, 'TUNAI', 4),
(5, '2026-11-03 08:30:00', 45000, 'TRANSFER', 5),
(6, '2026-11-03 13:00:00', 30000, 'EDC', 6),
(7, '2026-11-04 09:00:00', 42000, 'TUNAI', 7),
(8, '2026-11-04 10:30:00', 35000, 'TRANSFER', 8),
(9, '2026-11-05 11:00:00', 39000, 'EDC', 9),
(10, '2026-11-05 14:00:00', 25000, 'TUNAI', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `telp` varchar(12) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `alamat`) VALUES
(1, 'PT Sumber Makmur', '081234567801', 'Surabaya'),
(2, 'CV Berkah Jaya', '081234567802', 'Sidoarjo'),
(3, 'UD Maju Bersama', '081234567803', 'Madura'),
(4, 'PT Indo Supply', '081234567804', 'Gresik'),
(5, 'CV Sejahtera', '081234567805', 'Mojokerto');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `waktu_transaksi` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `pelanggan_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `waktu_transaksi`, `keterangan`, `total`, `pelanggan_id`) VALUES
(1, '2026-11-01', 'Pembelian beras', 150000, 'PLG001'),
(2, '2026-11-01', 'Pembelian minyak', 36000, 'PLG002'),
(3, '2026-11-02', 'Pembelian gula', 48000, 'PLG003'),
(4, '2026-11-02', 'Pembelian tepung', 36000, 'PLG004'),
(5, '2026-11-03', 'Pembelian kopi', 45000, 'PLG005'),
(6, '2026-11-03', 'Pembelian teh', 30000, 'PLG001'),
(7, '2026-11-04', 'Pembelian susu', 42000, 'PLG002'),
(8, '2026-11-04', 'Pembelian mie', 35000, 'PLG003'),
(9, '2026-11-05', 'Pembelian kecap', 39000, 'PLG004'),
(10, '2026-11-05', 'Pembelian air mineral', 25000, 'PLG005'),
(11, '2026-11-03', 'pembelian beras 1kg', 0, 'PLG005');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `transaksi_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`transaksi_id`, `barang_id`, `harga`, `qty`) VALUES
(1, 1, 75000, 2),
(2, 2, 18000, 2),
(3, 3, 16000, 3),
(4, 4, 12000, 3),
(5, 5, 15000, 3),
(6, 6, 10000, 3),
(7, 7, 14000, 3),
(8, 8, 3500, 10),
(9, 9, 13000, 3),
(10, 10, 5000, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` tinyint(4) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(150) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin', 'admin123', 'Administrator', 'Bangkalan', '081234567890', 1),
(2, 'kasir01', 'kasir123', 'Kasir Satu', 'Surabaya', '081234567891', 2),
(3, 'kasir02', 'kasir123', 'Kasir Dua', 'Sidoarjo', '081234567892', 2),
(4, 'staff01', 'staff123', 'Staff Gudang', 'Gresik', '081234567893', 2),
(5, 'staff02', 'staff123', 'Staff Toko', 'Madura', '081234567894', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`transaksi_id`,`barang_id`),
  ADD KEY `barang_id` (`barang_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Ketidakleluasaan untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`),
  ADD CONSTRAINT `transaksi_detail_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
