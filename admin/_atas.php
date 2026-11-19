<?php
// File ini hanya dipakai lewat halaman admin yang menyertakannya.
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(404);
    exit;
}

// Kerangka AdminLTE dipakai oleh semua halaman setelah login.
// Sebelum include file ini, isi dulu variabel $judul_halaman.

// Kunci adalah folder bagian admin. Kunci kosong berarti dashboard di folder admin.
$menu_admin = [
    ''          => ['Dashboard', 'index.php'],
    'berita'    => ['Berita', 'berita/index.php'],
    'event'     => ['Event', 'event/index.php'],
    'produk'    => ['Produk Toko', 'produk/index.php'],
    'kiriman'   => ['Kiriman Sahabat', 'kiriman/index.php'],
    'pemesanan' => ['Pemesanan', 'pemesanan/index.php'],
    'pelanggan' => ['Pelanggan Email', 'pelanggan/index.php'],
];
$jalur_halaman = substr($_SERVER['SCRIPT_NAME'], strlen(admin_base()) + 1);
$bagian_aktif = str_contains($jalur_halaman, '/') ? explode('/', $jalur_halaman)[0] : '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($judul_halaman ?? 'Admin') ?> - Admin NOAH</title>
  <link rel="stylesheet" href="<?= e(url_admin('vendor/adminlte/adminlte.min.css')) ?>">
  <link rel="stylesheet" href="<?= e(url_admin('admin.css')) ?>">
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <div class="app-wrapper">
    <nav class="app-header navbar navbar-expand bg-body" aria-label="Menu atas">
      <div class="container-fluid gap-2">
        <button class="btn btn-outline-secondary btn-sm" type="button" data-lte-toggle="sidebar" aria-controls="menu-admin">
          Menu
        </button>
        <div class="d-flex flex-wrap align-items-center gap-2 ms-auto">
          <a class="btn btn-sm btn-outline-secondary" href="<?= e(url_admin('../index.php')) ?>">Lihat situs</a>
          <form method="post" action="<?= e(url_admin('logout.php')) ?>">
            <?= input_token() ?>
            <button type="submit" class="btn btn-sm btn-outline-danger">Keluar (<?= e($_SESSION['admin_username'] ?? '') ?>)</button>
          </form>
        </div>
      </div>
    </nav>

    <aside class="app-sidebar bg-body-secondary shadow" id="menu-admin" data-bs-theme="dark">
      <div class="sidebar-brand">
        <a class="brand-link" href="<?= e(url_admin('index.php')) ?>">
          <span class="brand-text fw-semibold">NOAH Admin</span>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <nav class="mt-2" aria-label="Navigasi admin">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview">
            <?php foreach ($menu_admin as $bagian => [$label, $file]) : ?>
              <li class="nav-item">
                <a class="nav-link<?= $bagian_aktif === $bagian ? ' active' : '' ?>" href="<?= e(url_admin($file)) ?>"<?php if ($bagian_aktif === $bagian) : ?> aria-current="true"<?php endif; ?>>
                  <p><?= e($label) ?></p>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </nav>
      </div>
    </aside>

    <main class="app-main">
      <div class="app-content-header">
        <div class="container-fluid">
          <h1 class="h3 mb-0"><?= e($judul_halaman ?? 'Admin') ?></h1>
        </div>
      </div>
      <div class="app-content pb-4">
        <div class="container-fluid">
          <?php $pesan = ambil_pesan(); if ($pesan !== '') : ?>
            <p class="alert alert-info" role="status"><?= e($pesan) ?></p>
          <?php endif; ?>
