-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Mar 2022 pada 06.22
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_ku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_fasilitas_kamar`
--

CREATE TABLE `tb_fasilitas_kamar` (
  `id` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `fasilitas` varchar(100) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_fasilitas_kamar`
--

INSERT INTO `tb_fasilitas_kamar` (`id`, `id_kamar`, `fasilitas`, `gambar`) VALUES
(1, 1, 'TV LCD 32 Inch', 'image/TVLCD32Inch20220305033325am.jpg'),
(2, 1, 'Air Mineral 2 botol', 'image/AirMineral2botol20220305033336am.jpg'),
(3, 1, 'AC full Politron', 'image/ACfullPolitron20220305033349am.jpg'),
(4, 2, 'TV LCD 32 Inch HD Resolution', 'image/TVLCD32InchHDResolution20220305033059am.jpg'),
(5, 2, 'AC Full Sharp', 'image/ACFullSharp20220305032903am.jpg'),
(6, 1, 'Air Mineral 2 Botol 1', 'image/AirMineral2Botol120220305032839am.jpg'),
(20, 1, 'Piano Mini', 'image/PianoMini20220305032536am.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_fasilitas_umum`
--

CREATE TABLE `tb_fasilitas_umum` (
  `id` int(11) NOT NULL,
  `nama_fasilitas` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_fasilitas_umum`
--

INSERT INTO `tb_fasilitas_umum` (`id`, `nama_fasilitas`, `keterangan`, `gambar`) VALUES
(1, 'Kolam Renang', 'Berada pada samping Lantai 1 dengan luas 6m persegi', 'image/ACfullPolitron20220305033349am.jpg'),
(2, 'Lapangan Badminton', 'Berada pada lantai 5 dengan luas 50m persegi', 'image/ACFullSharp20220305032903am.jpg'),
(3, 'Tempat Santai', 'Berada pada Lantai 12 menghadap Sunrise', 'image/TVLCD32Inch20220305033325am.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kamar`
--

CREATE TABLE `tb_kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `total_kamar` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kamar`
--

INSERT INTO `tb_kamar` (`id_kamar`, `nama_kamar`, `total_kamar`) VALUES
(1, 'Superior', 25),
(2, 'Deluxe', 15),
(3, 'Premium', 2),
(4, 'Economy', 20),
(5, 'Blazzer', 10),
(6, 'Gold', 5),
(7, 'Diskon', 5),
(8, 'Marketing', 12),
(9, 'Luxemburg', 3),
(10, 'Paris', 4),
(11, 'London', 2),
(12, 'Rekon', 12),
(13, 'More', 2),
(14, 'One and only', 2),
(15, 'Obi', 2),
(16, 'Interior', 5),
(17, 'Joombla', 2),
(18, 'Enggel', 3),
(19, 'Publisher', 7),
(20, 'Two Many', 6),
(21, 'Premium One', 4),
(22, 'Golang Better', 16),
(23, 'Coofee team one', 20),
(24, 'Light new', 12),
(25, 'Black Thown', 13),
(26, 'Broen Like', 3),
(27, 'White dog blur', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id` int(11) NOT NULL,
  `nama_pemesan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `hp` varchar(12) NOT NULL,
  `nama_tamu` varchar(50) NOT NULL,
  `tgl_pesan` datetime NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `jml_kamar` int(2) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `id_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id`, `nama_pemesan`, `email`, `hp`, `nama_tamu`, `tgl_pesan`, `checkin`, `checkout`, `jml_kamar`, `status`, `id_kamar`) VALUES
(1, 'Maklon Frare', 'maklon@gmail.com', '085234442455', 'Maklon Frare', '2022-02-05 07:09:59', '2022-02-05', '2022-02-05', 2, '', 1),
(3, 'Ferdy Durhan', 'kallonjuve@gmail.com', '23423', 'Ardy Wela', '2022-02-05 05:10:45', '2022-02-05', '2022-02-08', 2, '1', 1),
(4, 'Remigius Agut', 'kallonjuve@gmail.com', '23423', 'Noldy Saputra', '2022-02-05 05:14:59', '2022-02-07', '2022-02-10', 2, '1', 1),
(5, 'Rivan Manafe', 'admin@smkn1kuwus.sch.id', '085253227734', 'Juliana Mbau', '2022-02-05 05:58:59', '2022-02-05', '2022-02-08', 1, '1', 1),
(6, 'Lonida Ruth Manisa', 'maklonjacob.frare@gmail.com', '085253332244', 'Maklon Frare', '2022-02-06 12:28:41', '2022-02-09', '2022-02-24', 2, '1', 1),
(7, 'Egideus Helmon, S.P', 'egi@gmail.com', '085344225422', 'Hermanus Lando, S.Pd', '2022-02-06 12:31:27', '2022-02-07', '2022-02-10', 1, '', 2),
(8, 'Marsellina Patii', 'Marsel@gmail.com', '085664322455', 'John Umbu Pati', '2022-02-06 12:36:39', '2022-02-07', '2022-02-10', 2, '0', 2),
(9, 'Ipank', 'ipank@gmail.com', '678658755', 'Artho', '2022-02-07 07:04:41', '2022-02-12', '2022-02-15', 1, '0', 2),
(10, 'Maklon', 'maklonjacob.frare@gmail.com', '085253332245', 'Misel Jebabun', '2022-02-09 10:06:00', '2022-02-14', '2022-02-17', 1, '', 2),
(11, 'Zilan', 'nk8egc@erapor-smk.net', '085253332244', 'Richard', '2022-02-09 10:07:16', '2022-02-15', '2022-02-17', 1, '1', 1),
(12, 'Mizel', 'maklon@gmail.com', '085253332244', 'Maklom', '2022-02-09 12:57:04', '2022-02-10', '2022-02-12', 1, '', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `tipe` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `tipe`) VALUES
(1, 'admin', '123', 'admin'),
(2, 'resepsionis', '321', 'resepsionis');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_fasilitas_kamar`
--
ALTER TABLE `tb_fasilitas_kamar`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_fasilitas_umum`
--
ALTER TABLE `tb_fasilitas_umum`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kamar`
--
ALTER TABLE `tb_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_fasilitas_kamar`
--
ALTER TABLE `tb_fasilitas_kamar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_fasilitas_umum`
--
ALTER TABLE `tb_fasilitas_umum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_kamar`
--
ALTER TABLE `tb_kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
