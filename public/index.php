<?php

// Cek apakah sesi sudah dimulai, jika belum maka mulai sesi baru
if (!session_id()) session_start();

// Memasukkan file init.php yang berisi konfigurasi awal aplikasi
require_once '../app/init.php';

// Membuat instance dari class App untuk memulai aplikasi
$app = new App;
