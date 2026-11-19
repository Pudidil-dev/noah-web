<?php
// UPDATE: isi form dengan data lama, lalu simpan perubahan produk.
require __DIR__ . '/../fungsi.php';
wajib_login();
require __DIR__ . '/_data.php';

$id = (int) ($_GET['id'] ?? 0);
$data = cari_produk($koneksi, $id);
if (!$data) {
    set_pesan('Produk tidak ditemukan.');
    header('Location: index.php');
    exit;
}
$gambar_lama = $data['gambar'];
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cek_token();
    [$data, $error] = baca_input_produk();

    if (!$error) {
        $gambar_baru = '';
        try {
            // Jika form tidak mengirim foto, pertahankan foto sebelumnya.
            $gambar_baru = upload_gambar('gambar', 'toko-produk');
            $gambar = $gambar_baru === '' ? $gambar_lama : $gambar_baru;
            $stmt = mysqli_prepare($koneksi, 'UPDATE produk
                SET nama_produk = ?, kategori = ?, deskripsi = ?, harga = ?, gambar = ?,
                    produk_baru = ?, edisi_terbatas = ?, stok = ? WHERE id = ?');
            mysqli_stmt_bind_param($stmt, 'sssisiiii', $data['nama_produk'], $data['kategori'], $data['deskripsi'],
                $data['harga'], $gambar, $data['produk_baru'], $data['edisi_terbatas'], $data['stok'], $id);
            mysqli_stmt_execute($stmt);

            set_pesan('Produk berhasil diperbarui.');
            header('Location: index.php');
            exit;
        } catch (mysqli_sql_exception $e) {
            if ($gambar_baru !== '') {
                unlink(__DIR__ . '/../../' . $gambar_baru);
            }
            error_log($e->getMessage());
            $error[] = 'Perubahan gagal disimpan. Coba lagi.';
        } catch (Exception $e) {
            $error[] = $e->getMessage();
        }
    }
}

$judul_halaman = 'Edit Produk';
require __DIR__ . '/../_atas.php';
require __DIR__ . '/_form.php';
require __DIR__ . '/../_bawah.php';
