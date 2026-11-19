<?php
// File ini hanya dipakai lewat halaman admin yang menyertakannya.
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(404);
    exit;
}

// Form event. Dipakai oleh tambah.php dan edit.php.
// Sebelum include, siapkan: $data, $error, $tombol.
?>
<?php foreach ($error as $pesan_error) : ?>
  <p class="alert alert-danger" role="alert"><?= e($pesan_error) ?></p>
<?php endforeach; ?>

<form class="card card-body form-admin" method="post">
  <?= input_token() ?>

  <label class="form-label mt-3" for="jenis">Tampil di section</label>
  <select class="form-select" id="jenis" name="jenis" required>
    <option value="">Pilih section</option>
    <?php foreach (JENIS_EVENT as $nilai => $teks) : ?>
      <option value="<?= e($nilai) ?>" <?= $data['jenis'] === $nilai ? 'selected' : '' ?>><?= e($teks) ?></option>
    <?php endforeach; ?>
  </select>

  <label class="form-label mt-3" for="judul">Judul</label>
  <input class="form-control" id="judul" type="text" name="judul" maxlength="150" required value="<?= e($data['judul']) ?>">
  <p class="form-text mb-0">Untuk Konser Mendatang, isi dengan nama kota (contoh: Jakarta). Card konser menampilkan kolom Kota.</p>

  <label class="form-label mt-3" for="tanggal">Tanggal</label>
  <input class="form-control" id="tanggal" type="date" name="tanggal" value="<?= e($data['tanggal'] ?? '') ?>">
  <p class="form-text mb-0">Wajib untuk Konser Mendatang dan Event Komunitas. Boleh kosong untuk arsip yang hanya diketahui tahunnya.</p>

  <label class="form-label mt-3" for="kota">Kota</label>
  <input class="form-control" id="kota" type="text" name="kota" maxlength="255" value="<?= e($data['kota'] ?? '') ?>">
  <p class="form-text mb-0">Untuk Arsip Event, isi daftar kota yang dikunjungi, dipisah koma.</p>

  <label class="form-label mt-3" for="venue">Venue</label>
  <input class="form-control" id="venue" type="text" name="venue" maxlength="150" value="<?= e($data['venue'] ?? '') ?>">
  <p class="form-text mb-0">Hanya tampil untuk Konser Mendatang. Kosongkan untuk Arsip dan Event Komunitas.</p>

  <label class="form-label mt-3" for="deskripsi">Deskripsi</label>
  <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= e($data['deskripsi'] ?? '') ?></textarea>
  <p class="form-text mb-0">Boleh kosong untuk Arsip Event.</p>

  <label class="form-label mt-3" for="label">Label (badge kecil di card)</label>
  <input class="form-control" id="label" type="text" name="label" maxlength="50" value="<?= e($data['label'] ?? '') ?>">
  <p class="form-text mb-0">Contoh: Tersedia, TUR DUNIA, Gathnas 2024. Boleh kosong.</p>

  <div class="d-flex flex-wrap gap-2 mt-3">
    <button type="submit" class="btn btn-primary"><?= e($tombol) ?></button>
    <a class="btn btn-outline-secondary" href="index.php">Batal</a>
  </div>
</form>
