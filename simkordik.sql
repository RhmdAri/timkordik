-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2024 at 09:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simkordik`
--

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nama` varchar(250) NOT NULL,
  `jekel` varchar(250) NOT NULL,
  `tlahir` varchar(250) NOT NULL,
  `tgllahir` varchar(250) NOT NULL,
  `agama` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  `negara` varchar(250) NOT NULL,
  `alamat` varchar(250) NOT NULL,
  `telp` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `darah` varchar(250) NOT NULL,
  `institusi` varchar(250) NOT NULL,
  `jenjang` varchar(250) NOT NULL,
  `jurusan` varchar(250) NOT NULL,
  `semester` varchar(250) NOT NULL,
  `nim` varchar(250) NOT NULL,
  `orientasi` varchar(250) NOT NULL,
  `awal` varchar(250) NOT NULL,
  `akhir` varchar(250) NOT NULL,
  `hubungan` varchar(250) NOT NULL,
  `namaWali` varchar(250) NOT NULL,
  `jekelWali` varchar(250) NOT NULL,
  `umur` varchar(250) NOT NULL,
  `alamatWali` varchar(250) NOT NULL,
  `pendidikan` varchar(250) NOT NULL,
  `pekerjaan` varchar(250) NOT NULL,
  `telpWali` varchar(250) NOT NULL,
  `foto` varchar(250) NOT NULL,
  `tertib` varchar(250) NOT NULL,
  `persetujuan` varchar(250) NOT NULL,
  `surhat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`id`, `user_id`, `tanggal`, `nama`, `jekel`, `tlahir`, `tgllahir`, `agama`, `status`, `negara`, `alamat`, `telp`, `email`, `darah`, `institusi`, `jenjang`, `jurusan`, `semester`, `nim`, `orientasi`, `awal`, `akhir`, `hubungan`, `namaWali`, `jekelWali`, `umur`, `alamatWali`, `pendidikan`, `pekerjaan`, `telpWali`, `foto`, `tertib`, `persetujuan`, `surhat`) VALUES
(1, 17, '2024-11-23 02:21:37', 'Percobaaan', 'Laki-laki', 'asd', '11/01/2024', 'asd', 'Belum Menikah', 'WNI', 'asd', '123', 'asd@', 'a', 'asd', 'S1', 'asd', '5', '2101', '11/01/2024', '11/12/2024', '11/28/2024', 'asd', 'asd', 'Laki-laki', '14', 'asd', 'asd', 'asd', '123', 'WhatsApp Image 2024-10-29 at 08.11.52.jpeg', 'Formulir-F2-04.pdf', 'Formulir-F2-03.pdf', 'dafduk_f_1_02.pdf'),
(2, 16, '2024-11-28 10:18:45', 'Hamdani', 'Laki-laki', 'asd', '11/20/2024', 'asd', 'Belum Menikah', 'WNI', 'qw', '123', 'asd@', 'a', 'Cobaba', 'SMK', 'asd', '5', '2101', '11/27/2024', '11/29/2024', '11/30/2024', 'asd', 'asd', 'Laki-laki', '21', 'as', 'asd', 'asd', '123', 'WhatsApp Image 2024-11-28 at 11.22.18.jpeg', 'Formulir-F2-04.pdf', 'Formulir-F2-03.pdf', 'Formulir-F2-01_blk_lahir.pdf'),
(3, 17, '2024-12-02 06:37:13', 'Final', 'Laki-laki', 'final', '12/01/2024', 'final', 'Belum Menikah', 'WNI', 'final', '098', 'final', 'final', 'final', 'S1', 'final', 'final', '0087', '12/01/2024', '12/12/2024', '12/12/2024', 'final', 'final', 'Laki-laki', '41', 'final', 'final', 'final', '098', 'WhatsApp Image 2024-11-28 at 18.56.01.jpeg', 'Surat Keterangan Sehat - Rahmad Ari Wijaya.pdf', '3802_KLAIM BY PENDIDIKAN_PKL_IT_UNISKA.pdf', 'SURAT AHLI WARIS.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `parkir`
--

CREATE TABLE `parkir` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `institusi` varchar(250) NOT NULL,
  `awal` varchar(250) NOT NULL,
  `akhir` varchar(250) NOT NULL,
  `jenis` varchar(250) NOT NULL,
  `nomor` varchar(250) NOT NULL,
  `stnk` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parkir`
