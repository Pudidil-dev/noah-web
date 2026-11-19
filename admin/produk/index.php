<?php
// READ: ambil semua produk untuk tabel AdminLTE.
require __DIR__ . '/../fungsi.php';
wajib_login();

$hasil = mysqli_query($koneksi, 'SELECT * FROM produk ORDER BY id DESC');
$judul_halaman = 'Produk Toko';
require __DIR__ . '/../_atas.php';
?>

<p><a class="btn btn-primary" href="tambah.php">Tambah Produk</a></p>
<div class="card">
  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle mb-0">
      <thead><tr><th>Foto</th><th>Produk</th><th>Kategori</th><th>Harga</th><th>Stok</th><th>Label</th><th>Aksi</th></tr></thead>
      <tbody>
        <?php if (mysqli_num_rows($hasil) === 0) : ?>
          <tr><td colspan="7">Belum ada produk.</td></tr>
        <?php endif; ?>
        <?php while ($produk = mysqli_fetch_assoc($hasil)) : ?>
          <tr>
            <td><img src="../../<?= e($produk['gambar']) ?>" alt=""></td>
            <td><?= e($produk['nama_produk']) ?></td>
            <td><?= e($produk['kategori']) ?></td>
            <td>Rp <?= number_format($produk['harga'], 0, ',', '.') ?></td>
            <td><?= e($produk['stok'] ?? '—') ?></td>
            <td>
              <?php if ($produk['produk_baru']) : ?><span class="badge text-bg-primary">Baru</span><?php endif; ?>
              <?php if ($produk['edisi_terbatas']) : ?><span class="badge text-bg-warning">Terbatas</span><?php endif; ?>
            </td>
            <td class="aksi">
              <a class="btn btn-sm btn-outline-primary" href="edit.php?id=<?= (int) $produk['id'] ?>">Edit</a>
              <a class="btn btn-sm btn-outline-danger" href="hapus.php?id=<?= (int) $produk['id'] ?>">Hapus</a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<?php require __DIR__ . '/../_bawah.php'; ?>
