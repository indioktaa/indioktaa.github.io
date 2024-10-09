-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Okt 2024 pada 15.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `writing_challenge`
--
CREATE DATABASE IF NOT EXISTS `writing_challenge` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `writing_challenge`;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tantangan`
--

CREATE TABLE `tantangan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tulisan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tantangan`
--

INSERT INTO `tantangan` (`id`, `tanggal`, `email`, `nama`, `tulisan`) VALUES
(1, '2024-10-09', 'oktaria@gmail.com', 'okta', 'AKHIRNYAAAA BISAAAA'),
(6, '2024-10-03', 'oktaria@gmail.com', 'okta', 'momomo');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tantangan`
--
ALTER TABLE `tantangan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tantangan`
--
ALTER TABLE `tantangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
