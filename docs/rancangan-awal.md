# Kebutuhan basis data (WBS 1.1)

Ringkasan ini dibuat saat rekonstruksi; draf awal historis tidak ditemukan.
Dasar: SQL, halaman PHP, dan dokumen rancangan final pada proyek sumber.

- Beranda: membaca konser dan berita; rencana berlangganan email.
- Cerita Band: membaca anggota band.
- Diskografi: membaca album dan single, dengan filter.
- Event: membaca konser, arsip, setlist; rencana pemesanan dan notifikasi email.
- Media: membaca berita dan galeri, dengan pencarian/filter.
- Sahabat NOAH: membaca komunitas dan kiriman; rencana pengiriman cerita.
- Toko: membaca dan memfilter produk.
- Admin direncanakan untuk kelola data, otentikasi, dan otorisasi (WBS 4).

Tabel pada implementasi final: `event`, `setlist`, `album`, `single`, `berita`, `galeri`, `produk`, `kiriman_sahabat`, `pemesanan_event`, `pelanggan_email`, `anggota`, `komunitas_regional`, `admin`.
