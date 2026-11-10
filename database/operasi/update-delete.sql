-- WBS 2.3: contoh manual UPDATE dan DELETE, bukan panel admin.
-- Import SQL utama dahulu. Gunakan hanya database latihan.
-- Ganti NULL dengan ID baris target yang benar di setiap blok untuk mencobanya.
-- Default NULL tidak memilih baris. ROLLBACK membatalkan UPDATE/DELETE.
USE noah_db;

-- Tabel event
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `event` WHERE id = @target_id;
UPDATE `event` SET `judul` = 'Contoh event WBS' WHERE id = @target_id;
SELECT * FROM `event` WHERE id = @target_id;
DELETE FROM `event` WHERE id = @target_id;
SELECT * FROM `event` WHERE id = @target_id;
ROLLBACK;

-- Tabel setlist
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `setlist` WHERE id = @target_id;
UPDATE `setlist` SET `judul` = 'Contoh setlist WBS' WHERE id = @target_id;
SELECT * FROM `setlist` WHERE id = @target_id;
DELETE FROM `setlist` WHERE id = @target_id;
SELECT * FROM `setlist` WHERE id = @target_id;
ROLLBACK;

-- Tabel album
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `album` WHERE id = @target_id;
UPDATE `album` SET `judul` = 'Contoh album WBS' WHERE id = @target_id;
SELECT * FROM `album` WHERE id = @target_id;
DELETE FROM `album` WHERE id = @target_id;
SELECT * FROM `album` WHERE id = @target_id;
ROLLBACK;

-- Tabel single
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `single` WHERE id = @target_id;
UPDATE `single` SET `judul` = 'Contoh single WBS' WHERE id = @target_id;
SELECT * FROM `single` WHERE id = @target_id;
DELETE FROM `single` WHERE id = @target_id;
SELECT * FROM `single` WHERE id = @target_id;
ROLLBACK;

-- Tabel berita
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `berita` WHERE id = @target_id;
UPDATE `berita` SET `judul` = 'Contoh berita WBS' WHERE id = @target_id;
SELECT * FROM `berita` WHERE id = @target_id;
DELETE FROM `berita` WHERE id = @target_id;
SELECT * FROM `berita` WHERE id = @target_id;
ROLLBACK;

-- Tabel galeri
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `galeri` WHERE id = @target_id;
UPDATE `galeri` SET `judul` = 'Contoh galeri WBS' WHERE id = @target_id;
SELECT * FROM `galeri` WHERE id = @target_id;
DELETE FROM `galeri` WHERE id = @target_id;
SELECT * FROM `galeri` WHERE id = @target_id;
ROLLBACK;

-- Tabel produk
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `produk` WHERE id = @target_id;
UPDATE `produk` SET `nama_produk` = 'Contoh produk WBS' WHERE id = @target_id;
SELECT * FROM `produk` WHERE id = @target_id;
DELETE FROM `produk` WHERE id = @target_id;
SELECT * FROM `produk` WHERE id = @target_id;
ROLLBACK;

-- Tabel kiriman_sahabat
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `kiriman_sahabat` WHERE id = @target_id;
UPDATE `kiriman_sahabat` SET `status` = 'tampil' WHERE id = @target_id;
SELECT * FROM `kiriman_sahabat` WHERE id = @target_id;
DELETE FROM `kiriman_sahabat` WHERE id = @target_id;
SELECT * FROM `kiriman_sahabat` WHERE id = @target_id;
ROLLBACK;

-- Tabel pemesanan_event
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `pemesanan_event` WHERE id = @target_id;
UPDATE `pemesanan_event` SET `catatan` = 'Contoh catatan WBS' WHERE id = @target_id;
SELECT * FROM `pemesanan_event` WHERE id = @target_id;
DELETE FROM `pemesanan_event` WHERE id = @target_id;
SELECT * FROM `pemesanan_event` WHERE id = @target_id;
ROLLBACK;

-- Tabel pelanggan_email
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `pelanggan_email` WHERE id = @target_id;
UPDATE `pelanggan_email` SET `asal_form` = 'event' WHERE id = @target_id;
SELECT * FROM `pelanggan_email` WHERE id = @target_id;
DELETE FROM `pelanggan_email` WHERE id = @target_id;
SELECT * FROM `pelanggan_email` WHERE id = @target_id;
ROLLBACK;

-- Tabel anggota
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `anggota` WHERE id = @target_id;
UPDATE `anggota` SET `posisi` = 'Contoh posisi WBS' WHERE id = @target_id;
SELECT * FROM `anggota` WHERE id = @target_id;
DELETE FROM `anggota` WHERE id = @target_id;
SELECT * FROM `anggota` WHERE id = @target_id;
ROLLBACK;

-- Tabel komunitas_regional
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `komunitas_regional` WHERE id = @target_id;
UPDATE `komunitas_regional` SET `jumlah_anggota` = 10 WHERE id = @target_id;
SELECT * FROM `komunitas_regional` WHERE id = @target_id;
DELETE FROM `komunitas_regional` WHERE id = @target_id;
SELECT * FROM `komunitas_regional` WHERE id = @target_id;
ROLLBACK;

-- Tabel admin
START TRANSACTION;
SET @target_id = NULL;
SELECT * FROM `admin` WHERE id = @target_id;
UPDATE `admin` SET `username` = 'contoh_wbs_admin' WHERE id = @target_id;
SELECT * FROM `admin` WHERE id = @target_id;
DELETE FROM `admin` WHERE id = @target_id;
SELECT * FROM `admin` WHERE id = @target_id;
ROLLBACK;
