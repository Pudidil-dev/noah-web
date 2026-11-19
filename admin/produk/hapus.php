<?php
// DELETE: buka konfirmasi dengan GET, hapus produk hanya setelah form POST.
require __DIR__ . '/../fungsi.php';
wajib_login();
require __DIR__ . '/_data.php';

$id = (int) ($_GET['id'] ?? 0);
$produk = cari_produk($koneksi, $id);
if (!$produk) {
    set_pesan('Produk tidak ditemukan.');
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cek_token();
    $stmt = mysqli_prepare($koneksi, 'DELETE FROM produk WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    // Hanya hapus baris database agar gambar bersama tetap bisa dipakai.
    set_pesan('Produk berhasil dihapus.');
    header('Location: index.php');
    exit;
}

$judul_halaman = 'Hapus Produk';
require __DIR__ . '/../_atas.php';
?>
<form class="card card-body form-admin" method="post">
  <?= input_token() ?>
  <p>Hapus produk <strong><?= e($produk['nama_produk']) ?></strong> dari katalog?</p>
  <div class="d-flex flex-wrap gap-2">
    <button class="btn btn-danger" type="submit">Ya, Hapus</button>
    <a class="btn btn-outline-secondary" href="index.php">Batal</a>
  </div>
</form>
<?php require __DIR__ . '/../_bawah.php'; ?>
