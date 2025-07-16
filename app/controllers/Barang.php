<?php

class Barang extends Controller {
    public function index() {
        $data['title'] = 'Barang';
        $data['barang'] = $this->model('Barang_model')->getAllBarang();
        $data['suppliers'] = $this->model('Supplier_model')->getAllSuppliers();

        $this->view('templates/header', $data);
        $this->view('barang/index', $data);
        $this->view('templates/footer');
    }

    public function tambah() {
        if ($this->model('Barang_model')->tambahDataBarang($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/barang');
        exit;
    }

    public function ubah() {
        if ($this->model('Barang_model')->ubahDataBarang($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
        }
        header('Location: ' . BASEURL . '/barang');
        exit;
    }

    public function getUbah() {
        header('Content-Type: application/json');
    
        if (!isset($_POST['id']) || empty($_POST['id'])) {
            echo json_encode(['error' => 'ID Barang tidak valid']);
            exit;
        }
    
        $id = intval($_POST['id']); // Konversi ke integer untuk keamanan
    
        $barang = $this->model('Barang_model')->getBarangById($id);
    
        if (!$barang) {
            echo json_encode(['error' => 'Data barang tidak ditemukan']);
            exit;
        }
    
        echo json_encode($barang);
    }
    
    public function hapus($id) {
        if ($this->model('Barang_model')->hapusDataBarang($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/barang');
        exit;
    }

}
