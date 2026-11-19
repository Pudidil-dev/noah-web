<?php
// File ini hanya dipakai lewat halaman admin yang menyertakannya.
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(404);
    exit;
}

// Form berita. Dipakai oleh tambah.php (form kosong) dan edit.php (form berisi data lama).
// Sebelum include, siapkan: $data (array isi form), $error (array pesan), $tombol (teks tombol).
?>
<?php foreach ($error as $pesan_error) : ?>
  <p class="alert alert-danger" role="alert"><?= e($pesan_error) ?></p>
<?php endforeach; ?>

<!-- enctype wajib ada kalau form mengirim file -->
<form class="card card-body form-admin" method="post" enctype="multipart/form-data">
  <?= input_token() ?>

  <label class="form-label mt-3" for="judul">Judul</label>
  <input class="form-control" id="judul" type="text" name="judul" maxlength="200" required value="<?= e($data['judul']) ?>">

  <label class="form-label mt-3" for="kategori">Kategori</label>
  <select class="form-select" id="kategori" name="kategori" required>
    <option value="">Pilih kategori</option>
    <?php foreach (KATEGORI_BERITA as $kategori) : ?>
      <option value="<?= e($kategori) ?>" <?= $data['kategori'] === $kategori ? 'selected' : '' ?>>
        <?= e($kategori) ?>
      </option>
    <?php endforeach; ?>
  </select>

  <label class="form-label mt-3" for="ringkasan">Ringkasan</label>
  <textarea class="form-control" id="ringkasan" name="ringkasan" rows="4" required><?= e($data['ringkasan']) ?></textarea>

  <label class="form-label mt-3" for="tanggal_terbit">Tanggal terbit</label>
  <input class="form-control" id="tanggal_terbit" type="date" name="tanggal_terbit" required value="<?= e($data['tanggal_terbit']) ?>">

  <label class="form-label mt-3" for="gambar">Gambar</label>
  <?php if (!empty($data['gambar'])) : ?>
    <p class="form-text mb-0">Gambar sekarang: <?= e($data['gambar']) ?>. Pilih file baru hanya kalau ingin mengganti.</p>
  <?php endif; ?>
  <input class="form-control" id="gambar" type="file" name="gambar" accept="image/jpeg,image/png,image/webp">
  <p class="form-text mb-0">Opsional. JPG, PNG, atau WEBP, maksimal 2 MB.</p>

  <label class="form-check-label mt-3">
    <input class="form-check-input" type="checkbox" name="jadi_utama" value="1" <?= $data['jadi_utama'] ? 'checked' : '' ?>>
    Jadikan Artikel Utama di halaman Media (berita utama lama otomatis dilepas)
  </label>

  <div class="d-flex flex-wrap gap-2 mt-3">
    <button type="submit" class="btn btn-primary"><?= e($tombol) ?></button>
    <a class="btn btn-outline-secondary" href="index.php">Batal</a>
  </div>
</form>
