<?php

// Kelas Home yang merupakan turunan dari Controller
class Dashboard extends Controller {
    
    // Method index untuk menampilkan halaman utama (Home)
    public function index() {
        $data['judul'] = 'Dashboard'; // Menentukan judul halaman
        
        // Memanggil model User_model dan mengambil data pengguna
        // $data['nama'] = $this->model('User_model')->getUser();

        // Memanggil view dengan menyertakan template header, konten home, dan footer
        $this->view('templates/header', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer');
    }
}
