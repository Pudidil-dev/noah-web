# Pemetaan WBS ke file commit

Riwayat ini direkonstruksi dari snapshot proyek yang tersedia, dengan tanggal
commit aktual. Status Complete berasal dari spreadsheet, bukan hasil pengujian.
Dokumen ringkasan 1.1 dan skrip operasi SQL disusun saat rekonstruksi.
Dokumen final 1.2 dan kode frontend disalin dari proyek sumber.

| WBS | Isi commit |
| --- | --- |
| # | README, konfigurasi Git, snapshot CSV, pembagian tugas, pemetaan ini |
| 1.1 | docs/rancangan-awal.md: ringkasan kebutuhan hasil rekonstruksi |
| 1.2 | docs/rancangan-akhir.md, dokumen rancangan asli DOCX dan PDF |
| 2.1 | database/noah_db.sql: hanya struktur database dan 13 tabel |
| 2.2 | database/noah_db.sql: tambah data awal; database/operasi/insert-select.sql |
| 2.3 | database/operasi/update-delete.sql: contoh operasi 13 tabel |
| 3.1 | koneksi.php, bagian/, style.css, images/, kerangka tujuh halaman PHP |
| 3.2 | index.php, cerita-band.php, diskografi.php: isi dan pembacaan data |
| 3.3 | tur-event.php, berita-media.php: isi dan pembacaan data |
| 3.4 | sahabat-noah.php, toko.php: isi dan pembacaan data |

Audit file aktual: `git log --reverse --stat` atau `git show --stat <hash>`.

## Batas cakupan dan selisih sumber

- WBS 3.5, 4.1–4.3, dan 5.1–5.3 berstatus Not Started; tidak dibuat commit
  penyelesaiannya. Folder admin/ dan proses/ tidak disertakan.
- Form POST frontend ditampilkan dalam fieldset disabled dengan keterangan WBS 3.5.
  Filter dan pencarian GET tetap aktif.
- WBS 1.2/2.1 menyebut relasi tabel, tetapi dokumen final dan SQL sumber menyatakan
  13 tabel independen tanpa foreign key. Selisih ini belum diselesaikan.
- Dokumen rancangan final asli juga menjelaskan fitur admin/form yang berada di
  luar cakupan repositori ini; isinya dipertahankan sebagai artefak sumber.
- Seed asli mengisi 11 tabel. Contoh INSERT dua tabel form tersedia dalam skrip
  transaksi ROLLBACK, terpisah dari seed agar bukan klaim form sudah terintegrasi.
- Skrip UPDATE/DELETE adalah contoh SQL manual, bukan fitur admin dan bukan
  bukti bahwa pengujian WBS 5 telah selesai. Jalankan pada database latihan.
- Kerangka WBS 3.1 menyiapkan tujuh halaman; isi dinamis masuk bertahap di 3.2–3.4.
