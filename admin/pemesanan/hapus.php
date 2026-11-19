<?php
// DELETE: tampilkan konfirmasi dulu, hapus setelah tombol ditekan.
require __DIR__ . '/../fungsi.php';
wajib_login();

$id = (int) ($_GET['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cek_token();

    $stmt = mysqli_prepare($koneksi, 'DELETE FROM pemesanan_event WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);

    set_pesan('Pemesanan berhasil dihapus.');
    header('Location: index.php');
    exit;
}

$stmt = mysqli_prepare($koneksi, 'SELECT nama_organisasi FROM pemesanan_event WHERE id = ?');
mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);
$pemesanan = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

if (!$pemesanan) {
    set_pesan('Pemesanan tidak ditemukan.');
    header('Location: index.php');
    exit;
}

$judul_halaman = 'Hapus Pemesanan';
require __DIR__ . '/../_atas.php';
?>

<form class="card card-body form-admin" method="post">
  <?= input_token() ?>
  <p>Yakin ingin menghapus pemesanan dari <strong><?= e($pemesanan['nama_organisasi']) ?></strong>? Data yang dihapus tidak bisa dikembalikan.</p>
  <div class="d-flex flex-wrap gap-2 mt-3">
    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
    <a class="btn btn-outline-secondary" href="index.php">Batal</a>
  </div>
</form>

<?php require __DIR__ . '/../_bawah.php'; ?>
