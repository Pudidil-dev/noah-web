# Website NOAH — rekonstruksi commit WBS

Repositori tugas PHP native + MySQL dengan commit per WBS.
Tahap persiapan sampai WBS 3.4 direkonstruksi dari snapshot proyek.
WBS 3.5 dan 4.1–4.3 melanjutkan implementasi tersebut.
Tanggal dan author commit memakai identitas Git aktual; assignee dan jadwal
tetap tercatat sebagai metadata WBS.

Sumber WBS: https://docs.google.com/spreadsheets/d/1I4Dvoxj2NF8CRLg5CnbBGVljulCA_IUdpiqDKmV5_qI/edit?gid=1115838130

Lihat [pemetaan commit dan batas cakupan](docs/pemetaan-wbs.md),
[snapshot WBS](docs/wbs-sumber.csv), dan [persiapan](docs/persiapan.md).
Dokumen dan kode pada tautan berikut tersedia setelah commit WBS terkait.

## Menjalankan proyek (sampai WBS 4.3)

1. Gunakan PHP 8.x dengan mysqli, mbstring, dan fileinfo serta MySQL/MariaDB (XAMPP atau Laragon).
2. Import `database/noah_db.sql` pada database latihan yang masih kosong.
3. Sesuaikan `koneksi.php` (default localhost, root, password kosong, noah_db).
4. Letakkan proyek di document root lalu buka `index.php`, atau jalankan
   `php -S localhost:8000` dari folder repositori.

SQL utama berisi struktur dan seed. Contoh operasi manual terpisah berada di
`database/operasi/`; transaksi contoh berakhir dengan ROLLBACK.
Database terdiri atas 13 tabel independen, tanpa foreign key atau JOIN.

Halaman: Beranda, Cerita Band, Diskografi, Event, Media, Sahabat NOAH, Toko.
Form berlangganan, pemesanan, dan kiriman menyimpan data ke database (WBS 3.5).

Buka `/admin/` untuk login dan mengelola berita, event, kiriman, pemesanan,
serta pelanggan email. Akun latihan tersedia pada komentar seed di
`database/noah_db.sql`. Ganti password sebelum memakai aplikasi di luar komputer
latihan. Folder `images/` perlu dapat ditulis oleh PHP untuk menerima foto.
Deliverable pengujian WBS 5 belum termasuk cakupan.

## Memeriksa riwayat

```sh
git log --reverse --oneline
git log --reverse --stat
git show <hash-commit> --
```

Format pesan: `feat(wbs-3.2): Tampilkan beranda, cerita band, diskografi`.
Commit persiapan memakai scope `wbs-persiapan` untuk WBS ID `#`.
