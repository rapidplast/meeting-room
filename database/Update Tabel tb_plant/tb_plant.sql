-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Nov 2023 pada 05.04
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `room2`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_plant`
--

CREATE TABLE `tb_plant` (
  `id_plant` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_plant`
--

INSERT INTO `tb_plant` (`id_plant`, `name`) VALUES
(1, 'Plant 1'),
(2, 'Plant 2'),
(3, 'Plant 3'),
(4, 'Plant 4'),
(5, 'Plant 5'),
(6, 'Plant 6');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_plant`
--
ALTER TABLE `tb_plant`
  ADD PRIMARY KEY (`id_plant`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_plant`
--
ALTER TABLE `tb_plant`
  MODIFY `id_plant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
