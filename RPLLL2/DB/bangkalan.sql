-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Jun 2024 pada 17.41
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bangkalan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `nama_admin`, `password`, `alamat`, `email`) VALUES
('A1', 'surya', 'Surya Eka', 'surya', 'Bangkalan', 'surya@gmail.com'),
('A2', 'admin1', 'admin1', 'admin1', 'Blitar', 'admin1@gmail.com'),
('A3', 'admin3', 'admin3', 'admin3', 'Solo', 'admin3@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri_kuliner`
--

CREATE TABLE `galeri_kuliner` (
  `id_galeri_kuliner` varchar(50) NOT NULL,
  `id_kuliner` varchar(50) NOT NULL,
  `gambar` varchar(1024) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri_kuliner`
--

INSERT INTO `galeri_kuliner` (`id_galeri_kuliner`, `id_kuliner`, `gambar`, `keterangan`) VALUES
('GK1', 'K1', 'https://i.ibb.co.com/vQjtpfT/dinjay-oke-189823116.webp', 'Bebek Sinjay'),
('GK2', 'K1', 'https://i.ibb.co.com/drJG7DF/bebek-sinjay.jpg', 'Bebek Sinjay Madura'),
('GK3', 'K2', 'https://i.ibb.co.com/HxkKmT8/maxresdefault.jpg', 'Sinjay Seafood');

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri_wisata`
--

CREATE TABLE `galeri_wisata` (
  `id_galeri_wisata` varchar(50) NOT NULL,
  `id_wisata` varchar(50) NOT NULL,
  `gambar` varchar(1024) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `galeri_wisata`
--

INSERT INTO `galeri_wisata` (`id_galeri_wisata`, `id_wisata`, `gambar`, `keterangan`) VALUES
('GW1', 'W1', 'https://i.ibb.co.com/XZH4Zv6/masjid-muhammad-kholil-depan.jpg', 'Masjid Syaikhona Dari Depan'),
('GW2', 'W1', 'https://i.ibb.co.com/9nx4XYJ/masjid-dalam.png', 'Masjid Syaikhona Dari Dalam'),
('GW3', 'W2', 'https://i.ibb.co.com/VQDFjf1/33222b4e-f57e-4313-9a5c-e871a705e062-1.jpg', 'Bukit Jhaddih'),
('GW4', 'W2', 'https://i.ibb.co.com/DzD4f8X/Wisata-Bukit-Jaddih-Madura.jpg', 'Bukit Jhaddih Madura'),
('GW5', 'W3', 'https://i.ibb.co.com/2v77xLW/64f43727bd670.jpg', 'Bukit Arosbaya'),
('GW6', 'W3', 'https://i.ibb.co.com/R0pXgvn/bukit-arosbaya-pahatan-relief-menakjubkan-di-tanah-madura.jpg', 'Pahatan Relief di Bukit Pelalangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuliner`
--

CREATE TABLE `kuliner` (
  `id_kuliner` varchar(50) NOT NULL,
  `nama_kuliner` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `jam_buka` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `latLng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kuliner`
--

INSERT INTO `kuliner` (`id_kuliner`, `nama_kuliner`, `alamat`, `harga`, `jam_buka`, `deskripsi`, `latLng`) VALUES
('K1', 'Bebek Sinjay Madura', 'Jalan Raya Ketengan Nomor45, Junok, Kecamatan Burneh, Kabupaten Bangkalan', 20000, '09.00 - 21.00', 'Jalan-jalan ke Madura, rasanya belum lengkap kalau tidak mampir ke Bebek Sinjay Bangkalan. Meskipun sekarang sudah ada banyak cabangnya di Surabaya, namun cita rasa aslinya tetap di warung ini. Itulah sebabnya Bebek Sinjay jadi salah satu destinasi kuliner terkenal di Madura. Keunikan dari tempat makan ini adalah meskipun antreannya panjang, tetapi pelayanannya cepat dan sesuai nomor urut. Selain itu porsi makanannya besar, banyak bonus kremes atau jeroannya, dan sambal pencitnya nendang banget.', '-7.026265300367752, 112.75314028032392'),
('K2', 'Sinjay Seafood', 'Jalan KH Kholil VII Nomor 23, Kecamatan Bangkalan, Kabupaten Bangkalan', 15000, '12.00 - 21.00', 'Madura yang berbatasan dengan laut tentu kaya akan hasil lautnya, seperti kepiting dan cumi-cumi. Buat kamu yang suka sekali dengan olahan laut, bisa mencoba mampir ke Sinjay Seafood. Salah satu rumah makan seafood di Bangkalan yang terkenal dengan olahan sambel pencitnya. Menu seafood-nya juga cukup beragam, mulai dari olahan ikan, bakaran, kepiting, hingga olahan cumi-cumi. Ciri khas dari olahan Sinjay Seafood adalah bumbu maduranya yang asin, gurih, dan pedas.', '-7.040627886370331, 112.72516206551435');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan_kuliner`
--

CREATE TABLE `ulasan_kuliner` (
  `id_ulasan_kuliner` int(11) NOT NULL,
  `id_kuliner` varchar(50) NOT NULL,
  `ulasan` text DEFAULT NULL,
  `rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan_kuliner`
--

INSERT INTO `ulasan_kuliner` (`id_ulasan_kuliner`, `id_kuliner`, `ulasan`, `rating`) VALUES
(1, 'K2', 'bjir', 4),
(2, 'K2', 'nice', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan_wisata`
--

CREATE TABLE `ulasan_wisata` (
  `id_ulasan_wisata` int(11) NOT NULL,
  `id_wisata` varchar(50) NOT NULL,
  `ulasan` text DEFAULT NULL,
  `rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `ulasan_wisata`
--

INSERT INTO `ulasan_wisata` (`id_ulasan_wisata`, `id_wisata`, `ulasan`, `rating`) VALUES
(1, 'W1', 'Masjid yang bagus, tempat yang mengukir sejarah bagi madura', 4),
(2, 'W1', 'tes ', NULL),
(3, 'W2', 'tes', NULL),
(4, 'W1', 'res', 4),
(5, 'W1', 'bjirr', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `wisata`
--

CREATE TABLE `wisata` (
  `id_wisata` varchar(50) NOT NULL,
  `nama_wisata` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `harga_tiket` int(11) DEFAULT NULL,
  `jam_buka` varchar(255) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `jenis_wisata` varchar(255) NOT NULL,
  `latLng` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `wisata`
--

INSERT INTO `wisata` (`id_wisata`, `nama_wisata`, `alamat`, `harga_tiket`, `jam_buka`, `deskripsi`, `jenis_wisata`, `latLng`) VALUES
('W1', 'Masjid Syaikhona Muhammad Kholil', 'Desa Martajesa Kel. Demangan Kab. Bangkalan Madura', 3000, '24 Jam', 'Syaikhona Muhammad Kholil adalah seorang ulama besar asal Bangkalan, Madura, Jawa Timur. Ulama yang berumur 105 tahun saat meninggal dunia pada tahun 1925 tersebut merupakan ulama kharismatik yang memiliki ratusan murid, di antaranya adalah ulama-ulama besar Nadhatul Ulama di Jawa dan Madura. Saat ini, tepat di lokasi pemakaman beliau, terdapat satu masjid indah yang dibangun sebagai penghormatan kepada sang ulama dan diberi nama Masjid Syaikhona Muhammad Kholil. Masjid yang tak pernah sepi dari peziarah ini awalnya adalah sebuah pesantren yang dilengkapi mushala berukuran 8×10 meter. Namun, karena kebutuhan akan sarana peribadahan yang memadai untuk masyarakat sekitar dan ramainya peziarah, maka pada tahun 2006 dibangunlah masjid yang lebih besar dan representatif.', 'Wisata Religi', '-7.041953330707175, 112.72336176366478'),
('W2', 'Wisata Bukit Jaddhih', 'Jakan, Parseh, Kec. Socah, Kabupaten Bangkalan, Jawa Timur.', 10000, '07.00 - 16.00', 'Bekas tambang batu kapur ini telah disulap menjadi destinasi wisata instagramable dengan panorama alam yang memukau dan nilai sejarah yang tinggi. Bukit Jaddhih menghadirkan pemandangan tebing-tebing batu kapur yang menjulang tinggi dengan berbagai bentuk dan tekstur yang unik. Warna putih dan krem dari batu kapur berpadu dengan langit biru dan hijaunya pepohonan di sekitarnya menciptakan panorama alam yang sangat indah.', 'Wisata Alam', '-7.0821126412612445, 112.75959323852892'),
('W3', 'Bukit Pelalangan Arosbaya', 'Plalangan Madura, Buduran, Arosbaya, Makam Air Mata, Buduran, Kec. Arosbaya, Kabupaten Bangkalan, Jawa Timur', 10000, '09.00 - 17.00', 'Wisatawan tentunya tidak asing dengan keindahan Antelope Canyon di Arizona, AS. Antelope Canyon adalah sebuah ngarai yang memiliki tebing eksotis berwarna coklat dengan lorong yang terbentuk akibat erosi. Ternyata, ada obyek wisata di Indonesia yang menyerupai Antelope Canyon Arizona, lho. Adalah Bukit Kapur Pelalangan Arosbaya atau Bukit Arosbaya yang berlokasi di Kecamatan Arosbaya, Kabupaten Bangkalan, Madura, Jawa Timur. Bukit Arosbaya merupakan bekas lahan tambang kapur yang diubah menjadi obyek wisata. Berbeda dengan bukit kapur kebanyakan yang berwarna putih, Bukit Arosbaya justru menawarkan hamparan bukit berwarna coklat keemasan. Sekilas, panorama di Bukit Arosbaya akan mengingatkan wisatawan dengan Antelope Canyon Arizona. Bedanya, jika Antelope Canyon Arizona berupa ngarai gersang, Bukit Arosbaya ditumbuhi banyak tumbuhan paku dan pepohonan rindang.', 'Wisata Alam', '-6.947242192045147, 112.85957690969114');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `galeri_kuliner`
--
ALTER TABLE `galeri_kuliner`
  ADD PRIMARY KEY (`id_galeri_kuliner`),
  ADD KEY `id_kuliner` (`id_kuliner`);

--
-- Indeks untuk tabel `galeri_wisata`
--
ALTER TABLE `galeri_wisata`
  ADD PRIMARY KEY (`id_galeri_wisata`),
  ADD KEY `id_wisata` (`id_wisata`);

--
-- Indeks untuk tabel `kuliner`
--
ALTER TABLE `kuliner`
  ADD PRIMARY KEY (`id_kuliner`);

--
-- Indeks untuk tabel `ulasan_kuliner`
--
ALTER TABLE `ulasan_kuliner`
  ADD PRIMARY KEY (`id_ulasan_kuliner`),
  ADD KEY `id_kuliner` (`id_kuliner`);

--
-- Indeks untuk tabel `ulasan_wisata`
--
ALTER TABLE `ulasan_wisata`
  ADD PRIMARY KEY (`id_ulasan_wisata`),
  ADD KEY `id_wisata` (`id_wisata`);

--
-- Indeks untuk tabel `wisata`
--
ALTER TABLE `wisata`
  ADD PRIMARY KEY (`id_wisata`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ulasan_kuliner`
--
ALTER TABLE `ulasan_kuliner`
  MODIFY `id_ulasan_kuliner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ulasan_wisata`
--
ALTER TABLE `ulasan_wisata`
  MODIFY `id_ulasan_wisata` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `galeri_kuliner`
--
ALTER TABLE `galeri_kuliner`
  ADD CONSTRAINT `galeri_kuliner_ibfk_1` FOREIGN KEY (`id_kuliner`) REFERENCES `kuliner` (`id_kuliner`);

--
-- Ketidakleluasaan untuk tabel `galeri_wisata`
--
ALTER TABLE `galeri_wisata`
  ADD CONSTRAINT `galeri_wisata_ibfk_1` FOREIGN KEY (`id_wisata`) REFERENCES `wisata` (`id_wisata`);

--
-- Ketidakleluasaan untuk tabel `ulasan_kuliner`
--
ALTER TABLE `ulasan_kuliner`
  ADD CONSTRAINT `ulasan_kuliner_ibfk_1` FOREIGN KEY (`id_kuliner`) REFERENCES `kuliner` (`id_kuliner`);

--
-- Ketidakleluasaan untuk tabel `ulasan_wisata`
--
ALTER TABLE `ulasan_wisata`
  ADD CONSTRAINT `ulasan_wisata_ibfk_1` FOREIGN KEY (`id_wisata`) REFERENCES `wisata` (`id_wisata`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
