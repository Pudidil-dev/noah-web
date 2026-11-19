<?php
// READ: tampilkan semua berita dalam tabel.
require __DIR__ . '/../fungsi.php';
wajib_login();

$hasil = mysqli_query($koneksi, 'SELECT * FROM berita ORDER BY tanggal_terbit DESC');

$judul_halaman = 'Berita';
require __DIR__ . '/../_atas.php';
?>

<p><a class="btn btn-primary" href="tambah.php">+ Tambah Berita</a></p>

<div class="card">
  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle mb-0">
    <tr>
      <th>Gambar</th>
      <th>Judul</th>
      <th>Kategori</th>
      <th>Tanggal</th>
      <th>Utama</th>
      <th>Aksi</th>
    </tr>
    <?php while ($b = mysqli_fetch_assoc($hasil)) : ?>
      <tr>
        <td>
          <?php if ($b['gambar']) : ?>
            <img src="../../<?= e($b['gambar']) ?>" alt="">
          <?php else : ?>
            -
          <?php endif; ?>
        </td>
        <td><?= e($b['judul']) ?></td>
        <td><?= e($b['kategori']) ?></td>
        <td><?= e($b['tanggal_terbit']) ?></td>
        <td><?= $b['jadi_utama'] ? 'Ya' : '' ?></td>
        <td class="aksi">
          <a class="btn btn-sm btn-outline-primary" href="edit.php?id=<?= $b['id'] ?>">Edit</a> |
          <a class="btn btn-sm btn-outline-danger" href="hapus.php?id=<?= $b['id'] ?>">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </table>
  </div>
</div>

<?php require __DIR__ . '/../_bawah.php'; ?>
