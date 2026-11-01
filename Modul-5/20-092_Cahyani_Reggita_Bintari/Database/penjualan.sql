-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Nov 2026 pada 23.50
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
-- Database: `penjualan`
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
(3, 'BRG003', 'Gula Pasir 1 Kg', 16000, 80, 3),
(4, 'BRG004', 'Tepung Terigu', 12000, 70, 4),
(5, 'BRG005', 'Mie Instan', 3500, 200, 5),
(6, 'BRG006', 'Kopi Sachet', 2000, 150, 6),
(7, 'BRG007', 'Teh Celup', 8000, 60, 7),
(8, 'BRG008', 'Susu Kaleng', 14000, 45, 8),
(9, 'BRG009', 'Kecap Manis', 11000, 55, 9),
(10, 'BRG010', 'Air Mineral', 5000, 120, 10);

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
('PLG001', 'Andi Saputra', 'L', '081300000001', 'Surabaya'),
('PLG002', 'Siti Aminah', 'P', '081300000002', 'Sidoarjo'),
('PLG003', 'Budi Santoso', 'L', '081300000003', 'Bangkalan'),
('PLG004', 'Dewi Lestari', 'P', '081300000004', 'Madura'),
('PLG005', 'Rina Amelia', 'P', '081300000005', 'Gresik'),
('PLG006', 'Agus Setiawan', 'L', '081300000006', 'Malang'),
('PLG007', 'Fitri Handayani', 'P', '081300000007', 'Mojokerto'),
('PLG008', 'Rizky Pratama', 'L', '081300000008', 'Jombang'),
('PLG009', 'Nur Aisyah', 'P', '081300000009', 'Lamongan'),
('PLG010', 'Dimas Prakoso', 'L', '081300000010', 'Pasuruan');

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
(1, '2026-10-01 09:00:00', 150000, 'TUNAI', 1),
(2, '2026-10-02 10:00:00', 90000, 'TRANSFER', 2),
(3, '2026-10-03 11:00:00', 80000, 'EDC', 3),
(4, '2026-10-04 12:00:00', 60000, 'TUNAI', 4),
(5, '2026-10-05 13:00:00', 35000, 'TRANSFER', 5),
(6, '2026-10-06 14:00:00', 40000, 'EDC', 6),
(7, '2026-10-07 15:00:00', 40000, 'TUNAI', 7),
(8, '2026-10-08 16:00:00', 70000, 'TRANSFER', 8),
(9, '2026-10-09 17:00:00', 55000, 'EDC', 9),
(10, '2026-10-10 18:00:00', 50000, 'TUNAI', 10);

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
(3, 'UD Mitra Sejahtera', '081234567803', 'Madura'),
(4, 'PT Indo Pangan', '081234567804', 'Gresik'),
(5, 'CV Sinar Abadi', '081234567805', 'Malang'),
(6, 'UD Lancar Jaya', '081234567806', 'Mojokerto'),
(7, 'PT Mitra Dagang', '081234567807', 'Jombang'),
(8, 'CV Karya Mandiri', '081234567808', 'Lamongan'),
(9, 'UD Sukses Bersama', '081234567809', 'Pasuruan'),
(10, 'PT Niaga Utama', '081234567810', 'Bangkalan');

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
(1, '2026-10-01', 'Pembelian beras', 150000, 'PLG001'),
(2, '2026-10-02', 'Pembelian minyak goreng', 90000, 'PLG002'),
(3, '2026-10-03', 'Pembelian gula pasir', 80000, 'PLG003'),
(4, '2026-10-04', 'Pembelian tepung terigu', 60000, 'PLG004'),
(5, '2026-10-05', 'Pembelian mie instan', 35000, 'PLG005'),
(6, '2026-10-06', 'Pembelian kopi sachet', 40000, 'PLG006'),
(7, '2026-10-07', 'Pembelian teh celup', 40000, 'PLG007'),
(8, '2026-10-08', 'Pembelian susu kaleng', 70000, 'PLG008'),
(9, '2026-10-09', 'Pembelian kecap manis', 55000, 'PLG009'),
(10, '2026-10-10', 'Pembelian air mineral', 50000, 'PLG010');

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
(2, 2, 18000, 5),
(3, 3, 16000, 5),
(4, 4, 12000, 5),
(5, 5, 3500, 10),
(6, 6, 2000, 20),
(7, 7, 8000, 5),
(8, 8, 14000, 5),
(9, 9, 11000, 5),
(10, 10, 5000, 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` tinyint(2) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(35) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `hp` varchar(20) DEFAULT NULL,
  `level` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `nama`, `alamat`, `hp`, `level`) VALUES
(1, 'admin01', 'admin123', 'Admin Utama', 'Surabaya', '081311111111', 1),
(2, 'kasir01', 'kasir123', 'Ani', 'Sidoarjo', '081311111112', 2),
(3, 'kasir02', 'kasir123', 'Budi', 'Bangkalan', '081311111113', 2),
(4, 'kasir03', 'kasir123', 'Citra', 'Madura', '081311111114', 2),
(5, 'admin02', 'admin123', 'Doni', 'Gresik', '081311111115', 1),
(6, 'kasir04', 'kasir123', 'Eka', 'Malang', '081311111116', 2),
(7, 'kasir05', 'kasir123', 'Fajar', 'Mojokerto', '081311111117', 2),
(8, 'kasir06', 'kasir123', 'Gina', 'Jombang', '081311111118', 2),
(9, 'kasir07', 'kasir123', 'Hani', 'Lamongan', '081311111119', 2),
(10, 'admin03', 'admin123', 'Indra', 'Pasuruan', '081311111120', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
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
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
