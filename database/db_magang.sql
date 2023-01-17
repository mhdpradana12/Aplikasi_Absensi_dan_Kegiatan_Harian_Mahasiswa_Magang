-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jan 2023 pada 14.31
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_magang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_absensi`
--

CREATE TABLE `tbl_absensi` (
  `id_absensi` int(15) NOT NULL,
  `id_mahasiswa` int(15) DEFAULT NULL,
  `status` int(15) DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_absensi`
--

INSERT INTO `tbl_absensi` (`id_absensi`, `id_mahasiswa`, `status`, `waktu`, `tanggal`) VALUES
(1, 1, 1, '08:01:00', '2022-12-05'),
(2, 1, 1, '08:02:00', '2022-12-06'),
(3, 1, 1, '08:03:00', '2022-12-07'),
(4, 1, 1, '08:04:00', '2022-12-08'),
(5, 1, 1, '08:05:00', '2022-12-09'),
(6, 1, 1, '08:06:00', '2022-12-12'),
(7, 1, 1, '08:04:00', '2022-12-13'),
(8, 1, 1, '08:05:00', '2022-12-14'),
(9, 1, 1, '08:06:00', '2022-12-15'),
(10, 1, 1, '08:05:00', '2022-12-16'),
(11, 1, 1, '08:04:00', '2022-12-19'),
(12, 1, 1, '08:01:00', '2022-12-20'),
(13, 1, 1, '08:02:00', '2022-12-21'),
(14, 1, 1, '08:05:00', '2022-12-22'),
(15, 1, 1, '08:08:00', '2022-12-23'),
(16, 1, 1, '08:11:00', '2022-12-26'),
(17, 1, 1, '08:12:00', '2022-12-27'),
(18, 1, 1, '08:15:00', '2022-12-28'),
(19, 1, 1, '08:12:00', '2022-12-29'),
(20, 1, 1, '08:10:00', '2022-12-30'),
(21, 2, 1, '08:01:00', '2022-12-05'),
(22, 2, 1, '08:02:00', '2022-12-06'),
(23, 2, 1, '08:03:00', '2022-12-07'),
(24, 2, 1, '08:04:00', '2022-12-08'),
(25, 2, 1, '08:05:00', '2022-12-09'),
(26, 2, 1, '08:06:00', '2022-12-12'),
(27, 2, 1, '08:04:00', '2022-12-13'),
(28, 2, 1, '08:05:00', '2022-12-14'),
(29, 2, 1, '08:06:00', '2022-12-15'),
(30, 2, 1, '08:05:00', '2022-12-16'),
(31, 2, 1, '08:04:00', '2022-12-19'),
(32, 2, 1, '08:01:00', '2022-12-20'),
(33, 2, 1, '08:02:00', '2022-12-21'),
(34, 2, 1, '08:05:00', '2022-12-22'),
(35, 2, 1, '08:08:00', '2022-12-23'),
(36, 2, 1, '08:11:00', '2022-12-26'),
(37, 2, 1, '08:12:00', '2022-12-27'),
(38, 2, 1, '08:15:00', '2022-12-28'),
(39, 2, 1, '08:12:00', '2022-12-29'),
(40, 2, 1, '08:10:00', '2022-12-30'),
(41, 3, 1, '08:01:00', '2022-12-05'),
(42, 3, 1, '08:02:00', '2022-12-06'),
(43, 3, 1, '08:03:00', '2022-12-07'),
(44, 3, 1, '08:04:00', '2022-12-08'),
(45, 3, 1, '08:05:00', '2022-12-09'),
(46, 3, 1, '08:06:00', '2022-12-12'),
(47, 3, 1, '08:04:00', '2022-12-13'),
(48, 3, 1, '08:05:00', '2022-12-14'),
(49, 3, 1, '08:06:00', '2022-12-15'),
(50, 3, 1, '08:05:00', '2022-12-16'),
(51, 3, 1, '08:04:00', '2022-12-19'),
(52, 3, 1, '08:01:00', '2022-12-20'),
(53, 3, 1, '08:02:00', '2022-12-21'),
(54, 3, 1, '08:05:00', '2022-12-22'),
(55, 3, 1, '08:08:00', '2022-12-23'),
(56, 3, 1, '08:11:00', '2022-12-26'),
(57, 3, 1, '08:12:00', '2022-12-27'),
(58, 3, 1, '08:15:00', '2022-12-28'),
(59, 3, 1, '08:12:00', '2022-12-29'),
(60, 3, 1, '08:10:00', '2022-12-30'),
(61, 1, 1, '08:01:00', '2023-01-02'),
(62, 1, 1, '08:02:00', '2023-01-03'),
(63, 1, 1, '08:03:00', '2023-01-04'),
(64, 1, 1, '08:04:00', '2023-01-05'),
(65, 1, 1, '08:05:00', '2023-01-06'),
(66, 1, 2, '08:04:00', '2023-01-09'),
(67, 1, 1, '08:05:00', '2023-01-10'),
(68, 2, 1, '08:01:00', '2023-01-02'),
(69, 2, 1, '08:02:00', '2023-01-03'),
(70, 2, 1, '08:03:00', '2023-01-04'),
(71, 2, 1, '08:04:00', '2023-01-05'),
(72, 2, 1, '08:05:00', '2023-01-06'),
(73, 2, 2, '08:04:00', '2023-01-09'),
(74, 2, 1, '08:05:00', '2023-01-10'),
(75, 1, 1, '16:04:47', '2023-01-11'),
(76, 2, 1, '16:04:47', '2023-01-11'),
(77, 1, 1, '08:05:00', '2023-01-12'),
(78, 2, 1, '16:04:47', '2023-01-12'),
(79, 1, 2, '08:05:00', '2023-01-13'),
(80, 2, 2, '16:04:47', '2023-01-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(15) NOT NULL,
  `kode_admin` varchar(4) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `nip` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `kode_admin`, `nama`, `nip`, `email`) VALUES
