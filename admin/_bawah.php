<?php
// File ini hanya dipakai lewat halaman admin yang menyertakannya.
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(404);
    exit;
}

?>
        </div>
      </div>
    </main>
    <footer class="app-footer">Panel Admin NOAH</footer>
  </div>
  <script src="<?= e(url_admin('vendor/adminlte/adminlte.min.js')) ?>"></script>
</body>
</html>
