-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Des 2022 pada 14.04
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_parking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `password2` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `level` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `created_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_user`, `username`, `password`, `password2`, `nama`, `level`, `status`, `created_dt`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Superadmin', 0, 1, '0000-00-00 00:00:00'),
(2, 'staff', '1253208465b1efa876f982d8a9e73eef', 'staff', 'Staff Tiketing', 1, 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_tarif_kendaraan`
--

CREATE TABLE `ms_tarif_kendaraan` (
  `id_tarif_kendaraan` int(11) NOT NULL,
  `jenis_kendaraan` varchar(50) NOT NULL,
  `tarif_kendaraan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ms_tarif_kendaraan`
--

INSERT INTO `ms_tarif_kendaraan` (`id_tarif_kendaraan`, `jenis_kendaraan`, `tarif_kendaraan`) VALUES
(1, 'Motor', 2000),
(2, 'Mobil', 3000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `trx_parking`
--

CREATE TABLE `trx_parking` (
  `kode_tiket` varchar(50) NOT NULL,
  `jenis_kendaraan` varchar(50) NOT NULL,
  `kode_huruf_awal` char(1) NOT NULL,
  `kode_nomor` char(4) NOT NULL,
  `kode_huruf_akhir` char(3) NOT NULL,
  `plat_nomor` char(8) NOT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_keluar` datetime NOT NULL,
  `durasi` varchar(50) NOT NULL,
  `tarif_parkir` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_dt` datetime NOT NULL,
  `update_by` varchar(50) NOT NULL,
  `update_dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `ms_tarif_kendaraan`
--
ALTER TABLE `ms_tarif_kendaraan`
  ADD PRIMARY KEY (`id_tarif_kendaraan`) USING BTREE;

--
-- Indeks untuk tabel `trx_parking`
--
ALTER TABLE `trx_parking`
  ADD PRIMARY KEY (`kode_tiket`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ms_tarif_kendaraan`
--
ALTER TABLE `ms_tarif_kendaraan`
  MODIFY `id_tarif_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
