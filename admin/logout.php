<?php
require __DIR__ . '/fungsi.php';
wajib_login();

// Keluar mengubah sesi, jadi hanya tombol dari formulir admin yang boleh memicunya.
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Allow: POST');
    http_response_code(405);
    exit;
}
cek_token();

// Hapus data sesi di server dan cookie dengan jalur yang sama di browser.
$_SESSION = [];
$cookie = session_get_cookie_params();
setcookie(session_name(), '', [
    'expires' => time() - 3600,
    'path' => $cookie['path'],
    'secure' => $cookie['secure'],
    'httponly' => $cookie['httponly'],
    'samesite' => $cookie['samesite'],
]);
session_destroy();

header('Location: ' . url_admin('login.php'));
exit;
