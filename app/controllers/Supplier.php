<?php

class Supplier extends Controller {
    public function index() {
        // Judul halaman
        $data['title'] = 'Data Supplier';

        // Memanggil model dan mengambil data supplier
        $data['suppliers'] = $this->model('Supplier_model')->getAllSuppliers();

        // Memanggil view
        $this->view('templates/header', $data);
        // $this->view('supplier/index', $data);
        $this->view('templates/footer');
    }
}
