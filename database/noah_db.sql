-- Database website NOAH
-- Import lewat phpMyAdmin: tab Import > pilih file ini > Go.
-- Kalau database noah_db sudah ada, hapus dulu (Drop) supaya tidak bentrok.
-- 13 tabel, semuanya berdiri sendiri (tanpa relasi / JOIN).

CREATE DATABASE IF NOT EXISTS noah_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE noah_db;


-- 1. event: Konser Mendatang, Arsip Event, Event Komunitas
CREATE TABLE event (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  jenis       ENUM('konser','arsip','komunitas') NOT NULL,
  judul       VARCHAR(150) NOT NULL,
  tanggal     DATE         NULL,              -- arsip lama boleh kosong
  kota        VARCHAR(255) NULL,              -- arsip: beberapa kota dipisah koma
  venue       VARCHAR(150) NULL,
  deskripsi   TEXT         NULL,
  label       VARCHAR(50)  NULL               -- badge di card, contoh: Tersedia
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. setlist: Arsip Setlist di halaman Event
CREATE TABLE setlist (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  judul        VARCHAR(150) NOT NULL,
  venue        VARCHAR(150) NULL,
  tanggal      DATE         NULL,
  tamu         VARCHAR(150) NULL,
  lagu_utama   TEXT         NULL,             -- satu lagu per baris
  lagu_encore  TEXT         NULL              -- satu lagu per baris
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. album: Grid Album di halaman Diskografi
CREATE TABLE album (
  id             INT AUTO_INCREMENT PRIMARY KEY,
  judul          VARCHAR(150) NOT NULL,
  tahun_rilis    YEAR         NOT NULL,
  kategori       ENUM('Studio','Kompilasi','Lagu Tema') NOT NULL,
  jumlah_lagu    INT          NOT NULL,
  lagu_unggulan  TEXT         NULL,           -- 3 lagu di card, satu per baris
  foto_album     VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. single: Tabel Single di halaman Diskografi
CREATE TABLE `single` (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  judul        VARCHAR(150) NOT NULL,
  tahun_rilis  YEAR         NOT NULL,
  album_asal   VARCHAR(150) NULL              -- teks biasa, contoh: OST Alexandria
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. berita: Artikel Utama dan Berita Terbaru
CREATE TABLE berita (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  judul           VARCHAR(200) NOT NULL,
  kategori        VARCHAR(50)  NOT NULL,
  ringkasan       TEXT         NOT NULL,
  gambar          VARCHAR(255) NULL,
  tanggal_terbit  DATE         NOT NULL,
  jadi_utama      BOOLEAN      NOT NULL DEFAULT FALSE   -- TRUE = Artikel Utama
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. galeri: Di Balik Layar dan Galeri Foto
CREATE TABLE galeri (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  bagian      ENUM('galeri_foto','di_balik_layar') NOT NULL,
  gambar      VARCHAR(255) NOT NULL,
  judul       VARCHAR(150) NULL,              -- khusus di_balik_layar
  keterangan  VARCHAR(255) NULL,              -- khusus di_balik_layar
  jenis       ENUM('Foto','Video') NOT NULL DEFAULT 'Foto',
  kategori    ENUM('Peterpan Era','NOAH Era','Konser','Studio') NULL   -- tombol filter
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. produk: Toko dan Edisi Terbatas
CREATE TABLE produk (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  nama_produk     VARCHAR(150) NOT NULL,
  kategori        VARCHAR(50)  NOT NULL,
  deskripsi       TEXT         NOT NULL,
  harga           INT          NOT NULL,      -- tanpa titik: 250000
  gambar          VARCHAR(255) NOT NULL,
  produk_baru     BOOLEAN      NOT NULL DEFAULT FALSE,   -- TRUE = badge Baru
  edisi_terbatas  BOOLEAN      NOT NULL DEFAULT FALSE,   -- TRUE = badge Terbatas
  stok            INT          NULL           -- ditampilkan untuk edisi terbatas
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. kiriman_sahabat: form Kirim Cerita, Cerita Sahabat, Karya Sahabat
CREATE TABLE kiriman_sahabat (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  nama_lengkap  VARCHAR(100) NOT NULL,
  email         VARCHAR(150) NOT NULL,
  kota          VARCHAR(100) NULL,
  kategori      ENUM('Cerita Penggemar','Karya Penggemar','Cover Lagu') NOT NULL,
  pesan         TEXT         NOT NULL,
  foto          VARCHAR(255) NULL,            -- foto profil (cerita) atau foto karya
  status        ENUM('menunggu','tampil') NOT NULL DEFAULT 'menunggu',
  waktu_kirim   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. pemesanan_event: form Pemesanan & Kerja Sama
CREATE TABLE pemesanan_event (
  id                  INT AUTO_INCREMENT PRIMARY KEY,
  nama_organisasi     VARCHAR(150) NOT NULL,
  email               VARCHAR(150) NOT NULL,
  telepon             VARCHAR(20)  NOT NULL,
  tanggal_acara       DATE         NULL,
  tipe_acara          ENUM('Festival Musik','Acara Korporat','Konser Privat') NOT NULL,
  estimasi_kehadiran  INT          NULL,
  venue_lokasi        VARCHAR(200) NULL,
  rentang_anggaran    VARCHAR(100) NULL,
  catatan             TEXT         NULL,
  waktu_kirim         DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. pelanggan_email: form Berlangganan dan Beritahu Saya
CREATE TABLE pelanggan_email (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  email         VARCHAR(150) NOT NULL UNIQUE,
  asal_form     ENUM('beranda','event') NOT NULL,
  waktu_daftar  DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 11. anggota: Kenali Anggota di halaman Cerita Band
CREATE TABLE anggota (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  nama       VARCHAR(100) NOT NULL,
  posisi     VARCHAR(100) NOT NULL,
  deskripsi  TEXT         NOT NULL,
  foto       VARCHAR(255) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 12. komunitas_regional: Komunitas Regional di halaman Sahabat NOAH
CREATE TABLE komunitas_regional (
  id              INT AUTO_INCREMENT PRIMARY KEY,
  kota            VARCHAR(100) NOT NULL,
  jumlah_anggota  INT          NOT NULL DEFAULT 0,
  ketua           VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 13. admin: login admin panel
CREATE TABLE admin (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  username  VARCHAR(50)  NOT NULL UNIQUE,
  password  VARCHAR(255) NOT NULL             -- hash dari password_hash()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