(1, 'A001', 'Muhammad Pradana', '2022122501', 'mhdpradana12@gmail.com'),
(2, 'A002', 'Muhammad Amin Fadlurrachman Zuhdi', '2022122502', 'amin_fz07@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_alasan`
--

CREATE TABLE `tbl_alasan` (
  `id_alasan` int(15) NOT NULL,
  `id_mahasiswa` int(15) DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_alasan`
--

INSERT INTO `tbl_alasan` (`id_alasan`, `id_mahasiswa`, `alasan`, `tanggal`) VALUES
(1, 1, 'Izin Kampus', '2023-01-09'),
(2, 2, 'Sakit Perut', '2023-01-09'),
(3, 1, 'Izin Kampus', '2023-01-13'),
(4, 2, 'Izin Kampus', '2023-01-13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_kegiatan`
--

CREATE TABLE `tbl_kegiatan` (
  `id_kegiatan` int(15) NOT NULL,
  `id_mahasiswa` int(15) DEFAULT NULL,
  `kegiatan` varchar(255) DEFAULT NULL,
  `waktu_awal` time DEFAULT NULL,
  `waktu_akhir` time DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_kegiatan`
--

INSERT INTO `tbl_kegiatan` (`id_kegiatan`, `id_mahasiswa`, `kegiatan`, `waktu_awal`, `waktu_akhir`, `tanggal`) VALUES
(1, 1, 'Melakukan Verifikasi Pajak', '08:00:09', '12:00:21', '2022-12-05'),
(2, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-05'),
(3, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-06'),
(4, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-06'),
(5, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-07'),
(6, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-07'),
(7, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-08'),
(8, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-08'),
(9, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-09'),
(10, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-09'),
(11, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-12'),
(12, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-12'),
(13, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-13'),
(14, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-13'),
(15, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-14'),
(16, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-14'),
(17, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-15'),
(18, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-15'),
(19, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-16'),
(20, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-16'),
(21, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-19'),
(22, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-19'),
(23, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-20'),
(24, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-20'),
(25, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-21'),
(26, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-21'),
(27, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-22'),
(28, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-22'),
(29, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-23'),
(30, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-23'),
(31, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-26'),
(32, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-26'),
(33, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-27'),
(34, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-27'),
(35, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-28'),
(36, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-28'),
(37, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-29'),
(38, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-29'),
(39, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-30'),
(40, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-30'),
(41, 2, 'Melakukan Verifikasi Pajak', '08:00:09', '12:00:21', '2022-12-05'),
(42, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-05'),
(43, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-06'),
(44, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-06'),
(45, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-07'),
(46, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-07'),
(47, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-08'),
(48, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-08'),
(49, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-09'),
(50, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-09'),
(51, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-12'),
(52, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-12'),
(53, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-13'),
(54, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-13'),
(55, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-14'),
(56, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-14'),
(57, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-15'),
(58, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-15'),
(59, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-16'),
(60, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-16'),
(61, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-19'),
(62, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-19'),
(63, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-20'),
(64, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-20'),
(65, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-21'),
(66, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-21'),
(67, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-22'),
(68, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-22'),
(69, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-23'),
(70, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-23'),
(71, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-26'),
(72, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-26'),
(73, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-27'),
(74, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-27'),
(75, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-28'),
(76, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-28'),
(77, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-29'),
(78, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-29'),
(79, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-30'),
(80, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-30'),
(81, 3, 'Melakukan Verifikasi Pajak', '08:00:09', '12:00:21', '2022-12-05'),
(82, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-05'),
(83, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-06'),
(84, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-06'),
(85, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-07'),
(86, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-07'),
(87, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-08'),
(88, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-08'),
(89, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-09'),
(90, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-09'),
(91, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-12'),
(92, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-12'),
(93, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-13'),
(94, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-13'),
(95, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-14'),
(96, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-14'),
(97, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-15'),
(98, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-15'),
(99, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-16'),
(100, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-16'),
(101, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-19'),
(102, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-19'),
(103, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-20'),
(104, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-20'),
(105, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-21'),
(106, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-21'),
(107, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-22'),
(108, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-22'),
(109, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-23'),
(110, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-23'),
(111, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-26'),
(112, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-26'),
(113, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-27'),
(114, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-27'),
(115, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-28'),
(116, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-28'),
(117, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-29'),
(118, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-29'),
(119, 3, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2022-12-30'),
(120, 3, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2022-12-30'),
(121, 1, 'Melakukan Verifikasi Pajak', '08:00:09', '12:00:21', '2023-01-02'),
(122, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-02'),
(123, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-03'),
(124, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-03'),
(125, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-04'),
(126, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-04'),
(127, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-05'),
(128, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-05'),
(129, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-06'),
(130, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-06'),
(131, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-09'),
(132, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-09'),
(133, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-10'),
(134, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-10'),
(135, 2, 'Melakukan Verifikasi Pajak', '08:00:09', '12:00:21', '2023-01-02'),
(136, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-02'),
(137, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-03'),
(138, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-03'),
(139, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-04'),
(140, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-04'),
(141, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-05'),
(142, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-05'),
(143, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-06'),
(144, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-06'),
(145, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-09'),
(146, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-09'),
(147, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-10'),
(148, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-10'),
(149, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-11'),
(150, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-11'),
(151, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-11'),
(152, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-11'),
(153, 1, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-12'),
(154, 1, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-12'),
(155, 2, 'Melakukan Verifikasi Pajak', '08:09:09', '14:13:21', '2023-01-12'),
(156, 2, 'Melakukan Verifikasi Pajak', '14:13:10', '14:13:22', '2023-01-12');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `id_mahasiswa` int(15) NOT NULL,
  `kode_mahasiswa` varchar(4) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `universitas` varchar(255) DEFAULT NULL,
  `jurusan` varchar(255) DEFAULT NULL,
  `nim` varchar(255) DEFAULT NULL,
  `mulai_magang` date DEFAULT NULL,
  `akhir_magang` date DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`id_mahasiswa`, `kode_mahasiswa`, `nama`, `universitas`, `jurusan`, `nim`, `mulai_magang`, `akhir_magang`, `alamat`, `no_telp`, `foto`) VALUES
(1, 'M001', 'Muhammad Pradana', 'Politeknik Negeri Sriwijaya', 'Teknik Komputer', '062030701635', '2022-12-05', '2023-01-30', 'Jl. Sutan Syahrir No. 1023', '089662380814', 'pradana.png'),
(2, 'M002', 'Gustav Ferdian', 'Politeknik Negeri Sriwijaya', 'Teknik Komputer', '062030701634', '2022-12-05', '2023-01-30', 'Jl. Merak Lr. Jambu 10', '08957342010', 'foto_default.png'),
(3, 'M003', 'Muhammad Amin Fadlurrachman Zuhdi', 'Politeknik Negeri Sriwijaya', 'Teknik Komputer', '062030701634', '2022-12-05', '2022-12-30', 'JL. Sekip Raya No.23', '08957342020', 'foto_default.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_setting_absensi`
--

CREATE TABLE `tbl_setting_absensi` (
  `id_waktu` int(15) DEFAULT NULL,
  `mulai_absen` time DEFAULT NULL,
  `akhir_absen` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_setting_absensi`
--

INSERT INTO `tbl_setting_absensi` (`id_waktu`, `mulai_absen`, `akhir_absen`) VALUES
(1, '08:00:00', '09:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_site`
--

CREATE TABLE `tbl_site` (
  `id_site` int(15) DEFAULT NULL,
  `nama_instansi` varchar(255) DEFAULT NULL,
  `pimpinan` varchar(255) DEFAULT NULL,
  `pembimbing` varchar(255) DEFAULT NULL,
  `no_telp` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_site`
--

INSERT INTO `tbl_site` (`id_site`, `nama_instansi`, `pimpinan`, `pembimbing`, `no_telp`, `alamat`, `website`, `logo`) VALUES
(1, 'Badan Pengolahan Pajak Daerah', 'Hery Kurniawan, S.E. M.Si.', 'Tamara, S.IP., M.Si.', '(0711) 352-282', 'Jalan Merdeka No. 21 Kota Palembang, Sumatera Selatan 30136', 'bppd.palembang.go.id', 'logo.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(15) NOT NULL,
  `kode_pengguna` varchar(4) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `kode_pengguna`, `username`, `password`, `level`) VALUES
(1, 'A001', 'pradana', 'e10adc3949ba59abbe56e057f20f883e', 'Admin'),
(2, 'A002', 'amin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin'),
(3, 'M001', '062030701635', 'e10adc3949ba59abbe56e057f20f883e', 'Mahasiswa'),
(4, 'M002', '062030701636', 'e10adc3949ba59abbe56e057f20f883e', 'Mahasiswa'),
(5, 'M003', '062030701634', 'e10adc3949ba59abbe56e057f20f883e', 'Mahasiswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD PRIMARY KEY (`id_absensi`),
  ADD KEY `tbl_absensi_ibfk1_1` (`id_mahasiswa`);

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `kode_admin` (`kode_admin`);

--
-- Indeks untuk tabel `tbl_alasan`
--
ALTER TABLE `tbl_alasan`
  ADD PRIMARY KEY (`id_alasan`),
  ADD KEY `tbl_alasan_ibfk1_1` (`id_mahasiswa`);

--
-- Indeks untuk tabel `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  ADD PRIMARY KEY (`id_kegiatan`),
  ADD KEY `tbl_kegiatan_ibfk1_1` (`id_mahasiswa`);

--
-- Indeks untuk tabel `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`),
  ADD KEY `kode_mahasiswa` (`kode_mahasiswa`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `kode_pengguna` (`kode_pengguna`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  MODIFY `id_absensi` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_alasan`
--
ALTER TABLE `tbl_alasan`
  MODIFY `id_alasan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  MODIFY `id_kegiatan` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT untuk tabel `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  MODIFY `id_mahasiswa` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_absensi`
--
ALTER TABLE `tbl_absensi`
  ADD CONSTRAINT `tbl_absensi_ibfk1_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`kode_admin`) REFERENCES `tbl_user` (`kode_pengguna`);

--
-- Ketidakleluasaan untuk tabel `tbl_alasan`
--
ALTER TABLE `tbl_alasan`
  ADD CONSTRAINT `tbl_alasan_ibfk1_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_kegiatan`
--
ALTER TABLE `tbl_kegiatan`
  ADD CONSTRAINT `tbl_kegiatan_ibfk1_1` FOREIGN KEY (`id_mahasiswa`) REFERENCES `tbl_mahasiswa` (`id_mahasiswa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD CONSTRAINT `tbl_mahasiswa_ibfk_1` FOREIGN KEY (`kode_mahasiswa`) REFERENCES `tbl_user` (`kode_pengguna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
