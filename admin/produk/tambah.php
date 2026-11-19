<?php
// CREATE: tampilkan form kosong dan simpan produk baru setelah form valid.
require __DIR__ . '/../fungsi.php';
wajib_login();
require __DIR__ . '/_data.php';

$data = ['nama_produk' => '', 'kategori' => '', 'deskripsi' => '', 'harga' => '', 'stok' => '', 'produk_baru' => 0, 'edisi_terbatas' => 0];
$error = [];
$gambar_lama = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cek_token();
    [$data, $error] = baca_input_produk();

    if (!$error) {
        $gambar = '';
        try {
            $gambar = upload_gambar('gambar', 'toko-produk');
            if ($gambar === '') {
                throw new Exception('Foto produk wajib diunggah.');
            }

            // Tanda ? diisi sesuai urutan. s = teks, i = bilangan bulat.
            $stmt = mysqli_prepare($koneksi, 'INSERT INTO produk
                (nama_produk, kategori, deskripsi, harga, gambar, produk_baru, edisi_terbatas, stok)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
            mysqli_stmt_bind_param($stmt, 'sssisiii', $data['nama_produk'], $data['kategori'], $data['deskripsi'],
                $data['harga'], $gambar, $data['produk_baru'], $data['edisi_terbatas'], $data['stok']);
            mysqli_stmt_execute($stmt);

            set_pesan('Produk berhasil ditambahkan.');
            header('Location: index.php');
            exit;
        } catch (mysqli_sql_exception $e) {
            // Hapus foto baru jika data gagal disimpan.
            if ($gambar !== '') {
                unlink(__DIR__ . '/../../' . $gambar);
            }
            error_log($e->getMessage());
            $error[] = 'Produk gagal disimpan. Coba lagi.';
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }
    }
}

$judul_halaman = 'Tambah Produk';
require __DIR__ . '/../_atas.php';
require __DIR__ . '/_form.php';
require __DIR__ . '/../_bawah.php';
