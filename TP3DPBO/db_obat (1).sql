-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Bulan Mei 2024 pada 14.22
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_obat`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(100) NOT NULL,
  `obat_foto` varchar(255) DEFAULT NULL,
  `bentuk_obat` varchar(50) DEFAULT NULL,
  `expired_obat` date DEFAULT NULL,
  `id_peringatan` int(11) DEFAULT NULL,
  `id_produksi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `obat_foto`, `bentuk_obat`, `expired_obat`, `id_peringatan`, `id_produksi`) VALUES
(1, 'Rohto', 'rohto.jpg', 'Cair', '2025-05-01', 1, 1),
(2, 'Amoxicillin', 'amoxicillin.jpg', 'Tablet', '2025-06-01', 2, 2),
(3, 'Promag', 'promag.jpeg', 'Sirup', '2025-07-01', 3, 3),
(4, 'OBH Combi', 'combi.jpg', 'sirup', '2025-05-10', 1, 2),
(12, 'Minyak Telon', 'minyaktelon.jpg', 'Cair', '2024-05-04', 3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `peringatan`
--

CREATE TABLE `peringatan` (
  `id_peringatan` int(11) NOT NULL,
  `nama_peringatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `peringatan`
--

INSERT INTO `peringatan` (`id_peringatan`, `nama_peringatan`) VALUES
(1, 'Obat Bebas'),
(2, 'Obat Keras'),
(3, 'Jamu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `id_produksi` int(11) NOT NULL,
  `nama_produksi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`id_produksi`, `nama_produksi`) VALUES
(1, 'PT Rohto Labolatories Indonesia'),
(2, 'PT Indo Farma'),
(3, 'PT Kalbe Farma Tbk');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`),
  ADD KEY `id_peringatan` (`id_peringatan`),
  ADD KEY `id_produksi` (`id_produksi`);

--
-- Indeks untuk tabel `peringatan`
--
ALTER TABLE `peringatan`
  ADD PRIMARY KEY (`id_peringatan`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`id_produksi`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `peringatan`
--
ALTER TABLE `peringatan`
  MODIFY `id_peringatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `id_produksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `obat`
--
ALTER TABLE `obat`
  ADD CONSTRAINT `obat_ibfk_1` FOREIGN KEY (`id_peringatan`) REFERENCES `peringatan` (`id_peringatan`),
  ADD CONSTRAINT `obat_ibfk_2` FOREIGN KEY (`id_produksi`) REFERENCES `produksi` (`id_produksi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
