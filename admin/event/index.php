<?php
// READ: tampilkan semua event, dikelompokkan per jenis.
require __DIR__ . '/../fungsi.php';
require __DIR__ . '/_data.php';
wajib_login();

// Urutkan per jenis dulu, lalu tanggal terbaru. Tanggal kosong (NULL) taruh di bawah.
$hasil = mysqli_query($koneksi, 'SELECT * FROM event ORDER BY jenis, tanggal IS NULL, tanggal DESC');

$judul_halaman = 'Event';
require __DIR__ . '/../_atas.php';
?>

<p><a class="btn btn-primary" href="tambah.php">+ Tambah Event</a></p>

<div class="card">
  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle mb-0">
    <tr>
      <th>Jenis</th>
      <th>Judul</th>
      <th>Tanggal</th>
      <th>Kota / Venue</th>
      <th>Label</th>
      <th>Aksi</th>
    </tr>
    <?php while ($ev = mysqli_fetch_assoc($hasil)) : ?>
      <tr>
        <td><?= e($ev['jenis']) ?></td>
        <td><?= e($ev['judul']) ?></td>
        <td><?= e($ev['tanggal'] ?? '-') ?></td>
        <td><?= e(trim(($ev['kota'] ?? '') . ' / ' . ($ev['venue'] ?? ''), ' /')) ?></td>
        <td><?= e($ev['label']) ?></td>
        <td class="aksi">
          <a class="btn btn-sm btn-outline-primary" href="edit.php?id=<?= $ev['id'] ?>">Edit</a> |
          <a class="btn btn-sm btn-outline-danger" href="hapus.php?id=<?= $ev['id'] ?>">Hapus</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </table>
  </div>
</div>

<?php require __DIR__ . '/../_bawah.php'; ?>
