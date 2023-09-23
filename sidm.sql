-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jun 2023 pada 02.45
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sidm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_matkul`
--

CREATE TABLE `detail_matkul` (
  `id_nilai` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `jns_nilai` varchar(255) NOT NULL,
  `nm_matkul` varchar(255) DEFAULT NULL,
  `dosen` varchar(40) DEFAULT NULL,
  `nilai` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `detail_matkul`
--

INSERT INTO `detail_matkul` (`id_nilai`, `nim`, `jns_nilai`, `nm_matkul`, `dosen`, `nilai`, `grade`) VALUES
(1, '1718112', 'UTS', 'Jaringan Komputer', 'Yudhi Prabowo, S.ST', '90', 'A'),
(169, '080808', 'UTS', 'Pemrograman Web', 'Novyanti Dewi Wulandhari, M.Kom', '65', 'C'),
(170, '1718123', 'TUGAS', 'Desain Web', 'Misbah Zainil Annam, S.Kom', '50', 'D'),
(171, '1718811', 'UN', 'Basis Data', 'Ganjar Sukma S.Kom', '30', 'E'),
(174, '2103035833', 'SKS', 'Algoritma Pemrograman', 'Ichsan Hanifdeal', '90', 'A'),
(175, '2103035833', 'UAS', 'Algoritma Pemrograman', 'Ichsan Hanifdeal', '90', 'A'),
(179, '12345', 'UAS', 'Pemrograman Web', 'Ichsan Hanifdeal', '20', 'E');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dosen`
--

