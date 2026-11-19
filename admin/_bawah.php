<?php
// File ini hanya dipakai lewat halaman admin yang menyertakannya.
if (realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === __FILE__) {
    http_response_code(404);
    exit;
}

?>
  </main>
</body>
</html>
