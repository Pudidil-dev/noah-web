<?php
// READ: daftar email dari form Berlangganan (beranda) dan Beritahu Saya (halaman Event).
require __DIR__ . '/../fungsi.php';
wajib_login();

$hasil = mysqli_query($koneksi, 'SELECT * FROM pelanggan_email ORDER BY waktu_daftar DESC');

$judul_halaman = 'Pelanggan Email';
require __DIR__ . '/../_atas.php';
?>

<p>Email yang mendaftar untuk kabar terbaru. Kolom "Asal Form" menunjukkan form mana yang dipakai.</p>

<?php if (mysqli_num_rows($hasil) == 0) { ?>
  <p>Belum ada pelanggan.</p>
<?php } ?>

<div class="card">
  <div class="table-responsive">
    <table class="table table-striped table-hover align-middle mb-0">
    <tr>
      <th>Waktu Daftar</th>
      <th>Email</th>
      <th>Asal Form</th>
      <th>Aksi</th>
    </tr>
    <?php while ($p = mysqli_fetch_assoc($hasil)) { ?>
      <tr>
        <td><?= e($p['waktu_daftar']) ?></td>
        <td><?= e($p['email']) ?></td>
        <td><?= e($p['asal_form']) ?></td>
        <td class="aksi"><a class="btn btn-sm btn-outline-danger" href="hapus.php?id=<?= $p['id'] ?>">Hapus</a></td>
      </tr>
    <?php } ?>
    </table>
  </div>
</div>

<?php require __DIR__ . '/../_bawah.php'; ?>