--

INSERT INTO `parkir` (`id`, `nama`, `institusi`, `awal`, `akhir`, `jenis`, `nomor`, `stnk`) VALUES
(2, 'FINAL', 'Final', '12/01/2024', '12/01/2024', 'Mobil', 'DA123FNL', 'WhatsApp Image 2024-02-15 at 21.38.39.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `pelaksanaan`
--

CREATE TABLE `pelaksanaan` (
  `id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `institusi` varchar(250) NOT NULL,
  `jurusan` varchar(250) NOT NULL,
  `awal` varchar(250) NOT NULL,
  `akhir` varchar(250) NOT NULL,
  `jumlah` varchar(250) NOT NULL,
  `status` varchar(50) DEFAULT 'Belum Selesai'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelaksanaan`
--

INSERT INTO `pelaksanaan` (`id`, `pengajuan_id`, `institusi`, `jurusan`, `awal`, `akhir`, `jumlah`, `status`) VALUES
(3, 3, 'Universitas Lambung Mangkurat', 'Kedokteran Ilmu Penyakit Saraf', '11/20/2024', '11/28/2024', '5', '1'),
(4, 4, 'Universitas Lambung Mangkurat', 'Kedokteran Ilmu Penyakit Saraf', '11/13/2024', '11/28/2024', '5', '1'),
(5, 5, 'Universitas Islam Indonesia', 'Kedokteran Ilmu Penyakit Saraf', '12/01/2024', '12/18/2024', '5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pembimbing`
--

CREATE TABLE `pembimbing` (
  `id` int(11) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `pembimbing` varchar(255) NOT NULL,
  `kuota` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembimbing`
--

INSERT INTO `pembimbing` (`id`, `jurusan`, `pembimbing`, `kuota`) VALUES
(1, 'Kedokteran Ilmu Penyakit Saraf', 'dr. H. Among Wibowo, M.Kes, Sp.S', '5'),
(2, 'Kedokteran Ilmu Penyakit Saraf', 'dr. Muhammad Ichsan Safwannoor, Sp.S', '5'),
(3, 'Kedokteran Ilmu Penyakit Saraf', 'dr. Hj. Lily Runtuwene, Sp.S', '5'),
(4, 'Kedokteran Ilmu Penyakit Dalam', 'dr. H. Abimanyu, Sp.PD-KGEH FINASM', '5'),
(5, 'Kedokteran Ilmu Penyakit Dalam', 'dr. Bayu Eka Nugraha, Sp.PD', '5'),
(6, 'Kedokteran Ilmu Penyakit Dalam', 'dr. Dimas Hudy Ariadie, Sp.PD\r\n', '5'),
(7, 'Kedokteran Ilmu Penyakit Dalam', 'dr. Lingga Suryakusumah, Sp.PD\r\n', '5'),
(8, 'Kedokteran Ilmu Penyakit Dalam', 'dr. Nanik Tri Wulandari, Sp.PD', '5'),
(9, 'Kedokteran Ilmu Penyakit Dalam', 'dr. Rizqi Rifani, Sp.PD', '5'),
(10, 'DIII Keperawatan Stase Anak', 'Hendra, A.Md.Kep', '7'),
(11, 'DIV Keperawatan Stase Anak', 'Tika Rahyanti, S.Tr.Kep', '7'),
(12, 'Profesi Ners Stase Anak', 'Anita Febriani, S.Kep., Ns', '7'),
(13, 'Profesi Ners Stase Anak', 'Devy Sekar Tanjung, S.Tr.Kep., Ns', '7'),
(14, 'Profesi Ners Stase Medikal Bedah', 'Joni Rifani S.Tr.Kep.,Ns', '7'),
(15, 'Profesi Ners Stase Medikal Bedah', 'Noor Fahmi Ansyari, S.Kep.,Ns', '7'),
(16, 'Profesi Ners Stase Medikal Bedah', 'Muhammad Rizky Ramdani, S.Tr.Kep., Ns\r\n', '7'),
(17, 'Profesi Ners Stase Medikal Bedah', 'Ahmad Safariansyah, S.Kep., Ns', '7'),
(18, 'Profesi Ners Stase Medikal Bedah', 'Yani Octaviyani, S.Kep., Ns', '7'),
(19, 'Profesi Ners Stase Syariah', 'Akhmad Ridhani, S.Kep., Ns', '7'),
(20, 'Profesi Ners Stase Syariah', 'Anugrah Forcy Syabana, S.Kep.,Ns', '7'),
(21, 'Profesi Ners Stase Syariah', 'Ns. Prima Mahartanto, S.Kep', '7'),
(22, 'Profesi Ners Stase Syariah', 'Husnul Khatimah, S.Kep.,Ns\r\n', '7'),
(23, 'Profesi Ners Stase Syariah', 'Markus, S.Kep., Ns', '7'),
(24, 'Profesi Ners Stase Syariah', 'Indah Rahmawati, S.Kep., Ns', '7'),
(25, 'Profesi Ners Stase Maternitas', 'Winda Widiyati, S.Kep., Ns', '7'),
(26, 'DIII Analis Kesehatan', 'Dewi Fitria, A.Md.Ak', '7'),
(27, 'DIII Kebidanan', 'Nadya lhsana, Amd. Keb', '7'),
(28, 'DIII Kebidanan', 'Soraya, A.Md.Keb', '7'),
(29, 'DIII Kebidanan', 'Yunita Hariyanti, Amd. Keb', '7'),
(30, 'DIV Bidan Pendidik', 'Nur Wahyuni Iramadhaniah, S.Si.T', '7'),
(31, 'DIII Teknik Radiodiagnostik dan Radioterapi', 'Mohammad Fadhil, Amd.Rad', '7'),
(32, 'DIII Farmasi', 'Apt. Alfira Aryanti, S.Farm', '5'),
(33, 'S-1 Farmasi', 'Apt. Alfira Aryanti, S.Farm', '5'),
(34, 'Profesi Apoteker', 'Apt. Alfira Aryanti, S.Farm', '5'),
(35, 'Profesi Apoteker', 'Apt. Nurhikmah, S.Farm', '5'),
(36, 'Profesi Apoteker', 'Apt. Hendrawan Dwi Santoso, S.Farm', '5');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `no` varchar(100) NOT NULL,
  `dari` varchar(200) NOT NULL,
  `perihal` varchar(200) NOT NULL,
  `kegiatan` varchar(200) NOT NULL,
  `pembimbing_id` int(11) NOT NULL,
  `jurusan` varchar(200) NOT NULL,
  `idPks` int(11) NOT NULL,
  `awal` varchar(250) NOT NULL,
  `akhir` varchar(250) NOT NULL,
  `jumlah` varchar(200) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `no`, `dari`, `perihal`, `kegiatan`, `pembimbing_id`, `jurusan`, `idPks`, `awal`, `akhir`, `jumlah`, `user_id`) VALUES
(3, 'A', 'A', 'A', 'A', 1, '', 1, '11/20/2024', '11/27/2024', '5', 13),
(4, 'No1', 'Uniska', 'PKL', 'MAGANG', 1, '', 1, '11/13/2024', '11/27/2024', '5', 13),
(5, '002', 'UNIS', 'SURAT', 'PKL', 1, '', 3, '12/01/2024', '12/01/2024', '5', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pertemuan`
--

CREATE TABLE `pertemuan` (
  `id` int(11) NOT NULL,
  `idPks` int(11) NOT NULL,
  `jurusan` varchar(200) NOT NULL,
  `hari` varchar(250) NOT NULL,
  `waktu` time NOT NULL,
  `tempat` varchar(200) NOT NULL,
  `agenda` varchar(200) NOT NULL,
  `pengajuan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pertemuan`
--

INSERT INTO `pertemuan` (`id`, `idPks`, `jurusan`, `hari`, `waktu`, `tempat`, `agenda`, `pengajuan_id`) VALUES
(3, 1, 'Kedokteran Ilmu Penyakit Saraf', '11/21/2024', '09:00:00', 'Manajemen 5', 'Orientasi', 3),
(4, 1, 'Kedokteran Ilmu Penyakit Saraf', '', '00:00:00', '', '', 4),
(5, 3, 'Kedokteran Ilmu Penyakit Saraf', '12/03/2024', '09:00:00', 'Diklat 1', 'Persiapan PKL', 5);

-- --------------------------------------------------------

--
-- Table structure for table `pks`
--

CREATE TABLE `pks` (
  `id` int(11) NOT NULL,
  `institusi` varchar(200) NOT NULL,
  `fakultas` varchar(200) NOT NULL,
  `perihal` varchar(200) NOT NULL,
  `periode` varchar(200) NOT NULL,
  `mulai` varchar(250) NOT NULL,
  `berakhir` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pks`
--

INSERT INTO `pks` (`id`, `institusi`, `fakultas`, `perihal`, `periode`, `mulai`, `berakhir`) VALUES
(1, 'Universitas Lambung Mangkurat', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '09/26/2023', '09/26/2026'),
(2, 'Universitas Borneo Lestari', 'Fakultas Farmasi', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '06/12/2024', '06/12/2027'),
(3, 'Universitas Islam Indonesia', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '07/04/2024', '07/04/2027'),
(4, 'Politeknik Negeri Banjarmasin', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '02/15/2023', '02/15/2026'),
(5, 'Politeknik Negeri Banjarmasin', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '02/15/2023', '02/15/2026'),
(6, 'STIKES ISFI Banjarmasin', 'MoU', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '06/16/2023', '06/16/2026'),
(7, 'STIKES ISFI Banjarmasin', 'PKS', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '06/16/2023', '06/16/2026'),
(8, 'STIKES Borneo Nusantara Banjarmasin', 'Program Studi DIII Radiologi', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '01/11/2023', '01/11/2026'),
(9, 'STIKES Intan Martapura', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '5 Tahun', '01/30/2023', '01/30/2028'),
(10, 'Politeknik Kesehatan Kementerian Kesehatan Banjarmasin', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '2 Tahun', '05/17/2023', '05/17/2025'),
(11, 'Universitas Islam Sultan Agung Semarang', 'Profesi Apoteker', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '02/24/2023', '02/24/2026'),
(12, 'Universitas Muhammadiyah Banjarmasin', 'Fakultas Teknik', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '05/22/2023', '05/22/2026'),
(13, 'Universitas Muhammadiyah Banjarmasin', 'Fakultas Psikolog', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '05/22/2023', '05/22/2026'),
(14, 'Universitas Borneo Lestari', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '09/26/2023', '09/26/2026'),
(15, 'STIKES Husada Borneo', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '09/14/2023', '09/14/2026'),
(16, 'STIKES Abdi Persada', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '08/14/2023', '08/14/2026'),
(17, 'Universitas Islam Negeri Antasari Banjarmasin', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '08/14/2023', '08/14/2026'),
(18, 'Politeknik Unggulan Kalimantan', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '11/01/2021', '11/01/2024'),
(19, 'Universitas Islam Kalimantan Muhammad Arsyad Al Banjari Banjarmasin', 'Fakultas Kesehatan Masyarakat', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '10/31/2022', '10/31/2025'),
(20, 'Universitas Islam Sultan Agung Semarang', 'Fakultas Kedokteran', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '5 Tahun', '04/21/2022', '04/21/2027'),
(21, 'Universitas Islam Sultan Agung Semarang', 'Fakultas Ilmu Keperawatan', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '04/19/2022', '04/19/2025'),
(22, 'Universitas Lambung Mangkurat Banjarmasin', 'Fakultas Kedokteran', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '5 Tahun', '11/07/2022', '11/07/2027'),
(23, 'Universitas Muhammadiyah Banjarmasin', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '5 Tahun', '10/31/2022', '10/31/2027'),
(24, 'Universitas Muhammadiyah Banjarmasin', 'Fakultas Farmasi', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '11/22/2022', '11/22/2025'),
(25, 'Universitas Muhammadiyah Banjarmasin', 'Fakultas Keperawatan dan Ilmu Kesehatan', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '11/22/2022', '11/22/2025'),
(26, 'Universitas Sari Mulia Banjarmasin', 'Fakultas Ilmu Keperawatan', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '09/26/2022', '09/26/2025'),
(27, 'Universitas Respati Indonesia', '-', 'Pelaksanaan Tri Dharma Perguruan Tinggi', '3 Tahun', '12/26/2022', '12/26/2025');

-- --------------------------------------------------------

--
-- Table structure for table `serti`
--

CREATE TABLE `serti` (
  `id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no` varchar(255) NOT NULL,
  `institusi` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `awal` varchar(255) NOT NULL,
  `akhir` varchar(255) NOT NULL,
  `sertifikat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serti`
--

INSERT INTO `serti` (`id`, `pengajuan_id`, `user_id`, `no`, `institusi`, `jurusan`, `awal`, `akhir`, `sertifikat`) VALUES
(2, 4, 16, '001', 'Universitas Lambung Mangkurat', 'Kedokteran Ilmu Penyakit Saraf', '11/13/2024', '12/02/2024', '../sertif/674811352f0e34.72469009.pdf'),
(3, 5, 17, '002', 'Universitas Islam Indonesia', 'Kedokteran Ilmu Penyakit Saraf', '12/01/2024', '12/01/2024', '../sertif/674d51f4a0ac80.27867791.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `balasan` varchar(255) NOT NULL,
  `tagihan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`id`, `user_id`, `pengajuan_id`, `balasan`, `tagihan`) VALUES
(3, 0, 3, '', ''),
(4, 15, 4, 'eyJpdiI6InRLQjFoSWczZXg3QUo1QjZQVDliNUE9PSIsInZhbHVlIjoiMDFPNnRYVEpTVjVydTQ2TmpLNnJEUT09IiwibWFjIjoiMWQ0YWNmYWZjODZjNDQzODdhNDIxZTA5YmUzZTdhMDFkM2UzZjdmYWMxOGI0MzU4MjIyM2Y3MmRmZWE4Njg0NyJ9-1.pdf', 'eyJpdiI6InRLQjFoSWczZXg3QUo1QjZQVDliNUE9PSIsInZhbHVlIjoiMDFPNnRYVEpTVjVydTQ2TmpLNnJEUT09IiwibWFjIjoiMWQ0YWNmYWZjODZjNDQzODdhNDIxZTA5YmUzZTdhMDFkM2UzZjdmYWMxOGI0MzU4MjIyM2Y3MmRmZWE4Njg0NyJ9.pdf'),
(5, 17, 5, 'laporan_barang.xlsx', 'laporan_inventaris(8).xlsx');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `level`, `status`) VALUES
(13, 'simkordik', '$2y$10$k2G23Tr4GiSmQ9Kc2zCnR.IRnW9wW0iDP/KfWrdPHLc.PD5rmd0HG', 'admin', 'active'),
(15, 'Rahmad Ari', '$2y$10$8WuHGuYLCgVYzNm66trifehcvv3hwyn.3l1gv8290KDaVxa6Y9gBy', 'user', 'active'),
(16, 'Hamdani', '$2y$10$sTBfo4YdLSwLr3idGlYX3.o.znEDXDm6Vd96fg3F.RE8tV6YvMtGC', 'user', 'active'),
(17, 'Percobaan', '$2y$10$A9Z1pYxvAv/n89lo.fy6Zu6A9iHdUAjI84c8UweBo.RuuPs.2gZzm', 'user', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parkir`
--
ALTER TABLE `parkir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelaksanaan_ibfk_1` (`pengajuan_id`);

--
-- Indexes for table `pembimbing`
--
ALTER TABLE `pembimbing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_id` (`pengajuan_id`);

--
-- Indexes for table `pks`
--
ALTER TABLE `pks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `serti`
--
ALTER TABLE `serti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengajuan_id` (`pengajuan_id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_id` (`pengajuan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parkir`
--
ALTER TABLE `parkir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembimbing`
--
ALTER TABLE `pembimbing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pertemuan`
--
ALTER TABLE `pertemuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pks`
--
ALTER TABLE `pks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `serti`
--
ALTER TABLE `serti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pelaksanaan`
--
ALTER TABLE `pelaksanaan`
  ADD CONSTRAINT `pelaksanaan_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`);

--
-- Constraints for table `pertemuan`
--
ALTER TABLE `pertemuan`
  ADD CONSTRAINT `pertemuan_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`);

--
-- Constraints for table `serti`
--
ALTER TABLE `serti`
  ADD CONSTRAINT `serti_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`);

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
