<?php

// Kelas utama App yang berfungsi sebagai router utama dalam framework MVC
class App {
    protected $controller = 'Dashboard'; // Controller default jika tidak ada yang dipanggil
    protected $method = 'index'; // Method default jika tidak ada yang dipanggil
    protected $params = []; // Parameter default kosong

    // Constructor untuk menangani parsing URL dan menentukan controller, method, serta parameter
    public function __construct() {
        $url = $this->ParseUrl(); // Memproses URL

        // Mengecek apakah ada controller yang dipanggil dalam URL dan apakah file controller tersebut ada
        if (!empty($url) && file_exists('../app/controllers/' . $url[0] . '.php')) {
            $this->controller = $url[0]; // Mengatur controller sesuai dengan URL
            unset($url[0]); // Menghapus elemen pertama dari array URL karena sudah diproses
        }   

        // Memanggil file controller yang telah ditentukan
        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller; // Membuat instance dari controller

        // Mengecek apakah ada method yang dipanggil dalam URL
        if (isset($url[1])) {
            // Mengecek apakah method tersebut ada di dalam controller yang telah ditentukan
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1]; // Mengatur method sesuai dengan URL
                unset($url[1]); // Menghapus elemen kedua dari array URL karena sudah diproses
            }
        }

        // Menangani parameter jika ada
        if (!empty($url)) {
            $this->params = array_values($url); // Menyimpan sisa elemen dalam array sebagai parameter
        }

        // Jika request menggunakan metode POST dan method tersedia di controller
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1]; // Menyesuaikan method dengan URL
                unset($url[1]); // Hapus method dari URL
            }
        }

        // Menjalankan controller, method, dan parameter yang telah ditentukan
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // Method untuk memproses URL yang masuk
    public function ParseUrl() {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // Menghapus karakter '/' di akhir URL
            $url = filter_var($url, FILTER_SANITIZE_URL); // Membersihkan URL dari karakter berbahaya
            $url = explode('/', $url); // Memisahkan URL berdasarkan '/'
            return $url;
        }
    }
}
