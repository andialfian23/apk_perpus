-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jun 2023 pada 15.34
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_apk_perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(10) UNSIGNED NOT NULL,
  `no_id` varchar(4) NOT NULL,
  `nama_anggota` varchar(255) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `no_id`, `nama_anggota`, `jenis_kelamin`, `ket`) VALUES
(1, '0001', 'ANDI ALFIAN, S.Kom', 'L', '18 IF-A'),
(3, '0003', 'MUHAMAD HIKAYAT', 'L', '18 IF-A'),
(4, '0004', 'RIZKI ALAM RAMDHANI', 'L', '18 IF-A'),
(5, '0002', 'HARIS SAKURUDIN', 'L', '18 IF-A'),
(6, '0005', 'SALAHUDDIN NURUL FAHMI', 'L', '18 IF-A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(10) UNSIGNED NOT NULL,
  `kode_buku` varchar(10) NOT NULL,
  `id_judul` int(10) UNSIGNED NOT NULL,
  `is_ada` enum('y','n') NOT NULL DEFAULT 'y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `id_judul`, `is_ada`) VALUES
(1, 'BK001', 1, 'n'),
(2, '001', 2, 'n'),
(3, '002', 2, 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `denda`
--

CREATE TABLE `denda` (
  `id_pinjam` int(10) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `is_dibayar` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `denda`
--

INSERT INTO `denda` (`id_pinjam`, `jumlah`, `tanggal_pembayaran`, `is_dibayar`) VALUES
(2, 15000, '2023-06-01', 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `judul`
--

CREATE TABLE `judul` (
  `id_judul` int(10) UNSIGNED NOT NULL,
  `isbn` varchar(15) NOT NULL DEFAULT '0',
  `judul_buku` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `cover` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `judul`
--

INSERT INTO `judul` (`id_judul`, `isbn`, `judul_buku`, `penulis`, `penerbit`, `cover`) VALUES
(1, '9786029847192', 'Hidup di Empat Alam', 'Muslim Nurdin', 'Basmallah', '20230601202001.png'),
(2, '9786020305455', 'Bulan Terbelah di Langit Amerika', 'Hanum dan Rangga', 'PT. Gramedia Pustaka Utama', '20230601201541.png'),
(3, '9876020653204', 'KOSMOLOGI', 'Sten Odenwald', 'PT. Gramedia Pustaka Utama', '20230601202507.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_pinjam` int(10) UNSIGNED NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `id_anggota` int(10) UNSIGNED NOT NULL,
  `id_buku` int(10) UNSIGNED NOT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `is_kembali` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id_pinjam`, `tanggal_pinjam`, `id_anggota`, `id_buku`, `tanggal_kembali`, `is_kembali`) VALUES
(2, '2023-05-10', 5, 1, '2023-06-01', 'y'),
(4, '2023-05-31', 3, 2, '2023-05-31', 'y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('operator','admin') DEFAULT NULL,
  `is_blokir` enum('y','n') NOT NULL DEFAULT 'n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `level`, `is_blokir`) VALUES
(1, 'ADMIN PERPUS', '18.14.1.0001', '3d7e1a63c795d418e265f5c61f0acbd4', 'admin', 'n'),
(2, 'OPERATOR 1', '18.14.1.0014', '9cb966a6dafb348bd0c210db9b147b13', 'operator', 'n'),
(3, 'OPERATOR 2', '18.14.1.0027', 'd8a03e8cd4b9aebc4666ae61d5ba8df6', 'operator', 'n');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `uq_nisn` (`no_id`),
  ADD KEY `fk_siswa_kelas` (`ket`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `uq_kode_buku` (`kode_buku`),
  ADD KEY `fk_buku_judul` (`id_judul`);

--
-- Indeks untuk tabel `denda`
--
ALTER TABLE `denda`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- Indeks untuk tabel `judul`
--
ALTER TABLE `judul`
  ADD PRIMARY KEY (`id_judul`),
  ADD UNIQUE KEY `uq_isbn` (`isbn`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_pinjam`),
  ADD KEY `fk_peminjaman_siswa` (`id_anggota`),
  ADD KEY `fk_peminjaman_buku` (`id_buku`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `uq_username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `judul`
--
ALTER TABLE `judul`
  MODIFY `id_judul` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_pinjam` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