CREATE TABLE `dosen` (
  `id_dosen` int(100) NOT NULL,
  `nip` varchar(50) NOT NULL,
  `nama_dosen` varchar(40) DEFAULT NULL,
  `jenis_kelamin` varchar(20) DEFAULT NULL,
  `tempat_lahir` varchar(80) DEFAULT NULL,
  `tanggal_lahir` varchar(30) DEFAULT NULL,
  `dosen_matkul` varchar(20) DEFAULT NULL,
  `alamat` varchar(70) DEFAULT NULL,
  `telepon` varchar(13) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `level` varchar(10) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `dosen`
--

INSERT INTO `dosen` (`id_dosen`, `nip`, `nama_dosen`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `dosen_matkul`, `alamat`, `telepon`, `email`, `level`, `username`, `password`) VALUES
(1, '2103035833', 'Ichsan Hanifdeal', 'Laki-Laki', 'Batusangkar', '2002-09-30', 'Praktikum Web Lanjut', 'Pekanbaru', '081270840074', 'ichsanhanifdeal@gmail.com', 'dosen', '2103035833', '103df0b2a8f8d12cd56b9b74e43946e9'),
(2, 'dosen', 'dosen', 'Laki-Laki', 'dosen', '2023-05-25', 'dosen', 'dosen', '0812', 'dosen@gmail.com', 'dosen', 'dosen', 'ce28eed1511f631af6b2a7bb0a85d636');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` int(11) NOT NULL,
  `waktu_upload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `matkul`
--

CREATE TABLE `matkul` (
  `kd_matkul` int(11) NOT NULL,
  `nm_matkul` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `matkul`
--

INSERT INTO `matkul` (`kd_matkul`, `nm_matkul`) VALUES
(1, 'Algoritma dan Pemrograman'),
(2, 'Basis Data'),
(3, 'Mobile Programing'),
(4, 'Pemrograman Visual / GUI'),
(5, 'Pemrograman OOP'),
(6, 'Pemrograman Web'),
(7, 'Jaringan Komputer'),
(8, 'Desain Web'),
(9, 'Java Web'),
(10, 'PBO');

-- --------------------------------------------------------

--
-- Struktur dari tabel `silabus`
--

CREATE TABLE `silabus` (
  `id` int(11) NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `ukuran_file` int(11) NOT NULL,
  `waktu_upload` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `silabus`
--

INSERT INTO `silabus` (`id`, `nama_file`, `ukuran_file`, `waktu_upload`) VALUES
(31, 'CV+Terbaru_compressed.pdf', 417294, '2023-05-27 09:06:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_absen`
--

CREATE TABLE `tbl_absen` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `pertemuan1` tinyint(4) DEFAULT 0,
  `pertemuan2` tinyint(4) DEFAULT 0,
  `pertemuan3` tinyint(4) DEFAULT 0,
  `pertemuan4` tinyint(4) DEFAULT 0,
  `pertemuan5` tinyint(4) DEFAULT 0,
  `pertemuan6` tinyint(4) DEFAULT 0,
  `pertemuan7` tinyint(4) DEFAULT 0,
  `pertemuan8` tinyint(4) DEFAULT 0,
  `pertemuan9` tinyint(4) DEFAULT 0,
  `pertemuan10` tinyint(4) DEFAULT 0,
  `pertemuan11` tinyint(4) DEFAULT 0,
  `pertemuan12` tinyint(4) DEFAULT 0,
  `pertemuan13` tinyint(4) DEFAULT 0,
  `pertemuan14` tinyint(4) DEFAULT 0,
  `pertemuan15` tinyint(4) DEFAULT 0,
  `pertemuan16` tinyint(4) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tbl_absen`
--

INSERT INTO `tbl_absen` (`id`, `nim`, `pertemuan1`, `pertemuan2`, `pertemuan3`, `pertemuan4`, `pertemuan5`, `pertemuan6`, `pertemuan7`, `pertemuan8`, `pertemuan9`, `pertemuan10`, `pertemuan11`, `pertemuan12`, `pertemuan13`, `pertemuan14`, `pertemuan15`, `pertemuan16`, `created_at`, `updated_at`) VALUES
(15, '12345', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-06-22 18:43:30', '2023-06-22 18:43:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_mahasiswa`
--

CREATE TABLE `tbl_mahasiswa` (
  `nim` varchar(20) NOT NULL DEFAULT '',
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `level` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat_asal` varchar(100) NOT NULL,
  `alamat_sekarang` varchar(100) NOT NULL,
  `no_telepon` varchar(13) NOT NULL,
  `email` varchar(30) NOT NULL,
  `agama` varchar(50) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `fakultas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tbl_mahasiswa`
--

INSERT INTO `tbl_mahasiswa` (`nim`, `username`, `password`, `level`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat_asal`, `alamat_sekarang`, `no_telepon`, `email`, `agama`, `jurusan`, `fakultas`) VALUES
('12345', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'user', 'Laki-Laki', 'user', '2002-09-30', 'user', 'user', 'user', 'user@gmail.com', 'Islam', '', 'MI'),
('admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'Laki-Laki', 'admin', '2023-05-02', 'admin', 'admin', 'admin', 'admin@gmail.com', 'Islam', 'Manajemen Informatika', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_matkul`
--
ALTER TABLE `detail_matkul`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indeks untuk tabel `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id_dosen`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `matkul`
--
ALTER TABLE `matkul`
  ADD PRIMARY KEY (`kd_matkul`);

--
-- Indeks untuk tabel `silabus`
--
ALTER TABLE `silabus`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_absen`
--
ALTER TABLE `tbl_absen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nim` (`nim`);

--
-- Indeks untuk tabel `tbl_mahasiswa`
--
ALTER TABLE `tbl_mahasiswa`
  ADD PRIMARY KEY (`nim`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_matkul`
--
ALTER TABLE `detail_matkul`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;

--
-- AUTO_INCREMENT untuk tabel `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id_dosen` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `matkul`
--
ALTER TABLE `matkul`
  MODIFY `kd_matkul` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT untuk tabel `silabus`
--
ALTER TABLE `silabus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `tbl_absen`
--
ALTER TABLE `tbl_absen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tbl_absen`
--
ALTER TABLE `tbl_absen`
  ADD CONSTRAINT `tbl_absen_ibfk_1` FOREIGN KEY (`nim`) REFERENCES `tbl_mahasiswa` (`nim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
