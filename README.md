# Website NOAH — rekonstruksi commit WBS

Repositori tugas PHP native + MySQL, disusun ulang per WBS berstatus **Complete**.
Riwayat ini adalah rekonstruksi snapshot, bukan kronologi pengerjaan asli.
Tanggal dan author commit memakai identitas Git aktual; assignee dan jadwal
tetap tercatat sebagai metadata WBS.

Sumber WBS: https://docs.google.com/spreadsheets/d/1I4Dvoxj2NF8CRLg5CnbBGVljulCA_IUdpiqDKmV5_qI/edit?gid=1115838130

Lihat [pemetaan commit dan batas cakupan](docs/pemetaan-wbs.md),
[snapshot WBS](docs/wbs-sumber.csv), dan [persiapan](docs/persiapan.md).
Dokumen dan kode pada tautan berikut tersedia setelah commit WBS terkait.

## Menjalankan snapshot akhir (sampai WBS 3.4)

1. Gunakan PHP 8.x dengan mysqli dan MySQL/MariaDB (XAMPP atau Laragon).
2. Import `database/noah_db.sql` pada database latihan yang masih kosong.
3. Sesuaikan `koneksi.php` (default localhost, root, password kosong, noah_db).
4. Letakkan proyek di document root lalu buka `index.php`, atau jalankan
   `php -S localhost:8000` dari folder repositori.

SQL utama berisi struktur dan seed. Contoh operasi manual terpisah berada di
`database/operasi/`; transaksi contoh berakhir dengan ROLLBACK.
Database terdiri atas 13 tabel independen, tanpa foreign key atau JOIN.

Halaman: Beranda, Cerita Band, Diskografi, Event, Media, Sahabat NOAH, Toko.
Penyimpanan form (3.5), login/admin (4), dan deliverable pengujian (5) belum
termasuk cakupan Complete. Form POST dinonaktifkan dan diberi keterangan.

## Memeriksa riwayat

```sh
git log --reverse --oneline
git log --reverse --stat
git show <hash-commit> --
```

Format pesan: `feat(wbs-3.2): Tampilkan beranda, cerita band, diskografi`.
Commit persiapan memakai scope `wbs-persiapan` untuk WBS ID `#`.
