<?php
// Form ini dipakai bersama oleh tambah.php dan edit.php.
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(404);
    exit;
}
?>

<?php foreach ($error as $pesan_error) : ?>
  <p class="alert alert-danger" role="alert"><?= e($pesan_error) ?></p>
<?php endforeach; ?>

<form class="card card-body form-admin" method="post" enctype="multipart/form-data">
  <?= input_token() ?>
  <label class="form-label" for="nama_produk">Nama produk</label>
  <input class="form-control" id="nama_produk" name="nama_produk" maxlength="150" value="<?= e($data['nama_produk']) ?>" required>

  <label class="form-label mt-3" for="kategori">Kategori</label>
  <input class="form-control" id="kategori" name="kategori" maxlength="50" value="<?= e($data['kategori']) ?>" required>

  <label class="form-label mt-3" for="deskripsi">Deskripsi</label>
  <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" maxlength="2000" required><?= e($data['deskripsi']) ?></textarea>

  <label class="form-label mt-3" for="harga">Harga (rupiah)</label>
  <input class="form-control" id="harga" name="harga" type="number" min="1" max="2147483647" value="<?= e($data['harga']) ?>" required>

  <label class="form-label mt-3" for="gambar">Foto produk</label>
  <input class="form-control" id="gambar" name="gambar" type="file" accept="image/jpeg,image/png,image/webp" <?= $gambar_lama === '' ? 'required' : '' ?>>
  <p class="form-text mb-0">JPG, PNG, atau WEBP, maksimal 2 MB.</p>
  <?php if ($gambar_lama !== '') : ?>
    <p class="form-text mb-0">Kosongkan untuk memakai foto yang sekarang.</p>
  <?php endif; ?>

  <label class="form-label mt-3" for="stok">Stok (opsional)</label>
  <input class="form-control" id="stok" name="stok" type="number" min="0" max="2147483647" value="<?= e($data['stok']) ?>">
  <p class="form-text">Stok tampil untuk edisi terbatas. Isi 0 untuk menampilkan Habis.</p>

  <label class="form-check-label mb-2">
    <input class="form-check-input" type="checkbox" name="produk_baru" value="1" <?= $data['produk_baru'] ? 'checked' : '' ?>> Produk baru
  </label>
  <label class="form-check-label">
    <input class="form-check-input" type="checkbox" name="edisi_terbatas" value="1" <?= $data['edisi_terbatas'] ? 'checked' : '' ?>> Edisi terbatas
  </label>

  <div class="d-flex flex-wrap gap-2 mt-3">
    <button class="btn btn-primary" type="submit">Simpan</button>
    <a class="btn btn-outline-secondary" href="index.php">Batal</a>
  </div>
</form>
