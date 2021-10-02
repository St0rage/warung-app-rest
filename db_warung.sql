-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 19 Sep 2021 pada 13.54
-- Versi server: 10.4.19-MariaDB
-- Versi PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_warung`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'Makanan'),
(2, 'Minuman'),
(3, 'Biskuit'),
(4, 'Snack'),
(5, 'Rokok'),
(6, 'Kosmetik'),
(7, 'Obat-Obatan'),
(8, 'Kebersihan'),
(9, 'Lain-Lain'),
(10, 'Pembalut'),
(11, 'Pampers'),
(12, 'Bumbu'),
(13, 'Roti'),
(14, 'Kesehatan'),
(15, 'Mainan'),
(16, 'Es Krim'),
(17, 'Wafer'),
(18, 'Perkakas'),
(19, 'Deterjen'),
(20, 'Paket Data'),
(21, 'Permen'),
(22, 'Suplemen'),
(23, 'Alat Kebersihan'),
(24, 'Alat Tulis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `product_name`, `price`, `image`, `created_at`) VALUES
(60, 'Teh Botol', 7000, '1631361983054936713921961875880.jpg', '2021-09-11 12:06:54'),
(61, 'Teh Pucuk', 5000, '16313620419779199789247146125472.jpg', '2021-09-12 13:55:11'),
(62, 'Mizone', 7000, '16313620822535682910340900093144.jpg', '2021-09-11 12:08:14'),
(63, 'Aqua 1,5 Liter', 7000, '16313621286502751278524345220173.jpg', '2021-09-11 12:09:00'),
(64, 'Le Minerale 1,5 Liter', 7000, '16313621804062239799578228679430.jpg', '2021-09-11 12:09:52'),
(65, 'Larutan Botol Kecil', 4000, '16313622640076187927468621504643.jpg', '2021-09-11 12:11:20'),
(66, 'Adem Sari Chingku Kaleng', 8000, '16313623301631304653801066990226.jpg', '2021-09-11 12:12:20'),
(67, 'Kratingdaeng', 7000, '16313624192766063241015672327541.jpg', '2021-09-11 12:13:50'),
(68, 'Lampu Yasuka 20w', 15000, '16313624851031015607910811857542.jpg', '2021-09-11 12:14:59'),
(69, 'Lampu Yasuka 10w', 10000, '1631362567823304141972949705072.jpg', '2021-09-11 12:16:16'),
(70, 'You C1000', 12000, '16313626308853037462447939804391.jpg', '2021-09-11 12:17:21'),
(71, 'Roma Kelapa', 12000, '16313627253164616682467995184119.jpg', '2021-09-11 12:19:30'),
(72, 'Crispy Crackers', 12000, '16313628040198269496490975535624.jpg', '2021-09-11 12:20:14'),
(73, 'Okky Jelly BIG', 2000, '16313628733703280248861413653224.jpg', '2021-09-11 12:21:23'),
(74, 'Kopikap', 1500, '16313629246181340555913709576839.jpg', '2021-09-11 12:22:14'),
(75, 'Teh Gelas', 1500, '1631362971035891419838746771995.jpg', '2021-09-11 12:23:00'),
(76, 'Garpit', 22000, '16313630402526976249375456965987.jpg', '2021-09-11 12:24:10'),
(77, 'Magnum Filter', 20000, '16313631952951340838136403885252.jpg', '2021-09-11 12:26:47'),
(78, 'Djarum Super', 21000, '1631363327650406784098780814331.jpg', '2021-09-11 12:28:58'),
(79, 'Djarum Cokelat', 15000, '16313633679838314532553670861092.jpg', '2021-09-12 13:54:48'),
(80, 'Sikat Gigi Formula', 4000, '16319755000078288260799211035860.jpg', '2021-09-18 14:31:46'),
(88, 'Bear Brand', 14000, '16318847863134777791544331651839.jpg', '2021-09-17 13:20:29'),
(95, 'Pocari Sweat Kecil', 7000, '16318874666838755450780930756953.jpg', '2021-09-17 14:04:41'),
(97, 'Cleo 1,5 L', 6000, '16318895943158533664828756349944.jpg', '2021-09-17 14:40:07'),
(101, 'Tolak Angin', 4000, '1630849071342978626082752235391.jpg', '2021-09-18 14:29:32'),
(102, 'Malkist Abon', 8000, '16319754147391203138515202290435.jpg', '2021-09-18 14:30:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `product_categories`
--

INSERT INTO `product_categories` (`id`, `product_id`, `category_id`) VALUES
(63, 60, 2),
(65, 62, 2),
(66, 63, 2),
(67, 64, 2),
(68, 65, 2),
(69, 66, 2),
(70, 67, 2),
(71, 67, 22),
(72, 68, 9),
(73, 68, 18),
(74, 69, 9),
(75, 69, 18),
(76, 70, 2),
(77, 70, 22),
(78, 71, 3),
(79, 71, 1),
(80, 72, 3),
(81, 72, 1),
(82, 73, 2),
(83, 74, 2),
(84, 75, 2),
(85, 76, 5),
(86, 77, 5),
(87, 78, 5),
(90, 79, 5),
(92, 61, 2),
(109, 88, 2),
(117, 95, 2),
(119, 97, 2),
(130, 101, 14),
(131, 101, 7),
(132, 102, 3),
(133, 102, 1),
(134, 80, 23),
(135, 80, 8);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT untuk tabel `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
