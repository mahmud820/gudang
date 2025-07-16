<?php

class Distribusi extends Controller {

    public function index() {
        $data['title'] = 'Distribusi';
        $data['distribusi'] = $this->model('Distribusi_model')->getAllDistribusi();
        $data['barang'] = $this->model('Barang_model')->getAllBarang(); // Ambil daftar barang

        $this->view('templates/header', $data);
        // $this->view('distribusi/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if (empty($_POST)) {
            Flasher::setFlash('gagal', 'tidak ada data yang dikirim', 'danger');
            header('Location: ' . BASEURL . '/distribusi');
            exit;
        }
    
        $result = $this->model('Distribusi_model')->tambahDataDistribusi($_POST);
    
        if ($result > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        } elseif ($result == -1) {
            Flasher::setFlash('gagal', 'stok tidak mencukupi', 'warning');
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
        }
    
        header('Location: ' . BASEURL . '/distribusi');
        exit;
    }

    public function getUbah() {
        // Pastikan permintaan hanya dari AJAX
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405); // Method Not Allowed
            echo json_encode(['error' => 'Metode tidak diizinkan']);
            exit;
        }
    
        header('Content-Type: application/json');
    
        // Cek apakah ID dikirim dan valid
        if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'ID tidak valid']);
            exit;
        }
    
        $id = intval($_POST['id']);
    
        // Ambil data distribusi berdasarkan ID
        $distribusi = $this->model('Distribusi_model')->getDistribusiById($id);
    
        if (!$distribusi) {
            http_response_code(404); // Not Found
            echo json_encode(['error' => 'Data distribusi tidak ditemukan']);
            exit;
        }
    
        // Kirim response data dalam format JSON
        http_response_code(200); // OK
        echo json_encode($distribusi);
    }
    

    public function ubah() {
        // Validasi input jika diperlukan
        if (empty($_POST['id_distribusi']) || empty($_POST['jumlah']) || empty($_POST['tujuan']) || empty($_POST['tanggal_kirim']) || empty($_POST['status'])) {
            Flasher::setFlash('gagal', 'Data tidak lengkap', 'danger');
            header('Location: ' . BASEURL . '/distribusi');
            exit;
        }
    
        // Pastikan jumlah input adalah angka positif
        if ($_POST['jumlah'] <= 0) {
            Flasher::setFlash('gagal', 'Jumlah harus lebih dari 0', 'danger');
            header('Location: ' . BASEURL . '/distribusi');
            exit;
        }
    
        // Cek apakah perubahan berhasil
        $result = $this->model('Distribusi_model')->ubahDataDistribusi($_POST);
    
        if ($result === "Stok tidak mencukupi") {
            Flasher::setFlash('gagal', 'Stok tidak mencukupi', 'warning');
        } elseif ($result > 0) {
            Flasher::setFlash('berhasil', 'Data berhasil diubah', 'success');
        } else {
            Flasher::setFlash('gagal', 'Tidak ada perubahan data', 'primary');
        }
    
        header('Location: ' . BASEURL . '/distribusi');
        exit;
    }
    
    

    public function hapus($id) {
        if ($this->model('Distribusi_model')->hapusDataDistribusi($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/distribusi');
        exit;
    }
}
