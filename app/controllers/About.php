<?php

// Kelas About yang merupakan turunan dari Controller
class About extends Controller {
    
    // Method index untuk halaman About Me
    // Parameter default: nama, pekerjaan, dan umur jika tidak diberikan dalam URL
    public function index($nama = 'Mahmud Aripin', $pekerjaan = 'Mahasiswa', $umur = 20) {

        // Menyimpan data yang akan dikirim ke view
        $data['name'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;
        $data['judul'] = 'About Me'; // Judul halaman

        // Memanggil view dengan menyertakan template header, konten, dan footer
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }

    // Method page untuk menampilkan halaman lain dari About
    public function page() {
        $data['judul'] = 'Pages'; // Judul halaman

        // Memanggil view dengan menyertakan template header, konten, dan footer
        $this->view('templates/header', $data);
        $this->view('about/page');
        $this->view('templates/footer');
    }
}
