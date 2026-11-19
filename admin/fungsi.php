<?php
// Fungsi bantu yang dipakai semua halaman admin.
// Setiap halaman admin cukup menulis: require __DIR__ . '/fungsi.php';

session_start();
require_once __DIR__ . '/../koneksi.php';

/**
 * Lempar ke halaman login kalau belum login.
 * Panggil di baris paling atas setiap halaman admin (kecuali login.php).
 */
function wajib_login(): void
{
    if (empty($_SESSION['admin_id'])) {
        header('Location: ' . url_admin('login.php'));
        exit;
    }
}

/** Buat alamat lengkap ke file di dalam folder admin. */
function url_admin(string $file): string
{
    return admin_base() . '/' . $file;
}

/** Cari alamat folder admin dari alamat halaman yang sedang dibuka. */
function admin_base(): string
{
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);   // contoh: /noah/admin/berita/index.php
    $posisi = strrpos($script, '/admin/');
    return substr($script, 0, $posisi + strlen('/admin'));       // hasil:  /noah/admin
}

/** Singkatan htmlspecialchars. Wajib dipakai saat menampilkan data dari database. */
function e(?string $teks): string
{
    return htmlspecialchars($teks ?? '', ENT_QUOTES, 'UTF-8');
}

/**
 * Token CSRF: kode acak yang disimpan di session dan diselipkan di setiap form.
 * Tujuannya supaya form admin hanya bisa dikirim dari halaman admin sendiri,
 * bukan dari website lain yang memancing admin mengklik sesuatu.
 */
function input_token(): string
{
    if (empty($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(16));
    }
    return '<input type="hidden" name="token" value="' . $_SESSION['token'] . '">';
}

function cek_token(): void
{
    $token = $_POST['token'] ?? '';
    if (empty($_SESSION['token']) || !hash_equals($_SESSION['token'], $token)) {
        http_response_code(400);
        die('Form kedaluwarsa. Kembali dan coba kirim ulang.');
    }
}
