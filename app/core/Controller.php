<?php

// Kelas Controller sebagai parent untuk semua controller dalam sistem MVC
class Controller {
    
    // Method untuk memuat view
    public function view($view, $data = []) {
        // Memuat file view dari folder views sesuai dengan parameter $view
        require_once '../app/views/' . $view . '.php';
    }

    // Method untuk memuat model
    public function model($model) {
        // Memuat file model dari folder models sesuai dengan parameter $model
        require_once '../app/models/' . $model . '.php';
        return new $model; // Mengembalikan instance dari model yang dipanggil
    }
}

