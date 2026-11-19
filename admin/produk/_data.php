<?php
// File ini dipakai oleh halaman produk, bukan dibuka langsung.
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(404);
    exit;
}

/** Cari produk berdasarkan ID. Kembalikan null jika produknya sudah tidak ada. */
function cari_produk(mysqli $koneksi, int $id): ?array
{
    $stmt = mysqli_prepare($koneksi, 'SELECT * FROM produk WHERE id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    return mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
}

/** Baca form dan kembalikan data serta daftar kesalahan yang bisa ditampilkan. */
function baca_input_produk(): array
{
    $data = [
        'nama_produk' => trim(isi_form('nama_produk')),
        'kategori' => trim(isi_form('kategori')),
        'deskripsi' => trim(isi_form('deskripsi')),
        'harga' => trim(isi_form('harga')),
        'stok' => trim(isi_form('stok')),
        'produk_baru' => isi_form('produk_baru') === '1' ? 1 : 0,
        'edisi_terbatas' => isi_form('edisi_terbatas') === '1' ? 1 : 0,
    ];
    $error = [];

    if ($data['nama_produk'] === '' || mb_strlen($data['nama_produk']) > 150) {
        $error[] = 'Nama produk wajib diisi, maksimal 150 karakter.';
    }
    if ($data['kategori'] === '' || mb_strlen($data['kategori']) > 50) {
        $error[] = 'Kategori wajib diisi, maksimal 50 karakter.';
    }
    if ($data['deskripsi'] === '' || mb_strlen($data['deskripsi']) > 2000) {
        $error[] = 'Deskripsi wajib diisi, maksimal 2.000 karakter.';
    }

    // Batas atas mengikuti tipe INT di MySQL. Stok kosong disimpan sebagai NULL.
    $harga = filter_var($data['harga'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 2147483647]]);
    $stok = $data['stok'] === '' ? null : filter_var($data['stok'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 2147483647]]);
    if ($harga === false) {
        $error[] = 'Harga harus bilangan bulat positif, tanpa titik atau koma.';
    }
    if ($stok === false) {
        $error[] = 'Stok harus bilangan bulat nol atau lebih, atau dikosongkan.';
    }
    if (!$error) {
        $data['harga'] = $harga;
        $data['stok'] = $stok;
    }
    return [$data, $error];
}
