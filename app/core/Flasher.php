<?php

// Kelas Flasher untuk menampilkan notifikasi flash message
class Flasher {

  // Method untuk menyimpan pesan flash ke dalam session
  public static function setFlash($pesan, $aksi, $tipe) {
    $_SESSION['flash'] = [
      'pesan' => $pesan, // Isi pesan
      'aksi' => $aksi,   // Aksi yang dilakukan (misal: "ditambahkan", "dihapus", "diubah")
      'tipe' => $tipe    // Tipe alert (misal: "success", "danger", "warning")
    ];
  }

  // Method untuk menampilkan pesan flash di halaman
  public static function flash() {
    if (isset($_SESSION['flash'])) {
      echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
               Data Distribusi <strong>' . $_SESSION['flash']['pesan'] . '</strong> ' . $_SESSION['flash']['aksi'] . '
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
      // Menghapus pesan flash setelah ditampilkan agar tidak muncul kembali saat halaman direfresh
      unset($_SESSION['flash']);
    }
  }
}
