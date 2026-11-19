<?php
require __DIR__ . '/fungsi.php';
wajib_login();

// Hitung jumlah baris tiap tabel untuk ringkasan di dashboard.
// Nama tabel ditulis langsung (bukan dari input pengguna), jadi aman tanpa prepared statement.
$tabel = [
    'berita'          => 'Berita',
    'event'           => 'Event',
    'kiriman_sahabat' => 'Kiriman Sahabat',
    'pemesanan_event' => 'Pemesanan Event',
    'pelanggan_email' => 'Pelanggan Email',
];

$jumlah = [];
foreach ($tabel as $nama => $label) {
    $hasil = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM $nama");
    $jumlah[$label] = mysqli_fetch_assoc($hasil)['total'];
}

// Kiriman yang belum diperiksa admin
$hasil_menunggu = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM kiriman_sahabat WHERE status = 'menunggu'");
$jumlah_menunggu = mysqli_fetch_assoc($hasil_menunggu)['total'];

$judul_halaman = 'Dashboard';
require __DIR__ . '/_atas.php';
?>

<p>Selamat datang, <?= e($_SESSION['admin_username']) ?>.</p>

<?php
// Nama kartu cocok dengan label pada hasil hitung di atas.
$kartu_admin = [
    'Berita'          => ['berita/index.php', 'text-bg-primary'],
    'Event'           => ['event/index.php', 'text-bg-success'],
    'Kiriman Sahabat' => ['kiriman/index.php', 'text-bg-warning'],
    'Pemesanan Event' => ['pemesanan/index.php', 'text-bg-info'],
    'Pelanggan Email' => ['pelanggan/index.php', 'text-bg-secondary'],
];
?>
<div class="row">
  <?php foreach ($kartu_admin as $label => [$tautan, $warna]) : ?>
    <div class="col-12 col-sm-6 col-xl-4">
      <div class="small-box <?= e($warna) ?>">
        <div class="inner">
          <h2 class="h3"><?= (int) $jumlah[$label] ?></h2>
          <p><?= e($label) ?></p>
        </div>
        <a class="small-box-footer" href="<?= e($tautan) ?>">Buka <?= e($label) ?> →</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?php if ($jumlah_menunggu > 0) : ?>
  <p class="alert alert-warning" role="status">
    <?= (int) $jumlah_menunggu ?> kiriman sahabat menunggu diperiksa.
    <a class="alert-link" href="kiriman/index.php">Periksa sekarang</a>
  </p>
<?php endif; ?>

<?php require __DIR__ . '/_bawah.php'; ?>
