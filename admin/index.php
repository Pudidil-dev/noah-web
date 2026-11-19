<?php
require __DIR__ . '/fungsi.php';

// Hentikan halaman sebelum menampilkan isi jika pengunjung belum login.
wajib_login();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Admin NOAH</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body class="halaman-login">
  <main class="kotak-login">
    <h1>Admin NOAH</h1>
    <p>Selamat datang, <?= e($_SESSION['admin_username']) ?>.</p>
    <a href="logout.php">Keluar</a>
  </main>
</body>
</html>
