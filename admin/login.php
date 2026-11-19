<?php
require __DIR__ . '/fungsi.php';

// Sudah login? Langsung ke dashboard.
if (!empty($_SESSION['admin_id'])) {
    header('Location: ' . url_admin('index.php'));
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cek_token();

    $username = trim(isi_form('username'));
    $password = isi_form('password');

    // 1. Cari admin berdasarkan username.
    $stmt = mysqli_prepare($koneksi, 'SELECT id, username, password FROM admin WHERE username = ?');
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $admin = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));

    // 2. Cocokkan password yang diketik dengan hash di database.
    if ($admin && password_verify($password, $admin['password'])) {
        // 3. Ganti ID session supaya session lama tidak bisa dipakai orang lain.
        session_regenerate_id(true);
        // Buang token login agar formulir admin mendapat token baru.
        $_SESSION = [];
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_username'] = $admin['username'];
        header('Location: ' . url_admin('index.php'));
        exit;
    }

    // Pesan sengaja sama untuk username salah maupun password salah,
    // supaya orang lain tidak bisa menebak username mana yang ada.
    $error = 'Username atau password salah.';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin NOAH</title>
  <link rel="stylesheet" href="vendor/adminlte/adminlte.min.css">
</head>
<body class="login-page bg-body-secondary">
  <main class="login-box">
    <div class="login-logo"><a href="../index.php"><b>NOAH</b> Admin</a></div>
    <div class="card">
      <div class="card-body login-card-body">
        <h1 class="h4 mb-3">Login Admin</h1>
        <?php if ($error !== '') : ?>
          <p class="alert alert-danger" role="alert"><?= e($error) ?></p>
        <?php endif; ?>

        <form method="post">
          <?= input_token() ?>
          <div class="mb-3">
            <label class="form-label" for="username">Username</label>
            <input class="form-control" id="username" name="username" type="text" autocomplete="username" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label" for="password">Password</label>
            <input class="form-control" id="password" name="password" type="password" autocomplete="current-password" required>
          </div>
          <button class="btn btn-primary w-100" type="submit">Masuk</button>
        </form>
      </div>
    </div>
  </main>
</body>
</html>
