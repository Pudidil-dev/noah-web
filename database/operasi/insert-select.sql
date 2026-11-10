-- WBS 2.2: data awal 11 tabel ada dalam ../noah_db.sql.
-- Import SQL utama dahulu. Dua tabel form mendapat contoh manual berikut.
-- Semua perubahan contoh dibatalkan; tidak mengimplementasikan WBS 3.5.
USE noah_db;
START TRANSACTION;
INSERT INTO pemesanan_event (nama_organisasi, email, telepon, tipe_acara)
VALUES ('Contoh WBS', 'wbs-pemesanan@example.invalid', '0800000000', 'Festival Musik');
INSERT INTO pelanggan_email (email, asal_form)
VALUES (CONCAT('wbs-', UUID(), '@example.invalid'), 'beranda');
SELECT * FROM `event` ORDER BY id;
SELECT * FROM `setlist` ORDER BY id;
SELECT * FROM `album` ORDER BY id;
SELECT * FROM `single` ORDER BY id;
SELECT * FROM `berita` ORDER BY id;
SELECT * FROM `galeri` ORDER BY id;
SELECT * FROM `produk` ORDER BY id;
SELECT * FROM `kiriman_sahabat` ORDER BY id;
SELECT * FROM `pemesanan_event` ORDER BY id;
SELECT * FROM `pelanggan_email` ORDER BY id;
SELECT * FROM `anggota` ORDER BY id;
SELECT * FROM `komunitas_regional` ORDER BY id;
SELECT * FROM `admin` ORDER BY id;
ROLLBACK;
